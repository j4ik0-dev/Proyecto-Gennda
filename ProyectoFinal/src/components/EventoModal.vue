<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-button color="medium" @click="handleCancel">Cancelar</ion-button>
        </ion-buttons>
        <ion-title>Nuevo Evento</ion-title>
        <ion-buttons slot="end">
          <ion-button :strong="true" @click="handleSave" :disabled="!eventoData.titulo">Guardar</ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-list :inset="true">
        <ion-item>
          <ion-input
            label="Título"
            label-placement="stacked"
            placeholder="Título del evento"
            v-model="eventoData.titulo"
          ></ion-input>
        </ion-item>
        
        <ion-item>
          <ion-label>Fecha</ion-label>
          <ion-datetime-button datetime="datetime-fecha"></ion-datetime-button>
        </ion-item>

        <ion-item>
          <ion-label>Hora</ion-label>
          <ion-datetime-button datetime="datetime-hora"></ion-datetime-button>
        </ion-item>

        <ion-item>
          <ion-select
            label="Categoría"
            placeholder="Seleccionar"
            v-model="eventoData.categoria_id"
          >
            <ion-select-option :value="null">Sin Categoría</ion-select-option>
            <ion-select-option
              v-for="cat in categories"
              :key="cat.id"
              :value="cat.id"
            >
              {{ cat.nombre }}
            </ion-select-option>
          </ion-select>
        </ion-item>

        <ion-item>
          <ion-input
            label="Gasto Estimado"
            label-placement="stacked"
            type="number"
            placeholder="$0.00"
            v-model="eventoData.gasto_estimado"
          ></ion-input>
        </ion-item>
        
        <ion-item>
          <ion-textarea
            label="Descripción"
            label-placement="stacked"
            placeholder="Añade una descripción..."
            :auto-grow="true"
            v-model="eventoData.descripcion"
          ></ion-textarea>
        </ion-item>
      </ion-list>
    </ion-content>

    <ion-modal :keep-contents-mounted="true">
      <ion-datetime
        id="datetime-fecha"
        presentation="date"
        v-model="fechaValue" 
      ></ion-datetime>
    </ion-modal>
    <ion-modal :keep-contents-mounted="true">
      <ion-datetime
        id="datetime-hora"
        presentation="time"
        v-model="horaValue"
      ></ion-datetime>
    </ion-modal>
    </ion-page>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue';
import {
  IonPage,
  IonHeader,
  IonToolbar,
  IonButtons,
  IonButton,
  IonTitle,
  IonContent,
  IonList,
  IonItem,
  IonInput,
  IonTextarea,
  IonSelect,
  IonSelectOption,
  IonLabel,
  IonDatetime,
  IonDatetimeButton,
  IonModal,
  modalController,
  loadingController,
  toastController
} from '@ionic/vue';
import axios from 'axios';

// --- Props ---
const props = defineProps({
  selectedDate: {
    type: String,
    required: true,
  },
  categories: {
    type: Array as () => Categoria[],
    default: () => [],
  },
});

interface Categoria {
  id: number;
  nombre: string;
  color: string;
}

// --- Configuración de API ---

// --- ¡¡¡AQUÍ ESTÁ EL CAMBIO!!! ---
// Se eliminó "/public" de la URL para que coincida con el Alias de Apache
const API_URL = 'http://127.0.0.1:8000/api'; // <-- ¡URL NUEVA Y CORRECTA!
// --- FIN DEL CAMBIO ---

const authToken = localStorage.getItem('auth_token');
const apiClient = axios.create({
  baseURL: API_URL,
  headers: {
    'Authorization': `Bearer ${authToken}`,
    'Accept': 'application/json'
  }
});

// --- LÓGICA DE HORA (CORREGIDA) ---

// Helper para formatear 'HH:mm' (hora local)
const getLocalTimeHHMM = (date: Date): string => {
  const hours = String(date.getHours()).padStart(2, '0');
  const minutes = String(date.getMinutes()).padStart(2, '0');
  return `${hours}:${minutes}`;
};

// 1. Tomamos la hora actual LOCAL (ej: 1:28 PM)
const now = new Date(); 

// 2. v-model para el picker de FECHA.
//    El formato correcto es 'YYYY-MM-DD'
//    props.selectedDate ya viene en este formato.
const fechaValue = ref(props.selectedDate);

// 3. v-model para el picker de HORA.
//    El formato correcto es 'HH:mm'
const horaValue = ref(getLocalTimeHHMM(now)); // <-- '13:28'

// 4. Datos que se enviarán a la API
const eventoData = ref({
  titulo: '',
  fecha: fechaValue.value,
  hora: horaValue.value,
  descripcion: '',
  gasto_estimado: null,
  categoria_id: null,
});

// --- FIN DE LÓGICA CORREGIDA ---


// --- Watchers para sincronizar los pickers con los datos ---
watch(fechaValue, (newVal) => {
  // Cuando el picker cambia, actualizamos los datos a enviar
  eventoData.value.fecha = newVal;
});

watch(horaValue, (newVal) => {
  // Cuando el picker cambia, actualizamos los datos a enviar
  eventoData.value.hora = newVal;
});


// --- Métodos del Modal ---

const handleCancel = () => {
  modalController.dismiss(null, 'cancel');
};

const handleSave = async () => {
  const loading = await loadingController.create({ message: 'Guardando...' });
  await loading.present();

  try {
    // eventoData.value ahora tiene { fecha: '2025-11-03', hora: '13:28' }
    const response = await apiClient.post('/eventos', eventoData.value);
    
    await loading.dismiss();
    modalController.dismiss(response.data, 'confirm');

  } catch (error: any) {
    await loading.dismiss();
    
    const toast = await toastController.create({
      message: 'Error al guardar. Revisa los campos.',
      duration: 3000,
      color: 'danger'
    });
    await toast.present();
    console.error('Error en API:', error.response?.data);
  }
};
</script>

<style scoped>
/* Estilos para que los inputs se vean bien */
ion-list {
  background: transparent;
}
ion-item {
  margin-bottom: 8px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}
</style>
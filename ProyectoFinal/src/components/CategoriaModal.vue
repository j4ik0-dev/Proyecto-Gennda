<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-button color="medium" @click="handleCancel">Cancelar</ion-button>
        </ion-buttons>
        <ion-title>Nueva Categoría</ion-title>
        <ion-buttons slot="end">
          <ion-button :strong="true" @click="handleSave" :disabled="!categoria.nombre">Guardar</ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-list :inset="true">
        <ion-item>
          <ion-input
            label="Nombre"
            label-placement="stacked"
            placeholder="Ej. Personal, Trabajo..."
            v-model="categoria.nombre"
          ></ion-input>
        </ion-item>
        
        <ion-item>
          <ion-input
            label="Color (Hex)"
            label-placement="stacked"
            placeholder="Ej. #A78BFA"
            v-model="categoria.color"
          ></ion-input>
        </ion-item>

        <ion-list-header>
          <ion-label>O elige uno rápido</ion-label>
        </ion-list-header>
        <div class="color-palette">
          <div
            v-for="color in colorPalette"
            :key="color"
            class="color-swatch"
            :style="{ backgroundColor: color }"
            :class="{ 'selected': categoria.color === color }"
            @click="categoria.color = color"
          ></div>
        </div>

      </ion-list>
    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
import { ref } from 'vue';
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
  IonLabel,
  IonListHeader,
  modalController,
  loadingController,
  toastController
} from '@ionic/vue';
import axios from 'axios';

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

// --- Estado del Formulario ---
const categoria = ref({
  nombre: '',
  color: '#A78BFA' // Un color por defecto
});

const colorPalette = ref([
  '#A78BFA', // Morado (default)
  '#FCA5A5', // Rojo
  '#FDBA74', // Naranja
  '#6EE7B7', // Verde
  '#60A5FA', // Azul
  '#F472B6', // Rosa
  '#C4B5FD', // Morado claro
  '#374151'  // Gris oscuro
]);

// --- Métodos del Modal ---

const handleCancel = () => {
  modalController.dismiss(null, 'cancel');
};

const handleSave = async () => {
  if (!categoria.value.nombre || !categoria.value.color) {
    const toast = await toastController.create({
      message: 'Debes ingresar un nombre y un color.',
      duration: 2000,
      color: 'warning'
    });
    await toast.present();
    return;
  }

  const loading = await loadingController.create({ message: 'Guardando...' });
  await loading.present();

  try {
    // Llamar a la API para crear la categoría
    const response = await apiClient.post('/categorias', categoria.value);
    
    await loading.dismiss();
    
    // Devolver la nueva categoría a Calendario.vue
    modalController.dismiss(response.data, 'confirm');

  } catch (error: any) {
    await loading.dismiss();
    
    const toast = await toastController.create({
      message: 'Error al guardar la categoría.',
      duration: 3000,
      color: 'danger'
    });
    await toast.present();
    console.error('Error en API:', error.response?.data);
  }
};
</script>

<style scoped>
ion-list {
  background: transparent;
}
ion-item {
  margin-bottom: 8px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}
.color-palette {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  padding: 12px 20px;
}
.color-swatch {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.2s ease;
  border: 3px solid transparent;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.color-swatch.selected {
  border-color: #ffffff; /* Un borde blanco para el seleccionado */
  transform: scale(1.1);
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
</style>
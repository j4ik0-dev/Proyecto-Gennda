<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-menu-button />
                </ion-buttons>
                <ion-title>Historial de finanzas</ion-title>
            </ion-toolbar>
        </ion-header>
       <ion-content :fullscreen="true">
      <ion-list>
        <ion-item
          v-for="(item, index) in historial"
          :key="index"
          class="historial-item"
        >
          <ion-avatar slot="start">
            <div class="avatar" :style="{ '--bg-color': item.color }"></div>
          </ion-avatar>
          <ion-label>
            <h2>{{ item.fecha }}</h2>
            <p><strong>{{ item.usuario }}</strong> {{ item.detalle }}</p>
            <p class="descripcion">{{ item.descripción }}</p>
          </ion-label>
        </ion-item>
      </ion-list>
    </ion-content>
  </ion-page>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import {
  IonPage,
  IonHeader,
  IonToolbar,
  IonTitle,
  IonContent,
  IonList,
  IonItem,
  IonAvatar,
  IonLabel
} from '@ionic/vue'

interface HistorialItem {
  fecha: string
  usuario: string
  detalle: string
  descripción: string
  color: string
}

const historial = ref<HistorialItem[]>([
  {
    fecha: '2025-09-30',
    usuario: 'Ana López',
    detalle: 'Pago recibido',
    descripción: 'Pago vía tarjeta de crédito',
    color: '#4CAF50'
  },
  {
    fecha: '2025-09-29',
    usuario: 'Carlos Mendoza',
    detalle: 'Solicitud procesada',
    descripción: 'Documento verificado',
    color: '#2196F3'
  }
])
</script>

<style scoped>
.historial-item {
  --padding-start: 16px;
  --padding-end: 16px;
}

.avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: var(--bg-color);
}

.descripcion {
  color: var(--ion-color-medium, #999);
  font-size: 0.875rem;
  margin-top: 4px;
}

ion-label h2 {
  font-size: 0.95rem;
  margin-bottom: 4px;
}

ion-label p {
  margin: 0;
  font-size: 0.875rem;
}
</style>
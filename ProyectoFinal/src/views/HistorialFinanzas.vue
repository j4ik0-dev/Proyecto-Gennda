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
      <ion-content :fullscreen="true" id="content">
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
            <h1>{{ item.fecha }}</h1>
            <p><strong>{{ item.usuario }}</strong> {{ item.detalle }}</p>
            <p class="descripcion">{{ item.descripción }}</p>
          </ion-label>
        </ion-item>
      </ion-list>
    </ion-content>
    <ion-footer>
      <ion-toolbar>
        <p>© 2025 Gennda - Todos los derechos reservados</p>
      </ion-toolbar>
    </ion-footer>
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
  IonLabel,
  IonFooter,
  IonButtons,
  IonMenuButton
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
    usuario: 'Jefferson',
    detalle: 'Pago Realizado',
    descripción: 'Pago vía tarjeta de crédito',
    color: '#4CAF50'
  },
  {
    fecha: '2025-09-29',
    usuario: 'Jefferson',
    detalle: 'Pago Realizado',
    descripción: 'Mensualidad de suscripción cobrada spotify',
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
  color: var(--ion-color-medium, #030303);
  font-size: 0.875rem;
  margin-top: 4px;
}

ion-label h1 {
  font-size: 0.95rem;
  margin-bottom: 4px;
}

ion-label p {
  margin: 0;
  font-size: 0.875rem;
}
ion-footer ion-toolbar {
  text-align: center;
}

ion-footer p {
  margin: 10px 0;
  font-size: 0.875rem;
  color: #666;
}
</style>
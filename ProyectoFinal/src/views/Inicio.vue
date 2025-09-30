<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-menu-button/>
        </ion-buttons>
          <ion-title>Inicio</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content>
      <h1>Pagina de inicio</h1>


      <h1>
        Bienvenido a la aplicación de ejemplo con Ionic y Vue.js
      </h1>
    </ion-content>
    <ion-footer>
      <ion-toolbar>
        <p>Pie de página</p>
      </ion-toolbar>
    </ion-footer>
  </ion-page>
</template>
<script setup lang="ts">
import {IonPage, IonFooter, IonContent, IonButtons, IonHeader, IonToolbar, IonMenuButton, IonTitle,} from '@ionic/vue';

</script>
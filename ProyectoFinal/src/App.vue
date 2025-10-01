<template>
  <ion-app>
    <ion-menu content-id="main-content">
      <ion-header>
        <ion-toolbar>
          <ion-title>Menú</ion-title>
        </ion-toolbar>
      </ion-header>
      <ion-content>
        <ion-list>
          <ion-item router-link="/">Inicio</ion-item>
          <ion-item router-link="/historial">Historial</ion-item>
          <ion-item router-link="/login">Iniciar sesion</ion-item>
          <ion-item router-link="/calendario">Calendario</ion-item>
          <ion-item router-link="/historial">Historial Finanzas</ion-item>
          <ion-item router-link="/politica">politica</ion-item>
        </ion-list>
      </ion-content>
    </ion-menu>
    <div class="ion-page" id="main-content">
      <ion-router-outlet />
    </div>
    <ion-router-outlet />
  </ion-app>
</template>

<script setup lang="ts">
import {IonApp, IonContent, IonList, IonHeader, IonToolbar, IonTitle, IonMenu, IonItem, IonRouterOutlet } from '@ionic/vue';
</script>
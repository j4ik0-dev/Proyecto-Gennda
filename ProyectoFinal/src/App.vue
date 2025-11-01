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
          <ion-item router-link="/perfil">Perfil</ion-item>
          <ion-item router-link="/calendario">Calendario</ion-item>
          <ion-item router-link="/finanzas">Finanzas</ion-item>
          <ion-item router-link="/historial">Historial Finanzas</ion-item>
          <ion-item router-link="/politica">Politica</ion-item>
          <ion-item router-link="/ayuda-soporte">Ayuda y Soporte</ion-item>
        </ion-list>
      </ion-content>
    </ion-menu>
    <div class="ion-page" id="main-content">
          <ion-router-outlet />
    </div>
  </ion-app>
</template>

<script setup lang="ts">
import {IonApp, IonContent, IonList, IonHeader, IonToolbar, IonTitle, IonMenu, IonItem, IonRouterOutlet } from '@ionic/vue';
</script>
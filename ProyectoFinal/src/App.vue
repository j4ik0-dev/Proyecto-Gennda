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
          <ion-item router-link="/inicio">Inicio</ion-item>
          <ion-item router-link="/perfil">Perfil</ion-item>
          <ion-item router-link="/pagina1">Pagina 1</ion-item>
          <ion-item router-link="/pagina2">Pagina 2</ion-item>
          <ion-item router-link="/pagina3">Pagina 3</ion-item>
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
import {IonMenu, IonItem, IonRouterOutlet } from '@ionic/vue';
</script>
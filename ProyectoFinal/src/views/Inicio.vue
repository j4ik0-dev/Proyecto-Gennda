<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Gennda</ion-title>
        <ion-buttons slot="end">
          <ion-button shape="round" color="primary">Iniciar Sesion</ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>
    <ion-content>
      <div class="inicio-container">
        <div class="subcontainer">
          <div class="central-box">
            <img class="logo-inicio" src="/logo.png" alt="logo">
            <h1>Bienvenido a gennda</h1>
            <p>La mejor solución para tu organizacion</p>
            <ion-button shape="round" size="default" color="primary">Registrase</ion-button>
          </div>
        </div>
      </div>
    </ion-content>
    <ion-footer>
      <ion-toolbar>
        <p>Pie de página</p>
      </ion-toolbar>
    </ion-footer>
  </ion-page>
</template>
<script setup lang="ts">
import { IonPage, IonButton, IonFooter, IonContent, IonButtons, IonHeader, IonToolbar, IonMenuButton, IonTitle, } from '@ionic/vue';
</script>
<style socoped>
.subcontainer {
  display: flex;
  width: 100%;
  align-items: center;
  justify-content: center;
  height: 100%;

}

.inicio-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
  border: #e5aa62;
  width: 100%;
}

.central-box {
  padding: 40px;
  border-radius: 20px;
  text-align: center;
  background: linear-gradient(to bottom right, #63c8da, #8adfee, #c262e5);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
  width: 100rem;
  height: 90%;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.central-box h1 {
  margin: 0;
}

.central-box p {
  margin: 0;
}
.logo-inicio{
  
  width: 150px;
  height: 150px;
}
</style>
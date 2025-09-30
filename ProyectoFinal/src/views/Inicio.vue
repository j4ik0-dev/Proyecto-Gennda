<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Gennda</ion-title>
        <ion-buttons id="iniciar-sesion" slot="end">
          <ion-button>Iniciar Sesion</ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>
    <ion-content>
      <div class="inicio-container">
        <div class="subcontainer">
          <div class="central-box">
            <div cass="sub-logo">
              <img class="logo-inicio" src="/logo.png" alt="logo"></img>
            </div>
            <h1>Bienvenido a gennda</h1>
            <p>La mejor solución para tu organizacion</p>
            <ion-button id="boton-registro" size="default">Registrase</ion-button>
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
  width: 100%;
}

.central-box {
  padding: 40px;
  border-radius: 20px;
  text-align: center;
  background: linear-gradient(to bottom right, #b488e9, #eb94d7, #d181ef);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
  width: 100rem;
  height: 85%;
  display: flex;
  flex-direction: column;
  gap: 20px;
  margin: 40px;
}

.central-box h1 {
  margin: 0;
}

.central-box p {
  margin: 0;
}

.logo-inicio {
  width: 150px;
  height: 150px;
}
.sub-logo{
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
}
#iniciar-sesion{
  width: 150px;
  margin-right: 10px;
  text-align: center;
}
#boton-registro{
  width: 150px;
  align-self: center;
  margin-top: 20px;
  color: white;

}
</style>
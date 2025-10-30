<template>
<div>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Gennda</ion-title>
            <ion-button id="boton-sesion" slot="end" @click="$router.push('/login')">Iniciar Sesion</ion-button>
      </ion-toolbar>
    </ion-header>
    <ion-content>
      <div class="inicio-container">
        <div class="subcontainer">
          <div class="central-box">
            <div cass="sub-logo">
              <img class="logo-inicio" src="/logo.png" alt="logo"></img>
            </div>
            <h1>Bienvenido a Gennda</h1>
            <p>La mejor solución para tu organizacion</p>
            <router-link to="/registro">
              <ion-button id="boton-registro" size="default">Registrase</ion-button>
            </router-link>
            
          </div>
        </div>
      </div>
    </ion-content>
    <ion-footer>
      <ion-toolbar>
        <p>© 2025 Gennda - Todos los derechos reservados</p>
      </ion-toolbar>
    </ion-footer>
  </ion-page>
  </div>
</template>
<script setup lang="ts">
import { IonButtons,IonPage, IonButton, IonFooter, IonContent, IonHeader, IonToolbar, IonMenuButton, IonTitle, } from '@ionic/vue';
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
ion-title{
  color: black;
}
.central-box {
  padding: 40px;
  border-radius: 20px;
  text-align: center;
  background: linear-gradient(to bottom right, #c2aadf, #e8bcde, #dca8ef);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
  width: 80%;
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
#boton-registro{
  width: 150px;
  align-self: center;
  margin-top: 20px;
  color: white;
}
#boton-sesion{
  margin-right: 10px;
  --color: #ffffff;
  color: #ffffff;
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
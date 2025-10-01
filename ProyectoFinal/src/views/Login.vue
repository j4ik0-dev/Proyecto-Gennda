<template>
    <ion-page>
        <ion-header>
        </ion-header>
        <ion-content class="login-container">
            <div class="subcontainer">
                <div class="login-box">
                    <h1>Iniciar Sesion</h1>
                    <div class="sub-logo">
                        <img class="logo" src="/logo.png" alt="logo" />
                    </div>
                    <ion-item>
                        <ion-label position="floating">Correo</ion-label>
                        <ion-input type="email"></ion-input>
                    </ion-item>
                    <ion-item>
                        <ion-label position="floating">Contraseña</ion-label>
                        <ion-input type="password"></ion-input>
                    </ion-item>
                    <div class="boton-login">
                        <ion-button expand="block" color="primary">
                        Iniciar Sesión
                    </ion-button>
                    </div>
                    <p class="register-text">
                        ¿No tienes cuenta?
                        <a href="#">Regístrate</a>
                    </p>
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
import { IonPage, IonContent, IonLabel, IonInput, IonItem, IonButton, IonHeader, IonToolbar, IonMenuButton, IonTitle, } from '@ionic/vue';

</script>
<style scoped>
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-box {
    background: #ffffff;
    padding: 30px;
    border-radius: 20px;
    width: 90%;
    max-width: 400px;
    text-align: center;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
    margin-bottom: 20px;
}

.sub-logo {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.logo {
    width: 100px;
    height: 100px;
    margin-bottom: 20px;
    margin-top: 20px;

}

.register-text {
    margin-top: 10px;
    font-size: 14px;
}

.register-text a {
    color: #30399b;
    text-decoration: none;
    font-weight: bold;
}

.register-text a:hover {
    text-decoration: underline;
}

.subcontainer {
    display: flex;
    width: 100%;
    align-items: center;
    justify-content: center;
}

.login-box ion-item {
    --background: transparent;
    --ion-item-background: transparent;
    border: none;
    box-shadow: none;
}
.boton-login{
    margin-top: 20px;
    justify-content: center;
}
</style>
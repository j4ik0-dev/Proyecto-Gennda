<template>
    <ion-page>
        <ion-header>
        </ion-header>
        <ion-content class="login-container">
            <div class="subcontainer">
                <div class="login-box">
                    <h1>Registro</h1>
                    <div class="sub-logo">
                        <img class="logo" src="/logo2.png" alt="logo" />
                    </div>
                    <ion-item>
                        <ion-label position="floating">Nombre</ion-label>
                        <ion-input type="text"></ion-input>
                    </ion-item>
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
                            Registrarse
                        </ion-button>
                    </div>
                    <p class="register-text">
                        ¿Ya tienes cuenta?
                        <router-link to="/login">Inicia sesion</router-link>
                    </p>
                </div>
            </div>
        </ion-content>
        <ion-footer>
            <ion-toolbar>
                <p>© 2025 Gennda - Todos los derechos reservados</p>
            </ion-toolbar>
        </ion-footer>
    </ion-page>
</template>
<script setup lang="ts">
import { IonPage, IonFooter, IonContent, IonLabel, IonInput, IonItem, IonButton, IonHeader, IonToolbar, IonMenuButton, IonTitle, } from '@ionic/vue';

</script>
// ...existing code...
<style scoped>
:root {
    --card-max-width: 420px;
    --card-padding: 28px;
    --gap: 18px;
}

/* Contenedor centrado y adaptable */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: calc(100vh - 80px);
    /* deja espacio para header/footer */
    padding: 20px;
    box-sizing: border-box;
}

/* Card principal */
.login-box {
    background: #ffffff;
    padding: var(--card-padding);
    border-radius: 20px;
    width: min(92%, var(--card-max-width));
    max-width: var(--card-max-width);
    text-align: center;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    display: flex;
    flex-direction: column;
    gap: var(--gap);
    margin: 20px 0;
}

/* Logo adaptable */
.sub-logo {
    display: flex;
    justify-content: center;
    margin-top: 8px;
}

.logo {
    width: clamp(100px, 32vw, 150px);
    height: auto;
    object-fit: contain;
    margin: 8px 0 4px;
}

/* Inputs y items Ionic ocupan todo el ancho del card */
.login-box ion-item {
    --background: transparent;
    --ion-item-background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    /* Aumenta el padding interno para que los inputs no queden pegados a los lados */
    --padding-start: 12px;
    --padding-end: 12px;
    padding-inline: 6px;
    box-sizing: border-box;
}

/* Botón ocupa todo el ancho en pantallas pequeñas y mantiene margen */
.boton-login {
    margin-top: 8px;
    display: flex;
    justify-content: center;
}

.boton-login ion-button {
    width: 100%;
    max-width: 320px;
}

/* Texto de registro */
.register-text {
    margin-top: 6px;
    font-size: 0.95rem;
}

.register-text a {
    color: #30399b;
    text-decoration: none;
    font-weight: 600;
}

.register-text a:hover {
    text-decoration: underline;
}

/* Footer */
ion-footer ion-toolbar {
    text-align: center;
}

ion-footer p {
    margin: 10px 0;
    font-size: 0.85rem;
    color: #666;
}

/* Ajustes por breakpoints */
@media (min-width: 600px) {
    :root {
        --card-padding: 34px;
        --gap: 20px;
    }

    .login-box {
        width: min(80%, 420px);
    }

    .register-text {
        font-size: 0.98rem;
    }
}

@media (min-width: 1000px) {
    :root {
        --card-padding: 36px;
        --gap: 22px;
    }

    .login-box {
        width: 420px;
        margin-top: 40px;
        margin-bottom: 40px;
    }

    .logo {
        width: 150px;
    }
}

/* Accesibilidad: tamaños y foco */
ion-input,
ion-button {
    font-size: 0.95rem;
}

ion-input:focus,
ion-button:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(48, 57, 155, 0.12);
}
</style>
// ...existing code...
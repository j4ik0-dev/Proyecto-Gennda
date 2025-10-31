<template>
    <ion-page>
        <ion-header>
        </ion-header>
        <ion-content class="login-container">
            <div class="subcontainer">
                <div class="login-box">
                    <div class="sub-logo">
                        <img class="logo" src="/logo2.png" alt="logo" />
                    </div>
                    <ion-item>
                        <ion-label position="floating">Correo</ion-label>
                        <ion-input type="email" v-model="formData.email"></ion-input>
                    </ion-item>
                    <ion-item>
                        <ion-label position="floating">Contraseña</ion-label>
                        <ion-input type="password" v-model="formData.password"></ion-input>
                    </ion-item>
                    <div class="boton-login">
                        <ion-button expand="block" color="primary" @click="handleLogin">
                            Iniciar Sesión
                        </ion-button>
                    </div>
                    <p class="register-text">
                        ¿No tienes cuenta?
                        <router-link to="/registro">Regístrate</router-link>
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
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { IonPage, IonFooter, IonContent, IonLabel, IonInput, IonItem, IonButton, IonHeader, IonToolbar, toastController // Importamos toastController
} from '@ionic/vue';
import axios from 'axios';

const formData = ref({
    email: '',
    password: ''
});

const router = useRouter();

const API_URL = 'http://127.0.0.1:8000/api';

const presentToast = async (message: string, color: 'success' | 'danger') => {
    const toast = await toastController.create({
        message: message,
        duration: 3000,
        position: 'top',
        color: color,
    });
    await toast.present();
};

const handleLogin = async () => {
    if (!formData.value.email || !formData.value.password) {
        presentToast('Por favor, ingresa correo y contraseña', 'danger');
        return;

    }

    try {
        const response = await axios.post(`${API_URL}/login`, formData.value);
        if (response.status === 200 && response.data.access_token) {
            console.log('Login exitoso:', response.data);

            localStorage.setItem('auth_token', response.data.access_token);
            localStorage.setItem('user_data', JSON.stringify(response.data.user));
            axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.access_token}`;

            presentToast(`¡Bienvenido, ${response.data.user.nombre}!`, 'success');
            router.push('/calendario');
        }
    } catch (error: any) {
        console.error('Error en el login:', error);

        if (error.response && (error.response.status === 401 || error.response.status === 422)) {
            presentToast('Correo o contraseña incorrectos.', 'danger');
        } else {
            presentToast('No se pudo iniciar sesión. Intenta más tarde.', 'danger');
        }
    }
};
</script>
<style scoped>
:root {
    --card-max-width: 420px;
    --card-padding: 28px;
    --gap: 18px;
}

.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: calc(100vh - 80px);
    padding: 20px;
    box-sizing: border-box;
}

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
    box-sizing: border-box;
}

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

.login-box ion-item {
    --background: transparent;
    --ion-item-background: transparent;
    border: none;
    box-shadow: none;
    width: 100%;
    --padding-start: 12px;
    --padding-end: 12px;
    padding-inline: 8px;
    box-sizing: border-box;
}

.boton-login {
    margin-top: 8px;
    display: flex;
    justify-content: center;
}

.boton-login ion-button {
    width: 100%;
    max-width: 320px;
}

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

ion-footer ion-toolbar {
    text-align: center;
}

ion-footer p {
    margin: 10px 0;
    font-size: 0.85rem;
    color: #666;
}

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
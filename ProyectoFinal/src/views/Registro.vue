<template>
    <ion-page>
        <ion-header>
        </ion-header>
        <!-- CLASE ELIMINADA DE AQUÍ -->
        <ion-content>
            <div class="subcontainer">
                <div class="login-box">
                    <div class="sub-logo">
                        <img class="logo" src="/logo2.png" alt="logo" />
                    </div>
                    <ion-item>
                        <ion-label position="floating">Nombre</ion-label>
                        <ion-input type="text" v-model="formData.nombre"></ion-input>
                    </ion-item>
                    <ion-item>
                        <ion-label position="floating">Correo</ion-label>
                        <ion-input type="email" v-model="formData.email"></ion-input>
                    </ion-item>
                    <ion-item>
                        <ion-label position="floating">Contraseña</ion-label>
                        <ion-input type="password" v-model="formData.password"></ion-input>
                    </ion-item>
                    <ion-item>
                        <ion-label position="floating">Confirmar Contraseña</ion-label>
                        <ion-input type="password" v-model="formData.password_confirmation"></ion-input>
                    </ion-item>

                    <div class="boton-login">
                        <!-- ICONO AÑADIDO AQUÍ -->
                        <ion-button expand="block" color="primary" @click="handleRegister">
                            <ion-icon slot="start" :icon="personAddOutline"></ion-icon>
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
import { ref } from 'vue';
import { useRouter } from 'vue-router';
// IMPORTADO IonIcon
import { IonPage, IonFooter, IonContent, IonLabel, IonInput, IonItem, IonButton, IonHeader, IonToolbar, toastController, IonIcon
} from '@ionic/vue';
import axios from 'axios';
// IMPORTADO el icono
import { personAddOutline } from 'ionicons/icons';

const formData = ref({
    nombre: '',
    email: '',
    password: '',
    password_confirmation: ''
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

const handleRegister = async () => {
    if (formData.value.password !== formData.value.password_confirmation) {
        presentToast('Las contraseñas no coinciden', 'danger');
        return;
    }
    try {
        const response = await axios.post(`${API_URL}/register`, formData.value);
        if (response.status === 201) {
            console.log('Registro exitoso:', response.data);
            presentToast('¡Registro exitoso! Ahora puedes iniciar sesión.', 'success');
            router.push('/login');
        }
    } catch (error: any) {
        console.error('Error en el registro:', error);
        if (error.response && error.response.status === 422) {
            const errors = error.response.data.errors;
            let errorMessage = 'Error de validación:';
            for (const key in errors) {
                errorMessage += `\n- ${errors[key][0]}`;
            }
            presentToast(errorMessage, 'danger');
        } else {
            presentToast('No se pudo completar el registro. Intenta más tarde.', 'danger');
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

/* REGLA ELIMINADA: .login-container */

/* ESTA REGLA FUE MODIFICADA PARA CENTRAR TODO */
.subcontainer {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%; /* <-- Clave para centrar verticalmente */
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
    padding-inline: 6px;
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

/* CSS AÑADIDO PARA EL ICONO */
.boton-login ion-icon {
    margin-right: 6px;
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

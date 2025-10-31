<template>
        <ion-page>
            <ion-header>
                <ion-toolbar>
                    <ion-buttons slot="start">
                        <ion-menu-button></ion-menu-button>
                    </ion-buttons>
                    <ion-title>Mi Perfil</ion-title>
                </ion-toolbar>
            </ion-header>
            <ion-content :fullscreen="true" class="ion-padding">
                <div class="profile-card" v-if="user">
                    <div class="avatar-container" @click="triggerFileInput">
                        <ion-avatar>
                            <img :src="user.foto_url" alt="Foto de perfil" />
                        </ion-avatar>
                        <div class="edit-icon">
                            <ion-icon :icon="camera"></ion-icon>
                        </div>
                    </div>
                    <input type="file" @change="onFileChange" ref="fileInput" accept="image/png, image/jpeg" hidden />
                    <div class="user-info-container">
                        <div class="info-field">
                            <label>Nombre</label>
                            <p>{{ user.nombre }}</p>
                        </div>
                        <div class="info-field">
                            <label>Correo Electrónico</label>
                            <p>{{ user.email }}</p>
                        </div>
                    </div>
                    <ion-button @click="handleLogout" color="danger" expand="block" class="logout-button">
                        Cerrar Sesión
                        <ion-icon slot="end" :icon="logOutOutline"></ion-icon>
                    </ion-button>
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
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { IonPage, IonHeader, IonToolbar, IonTitle, IonContent, IonFooter,IonAvatar, IonButton, IonButtons, IonList, IonItem, IonLabel,IonIcon, IonMenuButton, loadingController, toastController
} from '@ionic/vue';
import { camera, logOutOutline } from 'ionicons/icons';
import axios from 'axios';

const router = useRouter();
const user = ref<any>(null);
const fileInput = ref<HTMLInputElement | null>(null);

const API_URL = 'http://127.0.0.1:8000/api';

onMounted(() => {
    loadUserData();
});

const loadUserData = () => {
    const userDataString = localStorage.getItem('user_data');
    if (userDataString) {
        user.value = JSON.parse(userDataString);
    } else {
        handleLogout(false);
    }
};

const triggerFileInput = () => {
    fileInput.value?.click();
};

const onFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    const file = target.files?.[0];
    if (file) {
        uploadPhoto(file);
    }
};

const uploadPhoto = async (file: File) => {
    const loading = await loadingController.create({ message: 'Subiendo foto...' });
    await loading.present();

    const formData = new FormData();
    formData.append('foto', file);

    try {
        const token = localStorage.getItem('auth_token');
        if (!token) {
            presentToast('Error de autenticación', 'danger');
            return;
        }

        const response = await axios.post(`${API_URL}/perfil/foto`, formData, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'multipart/form-data',
            }
        });

        user.value = response.data;
        localStorage.setItem('user_data', JSON.stringify(response.data));
        presentToast('Foto de perfil actualizada', 'success');

    } catch (error: any) {
        console.error('Error al subir la foto:', error);
        let msg = 'No se pudo subir la foto.';
        if (error.response?.status === 422) {
            msg = 'Archivo no válido. (Debe ser imagen, max 2MB)';
        }
        presentToast(msg, 'danger');
    } finally {
        await loading.dismiss();
    }
};

const handleLogout = async (showLoading = true) => {
    let loading;
    if (showLoading) {
        loading = await loadingController.create({ message: 'Cerrando sesión...' });
        await loading.present();
    }

    const token = localStorage.getItem('auth_token');

    try {
        if (token) {
            await axios.post(`${API_URL}/logout`, {}, {
                headers: { 'Authorization': `Bearer ${token}` }
            });
        }
    } catch (error) {
        console.error('Error en el logout de la API (no importa):', error);
    } finally {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user_data');
        delete axios.defaults.headers.common['Authorization'];

        if (loading) {
            await loading.dismiss();
        }
        
        router.replace('/login');
    }
};

const presentToast = async (message: string, color: 'success' | 'danger') => {
    const toast = await toastController.create({
        message: message,
        duration: 3000,
        position: 'top',
        color: color,
    });
    await toast.present();
};
</script>

<style scoped>
.profile-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    padding: 24px;
    width: 100%;
    max-width: 500px; 
    margin: 20px auto; 
}
.avatar-container {
    position: relative;
    cursor: pointer;
    margin-bottom: 10px;
    margin-top: 10px;
}
ion-avatar {
    width: 120px;
    height: 120px;
    border: 4px solid var(--ion-color-primary, #3880ff);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
.edit-icon {
    position: absolute;
    bottom: 5px;
    right: 5px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    border: 1px solid #ddd;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.edit-icon ion-icon {
    color: var(--ion-color-primary, #3880ff);
    font-size: 18px;
}
h2 {
    font-size: 1.8rem;
    font-weight: 600;
    margin: 0;
    color: #000;
}
.email-text {
    font-size: 1rem;
    color: #666;
    margin-bottom: 20px;
}
.logout-button {
    margin-top: 20px;
    width: 100%;
}
.user-info-container {
    width: 100%;
    margin: 20px 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.info-field {
    background-color: #f9f9f9;
    border: 1px solid #ebebeb;
    border-radius: 10px;
    padding: 12px 16px;
    width: 100%;
    text-align: left;
}

.info-field label {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    margin-bottom: 2px;
}

.info-field p {
    font-size: 1rem;
    color: #000;
    margin: 0;
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



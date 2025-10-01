
<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-menu-button />
                </ion-buttons>
                <ion-title>Ayuda y Soporte</ion-title>
            </ion-toolbar>
        </ion-header>
        <ion-content class="ion-padding">
            <div class="ayuda-container">
                <!-- Sección de búsqueda -->
                <div class="search-section">
                    <ion-searchbar 
                        v-model="searchQuery"
                        placeholder="¿En qué podemos ayudarte?"
                        :animated="true"
                    ></ion-searchbar>
                </div>

                <!-- Preguntas Frecuentes -->
                <div class="section-container">
                    <h2 class="section-title">Preguntas Frecuentes</h2>
                    <div class="faq-grid">
                        <div 
                            v-for="(faq, index) in filteredFaqs" 
                            :key="index"
                            class="faq-card"
                            @click="toggleFaq(index)"
                        >
                            <div class="faq-header">
                                <ion-icon 
                                    :icon="faq.expanded ? chevronDownOutline : chevronForwardOutline"
                                    class="faq-icon"
                                ></ion-icon>
                                <h3>{{ faq.pregunta }}</h3>
                            </div>
                            <div v-show="faq.expanded" class="faq-content">
                                <p>{{ faq.respuesta }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categorías de Ayuda -->
                <div class="section-container">
                    <h2 class="section-title">Categorías de Ayuda</h2>
                    <div class="categories-grid">
                        <div 
                            v-for="(categoria, index) in categorias" 
                            :key="index"
                            class="category-card"
                        >
                            <div class="category-icon" :style="{ backgroundColor: categoria.color }">
                                <ion-icon :icon="categoria.icon" size="large"></ion-icon>
                            </div>
                            <h3>{{ categoria.titulo }}</h3>
                            <p>{{ categoria.descripcion }}</p>
                        </div>
                    </div>
                </div>

                <!-- Contacto y Soporte -->
                <div class="section-container">
                    <h2 class="section-title">Contacta con Nosotros</h2>
                    <div class="contact-card">
                        <div class="contact-info">
                            <div class="contact-item">
                                <ion-icon :icon="mailOutline" size="large"></ion-icon>
                                <div>
                                    <h4>Correo electrónico</h4>
                                    <p>soporte@gennda.com</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <ion-icon :icon="callOutline" size="large"></ion-icon>
                                <div>
                                    <h4>Teléfono</h4>
                                    <p>+503 1234-5678</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <ion-icon :icon="timeOutline" size="large"></ion-icon>
                                <div>
                                    <h4>Horario de atención</h4>
                                    <p>Lunes a Viernes: 8:00 AM - 6:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <ion-button expand="block" class="contact-button">
                            Enviar mensaje
                        </ion-button>
                    </div>
                </div>

                <!-- Recursos adicionales -->
                <div class="section-container">
                    <h2 class="section-title">Recursos Adicionales</h2>
                    <div class="resources-list">
                        <ion-item 
                            v-for="(recurso, index) in recursos" 
                            :key="index"
                            button
                            class="resource-item"
                        >
                            <ion-icon :icon="recurso.icon" slot="start"></ion-icon>
                            <ion-label>
                                <h3>{{ recurso.titulo }}</h3>
                                <p>{{ recurso.descripcion }}</p>
                            </ion-label>
                            <ion-icon :icon="chevronForwardOutline" slot="end"></ion-icon>
                        </ion-item>
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
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import {
    IonPage,
    IonHeader,
    IonToolbar,
    IonButtons,
    IonMenuButton,
    IonTitle,
    IonContent,
    IonFooter,
    IonSearchbar,
    IonIcon,
    IonButton,
    IonItem,
    IonLabel
} from '@ionic/vue';
import {
    chevronForwardOutline,
    chevronDownOutline,
    walletOutline,
    calendarOutline,
    personOutline,
    settingsOutline,
    mailOutline,
    callOutline,
    timeOutline,
    documentTextOutline,
    videocamOutline,
    bookOutline
} from 'ionicons/icons';

interface FAQ {
    pregunta: string;
    respuesta: string;
    expanded: boolean;
}

const searchQuery = ref('');

const faqs = ref<FAQ[]>([
    {
        pregunta: '¿Cómo puedo registrar un nuevo gasto en Finanzas?',
        respuesta: 'Dirígete a la sección de Finanzas desde el menú lateral, luego presiona el botón "Añadir" y completa los detalles del gasto como monto, categoría y descripción.',
        expanded: false
    },
    {
        pregunta: '¿Cómo funciona el calendario de eventos?',
        respuesta: 'El calendario te permite visualizar todos tus eventos organizados por fecha. Puedes agregar eventos familiares, mandatos, y otros recordatorios importantes. Los eventos se muestran con diferentes colores según su categoría.',
        expanded: false
    },
    {
        pregunta: '¿Puedo ver el historial de todas mis transacciones?',
        respuesta: 'Sí, en la sección "Historial de Finanzas" puedes ver todas tus transacciones pasadas con detalles completos incluyendo fecha, usuario, monto y descripción.',
        expanded: false
    },
    {
        pregunta: '¿Cómo actualizo mi información de perfil?',
        respuesta: 'Accede a "Mi Perfil" desde el menú lateral. Allí podrás editar tu información personal, cambiar tu foto de perfil y actualizar tus preferencias.',
        expanded: false
    },
    {
        pregunta: '¿La aplicación funciona sin conexión a internet?',
        respuesta: 'Algunas funciones están disponibles sin conexión, pero se requiere internet para sincronizar datos y acceder a funciones en tiempo real.',
        expanded: false
    },
    {
        pregunta: '¿Cómo puedo exportar mis datos financieros?',
        respuesta: 'Desde la sección de Finanzas, utiliza la opción de menú (tres puntos) y selecciona "Exportar datos". Podrás descargar tus registros en formato PDF o Excel.',
        expanded: false
    }
]);

const categorias = ref([
    {
        titulo: 'Finanzas',
        descripcion: 'Gestión de ingresos, gastos y balance',
        icon: walletOutline,
        color: '#5B7FE8'
    },
    {
        titulo: 'Calendario',
        descripcion: 'Organización de eventos y recordatorios',
        icon: calendarOutline,
        color: '#B67FE8'
    },
    {
        titulo: 'Cuenta y Perfil',
        descripcion: 'Configuración de usuario y privacidad',
        icon: personOutline,
        color: '#E87F9B'
    },
    {
        titulo: 'Configuración',
        descripcion: 'Ajustes generales de la aplicación',
        icon: settingsOutline,
        color: '#7FE8CC'
    }
]);

const recursos = ref([
    {
        titulo: 'Guía de inicio rápido',
        descripcion: 'Aprende lo básico en 5 minutos',
        icon: bookOutline
    },
    {
        titulo: 'Tutoriales en video',
        descripcion: 'Videos explicativos paso a paso',
        icon: videocamOutline
    },
    {
        titulo: 'Documentación completa',
        descripcion: 'Manual de usuario detallado',
        icon: documentTextOutline
    }
]);

const filteredFaqs = computed(() => {
    if (!searchQuery.value) return faqs.value;
    
    const query = searchQuery.value.toLowerCase();
    return faqs.value.filter(faq => 
        faq.pregunta.toLowerCase().includes(query) || 
        faq.respuesta.toLowerCase().includes(query)
    );
});

const toggleFaq = (index: number) => {
    faqs.value[index].expanded = !faqs.value[index].expanded;
};
</script>

<style scoped>
.ayuda-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.search-section {
    margin-bottom: 30px;
}

.section-container {
    margin-bottom: 40px;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #2c3e50;
}

/* FAQ Cards */
.faq-grid {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.faq-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: all 0.3s ease;
}

.faq-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

.faq-header {
    display: flex;
    align-items: center;
    gap: 15px;
}

.faq-icon {
    color: #5B7FE8;
    font-size: 24px;
    flex-shrink: 0;
}

.faq-header h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
}

.faq-content {
    margin-top: 15px;
    padding-left: 39px;
}

.faq-content p {
    margin: 0;
    color: #666;
    line-height: 1.6;
}

/* Categories Grid */
.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.category-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.category-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

.category-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: white;
}

.category-card h3 {
    margin: 10px 0;
    font-size: 1.2rem;
    font-weight: 600;
    color: #2c3e50;
}

.category-card p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

/* Contact Card */
.contact-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    padding: 30px;
    color: white;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 25px;
    margin-bottom: 25px;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.contact-item ion-icon {
    color: white;
    flex-shrink: 0;
}

.contact-item h4 {
    margin: 0 0 5px 0;
    font-size: 1rem;
    font-weight: 600;
}

.contact-item p {
    margin: 0;
    opacity: 0.9;
}

.contact-button {
    --background: white;
    --color: #667eea;
    font-weight: 600;
    margin-top: 10px;
}

/* Resources List */
.resources-list {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.resource-item {
    --padding-start: 20px;
    --padding-end: 20px;
    --inner-padding-end: 0;
}

.resource-item h3 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 5px;
    color: #2c3e50;
}

.resource-item p {
    font-size: 0.875rem;
    color: #666;
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

/* Responsive */
@media (max-width: 768px) {
    .categories-grid {
        grid-template-columns: 1fr;
    }
    
    .section-title {
        font-size: 1.3rem;
    }
}
</style>
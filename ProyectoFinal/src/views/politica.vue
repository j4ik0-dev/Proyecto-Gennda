<template>
    <div>
        <ion-header>
            <ion-toolbar>
                <ion-title>Gennda</ion-title>
                <ion-buttons id="iniciar-sesion" slot="end">
                    <ion-button>Iniciar Sesion</ion-button>
                </ion-buttons>
            </ion-toolbar>
        </ion-header>
        <!-- menu -->


        <!-- constenido -->
        <ion-page>
            <ion-content :fullscreen="true">

                <div class="background-container ion-padding">

                    <ion-card class="terms-card">

                        <ion-card-header>
                            <ion-card-title class="ion-text-center">Términos y políticas</ion-card-title>
                        </ion-card-header>

                        <ion-card-content class="ion-no-padding">

                            <ion-accordion-group expand="inset">

                                <ion-accordion value="politica-comercial">
                                    <ion-item slot="header" class="white-bg-item">
                                        <ion-label class="bold-text">Política Comercial</ion-label>
                                    </ion-item>
                                    <div class="ion-padding" slot="content">
                                        <p><strong>Objeto:</strong> El servicio se presta bajo un esquema de suscripción
                                            mensual.</p>
                                        <p><strong>Precios:</strong> Los precios están sujetos a cambios con
                                            notificación de 30 días.</p>
                                    </div>
                                </ion-accordion>

                                <ion-accordion value="membresias">
                                    <ion-item slot="header" class="white-bg-item">
                                        <ion-label class="bold-text">Membresías</ion-label>
                                    </ion-item>
                                    <div class="ion-padding" slot="content">
                                        <p><strong>Nivel Básico:</strong> Acceso limitado a funciones esenciales.</p>
                                        <p><strong>Nivel Premium:</strong> Acceso completo, soporte 24/7 y descuentos
                                            exclusivos.</p>
                                    </div>
                                </ion-accordion>

                                <ion-accordion value="requisitos">
                                    <ion-item slot="header" class="white-bg-item">
                                        <ion-label class="bold-text">Requisitos para obtener el servicio</ion-label>
                                    </ion-item>
                                    <div class="ion-padding" slot="content">
                                        <p>Ser mayor de 18 años, presentar una identificación oficial válida y aceptar
                                            los términos de uso.</p>
                                    </div>
                                </ion-accordion>

                                <ion-accordion value="mora">
                                    <ion-item slot="header"  class="white-bg-item">
                                        <ion-label class="bold-text">Cargo de mora</ion-label>
                                    </ion-item>
                                    <div class="ion-padding" slot="content">
                                        <p>Se aplicará un cargo del **10%** sobre el saldo pendiente si el pago no se
                                            realiza antes de la fecha de corte.</p>
                                    </div>
                                </ion-accordion>

                                <ion-accordion value="privacidad">
                                    <ion-item slot="header" class="white-bg-item">
                                        <ion-label class="bold-text">Política de privacidad</ion-label>
                                    </ion-item>
                                    <div class="ion-padding" slot="content">
                                        <p>Tus datos se utilizan exclusivamente para la gestión de la cuenta y el envío
                                            de notificaciones. No se comparten con terceros.</p>
                                    </div>
                                </ion-accordion>

                                <ion-accordion value="cobertura">
                                    <ion-item slot="header" class="white-bg-item">
                                        <ion-label class="bold-text">Cobertura</ion-label>
                                    </ion-item>
                                    <div class="ion-padding" slot="content">
                                        <p>El servicio está disponible en Ciudad A, Ciudad B y áreas metropolitanas
                                            colindantes. Verifica tu código postal.</p>
                                    </div>
                                </ion-accordion>


                            </ion-accordion-group>

                            <div class="checkbox-container ion-padding">

                                <ion-item lines="none" class="white-bg-item">
                                    <ion-checkbox slot="end" :checked="readTerms"
                                        @ionChange="readTerms = $event.detail.checked"></ion-checkbox>
                                    <ion-label class="bold-text"><span class="required-asterisk">*</span>He leído los
                                        términos y condiciones</ion-label>
                                </ion-item>

                                <ion-item lines="none" class="white-bg-item">
                                    <ion-checkbox slot="end" :checked="acceptTerms"
                                        @ionChange="acceptTerms = $event.detail.checked"></ion-checkbox>
                                    <ion-label class="bold-text"><span class="required-asterisk">*</span>Acepto términos
                                        y condiciones</ion-label>
                                </ion-item>

                            </div>

                        </ion-card-content>
                    </ion-card>

                </div>
            </ion-content>
        </ion-page>
    </div>
</template>

<script>
import {
    IonPage,
    IonContent,
    IonCard,
    IonCardHeader,
    IonCardTitle,
    IonCardContent,
    IonItem,
    IonLabel,
    IonCheckbox,
    // 💡 Importar los componentes de Accordion
    IonAccordionGroup,
    IonAccordion
} from '@ionic/vue';
import { ref } from 'vue';

export default {
    components: {
        IonPage,
        IonContent,
        IonCard,
        IonCardHeader,
        IonCardTitle,
        IonCardContent,
        IonItem,
        IonLabel,
        IonCheckbox,
        IonAccordionGroup, // Componente Padre
        IonAccordion       // Componente Hijo para cada ítem
    },
    setup() {
        const readTerms = ref(false);
        const acceptTerms = ref(false);

        return {
            readTerms,
            acceptTerms
        }
    }
}
</script>

<style scoped>
/* Estilo agregado para aplicar negritas a los labels de acordeones y checkboxes */
.bold-text {
    font-weight: bold;
    background: white;
    color: black;

}

.ion-text-center{
    color: black;
    padding-top: 20px;
}
ion-label{
    background: rgb(255, 255, 255);
    color: black;
}
/* 1. Contenedor de fondo general */
.background-container {
    /* background: #e0f7fa; */
    min-height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* 2. La tarjeta principal se asegura con fondo blanco */
.terms-card {
    width: 25%;
    /* max-width: 400px; */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    --background: white;
}

ion-card-title {
    font-weight: bold;
    font-size: 1.5em;
}

/* 3. CLASE CLAVE: Asegura fondo blanco para los ion-item (headers de acordeón y checkboxes) */
.white-bg-item {
    /* 🔑 Fuerza el fondo a blanco para eliminar el gris/negro que toma color="light" o el tema oscuro */
    --background: white !important;
    /* 🔑 Asegura que el color del texto dentro del item sea negro, si fuera blanco por el tema oscuro */
    --color: black !important;
}

/* 4. Estilo para simular la línea bajo el último elemento del grupo accordion */
ion-accordion-group {
    --background: white;
    /* Esto es la línea divisoria inferior del grupo */
    border-bottom: 1px solid var(--ion-color-step-150, #c8c7cc);
}

/* 5. Estilos para el contenido desplegable del accordion (asegura fondo blanco) */
ion-accordion div[slot="content"] {
    background: white;
}

/* 6. Ajuste para el color de los encabezados de accordion que pueden tener color=light */
ion-accordion ion-item[slot="header"] {
    /* Si el tema aplica un color de texto oscuro a los headers, aquí lo forzamos a negro */
    --color: black;
    background: white;
}

/* Contenedor de checkboxes */
.checkbox-container {
    padding-top: 15px;
}

.required-asterisk {
    color: red;
    font-weight: bold;
    margin-right: 4px;
}

/* Ajustes para los ion-item de los checkboxes */
ion-item[lines="none"] {
    --padding-start: 0;
    --inner-padding-end: 0;
    --min-height: 35px;
}
</style>
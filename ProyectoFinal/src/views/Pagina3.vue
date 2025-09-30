<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-menu-button />
                </ion-buttons>
                <ion-title>Pagina 3</ion-title>
            </ion-toolbar>
        </ion-header>
        <ion-content>
            <h1>Pagina 3</h1>
        </ion-content>
        <ion-footer>
            <ion-toolbar>
                <p>Pie de página</p>
            </ion-toolbar>
        </ion-footer>
    </ion-page>
</template>
<script setup lang="ts">
import { IonPage, IonContent, IonButtons, IonHeader, IonToolbar, IonMenuButton, IonTitle, } from '@ionic/vue';
</script>
<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-menu-button/>
                    <ion-title>Pagina 2</ion-title>
                </ion-buttons>
            </ion-toolbar>
        </ion-header>
        <ion-content>
            <h1>Pagina 2</h1>
        </ion-content>
        <ion-footer>
            <ion-toolbar>
                <p>Pie de pagina</p>
            </ion-toolbar>
        </ion-footer>
    </ion-page>
</template>
<script setup lang="ts">
import { IonPage, IonHeader, IonToolbar, IonButtons, IonMenuButton, IonTitle, IonContent } from '@ionic/vue';
</script>
<template>
    <ion-page>
        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-menu-button />
                </ion-buttons>
                <ion-title>Historial de finanzas</ion-title>
            </ion-toolbar>
        </ion-header>
        <ion-content>
            <ion-list>
                {historial.map((item, index)=> (
                    <ion-item key={index}>
                        <ion-avatar slot="start">
                       <div :style="{
                         backgroundColor: item.color, width: '40px', 
                         height: '40px', borderRadius: '50%' }"></div>
                        </ion-avatar>
                        <ion-label>
                            <h2>{{ item.fecha }}</h2>
                            <p><strong>{{ item.usuario }}</strong> {{ item.detalle }}</p>
                           <p style="color: gray;">{{ item.descripción }}</p>
                        </ion-label>
                    </ion-item>
                ))}
            </ion-list>
        </ion-content>
        <ion-footer>
            <ion-toolbar>
                <p>Pie de página</p>
            </ion-toolbar>
        </ion-footer>
    </ion-page>
</template>
<script setup lang="ts">
import { IonPage, IonContent, IonButtons, IonHeader, IonToolbar, IonMenuButton, IonTitle, IonItem, IonList,IonLabel } from '@ionic/vue';

 const historial = [
    {
        fecha: '2024-10-01',
        usuario: 'Juan Pérez',
        detalle: 'Agregó un gasto',
        descripción: 'Gasto de $50 en comida',
        color: '#FF5733'
    },
    {
        fecha: '2024-10-02',
        usuario: 'María López',
        detalle: 'Agregó un ingreso',
        descripción: 'Ingreso de $200 por venta',
        color: '#33FF57'
    },
    {
        fecha: '2024-10-03',
        usuario: 'Carlos Sánchez',
        detalle: 'Agregó un gasto',
        descripción: 'Gasto de $30 en transporte',
        color: '#3357FF'
    }
];
</script>
import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import VueRouter from 'vue-router'
import Inicio from '../views/Inicio.vue'
import HistorialFinanzas from '../views/HistorialFinanzas.vue'
import Login from '../views/Login.vue'
import politica from '@/views/politica.vue'
import AyudaSoporte from '../views/AyudaSoporte.vue'
import Calendario from '../views/Calendario.vue'
import Finanzas from '../views/Finanzas.vue'
import Registro from '@/views/Registro.vue';

const routes: Array<RouteRecordRaw> = [
    {
        path: '/',
        redirect: '/inicio'
    },
    {
        path: '/inicio',
        name: 'Inicio',
        component: Inicio
    },
    {
        path: '/historial',
        name: 'Historial',
        component: HistorialFinanzas
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/politica',
        name: 'politica',
        component: politica
    },
    {
        path: '/calendario',
        name: 'Calendario',
        component: Calendario
    },
    {
        path: '/ayuda-soporte',
        name: 'AyudaSoporte',
        component: AyudaSoporte
    },
    {
        path: '/finanzas',
        name: 'Finanzas',
        component: Finanzas

    },
    {
        path: '/registro',
        name: 'Registro',
        component: Registro
    }
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL), 
    routes
})

export default router
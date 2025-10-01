import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import Inicio from '../views/Inicio.vue'
import HistorialFinanzas from '../views/HistorialFinanzas.vue'
import Login from '../views/Login.vue'
import Pagina2 from '../views/Pagina2.vue'
import Pagina3 from '../views/Pagina3.vue'
import Perfil from '@/views/Perfil.vue';
import AyudaSoporte from '@/views/AyudaSoporte.vue';

const routes: Array<RouteRecordRaw> = [
    {
        path: '/',
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
        path: '/pagina2',
        name: 'Pagina2',
        component: Pagina2
    },
    {
        path: '/pagina3',
        name: 'Pagina3',
        component: Pagina3
    },
    {
        path: '/perfil',
        name: 'Perfil',
        component: Perfil
    },
    {
        path: '/ayuda-soporte',
        name: 'AyudaSoporte',
        component: AyudaSoporte
    }   
    ]
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL), routes
})
export default router
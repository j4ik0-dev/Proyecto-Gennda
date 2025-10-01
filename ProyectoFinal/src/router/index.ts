import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import Inicio from '../views/Inicio.vue'
import HistorialFinanzas from '../views/HistorialFinanzas.vue'
import Login from '../views/Login.vue'
import politica from '../views/politica.vue'
import Perfil from '../views/Perfil.vue'
import Pagina1 from '../views/Pagina1.vue'
import Pagina2 from '../views/Pagina2.vue'
import Pagina3 from '../views/Pagina3.vue'
import Calendario from '../views/Calendario.vue'

const routes: Array<RouteRecordRaw> = [
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
        path:'/politica',
        name:'politica',
        component: politica
    },
    {
        path: '/pagina1',
        name: 'Pagina1',
        component: Pagina1

    },
    {
        path: '/calendario',
        name: 'Calendario',
        component: Calendario
    },
    {
        path: '/pagina3',
        name: 'Pagina3',
        component: Pagina3
    },
]
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL), routes
})
export default router
import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import Inicio from '../views/Inicio.vue'
import Pagina1 from '../views/Pagina1.vue'
import Perfil from '../views/Perfil.vue'
import Pagina2 from '../views/Pagina2.vue'
import Pagina3 from '../views/Pagina3.vue'

interface MyRouteMeta {
  title: string
}

const routes: Array<RouteRecordRaw & { meta?: MyRouteMeta }> = [
  {
    path: '/',
    redirect: '/inicio'
  },
  {
    path: '/inicio',
    name: 'Inicio',
    component: Inicio,
    meta: { title: 'Inicio' }
  },
  {
    path: '/pagina1',
    name: 'Pagina1',
    component: Pagina1,
    meta: { title: 'Página 1' }
  },
  {
    path: '/perfil',
    name: 'Perfil',
    component: Perfil,
    meta: { title: 'Perfil' }
  },
  {
    path: '/pagina2',
    name: 'Pagina2',
    component: Pagina2,
    meta: { title: 'Página 2' }
  },
  {
    path: '/pagina3',
    name: 'Pagina3',
    component: Pagina3,
    meta: { title: 'Página 3' }
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  document.title = (to.meta?.title as string) || 'ProyectoFinal'
  next()
})

export default router

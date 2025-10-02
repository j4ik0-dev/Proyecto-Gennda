<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-menu-button />
        </ion-buttons>
        <ion-title>Calendario</ion-title>
        <ion-buttons slot="end">
          <ion-searchbar 
            placeholder="Calendario Junio" 
            :debounce="300"
            style="max-width: 250px;"
          ></ion-searchbar>
          <ion-button fill="clear">
            <ion-icon :icon="calendarOutline"></ion-icon>
          </ion-button> 
          <ion-button fill="clear">
            <ion-icon :icon="calendarNumberOutline"></ion-icon>
          </ion-button>
          <ion-chip>
            <ion-label>Agenda proximas</ion-label>
          </ion-chip>
          <ion-button shape="round" color="primary">
            <ion-icon :icon="personOutline"></ion-icon>
          </ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>

    <ion-content class="calendar-page">
      <div class="content-wrapper">
        <!-- Main Calendar Area -->
        <div class="main-calendar-area">
          <ion-card class="calendar-card">
            <ion-card-header>
              <div class="calendar-header-content">
                <div class="header-left">
                  <ion-card-title class="month-title">{{ currentMonth }}</ion-card-title>
                  
                  <div class="categories-container">
                    <ion-chip 
                      v-for="(category, idx) in eventCategories" 
                      :key="idx"
                      :style="{ '--background': category.color }"
                      class="category-chip"
                    >
                      <div class="category-dot" :style="{ backgroundColor: category.color }"></div>
                      <ion-label>{{ category.name }}</ion-label>
                    </ion-chip>
                    <ion-button fill="clear" size="small">
                      <ion-icon :icon="addOutline"></ion-icon>
                    </ion-button>
                  </div>
                </div>

                <div class="balance-section">
                  <ion-text color="medium">
                    <p class="balance-label">Balance actual</p>
                  </ion-text>
                  <ion-text color="dark">
                    <h2 class="balance-amount">{{ currentBalance }}</h2>
                  </ion-text>
                </div>
              </div>
            </ion-card-header>

            <ion-card-content class="calendar-content">
              <!-- Week Days -->
              <ion-grid class="calendar-grid">
                <ion-row class="week-days-row">
                  <ion-col 
                    v-for="(day, idx) in weekDays" 
                    :key="idx"
                    class="week-day-col"
                  >
                    <ion-text color="medium">
                      <small>{{ day }}</small>
                    </ion-text>
                  </ion-col>
                </ion-row>

                <!-- Calendar Days -->
                <ion-row 
                  v-for="(week, weekIdx) in weeksArray" 
                  :key="weekIdx"
                  class="days-row"
                >
                  <ion-col
                    v-for="(dayData, dayIdx) in week"
                    :key="dayIdx"
                    class="day-col"
                    :class="{
                      'day-empty': !dayData.day,
                      'day-active': dayData.day,
                      'day-highlight': dayData.day === '30'
                    }"
                  >
                    <div v-if="dayData.day" class="day-content">
                      <ion-text color="dark" class="day-number">
                        <strong>{{ dayData.day }}</strong>
                      </ion-text>
                      <div class="events-list">
                        <ion-chip
                          v-for="(event, eventIdx) in dayData.events"
                          :key="eventIdx"
                          class="event-chip"
                          :style="{
                            backgroundColor: event.color,
                            color: event.textColor || '#1F2937'
                          }"
                        >
                          <ion-label class="event-label">{{ event.title }}</ion-label>
                        </ion-chip>
                      </div>
                    </div>
                  </ion-col>
                </ion-row>
              </ion-grid>
            </ion-card-content>
          </ion-card>
        </div>

        <!-- Right Sidebar - Events -->
        <div class="events-sidebar">
          <div class="events-header">
            <ion-text color="light">
              <h2>Eventos</h2>
              <p>30 Junio 2024</p>
            </ion-text>
          </div>

          <div class="events-list-container">
            <ion-card
              v-for="(event, idx) in upcomingEvents"
              :key="idx"
              class="event-card"
              :style="{ backgroundColor: event.color }"
            >
              <ion-card-content>
                <div class="event-card-header">
                  <div>
                    <ion-text color="light">
                      <p class="event-date">{{ event.date }}</p>
                    </ion-text>
                    <ion-text color="light">
                      <h3 class="event-time">{{ event.time }}</h3>
                    </ion-text>
                  </div>
                  <ion-button fill="clear" class="event-action-btn">
                    <ion-icon :icon="peopleOutline" color="light"></ion-icon>
                  </ion-button>
                </div>
                
                <ion-text color="light">
                  <h4 class="event-title">{{ event.title }}</h4>
                  <p class="event-subtitle">{{ event.subtitle }}</p>
                  <p class="event-description">{{ event.description }}</p>
                </ion-text>
              </ion-card-content>
            </ion-card>
          </div>

          <ion-button 
            expand="block" 
            shape="round" 
            color="light" 
            class="add-event-btn"
          >
            <ion-icon :icon="addOutline" slot="icon-only"></ion-icon>
          </ion-button>
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
  IonTitle,
  IonContent,
  IonButtons,
  IonButton,
  IonIcon,
  IonSearchbar,
  IonCard,
  IonCardHeader,
  IonCardTitle,
  IonCardContent,
  IonGrid,
  IonRow,
  IonCol,
  IonChip,
  IonLabel,
  IonText,
  IonMenuButton,
  IonFooter
} from '@ionic/vue';
import {
  calendarOutline,
  calendarNumberOutline,
  personOutline,
  addOutline,
  peopleOutline
} from 'ionicons/icons';

interface Event {
  title: string;
  color: string;
  textColor?: string;
}

interface DayData {
  day: string;
  events: Event[];
}

interface Category {
  name: string;
  color: string;
}

interface UpcomingEvent {
  date: string;
  time: string;
  title: string;
  subtitle: string;
  description: string;
  color: string;
}

const currentMonth = ref('JUNIO');
const currentBalance = ref('$122.50');

const weekDays = ['LUNES', 'MARTES', 'MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO', 'DOMINGO'];

const eventCategories: Category[] = [
  { name: 'Reuniones', color: '#C4B5FD' },
  { name: 'Proyecto personal', color: '#A78BFA' },
  { name: 'Familiar', color: '#D1D5DB' },
  { name: 'Mandados', color: '#1F2937' }
];

const upcomingEvents: UpcomingEvent[] = [
  {
    date: '30 Junio 2024',
    time: '6:35 am',
    title: 'Intención de plan de desarrollo para el...',
    subtitle: 'Revistas de arquitectura',
    description: 'Conversación de diseño arquitectónico con el comité del barrio',
    color: '#C4B5FD'
  },
  {
    date: '30 Junio 2024',
    time: '2:05pm',
    title: 'Reunión por Visitas extranjera con...',
    subtitle: 'Junta cultural',
    description: 'Bienvenida a extranjeros que visitan una feria en la ciudad...',
    color: '#374151'
  },
  {
    date: '30 Junio 2024',
    time: '5:45pm',
    title: 'Comprar para el día de las tres veces que...',
    subtitle: 'Asunto personal',
    description: 'Reunión del 4 de julio',
    color: '#1F2937'
  }
];

const calendarDays: DayData[] = [
  { day: '', events: [] },
  { day: '', events: [] },
  { day: '', events: [] },
  { day: '', events: [] },
  { day: '', events: [] },
  { day: '01', events: [] },
  { day: '02', events: [{ title: 'Día por visitar tiendas', color: '#C4B5FD' }] },
  { day: '03', events: [{ title: 'Junta Familiar Sabatina', color: '#A78BFA' }] },
  { day: '04', events: [{ title: 'Día por Recitar el himno', color: '#374151', textColor: '#fff' }] },
  { day: '05', events: [] },
  { day: '06', events: [{ title: 'Día Familiar mensual', color: '#C4B5FD' }] },
  { day: '07', events: [] },
  { day: '08', events: [] },
  { day: '09', events: [] },
  { day: '10', events: [{ title: 'Día por colaborar aviones', color: '#C4B5FD' }] },
  { day: '11', events: [{ title: 'Día por liberar niños', color: '#374151', textColor: '#fff' }] },
  { day: '12', events: [{ title: 'Día por Reunión Familiar', color: '#C4B5FD' }] },
  { day: '13', events: [] },
  { day: '14', events: [] },
  { day: '15', events: [{ title: 'Dia por Hacer Reunion', color: '#C4B5FD' }] },
  { day: '16', events: [{ title: 'Dia por Reunión Niños', color: '#C4B5FD' }] },
  { day: '17', events: [{ title: 'Día por colaborar Jovenes', color: '#C4B5FD' }] },
  { day: '18', events: [{ title: 'Día por liberar niños', color: '#374151', textColor: '#fff' }] },
  { day: '19', events: [{ title: 'Dia por Visita Parental', color: '#C4B5FD' }] },
  { day: '20', events: [
    { title: 'Dia por Colaboracion', color: '#C4B5FD' }, 
    { title: 'La Union Viena el amor', color: '#374151', textColor: '#fff' }
  ]},
  { day: '21', events: [{ title: 'Dia por Visitar abuelas', color: '#C4B5FD' }] },
  { day: '22', events: [{ title: 'Venir Festival de niños', color: '#C4B5FD' }] },
  { day: '23', events: [] },
  { day: '24', events: [{ title: 'Dia colaborar al rancho', color: '#C4B5FD' }] },
  { day: '25', events: [{ title: 'Dia por liberar niños', color: '#374151', textColor: '#fff' }] },
  { day: '26', events: [] },
  { day: '27', events: [] },
  { day: '28', events: [{ title: 'La Union Viena el amor', color: '#374151', textColor: '#fff' }] },
  { day: '29', events: [] },
  { day: '30', events: [
    { title: 'Juntas de Reunión de apoyos', color: '#C4B5FD' }, 
    { title: 'Reunión Plan de soporte', color: '#A78BFA' }, 
    { title: 'Día por liberar niños', color: '#374151', textColor: '#fff' }
  ]}
];

const weeksArray = computed(() => {
  const weeks: DayData[][] = [];
  for (let i = 0; i < calendarDays.length; i += 7) {
    weeks.push(calendarDays.slice(i, i + 7));
  }
  return weeks;
});
</script>

<style scoped>
.calendar-page {
  --background: linear-gradient(135deg, #A5F3FC 0%, #67E8F9 100%);
}

.content-wrapper {
  display: flex;
  height: 100%;
  padding: 16px;
  gap: 16px;
}

.main-calendar-area {
  flex: 1;
  overflow-y: auto;
}

.calendar-card {
  background: linear-gradient(135deg, #DBEAFE 0%, #E9D5FF 100%);
  border: 4px solid #A78BFA;
  border-radius: 24px;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.calendar-header-content {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.header-left {
  display: flex;
  align-items: center;
  gap: 24px;
  flex-wrap: wrap;
}

.month-title {
  font-size: 28px;
  font-weight: bold;
  color: #1E3A8A;
  letter-spacing: 4px;
  margin: 0;
}

.categories-container {
  display: flex;
  gap: 8px;
  align-items: center;
  flex-wrap: wrap;
}

.category-chip {
  height: 28px;
  font-size: 11px;
}

.category-dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  margin-right: 4px;
}

.balance-section {
  text-align: right;
}

.balance-label {
  font-size: 12px;
  margin: 0 0 4px 0;
}

.balance-amount {
  font-size: 22px;
  font-weight: bold;
  margin: 0;
}

.calendar-content {
  background: white;
  border-radius: 16px;
  padding: 16px;
}

.calendar-grid {
  padding: 0;
  width: 100%;
}

.week-days-row {
  margin-bottom: 12px;
}

.week-day-col {
  text-align: center;
  padding: 8px 4px;
}

.week-day-col small {
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
}

.days-row {
  margin-bottom: 8px;
}

.day-col {
  min-height: 120px;
  padding: 8px;
  border-radius: 8px;
}

.day-empty {
  background: transparent;
}

.day-active {
  background: #F9FAFB;
  border: 1px solid #E5E7EB;
}

.day-highlight {
  border: 2px solid #A78BFA !important;
  box-shadow: 0 0 0 2px rgba(167, 139, 250, 0.3);
  background: #F3E8FF !important;
}

.day-content {
  height: 100%;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.day-number {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 6px;
  display: block;
  color: #1F2937;
}

.events-list {
  display: flex;
  flex-direction: column;
  gap: 3px;
}

.event-chip {
  height: auto;
  min-height: 24px;
  margin: 0;
  padding: 4px 8px;
  border-radius: 6px;
}

.event-label {
  font-size: 10px !important;
  line-height: 1.3;
  margin: 0;
  white-space: normal;
  font-weight: 500;
}

.events-sidebar {
  width: 320px;
  background: linear-gradient(135deg, #67E8F9 0%, #22D3EE 100%);
  border-radius: 16px;
  padding: 20px;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
}

.events-header {
  margin-bottom: 20px;
}

.events-header h2 {
  font-size: 22px;
  font-weight: bold;
  margin: 0 0 4px 0;
}

.events-header p {
  font-size: 14px;
  margin: 0;
}

.events-list-container {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.event-card {
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  margin: 0;
}

.event-card ion-card-content {
  padding: 12px;
  
}

.event-card-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 8px;
}

.event-date {
  font-size: 11px;
  opacity: 0.9;
  margin: 0 0 4px 0;
}

.event-time {
  font-size: 18px;
  font-weight: bold;
  margin: 0;
}

.event-action-btn {
  --background: rgba(255, 255, 255, 0.2);
  --border-radius: 50%;
  margin: 0;
  height: 32px;
  width: 32px;
}

.event-title {
  font-size: 13px;
  font-weight: 600;
  margin: 0 0 4px 0;
}

.event-subtitle {
  font-size: 11px;
  opacity: 0.9;
  margin: 0 0 6px 0;
}

.event-description {
  font-size: 11px;
  opacity: 0.85;
  margin: 0;
}

.add-event-btn {
  margin-top: 16px;
  --background: white;
  --color: #22D3EE;
  font-size: 28px;
  height: 48px;
}

ion-searchbar {
  --background: white;
  --border-radius: 8px;
  padding: 4px 8px;
}

ion-chip {
  --background: #E5E7EB;
}

ion-footer ion-toolbar {
  text-align: center;
}

ion-footer p {
  margin: 10px 0;
  font-size: 0.875rem;
  color: #666;
}
.card-content-md {
    -webkit-padding-start: 16px;
    padding-inline-start: 16px;
    -webkit-padding-end: 16px;
    padding-inline-end: 16px;
    padding-top: 13px;
    padding-bottom: 13px;
    font-size: 0.875rem;
    line-height: 1.5;
}
</style>
<template>
  <ion-page>
    <ion-header>
      <ion-toolbar color="light">
        <ion-title>Finanzas</ion-title>
        <ion-buttons slot="end">
          <ion-searchbar 
            placeholder="Gastos del mes" 
            :debounce="300"
            style="max-width: 250px;"
          ></ion-searchbar>
          <ion-button fill="clear">
            <ion-icon :icon="notifications" color="primary"></ion-icon>
          </ion-button>
          <ion-button fill="clear">
            <ion-icon :icon="notifications" color="primary"></ion-icon>
          </ion-button>
          <ion-chip>
            <ion-label>Gestion parametros</ion-label>
          </ion-chip>
          <ion-button shape="round" color="primary">
            <ion-icon :icon="personOutline"></ion-icon>
          </ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>

    <ion-content class="finance-page">
      <div class="content-wrapper">
        <!-- Main Finance Area -->
        <div class="main-finance-area">
          <!-- Balance Section -->
          <div class="balance-section">
            <ion-text color="light">
              <p class="balance-label">Balance actual</p>
            </ion-text>
            <ion-text color="light">
              <h1 class="balance-amount">{{ currentBalance }}</h1>
            </ion-text>
          </div>

          <!-- Summary Cards -->
          <div class="summary-section">
            <ion-card class="summary-card income-card">
              <ion-card-content>
                <ion-text color="light">
                  <p class="summary-label">Ingreso mensual</p>
                  <h2 class="summary-amount">{{ monthlyIncome }}</h2>
                  <p class="summary-sublabel">{{ incomeDetails }}</p>
                </ion-text>
              </ion-card-content>
            </ion-card>

            <ion-card class="summary-card expense-card">
              <ion-card-content>
                <ion-text color="light">
                  <p class="summary-label">Gasto mensual</p>
                  <h2 class="summary-amount">{{ monthlyExpense }}</h2>
                  <p class="summary-sublabel">{{ expenseDetails }}</p>
                </ion-text>
                <div class="action-buttons">
                  <ion-button size="small" color="light" class="action-btn">
                    Añadir
                  </ion-button>
                  <ion-button size="small" color="light" class="action-btn">
                    Descontar
                  </ion-button>
                </div>
              </ion-card-content>
            </ion-card>
          </div>

          <!-- Transactions Grid -->
          <div class="transactions-header">
            <ion-text>
              <h3>Detalles de Desembolso</h3>
            </ion-text>
            <ion-text color="medium">
              <p class="transactions-subtitle">Nivel de importancias</p>
            </ion-text>
            <ion-button fill="clear" size="small">
              <ion-icon :icon="ellipsisHorizontal"></ion-icon>
            </ion-button>
          </div>

          <ion-grid class="transactions-grid">
            <ion-row>
              <ion-col 
                size="12" 
                size-md="6" 
                v-for="(transaction, idx) in transactions" 
                :key="idx"
              >
                <ion-card class="transaction-card" :class="transaction.className">
                  <ion-card-content>
                    <div class="transaction-content">
                      <div class="transaction-info">
                        <ion-text color="light">
                          <h3 class="transaction-amount">{{ transaction.amount }}</h3>
                          <p class="transaction-description">{{ transaction.description }}</p>
                        </ion-text>
                      </div>
                      <ion-icon 
                        :icon="lockClosed" 
                        color="light" 
                        class="transaction-icon"
                      ></ion-icon>
                    </div>
                    <ion-button 
                      expand="block" 
                      fill="clear" 
                      color="light" 
                      size="small"
                      class="detail-btn"
                    >
                      Ver detalle
                    </ion-button>
                  </ion-card-content>
                </ion-card>
              </ion-col>
            </ion-row>
          </ion-grid>
        </div>

        <!-- Right Sidebar - History -->
        <div class="history-sidebar">
          <div class="history-header">
            <ion-text>
              <h3>Historial</h3>
            </ion-text>
            <ion-button fill="clear" size="small">
              <ion-icon :icon="ellipsisHorizontal"></ion-icon>
            </ion-button>
          </div>

          <div class="history-list">
            <ion-card 
              v-for="(item, idx) in historyItems" 
              :key="idx"
              class="history-card"
              :class="item.type"
            >
              <ion-card-content>
                <div class="history-item-header">
                  <ion-icon 
                    :icon="lockClosed" 
                    color="light"
                    class="history-icon"
                  ></ion-icon>
                  <ion-text color="light">
                    <h4 class="history-amount">{{ item.amount }}</h4>
                  </ion-text>
                </div>
                <ion-text color="light">
                  <p class="history-description">{{ item.description }}</p>
                  <p class="history-date">{{ item.date }}</p>
                </ion-text>
              </ion-card-content>
            </ion-card>
          </div>

          <!-- Advertisement Banner -->
          <div class="ad-banner">
            <img src="https://via.placeholder.com/300x200/FF1744/FFFFFF?text=TU+COMIDA+FAVORITA" alt="Publicidad" />
          </div>
        </div>
      </div>
    </ion-content>
  </ion-page>
</template>

<script setup>
import { ref } from 'vue';
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
  IonCardContent,
  IonGrid,
  IonRow,
  IonCol,
  IonChip,
  IonLabel,
  IonText
} from '@ionic/vue';
import {
  notifications,
  personOutline,
  lockClosed,
  ellipsisHorizontal
} from 'ionicons/icons';

const currentBalance = ref('$ 122.50');
const monthlyIncome = ref('$ 3,122.50');
const monthlyExpense = ref('-$1625.8');
const incomeDetails = ref('Desembolsos');
const expenseDetails = ref('$0.00');

const transactions = [
  {
    amount: '$ 250.00',
    description: 'Seguro del carro',
    className: 'card-purple'
  },
  {
    amount: '$ 200.00',
    description: 'Seguro del carro',
    className: 'card-purple'
  },
  {
    amount: '$99.75',
    description: 'Compra lumínea',
    className: 'card-purple'
  },
  {
    amount: '$ 150.00',
    description: 'Seguro de viajes',
    className: 'card-purple'
  },
  {
    amount: '$ 125.00',
    description: 'Mantos para los ninos',
    className: 'card-purple'
  },
  {
    amount: '$ 50.00',
    description: 'Telefono moviles',
    className: 'card-purple'
  }
];

const historyItems = [
  {
    amount: '$ -43.50',
    description: 'Desayuno en familia',
    date: 'May 25, 2024',
    type: 'expense'
  },
  {
    amount: '$ -250,00',
    description: 'Arreglos del carro',
    date: 'May 25, 2024',
    type: 'expense'
  },
  {
    amount: '$ -5.50',
    description: 'Antojos',
    date: 'May 25, 2024',
    type: 'expense'
  }
];
</script>

<style scoped>
.finance-page {
  --background: linear-gradient(135deg, #A5F3FC 0%, #67E8F9 100%);
}

/* ...existing code... */
.content-wrapper {
  display: flex;
  height: 100%;
  padding: 20px;
  gap: 20px;
  flex-wrap: wrap; /* Allow items to wrap to the next line */
}

/* Add media queries for responsiveness */
@media (max-width: 768px) {
  .content-wrapper {
    flex-direction: column; /* Stack items vertically on smaller screens */
  }
}

.main-finance-area {
  flex: 1; /* Allow the main area to grow and take available space */
  min-width: 300px; /* Ensure it doesn't shrink too much */
  overflow-y: auto;
}

.history-sidebar {
  width: 340px; /* Keep the sidebar width */
  min-width: 200px; /* Ensure it doesn't shrink too much */
}
/* ...existing code... */

.main-finance-area {
  flex: 1;
  overflow-y: auto;
}

.balance-section {
  background: linear-gradient(135deg, #5B8DEF 0%, #0F52BA 100%);
  border-radius: 16px;
  padding: 24px;
  margin-bottom: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.balance-label {
  font-size: 14px;
  margin: 0 0 8px 0;
  opacity: 0.9;
}

.balance-amount {
  font-size: 48px;
  font-weight: bold;
  margin: 0;
}

.summary-section {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
  margin-bottom: 24px;
}

.summary-card {
  border-radius: 12px;
  margin: 0;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.income-card {
  background: linear-gradient(135deg, #7C3AED 0%, #5B21B6 100%);
}

.expense-card {
  background: linear-gradient(135deg, #7C3AED 0%, #5B21B6 100%);
}

.summary-card ion-card-content {
  padding: 16px;
}

.summary-label {
  font-size: 12px;
  margin: 0 0 8px 0;
  opacity: 0.9;
}

.summary-amount {
  font-size: 24px;
  font-weight: bold;
  margin: 0 0 4px 0;
}

.summary-sublabel {
  font-size: 11px;
  margin: 0 0 12px 0;
  opacity: 0.8;
}

.action-buttons {
  display: flex;
  gap: 8px;
}

.action-btn {
  --background: rgba(255, 255, 255, 0.2);
  --color: white;
  font-size: 12px;
  height: 32px;
}

.transactions-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 16px;
  padding: 0 8px;
}

.transactions-header h3 {
  font-size: 18px;
  font-weight: 600;
  margin: 0;
  color: #1F2937;
}

.transactions-subtitle {
  font-size: 12px;
  margin: 4px 0 0 0;
}

.transactions-grid {
  padding: 0;
}

.transaction-card {
  border-radius: 12px;
  margin: 0;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  height: 100%;
}

.card-purple {
  background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%);
}

.transaction-card ion-card-content {
  padding: 16px;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.transaction-content {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  flex: 1;
  margin-bottom: 12px;
}

.transaction-amount {
  font-size: 22px;
  font-weight: bold;
  margin: 0 0 8px 0;
}

.transaction-description {
  font-size: 13px;
  margin: 0;
  opacity: 0.9;
}

.transaction-icon {
  font-size: 24px;
}

.detail-btn {
  --background: rgba(255, 255, 255, 0.2);
  margin: 0;
  font-size: 12px;
  height: 32px;
}

.history-sidebar {
  width: 340px;
  background: linear-gradient(135deg, #7C3AED 0%, #5B21B6 100%);
  border-radius: 16px;
  padding: 20px;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.history-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.history-header h3 {
  font-size: 20px;
  font-weight: bold;
  color: white;
  margin: 0;
}

/* ...existing code... */
.history-list {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 12px;
  margin-bottom: 20px;
  overflow-x: auto; /* Enable horizontal scrolling for smaller screens */
}

/* Add media queries for responsiveness */
@media (max-width: 768px) {
  .history-list {
    flex-direction: row; /* Display items in a row */
    overflow-x: auto; /* Enable horizontal scrolling */
    white-space: nowrap; /* Prevent items from wrapping */
  }

  .history-card {
    flex: 0 0 auto; /* Prevent cards from shrinking */
    width: 80%; /* Adjust card width as needed */
    max-width: 200px; /* Set a maximum width */
  }
}
/* ...existing code... */

.history-card {
  border-radius: 12px;
  margin: 0;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.history-card.expense {
  background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
}

.history-card ion-card-content {
  padding: 12px;
}

.history-item-header {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 8px;
}

.history-icon {
  font-size: 20px;
}

.history-amount {
  font-size: 18px;
  font-weight: bold;
  margin: 0;
}

.history-description {
  font-size: 12px;
  margin: 0 0 4px 0;
  opacity: 0.9;
}

.history-date {
  font-size: 11px;
  margin: 0;
  opacity: 0.8;
}

.ad-banner {
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.ad-banner img {
  width: 100%;
  height: auto;
  display: block;
}

ion-searchbar {
  --background: white;
  --border-radius: 20px;
  padding: 4px 8px;
}

ion-chip {
  --background: #E5E7EB;
}

ion-grid {
  --ion-grid-padding: 0;
}

ion-col {
  padding: 8px;
}
</style>
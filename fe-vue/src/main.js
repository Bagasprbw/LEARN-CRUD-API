import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router' // <--- tambahkan baris ini

// createApp(App).mount('#app')
createApp(App).use(router).mount('#app')

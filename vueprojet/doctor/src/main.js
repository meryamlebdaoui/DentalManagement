import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import VueSweetalert2 from 'vue-sweetalert2';

createApp(App).use(store).use(router).use(VueSweetalert2).mount('#app')

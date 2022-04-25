import AboutView from '@/views/AboutView.vue'
import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SignUpView from '../views/SignUpView.vue'
import LoginView from '../views/LoginView.vue'
import AppointmentView from '../views/Appointment/AppointmentView.vue'
import AllappointmentView from '../views/Appointment/AllappointmentView.vue'
import Update from '@/components/Update.vue'
// import NotFoundView from '../views/NotFoundView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/about',
    name: 'about',
    component : AboutView
  },
  
  {
    path: '/signup',
    name: 'signup',
    component: SignUpView
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/appointment',
    name: 'appointments',
    component: AppointmentView
  },
  {
    path: '/Allappointment',
    name: 'MyAppointments',
    component: AllappointmentView
  },
  {
    path: '/Appointment/update/:id',
    name: 'Update',
    component: Update
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router

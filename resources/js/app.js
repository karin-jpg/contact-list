
import './bootstrap';

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

import App from './App.vue'
import Agenda from './components/agenda.vue'
import AgendaForm from './components/agenda-form.vue'


const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: Agenda },
        { path: '/form', component: AgendaForm }
    ]
});

createApp(App)
    .use(router)
    .mount('#app')

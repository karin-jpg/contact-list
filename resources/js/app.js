
import './bootstrap';

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

import App from './App.vue'
import Agenda from './views/Agenda.vue'
import AgendaFormulario from './components/Agenda-formulario.vue'
import CriarContato from './views/CriarContato.vue'
import EditarContato from './views/EditarContato.vue'


const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: Agenda },
        { path: '/criar-contato', component: CriarContato},
        { path: '/editar', component: EditarContato }
    ]
});

createApp(App)
    .use(router)
    .component('agenda-formulario', AgendaFormulario)
    .mount('#app')

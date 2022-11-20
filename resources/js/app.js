
import './bootstrap';

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import VueTheMask from 'vue-the-mask'

import App from './App.vue'
import Agenda from './views/Agenda.vue'
import AgendaFormulario from './components/Agenda-formulario.vue'
import CriarContato from './views/CriarContato.vue'
import EditarContato from './views/EditarContato.vue'


const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', name: 'Home', component: Agenda },
        { path: '/criar-contato', name: 'criarContato', component: CriarContato},
        { path: '/editar-contato/:id', name: 'editarContato', component: EditarContato }
    ]
});

createApp(App)
    .use(router)
    .use(VueTheMask)
    .component('agenda-formulario', AgendaFormulario)
    .mount('#app')

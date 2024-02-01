import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Import components
import App from './components/App.vue';
import UsuarioList from './components/UsuarioList.vue';
import UsuarioForm from './components/UsuarioForm.vue';
import Usuario from './components/Usuario.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: UsuarioList },
        { path: '/usuarios/create', component: UsuarioForm },
        { path: '/usuarios/:id', component: Usuario },
        { path: '/usuarios/:id/edit', component: UsuarioForm },
    ]
});

const app = createApp(App);
app.use(router);
app.mount('#app');
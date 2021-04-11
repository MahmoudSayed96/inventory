import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import Forgot from './components/auth/Forgot.vue';

export const routes = [
    {path: '/', component: Login, name: '/'},
    {path: '/register', component: Register, name: 'register'},
    {path: '/forgot', component: Forgot, name: 'forgot'},
];
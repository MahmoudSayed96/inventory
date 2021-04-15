import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import Forgot from './components/auth/Forgot.vue';
import Logout from './components/auth/Logout.vue';

import Home from './components/Home.vue';

// Employee Components
import AllEmployees from './components/employee/AllEmployees.vue';
import CreateEmployee from './components/employee/CreateEmployee.vue';
import EditEmployee from './components/employee/EditEmployee.vue';

export const routes = [
    {path: '/', component: Login, name: '/'},
    {path: '/register', component: Register, name: 'register'},
    {path: '/forgot', component: Forgot, name: 'forgot'},
    {path: '/logout', component: Logout, name: 'logout'},

    {path: '/home', component: Home, name: 'home'},
    
    {path: '/employees', component: AllEmployees, name: 'employees'},
    {path: '/create-employee', component: CreateEmployee, name: 'create-employee'},
    {path: '/edit-employee/:id', component: EditEmployee, name: 'edit-employee'},

];
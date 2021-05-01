import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import Forgot from './components/auth/Forgot.vue';
import Logout from './components/auth/Logout.vue';

import Home from './components/Home.vue';

// Employee Components
import AllEmployees from './components/employee/AllEmployees.vue';
import CreateEmployee from './components/employee/CreateEmployee.vue';
import EditEmployee from './components/employee/EditEmployee.vue';

// Supplier Components
import AllSuppliers from './components/supplier/AllSuppliers.vue';
import CreateSupplier from './components/supplier/CreateSupplier.vue';
import EditSupplier from './components/supplier/EditSupplier.vue';

// Category Components
import AllCategories from './components/category/AllCategories.vue';
import CreateCategory from './components/category/CreateCategory.vue';
import EditCategory from './components/category/EditCategory.vue';

// Product Components
import AllProducts from './components/product/AllProducts.vue';
import CreateProduct from './components/product/CreateProduct.vue';
import EditProduct from './components/product/EditProduct.vue';

// Expense Components
import AllExpenses from './components/expense/AllExpenses.vue';
import CreateExpense from './components/expense/CreateExpense.vue';
import EditExpense from './components/expense/EditExpense.vue';

// Customer Components
import AllCustomers from './components/customer/AllCustomers.vue';
import CreateCustomer from './components/customer/CreateCustomer.vue';
import EditCustomer from './components/customer/EditCustomer.vue';

// Salary Components
import AllSalaries from './components/salary/AllSalaries.vue';
import GivenSalaries from './components/salary/GivenSalaries.vue';
import PaySalary from './components/salary/PaySalary.vue';
import ViewSalary from './components/salary/ViewSalary.vue';
import EditSalary from './components/salary/EditSalary.vue';

// Stock.
import Stock from './components/stock/Stock.vue';
import EditStock from './components/stock/EditStock.vue';

// Pos.
import Pos from './components/pos/Pos.vue';

export const routes = [
    {path: '/', component: Login, name: '/'},
    {path: '/register', component: Register, name: 'register'},
    {path: '/forgot', component: Forgot, name: 'forgot'},
    {path: '/logout', component: Logout, name: 'logout'},

    {path: '/home', component: Home, name: 'home'},

    // Employee Routes
    {path: '/employees', component: AllEmployees, name: 'employees'},
    {path: '/create-employee', component: CreateEmployee, name: 'create-employee'},
    {path: '/edit-employee/:id', component: EditEmployee, name: 'edit-employee'},

    // Supplier Routes
    {path: '/suppliers', component: AllSuppliers, name: 'suppliers'},
    {path: '/create-supplier', component: CreateSupplier, name: 'create-supplier'},
    {path: '/edit-supplier/:id', component: EditSupplier, name: 'edit-supplier'},

    // Category Routes
    {path: '/categories', component: AllCategories, name: 'categories'},
    {path: '/create-category', component: CreateCategory, name: 'create-category'},
    {path: '/edit-category/:id', component: EditCategory, name: 'edit-category'},

    // Product Routes
    {path: '/products', component: AllProducts, name: 'products'},
    {path: '/create-product', component: CreateProduct, name: 'create-product'},
    {path: '/edit-product/:id', component: EditProduct, name: 'edit-product'},

    // Customer Routes
    {path: '/customers', component: AllCustomers, name: 'customers'},
    {path: '/create-customer', component: CreateCustomer, name: 'create-customer'},
    {path: '/edit-customer/:id', component: EditCustomer, name: 'edit-customer'},
    
    // Expense Routes
    {path: '/expenses', component: AllExpenses, name: 'expenses'},
    {path: '/create-expense', component: CreateExpense, name: 'create-expense'},
    {path: '/edit-expense/:id', component: EditExpense, name: 'edit-expense'},
    
    // Salary Routes
    {path: '/salaries', component: AllSalaries, name: 'salaries'},
    {path: '/given-salaries', component: GivenSalaries, name: 'given-salaries'},
    {path: '/pay-salary/:id', component: PaySalary, name: 'pay-salary'},
    {path: '/view-salary/:id', component: ViewSalary, name: 'view-salary'},
    {path: '/edit-salary/:id', component: EditSalary, name: 'edit-salary'},
    
    // Stock.
    {path: '/stock', component: Stock, name: 'stock'},
    {path: '/edit-stock/:id', component: EditStock, name: 'edit-stock'},
    
    // Pos.
    {path: '/pos', component: Pos, name: 'pos'},

];
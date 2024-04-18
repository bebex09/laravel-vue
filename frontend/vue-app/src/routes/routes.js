import ContactList from '../components/ContactList';
import AddContact from '../components/AddContact';
import EditContact from '../components/EditContact';
import LogIn from '../components/LogIn';
import Register from '../components/Register';
import Dashboard from '../components/Dashboard';
import AddProduct from '../components/AddProduct';
import ProductList from '../components/ProductList';
import EditProduct from '../components/EditProduct';
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        name: 'Dashboard',
        path: '/',
        component: Dashboard
    },
    {
        name: 'LogIn',
        path: '/login',
        component: LogIn
    },
    {
        name: 'Register',
        path: '/register',
        component: Register
    },
    {
        name: 'AddProduct',
        path: '/add_products',
        component: AddProduct
    },
    {
        name: 'ProductList',
        path: '/products',
        component: ProductList
    },
    {
        name: 'EditProduct',
        path: '/products/edit/:id?',
        component: EditProduct
    },
    {
        name: 'ContactList',
        path: '/contacts',
        component: ContactList
    },
    {
        name: 'AddContact',
        path: '/add',
        component: AddContact
    },
    {
        name: 'EditContact',
        path: '/contact/edit/:id?',
        component: EditContact
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;

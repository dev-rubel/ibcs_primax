import Vue from 'vue'
import Router from 'vue-router'
import Dashboard from './views/Dashboard'
import Disiplinary from './views/Disiplinary'
import Home from './views/Home'
import Login from './views/Login'

Vue.use(Router)

const routes = [
    {
        path: '/home',
        name: 'home',
        component: Home,
        children: [
            {
                path: '',
                name: 'dashboard',
                component: Dashboard,
                meta: { title: 'Dashboard' }
            },
            {
                path: '/disiplinary',
                name: 'disiplinary',
                component: Disiplinary,
                meta: { title: 'Disiplinary' }
            }
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: { title: 'Login Page' }
    }
]

const router = new Router({
    routes: routes,
    linkActiveClass: 'active'
})

export default router
import Vue from 'vue'
import Router from 'vue-router'
import Dashboard from './views/Dashboard'
import Category from './views/Category'

Vue.use(Router)

const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/category',
        name: 'category',
        component: Category
    }
]

const router = new Router({
    routes: routes,
    linkActiveClass: 'active'
})

export default router
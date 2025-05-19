import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import { useAuthStore } from '../stores/auth'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'Home',
            component: HomeView,
        },
        {
            path: '/about',
            name: 'About',
            component: () => import('../views/AboutView.vue'),
        },
        {
            path: '/developers',
            name: 'Developers',
            component: () => import('../views/DevelopersView.vue'),
            meta: { projectOwnersOnly: true },
        },
        {
            path: '/developers/:id',
            name: 'DeveloperDetail',
            component: () => import('../views/DeveloperDetail.vue'),
            props: true,
            meta: { requiresAuth: true, projectOwnersOnly: true },
        },
        {
            path: '/apply/:projectId',
            name: 'Apply',
            component: () => import('../views/ApplicationsView.vue'),
            props: true,
            meta: { requiresAuth: true, developersOnly: true },
        },
        {
            path: '/profile',
            name: 'Profile',
            component: () => import('../views/ProfileView.vue'),
            meta: { requiresAuth: true },
        },
        {
            path: '/projects',
            name: 'Projects',
            component: () => import('../views/ProjectsView.vue'),
            meta: { developersOnly: true },
        },
        {
            path: '/projects/owned',
            name: 'OwnedProjects',
            component: () => import('../views/OwnedProjectsView.vue'),
            meta: { requiresAuth: true, projectOwnersOnly: true },
        },
        {
            path: '/projects/post',
            name: 'PostProject',
            component: () => import('../views/PostProjectView.vue'),
            meta: { requiresAuth: true, projectOwnersOnly: true },
        },
        {
            path: '/projects/:id',
            name: 'ProjectDetail',
            component: () => import('../views/ProjectDetailView.vue'),
            meta: { requiresAuth: true, developersOnly: true },
        },
        {
            path: '/login',
            name: 'Login',
            component: () => import('../views/LoginView.vue'),
        },
        {
            path: '/signup',
            name: 'SignUp',
            component: () => import('../views/SignUpView.vue'),
        },
        {
            path: '/:catchAll(.*)',
            name: 'page-not-found',
            component: () => import('../views/Error404View.vue'),
        },
    ],
})

router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore()

    await authStore.fetchUser()

    if (to.meta.requiresAuth && !authStore.getIsAuthenticated) {
        next('/login')
    } else if (to.meta.developersOnly && !authStore.getUserIsDeveloper) {
        next('/page-not-found')
    } else if (to.meta.projectOwnersOnly && !authStore.getUserIsProjectOwner) {
        next('/page-not-found')
    } else {
        next()
    }
})

export default router

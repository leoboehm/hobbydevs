import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

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
        },
        {
            path: '/apply/:projectId',
            name: 'Apply',
            component: () => import('../views/ApplicationsView.vue'),
            props: true,
        },
        // {
        //     path: '/applications',
        //     name: 'Applications',
        //     component: () => import('../views/ApplicationsView.vue'),
        // },
        {
            path: '/profile',
            name: 'Profile',
            component: () => import('../views/ProfileView.vue'),
        },
        {
            path: '/projects',
            name: 'Projects',
            component: () => import('../views/ProjectsView.vue'),
        },
        {
            path: '/projects/owned',
            name: 'OwnedProjects',
            component: () => import('../views/OwnedProjectsView.vue'),
        },
        {
            path: '/projects/post',
            name: 'PostProject',
            component: () => import('../views/PostProjectView.vue'),
        },
        {
            path: '/projects/:id',
            name: 'ProjectDetail',
            component: () => import('../views/ProjectDetailView.vue'),
        },
        {
            path: '/projects/:id/edit',
            name: 'EditProject',
            component: () => import('../views/EditProjectView.vue'),
        },
        {
            path: '/edit-personal-data',
            name: 'EditData',
            component: () => import('../views/EditPersonalDataView.vue'),
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
            path: '/sent-applications',
            name: 'SentApplications',
            component: () => import('../views/SentApplicationsView.vue'),
          },
    ],
})

export default router

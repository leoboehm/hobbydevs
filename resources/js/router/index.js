import { createRouter, createWebHistory } from 'vue-router'
import { routeComponents } from './routeComponents'
import applyAuthGuard from './authGuard'


const routes = [
    {
      path: '/',
      name: 'Home',
      component: routeComponents.Home,
    },
    {
      path: '/about',
      name: 'About',
      component: routeComponents.About,
    },
    {
      path: '/developers',
      name: 'Developers',
      component: routeComponents.Devs,
      meta: { projectOwnersOnly: true },
    },
    {
      path: '/developers/:id',
      name: 'DeveloperDetail',
      component: routeComponents.DevDetail,
      props: true,
      meta: { requiresAuth: true, projectOwnersOnly: true },
    },
    {
      path: '/apply/:projectId',
      name: 'Apply',
      component: routeComponents.Apply,
      props: true,
      meta: { requiresAuth: true, developersOnly: true },
    },
    {
      path: '/profile',
      name: 'Profile',
      component: routeComponents.Profile,
      meta: { requiresAuth: true },
    },
    {
      path: '/projects',
      name: 'Projects',
      component: routeComponents.Projects,
      meta: { developersOnly: true },
    },
    {
      path: '/projects/post',
      name: 'PostProject',
      component: routeComponents.PostProject,
      meta: { requiresAuth: true, projectOwnersOnly: true },
    },
    {
      path: '/projects/:id',
      name: 'ProjectDetail',
      component: routeComponents.ProjectDetail,
      meta: { requiresAuth: true },
    },
    {
      path: '/login',
      name: 'Login',
      component: routeComponents.Login,
    },
    {
      path: '/signup',
      name: 'SignUp',
      component: routeComponents.SignUp,
    },
    {
      path: '/:catchAll(.*)',
      name: 'NotFound',
      component: routeComponents.NotFound,
    },
  ]

const router = createRouter({
history: createWebHistory(import.meta.env.BASE_URL),
routes,
})

applyAuthGuard(router)

export default router

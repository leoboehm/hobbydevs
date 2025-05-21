import { useAuthStore } from '../stores/auth'

export default function applyAuthGuard(router) {
  router.beforeEach(async (to, from, next) => {
    const auth = useAuthStore()
    await auth.fetchUser()

    if (to.meta.requiresAuth && !auth.getIsAuthenticated) {
      return next('/login')
    }
    if (to.meta.developersOnly && !auth.getUserIsDeveloper) {
      return next('/page-not-found')
    }
    if (to.meta.projectOwnersOnly && !auth.getUserIsProjectOwner) {
      return next('/page-not-found')
    }
    next()
  })
}

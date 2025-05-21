import HomeView from '../views/HomeView.vue'

export const routeComponents = {
  Home:    HomeView,
  About:   () => import('../views/AboutView.vue'),
  Devs:    () => import('../views/DevelopersView.vue'),
  DevDetail: () => import('../views/DeveloperDetail.vue'),
  Apply:   () => import('../views/ApplicationsView.vue'),
  Profile: () => import('../views/ProfileView.vue'),
  Projects:() => import('../views/ProjectsView.vue'),
  PostProject:() => import('../views/PostProjectView.vue'),
  ProjectDetail:() => import('../views/ProjectDetailView.vue'),
  Login:   () => import('../views/LoginView.vue'),
  SignUp:  () => import('../views/SignUpView.vue'),
  NotFound:() => import('../views/Error404View.vue'),
}

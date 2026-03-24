import HomeView from '../views/HomeView.vue'

export const routeComponents = {
  Home: HomeView,
  Help: () => import('../views/HelpView.vue'),
  Devs: () => import('../views/DevelopersListView.vue'),
  DevDetail: () => import('../views/developers/DeveloperDetailView.vue'),
  Apply: () => import('../views/ApplicationsView.vue'),
  Profile: () => import('../views/ProfileView.vue'),
  Projects: () => import('../views/projects/ProjectsListView.vue'),
  PostProject: () => import('../views/EnlistProjectView.vue'),
  ProjectDetail: () => import('../views/ProjectDetailView.vue'),
  Login: () => import('../views/LoginView.vue'),
  SignUp: () => import('../views/SignUpView.vue'),
  NotFound: () => import('../views/Error404View.vue'),
}

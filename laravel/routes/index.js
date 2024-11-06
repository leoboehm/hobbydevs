import { createRouter, createWebHistory } from 'vue-router';

// Import your placeholder components
import Home from '../views/Home.vue';
import Developers from '../views/Developers.vue';
import Applications from '../views/Applications.vue';
import OwnProfile from '../views/OwnProfile.vue';
import Projects from '../views/Projects.vue';
import AboutHelp from '../views/AboutHelp.vue';
import Login from '../views/Login.vue';
import SignUp from '../views/SignUp.vue';
import ProjectDetail from '../views/ProjectDetail.vue';
import OwnedProjects from '../views/OwnedProjects.vue';
import PostProject from '../views/PostProject.vue';
import EditProject from '../views/EditProject.vue';
import EditData from '../views/EditData.vue';

const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/developers', name: 'Developers', component: Developers },
  { path: '/applications', name: 'Applications', component: Applications },
  { path: '/profile', name: 'OwnProfile', component: OwnProfile },
  { path: '/projects', name: 'Projects', component: Projects },
  { path: '/projects/owned', name: 'OwnedProjects', component: OwnedProjects },
  { path: '/projects/post', name: 'PostProject', component: PostProject },
  { path: '/projects/:id', name: 'ProjectDetail', component: ProjectDetail },
  { path: '/projects/:id/edit', name: 'EditProject', component: EditProject },
  { path: '/edit-data', name: 'EditData', component: EditData },
  { path: '/about', name: 'AboutHelp', component: AboutHelp },
  { path: '/login', name: 'Login', component: Login },
  { path: '/signup', name: 'SignUp', component: SignUp },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;

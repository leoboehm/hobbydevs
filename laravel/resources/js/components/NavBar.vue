<template>
    <v-app-bar app color="blue-darken-2" dark flat>
      <v-container class="d-flex justify-space-between align-center">
        <v-toolbar-title class="text-h6 font-weight-bold">
          <router-link to="/" class="text-white text-decoration-none">
            HobbyDevs
          </router-link>
        </v-toolbar-title>
  
        <v-spacer />
  
        <v-btn icon to="/" class="home-btn">
          <v-icon>mdi-home</v-icon>
        </v-btn>
  
        <v-btn
          text
          to="/projects"
          class="nav-btn"
          v-if="authStore.getUserIsDeveloper"
        >
          <v-icon left>mdi-briefcase</v-icon> Projects
        </v-btn>
  
        <v-btn
          text
          to="/projects/post"
          class="nav-btn"
          v-if="authStore.getUserIsProjectOwner"
        >
          <v-icon left>mdi-text-box-plus-outline</v-icon> Post Project
        </v-btn>

        <v-btn
          text
          to="/developers"
          class="nav-btn"
          v-if="authStore.getUserIsProjectOwner"
        >
          <v-icon left>mdi-head</v-icon> Developers
        </v-btn>
  
        <v-btn text to="/about" class="nav-btn">
          <v-icon left>mdi-information</v-icon> About
        </v-btn>
  
        <v-btn
          text
          v-if="!authStore.getIsAuthenticated"
          to="/login"
          class="nav-btn"
          color="blue-darken-4"
        >
          <v-icon left>mdi-login</v-icon> Login
        </v-btn>
  
        <template v-else>
          <!-- Avatar Dropdown -->
          <v-menu bottom left>
            <template #activator="{ props }">
              <v-avatar v-bind="props" class="clickable-avatar">
                <v-icon>mdi-account-circle</v-icon>
              </v-avatar>
            </template>
            <v-list>
              <v-list-item to="/profile" link>
                <v-list-item-title>My Profile</v-list-item-title>
              </v-list-item>
              <v-list-item @click="dialog = true">
                <v-list-item-title>Logout</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </template>
      </v-container>
  
      <!-- Logout Confirmation -->
      <v-dialog v-model="dialog" width="400">
        <v-card>
          <v-card-title class="text-h6">Confirm Logout</v-card-title>
          <v-card-text>Are you sure you want to log out?</v-card-text>
          <v-card-actions>
            <v-spacer />
            <v-btn text color="grey" @click="dialog = false">Cancel</v-btn>
            <v-btn text color="red" @click="confirmLogout">Yes, Log out</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-app-bar>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'
  import { useAuthStore } from '@/stores/auth'
  
  const router = useRouter()
  const authStore = useAuthStore()
  
  const dialog = ref(false)
  
  const confirmLogout = () => {
    dialog.value = false
    logout()
  }
  
  const logout = () => {
  if (authStore) {
    authStore.actionLogout().then(() => {
      router.push({ name: 'Home' }).then(() => {
        location.reload()
      })
    })
  } else {
    alert('Error during logout. Try again later...')
  }
}
  </script>
  
  <style scoped>
  .nav-btn {
    font-weight: 600;
  }
  
  .nav-btn .v-icon {
    margin-right: 8px;
  }
  
  .logout-btn {
    font-weight: 600;
    color: #f44336;
  }
  
  .clickable-avatar {
    cursor: pointer;
    transition: transform 0.2s ease-in-out;
    background: linear-gradient(135deg, #42a5f5, #478ed1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
  }
  
  .clickable-avatar:hover {
    transform: scale(1.1);
  }
  </style>
  
<template>
    <v-app-bar app color="blue-darken-2" dark flat>
        <v-container class="d-flex justify-space-between align-center">
            <v-toolbar-title class="text-h6 font-weight-bold">
            <router-link to="/" class="text-white text-decoration-none">
                HobbyDevs
                </router-link>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon to="/" class="home-btn"><v-icon>mdi-home</v-icon></v-btn>
            <v-btn text to="/projects" class="nav-btn">
                <v-icon left>mdi-briefcase</v-icon> Projects
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
                <v-btn text to="/projects/post" class="nav-btn">
                    Publish Project
                </v-btn>
                <v-btn text to="/applications" class="nav-btn">
                    Applications
                </v-btn>
                <v-btn text class="logout-btn" @click="dialog = true"> 
                    <v-icon left>mdi-logout</v-icon> Logout
                </v-btn>

            </template>
        </v-container>
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

<script>
import { useAuthStore } from '@/stores/auth'

export default {
    name: 'NavBar',

    data() {
        return {
            authStore: undefined,

            dialog: false,
        }
    },

    beforeMount() {
        this.authStore = useAuthStore()
    },
    methods: {
        confirmLogout() { 
      this.dialog = false
      this.logout()
    },
        logout() {
            if (this.authStore) {
                this.authStore.actionLogout()

                this.$router.push({ name: 'Home' })
            } else {
                alert('Error during logout. Try again later...')
            }
        },
    },
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
</style>

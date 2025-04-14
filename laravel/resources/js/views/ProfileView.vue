<template>
    <div>
        <h1>Own Profile Page</h1>

        <div v-if="authStore.getIsAuthenticated">
            <p><strong>Name:</strong> {{ authStore.user.name }}</p>
            <p><strong>Email:</strong> {{ authStore.user.email }}</p>
            <p><strong>Username:</strong> {{ authStore.user.username }}</p>
        </div>

        <div v-else>
            <p>You are not logged in. <router-link to="/login">Login here</router-link></p>
        </div>
    </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth'

export default {
    name: 'ProfileView',

    setup() {
        const authStore = useAuthStore()
        console.log('ProfileView - Auth Store:', authStore.user) // Debugging
        return { authStore }
    }
}
</script>

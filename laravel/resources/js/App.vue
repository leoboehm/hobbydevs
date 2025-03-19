<template>
    <v-app>
        <NavBar />

        <v-main>
            <v-container fluid>
                <router-view />
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import NavBar from './components/NavBar.vue';
import { useAuthStore } from './stores/auth';
import { useProjectStore } from './stores/project';

export default {
    components: {
        NavBar,
    },
    
    setup() {
        const auth = useAuthStore()
        const project = useProjectStore()
    
        if (window.Cypress) {
            window.store = {auth, project}
        }
    }
}
</script>

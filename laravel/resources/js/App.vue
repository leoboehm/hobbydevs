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
import NavBar from './components/NavBar.vue'

export default {
    components: {
        NavBar,
    },
}
</script>

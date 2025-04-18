<template>
    <v-app>
        <NavBar />

        <v-main>
            <v-container fluid>
                <router-view />
            </v-container>
        </v-main>

        <Footer />
    </v-app>
</template>

<script>
import NavBar from './components/NavBar.vue';
import Footer from './components/Footer.vue';

export default {
    components: {
        NavBar,
        Footer,
    },
};
</script>

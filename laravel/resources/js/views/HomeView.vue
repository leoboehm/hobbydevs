<template>
    <v-container fluid>
        <h1>Welcome to HobbyDevs!</h1>
        <ProjectsView />
    </v-container>
</template>

<script>
import ProjectsView from './ProjectsView.vue'

export default {
    name: 'HomeView',

    components: { ProjectsView },
}
</script>

<style scoped></style>

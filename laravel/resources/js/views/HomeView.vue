<template>
    <v-container class="py-12">
      <v-row>
        <v-col cols="12">
          <v-sheet elevation="2" rounded class="pa-10 text-center">
            <h1 class="text-h3 font-weight-bold mb-4">Bring Your Ideas to Life</h1>
            <p class="text-subtitle-1 mb-6">
              Connect with hobby developers and turn your vision into reality.
            </p>
            <v-btn color="primary" class="ma-2" to="/signup">Get Started</v-btn>
            <v-btn color="secondary" class="ma-2" to="/projects">View Projects</v-btn>
          </v-sheet>
        </v-col>
      </v-row>

        <v-container class="mt-12">
            <v-row>
                <v-col cols="12" md="4">
                    <v-card class="pa-4" elevation="3">
                        <v-icon color="primary" size="48"
                            >mdi-lightbulb-on-outline</v-icon
                        >
                        <h2 class="text-h5 font-weight-medium mt-2">
                            Explore Projects
                        </h2>
                        <p class="text-body-2">
                            Discover innovative ideas looking for developers
                            like you. Browse open projects and apply based on
                            your skills and availability.
                        </p>
                        <v-btn text color="primary" class="mt-2" to="/projects"
                            >View Projects</v-btn
                        >
                    </v-card>
                </v-col>

                <v-col cols="12" md="4">
                    <v-card class="pa-4" elevation="3">
                        <v-icon color="primary" size="48"
                            >mdi-account-plus-outline</v-icon
                        >
                        <h2 class="text-h5 font-weight-medium mt-2">Sign Up</h2>
                        <p class="text-body-2">
                            Create your profile and showcase your development
                            skills or post your project idea. Get matched with
                            like-minded collaborators.
                        </p>
                        <v-btn text color="primary" class="mt-2" to="/signup"
                            >Get Started</v-btn
                        >
                    </v-card>
                </v-col>

                <v-col cols="12" md="4">
                    <v-card class="pa-4" elevation="3">
                        <v-icon color="primary" size="48"
                            >mdi-information-outline</v-icon
                        >
                        <h2 class="text-h5 font-weight-medium mt-2">
                            About Us
                        </h2>
                        <p class="text-body-2">
                            Learn how Hobby Devs bridges the gap between ideas
                            and implementation by connecting visionaries with
                            talented developers.
                        </p>
                        <v-btn text color="primary" class="mt-2" to="/about"
                            >Read More</v-btn
                        >
                    </v-card>
                </v-col>
            </v-row>
        </v-container>

        <v-container class="text-center my-12">
            <h2 class="text-h4 font-weight-bold mb-2">
                Ready to bring your idea to life?
            </h2>
            <p class="text-body-1 mb-4">
                Start your journey today with Hobby Devs
            </p>
            <v-btn color="primary" large to="/signup">Get Started</v-btn>
        </v-container>
    </v-container>
</template>

<script>
import ProjectsView from './ProjectsView.vue'

export default {
    name: 'HomeView',

    components: { ProjectsView },
}
</script>

<style scoped>
</style>

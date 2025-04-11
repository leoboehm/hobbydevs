<template>
    <v-container fluid class="py-12">
        <h2 class="text-center text-h5 font-weight-bold mb-8">
            These projects are currently looking for Developers:
        </h2>

        <v-row
            dense
            v-for="project in projectList"
            :key="project.id"
            class="mb-6"
        >
            <v-col cols="12">
                <v-card class="elevation-2">
                    <v-card-title class="text-h6 font-weight-bold">{{
                        project.title
                    }}</v-card-title>
                    <v-card-subtitle class="text-subtitle-2"
                        >Category: {{ project.category }}</v-card-subtitle
                    >
                    <v-card-text>
                        <p class="text-subtitle-2">
                            Required Skills: {{ project.skills }}
                        </p>
                    </v-card-text>

                    <v-card-actions>
                        <v-btn
                            @click="apply(project.id)"
                            class="text-secondary"
                            outlined
                        >
                            <v-icon class="mr-2">mdi-application</v-icon> Apply
                            to this project
                        </v-btn>
                        <v-spacer />
                        <v-btn
                            @click="viewProjectDetail(project.id)"
                            class="text-primary"
                            outlined
                            >Read more
                            <v-icon class="ml-2">mdi-arrow-right</v-icon>
                        </v-btn>
                        <v-spacer />
                        <v-btn
                            @click="goToEditPage(project.id)"
                            class="text-warning"
                            outlined
                        >
                            <v-icon class="mr-2">mdi-pencil</v-icon> Edit Project
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { useProjectStore } from '../stores/project'
import { useAuthStore } from '@/stores/auth'

export default {
    name: 'ProjectsView',

    data() {
        return {
            projectStore: useProjectStore(),
            authStore: useAuthStore(),
            projectList: [],
        }
    },

    async created() {
        try {
            const fetchedProjects =
                await this.projectStore.actionGetAllProjects()
            if (fetchedProjects.length > 0) {
                this.projectList = fetchedProjects
            }
            console.log('Projects Loaded:', this.projectList)
        } catch (error) {
            console.error('Error loading projects:', error)
        }
    },

    methods: {
        viewProjectDetail(id) {
            if (this.authStore.getUserLoggedIn) {
                this.$router.push({ name: 'ProjectDetail', params: { id } })
            } else {
                this.$router.push({ name: 'Login' })
            }
        },
        apply(id) {
            if (this.authStore.getUserLoggedIn) {
                this.$router.push({ name: 'Apply', params: { projectId: id } })
            } else {
                this.$router.push({ name: 'Login' })
            }
        },
        goToEditPage(projectId) {
            this.$router.push(`/projects/${projectId}/edit`)
        },
    },
}
</script>

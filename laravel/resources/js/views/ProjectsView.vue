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
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useProjectStore } from '../stores/project'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'

// Initialize stores and router
const projectStore = useProjectStore()
const authStore = useAuthStore()
const router = useRouter()

// Reactive state
const projectList = ref([])

// Fetch projects on mounted
onMounted(async () => {
    try {
        const fetchedProjects = await projectStore.actionGetAllProjects()
        if (fetchedProjects.length > 0) {
            projectList.value = fetchedProjects
        }
    } catch (error) {
        console.error('Error loading projects:', error)
    }
})

// Method to navigate to project details
const viewProjectDetail = id => {
    if (authStore.getIsAuthenticated) {
        router.push({ name: 'ProjectDetail', params: { id } })
    } else {
        router.push({ name: 'Login' })
    }
}

// Method to navigate to apply page
const apply = id => {
    if (authStore.getIsAuthenticated) {
        router.push({ name: 'Apply', params: { projectId: id } })
    } else {
        router.push({ name: 'Login' })
    }
}

// Method to navigate to edit project page
const goToEditPage = projectId => {
    router.push(`/projects/${projectId}/edit`)
}
</script>

<template>
    <div>
        <h2 class="text-green my-2">
            These projects are currently looking for Developers:
        </h2>
        <v-row dense v-for="project in projectList" :key="project.id">
            <v-col cols="12">
                <v-card>
                    <v-card-title>{{ project.title }}</v-card-title>
                    <v-card-subtitle>{{ project.description }}</v-card-subtitle>
                    <v-card-text>
                        Category: {{ project.category }}<br />
                        Required Skills: {{ project.skills }}<br />
                        Salary: {{ project.salary_range }}<br />
                        Duration: {{ project.duration }}<br />
                        Start Date: {{ project.start_date }} - Deadline:
                        {{ project.deadline }}
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer />
                        <v-btn @click="apply(project.id)" class="text-primary"
                            >Apply to this project</v-btn
                        >
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import { useProjectStore } from '../stores/project'

export default {
    name: 'ProjectsView',

    data() {
        return {
            projectStore: undefined,

            projectList: [],
        }
    },

    async beforeMount() {
        this.projectStore = useProjectStore()

        this.projectList = await this.projectStore.actionGetAllProjects()
        console.debug('projects', this.projectList)
    },

    methods: {
        apply(id) {
            this.$router.push({ name: 'Apply', params: { projectId: id } })
        },
    },
}
</script>

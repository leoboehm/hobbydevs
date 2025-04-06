<template>
    <div>
        <h2 class="text-green my-2">
            These projects are currently looking for Developers:
        </h2>
        

        <v-row dense v-for="project in projectList" :key="project.id">
            <v-col cols="12">
                <v-card>
                    <v-card-title>{{ project.title }}</v-card-title>
                    <v-card-text>
                        Category: {{ project.category }}<br />
                        Required Skills: {{ project.skills }}<br />
                    </v-card-text>
                    <v-card-actions>
                        <v-btn 
                            @click="viewProjectDetail(project.id)" 
                            class="text-primary"
                        >
                            Project Detail
                        </v-btn>
                        <v-spacer />
                        <v-btn 
                            @click="apply(project.id)" 
                            class="text-primary"
                        >
                            Apply to this project
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import { useProjectStore } from '../stores/project'

export default {
    name: 'HomeView',

 /* data() {
        return {
            projectStore: useProjectStore(),
            projectList: [  // Mock data
                {
                    id: 1,
                    title: "AI-Powered Resume Analyzer",
                    description: "A web-based tool that helps job seekers analyze and optimize their resumes using AI.",
                    category: "Web Development",
                    skills: ["Vue.js", "JavaScript", "Python", "Machine Learning"],
                    salary_range: "€2000-€3000",
                    duration: "6 months",
                    start_date: "2025-05-01",
                    deadline: "2025-06-15"
                },
                {
                    id: 2,
                    title: "E-Learning Platform",
                    description: "An interactive e-learning platform with gamified content and real-time collaboration.",
                    category: "Education Tech",
                    skills: ["Vue.js", "Node.js", "MongoDB"],
                    salary_range: "€2500-€3500",
                    duration: "8 months",
                    start_date: "2025-06-01",
                    deadline: "2025-07-20"
                }
            ]
        };
    },
*/

    async created() {
        try {
            const fetchedProjects = await this.projectStore.actionGetAllProjects();
            if (fetchedProjects.length > 0) {
                this.projectList = fetchedProjects; 
            }
            console.log("Projects Loaded:", this.projectList);
        } catch (error) {
            console.error("Error loading projects:", error);
        }
    },

    methods: {
        viewProjectDetail(id) {
            this.$router.push({ name: 'ProjectDetail', params: { id } });
        },
        apply(id) {
            this.$router.push({ name: 'Apply', params: { projectId: id } });
        },
    },
};
</script>
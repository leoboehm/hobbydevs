<template>
    <div>
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
          </v-card>
        </v-col>
      </v-row>
    </div>
  </template>
  
  <script>
  import { useProjectStore } from '../stores/project';
  
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
  
    methods: {
      viewProjectDetail(id) {
        this.$router.push({ name: 'ProjectDetail', params: { projectId: id } });
      },
      apply(id) {
        this.$router.push({ name: 'Apply', params: { projectId: id } });
      },
    },
  };
  </script>
  
  <style scoped>
  </style>
  
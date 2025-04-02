<template>
    <div>
      <h1>Owned Projects Page</h1>
      <p>Manage applications for your projects.</p>
  
      <div v-for="project in projects" :key="project.id" class="project-card">
        <h2>{{ project.title }}</h2>
        <p>{{ project.description }}</p>
        
        <h3>Applications:</h3>
        <div v-if="project.applications.length">
          <div v-for="application in project.applications" :key="application.id" class="application-card">
            <h4>Applicant: {{ application.applicantName }}</h4>
            <p>{{ application.message }}</p>
            <p>Status: <strong>{{ application.status }}</strong></p>
            
            <v-btn v-if="application.status === 'Pending'" @click="acceptApplication(project.id, application.id)" color="green">Accept</v-btn>
            <v-btn v-if="application.status === 'Pending'" @click="declineApplication(project.id, application.id)" color="red">Decline</v-btn>
          </div>
        </div>
        <p v-else>No applications yet.</p>
      </div>
    </div>
  </template>


  <script>
  /*
  export default {
    name: 'OwnedProjectsView',
    data() {
      return {
        projects: [
          {
            id: 1,
            title: "AI-Powered Resume Analyzer",
            description: "A web-based tool that helps job seekers optimize resumes using AI.",
            applications: [
              { id: 1, applicantName: "John Doe", message: "Interested in AI projects!", status: "Pending" },
              { id: 2, applicantName: "Jane Smith", message: "I have experience in Vue.js!", status: "Pending" },
            ]
          },
          {
            id: 2,
            title: "E-Learning Platform",
            description: "An interactive platform for gamified learning experiences.",
            applications: [
              { id: 3, applicantName: "Alice Johnson", message: "Experienced in EdTech platforms!", status: "Pending" },
            ]
          }
        ]
      };
    },

    methods: {
      acceptApplication(projectId, applicationId) {
        const project = this.projects.find(p => p.id === projectId);
        const application = project.applications.find(a => a.id === applicationId);
        application.status = "Accepted";
        console.log(`Accepted application ${applicationId} for project ${projectId}`);
      },
      declineApplication(projectId, applicationId) {
        const project = this.projects.find(p => p.id === projectId);
        const application = project.applications.find(a => a.id === applicationId);
        application.status = "Declined";
        console.log(`Declined application ${applicationId} for project ${projectId}`);
      }
    }
  };
  */
  </script>
  
  <style scoped>
  .project-card {
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 20px;
  }
  .application-card {
    border: 1px solid #eee;
    padding: 10px;
    margin-top: 10px;
  }
  </style>
  
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
  
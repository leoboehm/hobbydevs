<template>
    <v-container>
      <v-card>
        <v-card-title>My Sent Applications</v-card-title>
        <v-card-text>
          <v-list>
            <v-list-item v-for="application in applications" :key="application.id">
              <v-list-item-content>
                <v-list-item-title>
                  {{ application.first_name }} {{ application.last_name }}
                </v-list-item-title>
                <v-list-item-subtitle>
                  Status: {{ application.status ? application.status : 'N/A' }}
                </v-list-item-subtitle>
                <v-list-item-subtitle>
                  Applied on: {{ new Date(application.created_at).toLocaleDateString() }}
                </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>
      </v-card>
    </v-container>
  </template>
  
  <script>
  import axios from '../services/axios';
  
  export default {
    name: 'SentApplicationsView',
    data() {
      return {
        applications: [],
      };
    },
    created() {
      this.fetchApplications();
    },
    methods: {
      async fetchApplications() {
        try {
          // Assuming your backend endpoint is /api/sent-applications
          const response = await axios.get('/sent-applications');
          this.applications = response;
        } catch (error) {
          console.error('Error fetching sent applications:', error);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  
  </style>
  
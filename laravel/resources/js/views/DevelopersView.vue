<template>
    <v-container class="pa-4">
      <v-card>
        <v-card-title>
          <span class="headline">Developer Profiles</span>
        </v-card-title>
        <v-card-text>
          <v-row>
            <v-col
              v-for="dev in developers"
              :key="dev.id"
              cols="12"
              md="6"
              lg="4"
            >
              <v-card outlined>
                <v-card-title class="d-flex justify-space-between">
                  {{ dev.name }}
                  <v-chip color="primary" small>{{ dev.skill }}</v-chip>
                </v-card-title>
                <v-card-text>
                  <p><strong>Email:</strong> {{ dev.email }}</p>
                  <p><strong>Experience:</strong> {{ dev.experience }} years</p>
                  <p>{{ dev.bio }}</p>
                  
                  <!-- Rating Section -->
                  <v-rating
                    v-model="dev.rating"
                    :max="5"
                    color="amber"
                    size="20"
                    class="mt-3"
                  ></v-rating>
                  <p><strong>Rating:</strong> {{ dev.rating }} / 5</p>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-container>
  </template>
  
  <script>
  export default {
    name: 'DeveloperProfiles',
    data() {
      return {
        developers: [
          {
            id: 1,
            name: 'Lisa',
            email: 'lisa@example.com',
            skill: 'Frontend',
            experience: 2,
            bio: 'I love working with Vue and Material Design.',
            rating: 4, // Initial rating
          },
          {
            id: 2,
            name: 'Alex',
            email: 'alex@example.com',
            skill: 'Backend',
            experience: 3,
            bio: 'Specialized in Node.js and REST APIs.',
            rating: 5, // Initial rating
          },
        ],
      }
    },
  }
  </script>
  
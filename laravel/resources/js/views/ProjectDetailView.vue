<template>
  <div v-if="project">
    <v-card-text>
      <v-row>
        <v-col cols="12" sm="6">
          <strong>Category:</strong>
          <div>{{ project.category }}</div>
        </v-col>
        <v-col cols="12" sm="6">
          <strong>Required Skills:</strong>
          <div>{{ project.skills }}</div>
        </v-col>
        <v-col cols="12" sm="6">
          <strong>Salary:</strong>
          <div>{{ project.salary_range }}</div>
        </v-col>
        <v-col cols="12" sm="6">
          <strong>Duration:</strong>
          <div>{{ project.duration }}</div>
        </v-col>
        <v-col cols="12" sm="6">
          <strong>Start Date:</strong>
          <div>{{ project.start_date }}</div>
        </v-col>
        <v-col cols="12" sm="6">
          <strong>Deadline:</strong>
          <div>{{ project.deadline }}</div>
        </v-col>
      </v-row>

      <v-divider class="my-4"></v-divider>

      <strong>Description:</strong>
      <p>{{ project.description }}</p>
    </v-card-text>
  </div>
  <div v-else>
    <p>Loading...</p>
  </div>
</template>


<script>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';

export default {
  setup() {
    const route = useRoute(); 
    const projectId = ref(route.params.id);  

    const project = ref(null);

    onMounted(async () => {
      try {
        // Ensure projectId is defined
        if (projectId.value) {
          const response = await fetch(`http://127.0.0.1:8000/api/project/${projectId.value}`);
          if (response.ok) {
            project.value = await response.json();  // Store project data
          } else {
            console.error('Project not found');
          }
        } else {
          console.error('No project ID provided');
        }
      } catch (error) {
        console.error('Error fetching project:', error);
      }
    });

    return {
      project, 
    };
  },
};
</script>

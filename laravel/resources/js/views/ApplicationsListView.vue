/**
 *Sent applications (if user is a developer)
 *Received applications (if user is an owner)
 */

 <template>
    <v-container class="fill-height d-flex justify-center align-start" style="width: 100%">
      <v-card elevation="2" style="width: 80vw; max-width: 1200px" class="px-4 py-4">
        <v-card-title>
          <span class="headline">
            {{ isOwner ? 'Received Applications' : 'My Sent Applications' }}
          </span>
        </v-card-title>
  
        <v-card-text>
          <v-alert v-if="applications.length === 0" type="info">
            No applications to show.
          </v-alert>
  
          <v-list v-else>
            <v-list-item v-for="application in applications" :key="application.id">
              <v-list-item-content>
                <v-list-item-title>
                  {{ application.first_name }} {{ application.last_name }}
                </v-list-item-title>
                <v-list-item-subtitle>
                  Status: {{ application.status || 'N/A' }}
                </v-list-item-subtitle>
                <v-list-item-subtitle>
                  Applied on: {{ new Date(application.created_at).toLocaleDateString() }}
                </v-list-item-subtitle>
                <v-list-item-subtitle v-if="application.project">
                  Project: {{ application.project.title }}
                </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>
      </v-card>
    </v-container>
  </template>
  
  <script>
  import axios from '../services/axios'
  
  export default {
    name: 'ApplicationsListView',
  
    data() {
      return {
        user: null,
        applications: [],
      }
    },
  
    computed: {
      isOwner() {
        return this.user?.type === 'owner'
      },
    },
  
    async created() {
      await this.fetchUser()
      await this.fetchApplications()
    },
  
    methods: {
      async fetchUser() {
        try {
          const res = await axios.get('/user')
          this.user = res.data
        } catch (error) {
          console.error('Error fetching user:', error)
        }
      },
  
      async fetchApplications() {
        try {
          const route = this.isOwner ? '/received-applications' : '/sent-applications'
          const response = await axios.get(route)
          this.applications = response.data
        } catch (error) {
          console.error('Error fetching applications:', error)
        }
      },
    },
  }
  </script>
  
  <style scoped>
  .fill-height {
    height: 100vh;
  }
  </style>
  
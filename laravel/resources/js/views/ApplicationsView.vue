<template>
    <v-container
        class="fill-height d-flex justify-center align-start"
        style="width: 100%"
    >
        <v-card
            elevation="2"
            style="width: 80vw; max-width: 1200px"
            class="px-4 py-4"
        >
            <v-card-title>
                <span class="headline">Apply for a Project</span>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <!-- First Name -->
                    <v-text-field
                        v-model="firstName"
                        :rules="[rules.required]"
                        label="First Name"
                        outlined
                        required
                    ></v-text-field>

                    <!-- Last Name -->
                    <v-text-field
                        v-model="lastName"
                        :rules="[rules.required]"
                        label="Last Name"
                        outlined
                        required
                    ></v-text-field>

                    <!-- Skills (with tags) -->
                    <v-combobox
                        v-model="skills"
                        :items="availableSkills"
                        label="Skills"
                        multiple
                        outlined
                        chips
                        clearable
                        small-chips
                    ></v-combobox>

                    <!-- Availability -->
                    <v-text-field
                        v-model="availability"
                        :rules="[rules.required]"
                        label="Availability (e.g., 20 hours/week)"
                        outlined
                        required
                    ></v-text-field>

                    <!-- Past Experience -->
                    <v-textarea
                        v-model="pastExperience"
                        :rules="[rules.required]"
                        label="Past Experience"
                        outlined
                        required
                    ></v-textarea>

                    <!-- Motivation -->
                    <v-textarea
                        v-model="motivation"
                        :rules="[rules.required]"
                        label="Motivation"
                        outlined
                        required
                    ></v-textarea>

                    <!-- Contact Information -->
                    <v-text-field
                        v-model="contactInfo"
                        :rules="[rules.required, rules.email]"
                        label="Contact Information (Email or Phone)"
                        outlined
                        required
                    ></v-text-field>
                </v-form>
            </v-card-text>
            <v-card-actions class="justify-end">
                <!-- Cancel Button -->
                <v-btn text color="red" @click="cancel">Cancel</v-btn>
                <!-- Submit Button -->
                <v-btn color="primary" @click="submit" :disabled="!valid">
                    Submit
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script setup>
import { onMounted } from 'vue'
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useProjectStore } from '../stores/project'
import { useAuthStore } from '@/stores/auth'
// Store & router
const projectStore = useProjectStore()
const route = useRoute()
const router = useRouter()
const authStore = useAuthStore()
// Form state
const valid = ref(false)
const firstName = ref('')
const lastName = ref('')
const skills = ref([])
const availability = ref('')
const pastExperience = ref('')
const motivation = ref('')
const contactInfo = ref('')
const form = ref(null) // for template ref

const availableSkills = ['Java', 'Python', 'JavaScript', 'C++', 'HTML', 'CSS']

// Validation rules
const rules = {
    required: value => !!value || 'This field is required',
    email: value => /.+@.+\..+/.test(value) || 'E-mail must be valid',
}


// Submit method
const submit = async () => {
    if (form.value.validate()) {
        const applicationData = {
            id: authStore.getUser.id,
            firstName: firstName.value,
            lastName: lastName.value,
            skills: skills.value,
            availability: availability.value,
            pastExperience: pastExperience.value,
            motivation: motivation.value,
            contactInfo: contactInfo.value,
            project_id: route.params.projectId,
        }


        try {
            await projectStore.actionApplyForProject(applicationData)
            alert('Application submitted successfully!')
            router.push({ name: 'Home' })
        } catch (error) {
            console.error('Failed to submit application:', error)
            alert('There was an error submitting your application.')
        }
    }
}

// Cancel method
const cancel = () => {
    firstName.value = ''
    lastName.value = ''
    skills.value = []
    availability.value = ''
    pastExperience.value = ''
    motivation.value = ''
    contactInfo.value = ''
    form.value.resetValidation()
}
onMounted(() => {
  const user = authStore.user
  if (user) {
    firstName.value = user.firstname
    lastName.value = user.lastname
    contactInfo.value = user.email
  }
})
</script>

<style scoped>
.fill-height {
    height: 100vh;
}
</style>

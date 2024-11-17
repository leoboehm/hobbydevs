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

<script>
import { useProjectStore } from '../stores/project'
export default {
    name: 'ApplicationsView',

    data() {
        return {
            valid: false,
            firstName: '',
            lastName: '',
            skills: [], // Array to store skills as tags
            availableSkills: [
                'Java',
                'Python',
                'JavaScript',
                'C++',
                'HTML',
                'CSS',
            ], // Initial skill options
            availability: '',
            pastExperience: '',
            motivation: '',
            contactInfo: '',
            rules: {
                required: value => !!value || 'This field is required',
                email: value =>
                    /.+@.+\..+/.test(value) || 'E-mail must be valid',
            },
        }
    },

    methods: {
        async submit() {
            if (this.$refs.form.validate()) {
                const applicationData = {
                    firstName: this.firstName,
                    lastName: this.lastName,
                    skills: this.skills,
                    availability: this.availability,
                    pastExperience: this.pastExperience,
                    motivation: this.motivation,
                    contactInfo: this.contactInfo,
                }

                const projectStore = useProjectStore()
                try {
                    await projectStore.applyForProject(applicationData)
                    alert('Application submitted successfully!')
                    this.$router.push({ name: 'Home' })
                } catch (error) {
                    console.error('Failed to submit application:', error)
                    alert('There was an error submitting your application.')
                }
            }
        },

        cancel() {
            this.firstName = ''
            this.lastName = ''
            this.skills = []
            this.availability = ''
            this.pastExperience = ''
            this.motivation = ''
            this.contactInfo = ''
            this.$refs.form.resetValidation()
        },
    },
}
</script>

<style scoped>
.fill-height {
    height: 100vh;
}
</style>

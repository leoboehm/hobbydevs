<template>
    <v-container class="fill-height d-flex justify-center align-center">
        <v-card elevation="2" max-width="600">
            <v-card-title>
                <span class="headline">Apply for a Project</span>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <!-- Developer Name -->
                    <v-text-field
                        v-model="developerName"
                        :rules="[rules.required]"
                        label="Developer Name"
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
export default {
    name: 'ApplyForProject',

    data() {
        return {
            valid: false,
            developerName: '',
            skills: [],  // Array to store skills as tags
            availableSkills: ['Java', 'Python', 'JavaScript', 'C++', 'HTML', 'CSS'],  // Initial skill options
            availability: '',
            pastExperience: '',
            motivation: '',
            contactInfo: '',
            rules: {
                required: value => !!value || 'This field is required',
                email: value => /.+@.+\..+/.test(value) || 'E-mail must be valid',
            },
        }
    },

    methods: {
        submit() {
            if (this.$refs.form.validate()) {
                // Perform form submission logic here
                alert('Application submitted successfully!')
                this.$router.push({ name: 'Home' })
            }
        },
        cancel() {
            this.developerName = ''
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

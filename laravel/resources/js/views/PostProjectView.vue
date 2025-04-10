<template>
    <v-form ref="form" v-model="valid" lazy-validation>
        <v-stepper v-model="currentStep">
            <v-stepper-header>
                <v-stepper-item
                    title="Project Detail"
                    value="1"
                ></v-stepper-item>

                <v-divider></v-divider>

                <v-stepper-item
                    title="Duration & Salary"
                    value="2"
                ></v-stepper-item>

                <v-divider></v-divider>

                <v-stepper-item title="Application" value="3"></v-stepper-item>
            </v-stepper-header>

            <v-stepper-window>
                <v-stepper-window-item step="1" value="1">
                    <v-card flat>
                        <v-card-text>
                            <v-row dense>
                                <v-col cols="12">
                                    <v-text-field
                                        id="project-title"
                                        v-model="project.title"
                                        label="Project Title"
                                        outlined
                                        dense
                                        required
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                        id="project-description"
                                        v-model="project.description"
                                        label="Project Description"
                                        outlined
                                        dense
                                        required
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-select
                                        id="category"
                                        v-model="project.category"
                                        :items="categories"
                                        label="Category"
                                        outlined
                                        dense
                                        required
                                        :rules="[rules.required]"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12">
                                    <v-select
                                        id="skills"
                                        v-model="project.skills"
                                        :items="skills"
                                        label="Skills"
                                        outlined
                                        dense
                                        multiple
                                        required
                                        :rules="[rules.required]"
                                    ></v-select>
                                </v-col>
                            </v-row>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer
                            ><v-btn
                                @click="currentStep += 1"
                                class="mx-2 text-green"
                                >Next</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-stepper-window-item>

                <v-stepper-window-item value="2" step="2">
                    <v-card flat>
                        <v-card-text>
                            <v-row dense>
                                <v-col cols="12">
                                    <v-text-field
                                        id="salary-range"
                                        v-model="project.salary"
                                        label="Project Salary Range"
                                        outlined
                                        hint="How much are you willing to pay for your project? e.g. 15$ per hour, 100$ in total, ..."
                                        persistent-hint
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                        id="project-duration"
                                        v-model="project.duration"
                                        label="Project Duration"
                                        outlined
                                        dense
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="5" class="mr-8">
                                    <DatePicker
                                        id="project-start-date"
                                        v-model="unformatted_project_start_date"
                                        label="Start Date"
                                        :min="today"
                                    />
                                </v-col>
                                <v-col cols="5">
                                    <DatePicker
                                        id="project-end-date"
                                        v-model="unformatted_project_end_date"
                                        label="Deadline"
                                        :min="project.start_date"
                                    />
                                </v-col>
                            </v-row>
                        </v-card-text>
                        <v-card-actions>
                            <v-btn @click="currentStep -= 1" class="mx-2"
                                >Previous</v-btn
                            ><v-spacer></v-spacer
                            ><v-btn
                                @click="currentStep += 1"
                                class="mx-2 text-green"
                                >Next</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-stepper-window-item>

                <v-stepper-window-item value="3" step="3"
                    ><v-card flat>
                        <v-card-text>
                            <v-row dense>
                                <v-col cols="5" class="mr-8">
                                    <DatePicker
                                        id="application-start-date"
                                        v-model="
                                            unformatted_application_start_date
                                        "
                                        label="Start Date"
                                        :min="project.start_date"
                                    />
                                </v-col>
                                <v-col cols="5">
                                    <DatePicker
                                        id="application-end-date"
                                        v-model="
                                            unformatted_application_end_date
                                        "
                                        label="End Date"
                                        :min="application.start_date"
                                    />
                                </v-col>
                            </v-row>
                        </v-card-text>
                        <v-card-actions>
                            <v-btn @click="currentStep -= 1" class="mx-2"
                                >Previous</v-btn
                            ><v-spacer></v-spacer
                            ><v-btn @click="postProject" class="mx-2 text-green"
                                >Submit</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-stepper-window-item>
            </v-stepper-window>
        </v-stepper>
    </v-form>
</template>

<script>
import { useDate } from 'vuetify'
import { useProjectStore } from '../stores/project'

import DatePicker from '@/components/DatePicker.vue'

export default {
    components: { DatePicker },
    data() {
        return {
            valid: false,
            date: undefined,
            projectStore: undefined,

            currentStep: 0,

            unformatted_project_start_date: null,
            unformatted_project_end_date: null,
            unformatted_application_start_date: null,
            unformatted_application_end_date: null,

            project: {
                title: '',
                description: '',
                category: '',
                skills: [],
                start_date: '',
                end_date: '',
            },
            application: {
                salary: '',
                start_date: '',
                end_date: '',
            },
            categories: [
                'Web Development',
                'Mobile Development',
                'Desktop Development',
                'Game Development',
                'Data Science',
                'Machine Learning',
                'Artificial Intelligence',
                'Cyber Security',
                'Networking',
            ],
            skills: [
                'HTML',
                'CSS',
                'JavaScript',
                'PHP',
                'Python',
                'Java',
                'C#',
                'C++',
                'Ruby',
                'Swift',
                'Kotlin',
                'Dart',
                'React',
                'Vue',
            ],
            rules: {
                required: value => !!value || 'This field is required',
            },
        }
    },

    beforeMount() {
        this.date = useDate()
        this.projectStore = useProjectStore()
    },
    components: {},
    methods: {
        async postProject() {
            if (this.$refs.form.validate()) {
                let projectData = {
                    title: this.project.title,
                    description: this.project.description,
                    category: this.project.category,
                    skills: this.project.skills,
                    salary_range: this.project.salary,
                    duration: this.project.duration,
                    start_date: this.project.start_date,
                    deadline: this.project.end_date,
                    application_start_date: this.application.start_date,
                    application_deadline: this.application.end_date,
                }
                await this.projectStore.actionPublishProject(projectData)
                this.$router.push({ name: 'Home' })
            }
        },

        formatStartDate(date) {
            this.project.start_date = this.date.format(date, 'fullDate')
        },
        formatEndDate(date) {
            this.project.end_date = this.date.format(date, 'fullDate')
        },
        formatApplicationStartDate(date) {
            this.application.start_date = this.date.format(date, 'fullDate')
        },
        formatApplicationEndDate(date) {
            this.application.end_date = this.date.format(date, 'fullDate')
        },
    },
    computed: {
        today: () => new Date(),
    },

    watch: {
        unformatted_project_start_date: 'formatStartDate',
        unformatted_project_end_date: 'formatEndDate',
        unformatted_application_start_date: 'formatApplicationStartDate',
        unformatted_application_end_date: 'formatApplicationEndDate',
    },
}
</script>

<style scoped></style>

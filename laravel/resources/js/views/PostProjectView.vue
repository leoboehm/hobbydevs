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
                                        v-model="project.start_date"
                                        label="Start Date"
                                        :min="today"
                                    />
                                </v-col>
                                <v-col cols="5">
                                    <DatePicker
                                        id="project-end-date"
                                        v-model="project.end_date"
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
                                            application.start_date
                                        "
                                        label="Start Date"
                                        :min="project.start_date"
                                    />
                                </v-col>
                                <v-col cols="5">
                                    <DatePicker
                                        id="application-end-date"
                                        v-model="
                                            application.end_date
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
import { useCategoryStore } from '../stores/category'
import { useSkillStore } from '../stores/skill'

import DatePicker from '../components/DatePicker.vue'
import PostProjectCommand from '@/commands/PostProjectCommand'
export default {
    components: { DatePicker },
    data() {
        return {
            valid: false,
            date: useDate(),
            projectStore: useProjectStore(),
            categoryStore: useCategoryStore(),
            skillStore: useSkillStore(),

            currentStep: 0,

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
            categories: [],
            skills: [],
            rules: {
                required: value => !!value || 'This field is required',
            },
        }
    },

    async beforeMount() {
        // load categories
        await this.categoryStore.fetchCategories()
        if (this.categoryStore.getCategoriesLoading == false) {
            this.categories = this.categoryStore.getCategories
        }

        // load skills
        await this.skillStore.fetchSkills()
        if (this.skillStore.getSkillsLoading == false) {
            this.skills = this.skillStore.getSkills
        }
    },
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
                    start_date: this.date.formatByString(this.project.start_date, "YYYY-MM-DD hh:mm:ss"),
                    deadline: this.date.formatByString(this.project.end_date, "YYYY-MM-DD hh:mm:ss"),
                    application_start_date: this.date.formatByString(this.application.start_date, "YYYY-MM-DD hh:mm:ss"),
                    application_deadline: this.date.formatByString(this.application.end_date, "YYYY-MM-DD hh:mm:ss"),
                }
                const command = new PostProjectCommand(
                    this.projectStore,
                    projectData,
                    () => this.$router.push({ name: 'Home' }),
                    (error) => alert('Something went wrong while posting.')
                )
                await command.execute()
            }
        },
    },
    computed: {
        today: () => new Date(),
    },
}
</script>

<style scoped></style>

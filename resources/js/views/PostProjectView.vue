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
                                        v-model="application.start_date"
                                        label="Start Date"
                                        :min="project.start_date"
                                    />
                                </v-col>
                                <v-col cols="5">
                                    <DatePicker
                                        id="application-end-date"
                                        v-model="application.end_date"
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

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useDate } from 'vuetify'
import { useProjectStore } from '../stores/project'
import { useCategoryStore } from '../stores/category'
import { useSkillStore } from '../stores/skill'
import DatePicker from '../components/DatePicker.vue'

// Refs
const valid = ref(false)
const date = useDate()
const currentStep = ref(0)

const projectStore = useProjectStore()
const categoryStore = useCategoryStore()
const skillStore = useSkillStore()

const project = ref({
    title: '',
    description: '',
    category: '',
    skills: [],
    start_date: '',
    end_date: '',
})

const application = ref({
    salary: '',
    start_date: '',
    end_date: '',
})

const categories = ref([])
const skills = ref([])

const rules = {
    required: value => !!value || 'This field is required',
}

// Router
const router = useRouter()

// Methods
const postProject = async () => {
    if (valid.value) {
        let projectData = {
            title: project.value.title,
            description: project.value.description,
            category: project.value.category,
            skills: project.value.skills,
            salary_range: application.value.salary,
            duration: project.value.duration,
            start_date: date.formatByString(
                project.value.start_date,
                'YYYY-MM-DD hh:mm:ss',
            ),
            deadline: date.formatByString(
                project.value.end_date,
                'YYYY-MM-DD hh:mm:ss',
            ),
            application_start_date: date.formatByString(
                application.value.start_date,
                'YYYY-MM-DD hh:mm:ss',
            ),
            application_deadline: date.formatByString(
                application.value.end_date,
                'YYYY-MM-DD hh:mm:ss',
            ),
        }

        await projectStore.actionPublishProject(projectData)
        router.push({ name: 'Home' })
    }
}

// Fetch categories and skills on mount
onMounted(async () => {
    await categoryStore.fetchCategories()
    if (!categoryStore.getCategoriesLoading) {
        categories.value = categoryStore.getCategories
    }

    await skillStore.fetchSkills()
    if (!skillStore.getSkillsLoading) {
        skills.value = skillStore.getSkills
    }
})

// Computed
const today = new Date()
</script>
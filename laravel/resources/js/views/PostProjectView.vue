<template>
    <v-stepper v-model="currentStep">
        <template v-slot:default="{ prev, next }">
            <v-stepper-header>
                <v-stepper-item
                    title="Project Detail"
                    value="1"
                    :complete="currentStep > currentStep - 1"
                ></v-stepper-item>

                <v-divider></v-divider>

                <v-stepper-item
                    title="Duration & Salary"
                    value="2"
                    complete
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
                                        v-model="project.title"
                                        label="Project Title"
                                        outlined
                                        dense
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                        v-model="project.description"
                                        label="Project Description"
                                        outlined
                                        dense
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-select
                                        v-model="project.category"
                                        :items="categories"
                                        label="Category"
                                        outlined
                                        dense
                                        required
                                    ></v-select>
                                </v-col>
                                <v-col cols="12">
                                    <v-select
                                        v-model="project.skills"
                                        :items="skills"
                                        label="Skills"
                                        outlined
                                        dense
                                        multiple
                                        required
                                    ></v-select>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
                    <v-stepper-actions
                        :disabled="disabled"
                        @click:next="next"
                    ></v-stepper-actions>
                </v-stepper-window-item>

                <v-stepper-window-item value="2" step="2">
                    <v-card flat>
                        <v-card-text>
                            <v-row dense>
                                <v-col cols="12">
                                    <v-text-field
                                        v-model="project.salary"
                                        label="Project Salary Range"
                                        outlined
                                        hint="How much are you willing to pay for your project? e.g. 15$ per hour, 100$ in total, ..."
                                        persistent-hint
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                        v-model="project.description"
                                        label="Project Duration"
                                        outlined
                                        dense
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="5" class="mr-8">
                                    <v-text-field
                                        v-model="project.start_date"
                                        label="Start Date"
                                        readonly
                                    >
                                        <template v-slot:prepend>
                                            <v-menu
                                                v-model="startDateMenu"
                                                :close-on-content-click="false"
                                                transition="scale-transition"
                                            >
                                                <template
                                                    v-slot:activator="{ props }"
                                                >
                                                    <v-icon
                                                        v-bind="props"
                                                        icon="mdi-calendar"
                                                    />
                                                </template>
                                                <v-date-picker
                                                    v-model="
                                                        unformatted_project_start_date
                                                    "
                                                    @update:modelValue="
                                                        startDateMenu = false
                                                    "
                                                    :min="today"
                                                    hide-header
                                                ></v-date-picker>
                                            </v-menu>
                                        </template>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="5">
                                    <v-text-field
                                        v-model="project.end_date"
                                        label="Deadline"
                                        readonly
                                    >
                                        <template v-slot:prepend>
                                            <v-menu
                                                v-model="deadlineMenu"
                                                :close-on-content-click="false"
                                                transition="scale-transition"
                                            >
                                                <template
                                                    v-slot:activator="{ props }"
                                                >
                                                    <v-icon
                                                        v-bind="props"
                                                        icon="mdi-calendar"
                                                    />
                                                </template>
                                                <v-date-picker
                                                    v-model="
                                                        unformatted_project_end_date
                                                    "
                                                    @update:modelValue="
                                                        deadlineMenu = false
                                                    "
                                                    :min="project.start_date"
                                                    hide-header
                                                ></v-date-picker>
                                            </v-menu>
                                        </template>
                                    </v-text-field>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
                    <v-stepper-actions
                        :disabled="disabled"
                        @click:next="next"
                        @click:prev="prev"
                    ></v-stepper-actions>
                </v-stepper-window-item>

                <v-stepper-window-item value="3" step="3"
                    ><v-card flat>
                        <v-card-text>
                            <v-row dense>
                                <v-col cols="5" class="mr-8">
                                    <v-text-field
                                        v-model="application.start_date"
                                        label="Start Date"
                                        readonly
                                    >
                                        <template v-slot:prepend>
                                            <v-menu
                                                v-model="
                                                    applicationStartDateMenu
                                                "
                                                :close-on-content-click="false"
                                                transition="scale-transition"
                                            >
                                                <template
                                                    v-slot:activator="{ props }"
                                                >
                                                    <v-icon
                                                        v-bind="props"
                                                        icon="mdi-calendar"
                                                    />
                                                </template>
                                                <v-date-picker
                                                    v-model="
                                                        unformatted_application_start_date
                                                    "
                                                    @update:modelValue="
                                                        applicationStartDateMenu = false
                                                    "
                                                    :min="today"
                                                    hide-header
                                                ></v-date-picker>
                                            </v-menu>
                                        </template>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="5">
                                    <v-text-field
                                        v-model="application.end_date"
                                        label="End Date"
                                        readonly
                                    >
                                        <template v-slot:prepend>
                                            <v-menu
                                                v-model="
                                                    applicationDeadlineMenu
                                                "
                                                :close-on-content-click="false"
                                                transition="scale-transition"
                                            >
                                                <template
                                                    v-slot:activator="{ props }"
                                                >
                                                    <v-icon
                                                        v-bind="props"
                                                        icon="mdi-calendar"
                                                    />
                                                </template>
                                                <v-date-picker
                                                    v-model="
                                                        unformatted_application_end_date
                                                    "
                                                    @update:modelValue="
                                                        applicationDeadlineMenu = false
                                                    "
                                                    :min="
                                                        application.start_date
                                                    "
                                                    hide-header
                                                ></v-date-picker>
                                            </v-menu>
                                        </template>
                                    </v-text-field>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
                    <v-stepper-actions
                        nextText="Submit"
                        @click:next="next"
                        @click:prev="prev"
                    ></v-stepper-actions>
                </v-stepper-window-item>
            </v-stepper-window>
        </template>
    </v-stepper>
</template>

<script>
import { useDate } from 'vuetify'

export default {
    data() {
        return {
            date: undefined,

            currentStep: 0,

            startDateMenu: false,
            deadlineMenu: false,
            applicationStartDateMenu: false,
            applicationDeadlineMenu: false,

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
        }
    },

    beforeMount() {
        this.date = useDate()
    },
    components: {},
    methods: {},
    computed: {
        today: () => new Date(),
    },

    watch: {
        unformatted_project_start_date(newValue) {
            this.project.start_date = this.date.format(newValue, 'fullDate')
        },
        unformatted_project_end_date(newValue) {
            this.project.end_date = this.date.format(newValue, 'fullDate')
        },
        unformatted_application_start_date(newValue) {
            this.application.start_date = this.date.format(newValue, 'fullDate')
        },
        unformatted_application_end_date(newValue) {
            this.application.end_date = this.date.format(newValue, 'fullDate')
        },
    },
}
</script>

<style scoped>
h2 {
    margin-bottom: 20px;
}
div {
    margin: 8px 0;
}
input {
    padding: 6px;
    font-size: 1em;
}
.output {
    margin-top: 20px;
}
</style>

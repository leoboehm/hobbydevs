<template>
    <v-stepper v-model="currentStep">
        <template v-slot:default="{ prev, next }">
            <v-stepper-header>
                <v-stepper-item
                    title="Step One"
                    value="1"
                    :complete="currentStep > currentStep - 1"
                ></v-stepper-item>

                <v-divider></v-divider>

                <v-stepper-item
                    title="Step Two"
                    value="2"
                    complete
                ></v-stepper-item>

                <v-divider></v-divider>

                <v-stepper-item title="Step Three" value="3"></v-stepper-item>
            </v-stepper-header>

            <v-stepper-window>
                <v-stepper-window-item step="1" value="1">
                    <v-card title="Project Detail" flat>
                        <v-card-text>
                            <v-row>
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
                                <v-col cols="12">
                                    <v-text-field
                                        v-model="project.salary"
                                        label="Project salary range"
                                        outlined
                                        dense
                                        required
                                    ></v-text-field>
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
                    <v-card title="Project Duration" flat>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                        v-model="project.description"
                                        label="Project Duration"
                                        outlined
                                        dense
                                        required
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                            <v-date-input
                                v-model="project.start_date"
                                label="Project Start Date"
                                outlined
                                dense
                                required
                            ></v-date-input>
                            <v-date-input
                                v-model="project.end_date"
                                label="Project End Date"
                                outlined
                                dense
                                required
                            ></v-date-input>
                        </v-card-text>
                    </v-card>
                    <v-stepper-actions
                        :disabled="disabled"
                        @click:next="next"
                        @click:prev="prev"
                    ></v-stepper-actions>
                </v-stepper-window-item>

                <v-stepper-window-item value="3" step="3"
                    ><v-card title="Application Timeline" flat>
                        <v-date-input
                            v-model="application.start_date"
                            label="Application Start Date"
                            outlined
                            dense
                            required
                        ></v-date-input>
                        <v-date-input
                            v-model="application.end_date"
                            label="Application End Date"
                            outlined
                            dense
                            required
                        ></v-date-input>
                    </v-card>
                    <v-stepper-actions
                        :disabled="disabled"
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
import { VDateInput } from '/node_modules/vuetify/lib/labs/VDateInput'
export default {
    data() {
        return {
            currentStep: 0,
            project: {
                title: '',
                description: '',
                category: '',
                skills: [],
                salary: 0,
                start_date: '',
                end_date: '',
            },
            application: {
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
            randomNumber: null,
        }
    },
    components: {
        VDateInput,
    },
    methods: {},
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

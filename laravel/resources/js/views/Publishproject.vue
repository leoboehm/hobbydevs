
<template v-slot:item.1>
    <v-stepper-step step="1" complete>
    <v-card title="Step One" flat>
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
            </v-row>
        </v-card-text>
    </v-card>
    </v-stepper-step>
    <v-stepper-step>
    <v-card title="Step Two" flat>
        <v-card-text>
            <v-row>
                <v-col cols="12">
                    <v-text-field
                        v-model="project.salary"
                        label="Project salary range"
                        outlined
                        dense
                        required
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
    </v-stepper-step>
</template>

<script>
    import {VDateInput} from '/node_modules/vuetify/lib/labs/VDateInput'

    export default {
        data(){
            return{
                project: {
                    title: '',
                    description: '',
                    category: '',
                    skills: [],
                    salary: 0,
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
        components: {
            VDateInput
        }
    };

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

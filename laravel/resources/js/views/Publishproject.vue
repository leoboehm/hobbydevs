<template>
    <div>
    <h2>Publish Project</h2>


    <div>
        <label for="projecttitle">Project Title:</label>
        <input v-model="projecttitle" type="text" id="projecttitle" placeholder="Enter your project title." />
    </div>

    <div>
        <label for="ProjectDescription">Project Descriptions:</label>
        <input v-model="projectdescription" type="text" id="ProjectDescription" placeholder="Enter your project description." />
    </div>
    


    <div>
        <label for="skillsneeded">Skills Requirments:</label>
        <input v-model="skillsneeded" type="skillsneeded" id="skillsneeded" placeholder="Enter skills required." />
    <v-combobox
        v-model="skills"
        :items="availableSkills"
        label="Skills"
        multiple
        outlined
        chips
        clearable_
        small-chips
    ></v-combobox>  
    </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                Selectedcategory: '',
                categories: ['Frontend', 'Backend', 'Database', 'Security', 'Design', 'Testing'],
                skills: [], 
                availableSkills: ['Java', 'Python', 'JavaScript', 'C++', 'HTML', 'CSS'],
            }
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

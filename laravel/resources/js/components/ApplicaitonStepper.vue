<template>
    <v-stepper>
        <v-stepper-header>
            <v-stepper-item
                title="Step One"
                value="1"
                complete
                editable
            ></v-stepper-item>

        <v-divider></v-divider>

        <v-stepper-item
            title="Step Two"
            value="2"
            complete
        ></v-stepper-item>

        <v-divider></v-divider>

        <v-stepper-item
        title="Step Three"
        value="3"
        editable
        ></v-stepper-item>
    </v-stepper-header>
    </v-stepper>
</template>
    <script>
    export default {
        data: () => ({
        steps: [
            {
            title: 'Step One',
            complete: true,
            editable: true,
            },
            {
            title: 'Step Two',
            editable: true, 
            complete: true,
            },
            {
            title: 'Step Three',
            editable: true,
            complete: true,
            },
        ],
        }),
    };
    </script>
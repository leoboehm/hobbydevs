<template>
    <v-app-bar color="black" dark>
        <v-app-bar-title>HobbyDevs</v-app-bar-title>
        <v-toolbar-items>
            <v-btn color="blue" class="white--text" to="/">Home</v-btn>

            <v-menu offset-y>
                <template #activator="{ on }">
                    <v-btn color="blue" class="white--text" v-on="on">
                        Projects
                    </v-btn>
                </template>
                <v-list>
                    <v-list-item @click="goToProjectDetails">
                        <v-list-item-title>Project Details</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="goToProjectList">
                        <v-list-item-title>Project List</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>

            <v-btn color="blue" to="/about">About</v-btn>
        </v-toolbar-items>
        <v-spacer></v-spacer>

        <v-text-field
            flat
            solo
            hide-details
            color="blue"
            prepend-inner-icon="mdi-magnify"
            placeholder="Search"
            class="search-bar"
        ></v-text-field>

        <v-btn class="text-red mx-2" icon @click="isSignedIn ? onLogoutClick : onLoginClick">
            {{ isSignedIn ? "Logout" : "Login" }}
        </v-btn>
        <v-dialog v-model="dialog" width="auto">
            <v-card
                max-width="400"
                prepend-icon="mdi-update"
                text="Are you sure you want to logout?."
                title="Logging out"
            >
                <template v-slot:actions>
                    <v-btn
                        class="ms-auto"
                        text="Yes"
                        @click="dialog = false"
                    ></v-btn>
                    <v-btn
                        class="ms-auto"
                        text="No"
                        @click="dialog = false"
                    ></v-btn>
                </template>
            </v-card>
        </v-dialog>
    </v-app-bar>
</template>

<script>
import { useAuthStore } from "@/stores/auth"

export default {
    name: "NavBar",

    data() {
        return {
            authStore: undefined,

            dialog: false,
        }
    },
    
    beforeMount() {
        this.authStore = useAuthStore()
    },
    methods: {
        onLoginClick() {
            this.$router.push('/login')
        },
        onLogoutClick() {
            this.dialog = true
        },
        goToProjectDetails() {
            this.$router.push('/project/details')
        },
        goToProjectList() {
            this.$router.push('/project/list')
        },
    },
    computed: {
        isSignedIn() {
            // Check if the user is signed in through authStore
            return this.authStore && this.authStore.getUserLoggedIn
        },
    }
}
</script>

<style scoped>
.search-bar {
    max-width: 200px;
}
</style>

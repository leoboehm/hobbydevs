<template>
    <v-app-bar color="black" dark>
        <v-app-bar-title>HobbyDevs</v-app-bar-title>
        <v-toolbar-items>
            <v-btn color="blue" class="white--text" to="/">Home</v-btn>

            <!-- <v-menu offset-y>
                <template #activator="{ on }">
                    <v-btn color="blue" class="white--text" v-on="on">
                        Projects
                    </v-btn>
                </template>
                <v-list>
                    <v-list-item to="/project/details">
                        <v-list-item-title>Project Details</v-list-item-title>
                    </v-list-item>
                    <v-list-item to="/project/list">
                        <v-list-item-title>Project List</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu> -->

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

        <v-btn
            v-if="!authStore.getUserLoggedIn"
            class="text-red mx-2"
            @click="loginClick"
        >
            Login
        </v-btn>
        <v-btn
            v-if="authStore.getUserLoggedIn"
            class="text-red mx-2"
            @click="dialog = true"
        >
            Logout
        </v-btn>
        <v-dialog v-model="dialog" width="auto">
            <v-card
                max-width="400"
                prepend-icon="mdi-update"
                text="Are you sure you want to logout?."
                title="Logging out"
            >
                <template v-slot:actions>
                    <v-btn class="ms-auto" text="Yes" @click="logout"></v-btn>
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
import { useAuthStore } from '@/stores/auth'

export default {
    name: 'NavBar',

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
        loginClick() {
            this.$router.push('/login')
        },
        logout() {
            if (this.authStore) {
                this.authStore.actionLogout()

                this.$router.push({ name: 'Home' })
            } else {
                alert('Error during logout. Try again later...')
            }
        },
    },
}
</script>

<style scoped>
.search-bar {
    max-width: 200px;
}
</style>

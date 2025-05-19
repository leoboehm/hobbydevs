<template>
    <v-container class="pa-4">
        <v-card>
            <v-card-title>
                <span class="headline">Developer Details</span>
            </v-card-title>
            <v-card-text v-if="developer">
                <p><strong>Name:</strong> {{ developer.firstname + " " + developer.lastname }}</p>
                <p><strong>Email:</strong> {{ developer.email }}</p>
                <p>
                    <strong>Experience:</strong>
                    {{ developer.experience }} years
                </p>
                <p><strong>Bio:</strong> {{ developer.bio }}</p>
                <p>
                    <strong>Skills:</strong> {{ developer.skills }}
                </p>
                <p><strong>Interests:</strong> {{ developer.interests }}</p>
                <v-rating
                    v-model="developer.rating"
                    :max="5"
                    color="amber"
                    size="24"
                    readonly
                />
                <p><strong>Rating:</strong> {{ developer.rating }} / 5</p>
            </v-card-text>
            <v-card-text v-else>
                <p>Developer not found.</p>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useDeveloperStore } from '../stores/developer'
import { useRoute } from 'vue-router'

const route = useRoute()
const developerStore = useDeveloperStore()

// Reactive state
const developer = ref(null)

// On mount, find developer by ID
onMounted(async () => {
    developer.value = await developerStore.actionGetDeveloperById(route.params.id,)
})
</script>

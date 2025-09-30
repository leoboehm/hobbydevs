<template>
    <v-container class="pa-4">
        <v-card v-if="developer">
            <v-card-title>
                <span class="headline"
                    >Developer Details:
                    {{ developer.firstname + ' ' + developer.lastname }}</span
                >
            </v-card-title>
            <v-card-text>
                <p><strong>Email:</strong> {{ developer.email }}</p>
                <p>
                    <strong>Experience:</strong>
                    {{ developer.experience }}
                </p>
                <p><strong>Bio:</strong> {{ developer.bio }}</p>
                <p>
                    <strong>Skills:</strong>
                    <template v-for="skill in developer.skills">
                        <v-chip size="small" class="ml-1">{{ skill }}</v-chip>
                    </template>
                </p>
                <p><strong>Interests:</strong> {{ developer.interests }}</p>
                <v-rating
                    v-model="developer.rating"
                    :max="5"
                    color="amber"
                    size="24"
                    readonly
                />
                <p v-if="developer.rating == 0">No ratings so far.</p>
                <p v-else>
                    <strong>Rating:</strong> {{ developer.rating }} / 5
                </p>
                <v-row v-if="authStore.getUserIsProjectOwner">
                    <v-divider class="my-8"></v-divider>
                    <v-btn
                        v-if="!ratingMode"
                        text
                        @click="ratingMode = true"
                        color="primary"
                        >Give Rating</v-btn
                    >
                    <template v-if="ratingMode">
                        <p class="mx-2">
                            Please rate your experience with this developer on a
                            scale from 1 to 5:<br />
                            <v-rating
                                v-model="rating"
                                :max="5"
                                color="amber"
                                size="40"
                            /><br />
                            <v-spacer></v-spacer>
                            <v-btn text @click="cancelRating">Cancel</v-btn>
                            <v-btn
                                text
                                class="mx-2"
                                color="green-darken-2"
                                @click="saveRating"
                                :disabled="rating == 0"
                                >Save</v-btn
                            >
                        </p>
                    </template>
                </v-row>
            </v-card-text>
        </v-card>
        <div v-else>
            <p>Developer not found.</p>
        </div>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useDeveloperStore } from '../stores/developer'
import { useAuthStore } from '../stores/auth'
import { useProfileStore } from '../stores/profile'

const router = useRouter()
const route = useRoute()
const developerStore = useDeveloperStore()
const authStore = useAuthStore()
const profileStore = useProfileStore()

// Reactive state
const developer = ref(null)
const ratingMode = ref(false)
const rating = ref(0)

const saveRating = async () => {
    try {
        const newRating = calculateRating()
        const updatedDeveloper = { ...developer.value }
        updatedDeveloper.rating = newRating
        await profileStore.updateUser(updatedDeveloper)
        router.go()
    } catch (error) {
        alert('Something went wrong while trying to save rating.')
    }
}

const cancelRating = () => {
    rating.value = 0
    ratingMode.value = false
}

const calculateRating = () => {
    return (developer.value.rating + rating.value) / 2
}

onMounted(async () => {
    developer.value = await developerStore.actionGetDeveloperById(
        route.params.id,
    )
    rating.value = developer.value.rating
})
</script>

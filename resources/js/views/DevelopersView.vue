<template>
    <v-container class="pa-4">
        <v-card>
            <v-card-title>
                <span class="headline">Developer Profiles</span>
            </v-card-title>
            <v-card-text>
                <v-row>
                    <v-col
                        v-for="dev in developers"
                        :key="dev.id"
                        cols="12"
                        md="6"
                        lg="4"
                    >
                        <!-- Clickable Card -->
                        <v-card
                            outlined
                            class="mb-4"
                            @click="goToDeveloper(dev.id)"
                            style="cursor: pointer"
                        >
                            <v-card-title class="d-flex justify-space-between">
                                {{ dev.firstname + " " + dev.lastname }}
                            </v-card-title>
                            <v-card-text>
                                <p><strong>Bio:</strong>{{ dev.bio }}</p>
                                <p>
                                    <strong>Skills:</strong>
                                    <template v-for="skill in dev.skills">
                                        <v-chip size="small" class="ml-1">{{ skill }}</v-chip>
                                    </template>
                                </p>
                                <p><strong>Email:</strong> {{ dev.email }}</p>
                                <p>
                                    <strong>Experience:</strong>
                                    {{ dev.experience }}
                                </p>
                                <v-rating
                                    v-model="dev.rating"
                                    :max="5"
                                    color="amber"
                                    size="20"
                                    class="mt-3"
                                    readonly
                                />
                                <p>
                                    <strong>Rating:</strong> {{ dev.rating }} /
                                    5
                                </p>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

import { useDeveloperStore } from '../stores/developer'

const router = useRouter()

const developerStore = useDeveloperStore()

const developers = ref([])

const goToDeveloper = (id) => {
    router.push(`/developers/${id}`)
}

onMounted(async () => {
    developers.value = await developerStore.actionGetDevelopersList()
})
</script>

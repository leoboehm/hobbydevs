<template>
    <v-text-field
        :id="id"
        :label="label"
        v-model="formattedDate"
        readonly
        outlined
        dense
        @click="menu = readonly ? false : true"
    >
        <template v-slot:prepend>
            <v-menu
                v-model="menu"
                :close-on-content-click="false"
                transition="scale-transition"
            >
                <template v-slot:activator="{ props }">
                    <v-icon v-bind="props" icon="mdi-calendar" />
                </template>
                <v-date-picker
                    v-model="proxyDate"
                    :min="min"
                    hide-header
                    @update:modelValue="menu = false"
                />
            </v-menu>
        </template>
    </v-text-field>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useDate } from 'vuetify'

// Props
defineProps({
  modelValue: {
    type: [String, Date],
    required: true,
  },
  label: String,
  id: String,
  min: {
    type: [String, Date],
    default: undefined,
  },
  readonly: Boolean
})

// Emits
const emit = defineEmits(['update:modelValue'])

// Vuetify's date utility
const date = useDate()

// Local state
const menu = ref(false)

// Computed: formatted date display
const formattedDate = computed(() =>
  modelValue ? date.format(modelValue, 'fullDate') : ''
)

// Computed: two-way binding proxy
const proxyDate = computed({
  get: () => modelValue,
  set: (newVal) => {
    emit('update:modelValue', date.format(newVal, 'fullDate'))
  },
})
</script>

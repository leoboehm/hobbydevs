<template>
    <v-text-field
        :id="props.id"
        :label="props.label"
        v-model="formattedDate"
        readonly
        outlined
        dense
        @click="menu = props.readonly ? false : true"
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
                    :min="props.min"
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

const props = defineProps({
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

const emit = defineEmits(['update:modelValue'])

const date = useDate()
const menu = ref(false)
const formattedDate = computed(() =>
  props.modelValue ? date.format(props.modelValue, 'fullDate') : ''
)

const proxyDate = computed({
  get: () => props.modelValue,
  set: (newVal) => {
    emit('update:modelValue', date.format(newVal, 'fullDate'))
  },
})
</script>

<template>
    <v-text-field
        :id="id"
        :label="label"
        v-model="formattedDate"
        readonly
        outlined
        dense
        @click="menu = true"
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

<script>
import { useDate } from 'vuetify'

export default {
    name: 'DatePicker',

    props: {
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
    },

    emits: ['update:modelValue'],

    data() {
        return {
            menu: false,
            date: useDate(),
        }
    },

    computed: {
        proxyDate: {
            get() {
                return this.modelValue
            },
            set(newVal) {
                this.$emit('update:modelValue', this.date.format(newVal, 'fullDate'))
            },
        },
        formattedDate() {
            return this.modelValue
                ? this.date.format(this.modelValue, 'fullDate')
                : ''
        },
    },
}
</script>
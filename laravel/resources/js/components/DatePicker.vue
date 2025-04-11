<template>
    <v-text-field
        :id="id"
        :label="label"
        v-model="formattedDate"
        readonly
        outlined
        dense
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
                    v-model="internalDate"
                    :min="min"
                    hide-header
                    @update:modelValue="handleDateChange"
                />
            </v-menu>
        </template>
    </v-text-field>
</template>

<script>
import { useDate } from 'vuetify'

export default {
    name: 'DatePickerField',
    props: {
        modelValue: Date,
        label: String,
        id: String,
        min: {
            type: [String, Date],
            default: undefined,
        },
    },
    data() {
        return {
            menu: false,
            internalDate: this.modelValue,
        }
    },
    watch: {
        modelValue(newVal) {
            this.internalDate = newVal
        },
    },
    computed: {
        formattedDate() {
            return this.internalDate
                ? this.date.format(this.internalDate, 'fullDate')
                : ''
        },
    },
    methods: {
        handleDateChange(newVal) {
            this.menu = false
            this.$emit('update:modelValue', newVal)
        },
    },
    created() {
        this.date = useDate()
    },
}
</script>

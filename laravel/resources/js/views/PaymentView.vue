<template>
    <v-container class="mt-5" max-width="500px">
        <v-card>
            <v-card-title>{{ step === 1 ? 'Transfer Simulation' : 'Confirm Transfer' }}</v-card-title>
            <v-card-text>
                <template v-if="step === 1">
                    <v-form ref="formRef" v-model="formValid">
                        <v-text-field v-model="form.name" label="Recipient Name" :rules="[requiredRule, stringRule]"
                            required />
                        <v-text-field v-model="form.id" label="Recipient ID" :rules="[requiredRule, integerRule]"
                            type="number" required />
                        <v-text-field v-model="form.amount" label="Transfer Amount" :rules="[requiredRule, integerRule]"
                            type="number" required />
                        <v-row class="mt-4" justify="space-between">
                            <v-btn color="grey" @click="resetForm">Cancel</v-btn>
                            <v-btn color="primary" @click="validateAndProceed">Confirm</v-btn>
                        </v-row>
                    </v-form>
                </template>

                <template v-else>
                    <p>Please confirm the following transfer details:</p>
                    <v-list>
                        <v-list-item>
                            <v-list-item-title>Recipient Name:</v-list-item-title>
                            <v-list-item-subtitle>{{ form.name }}</v-list-item-subtitle>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-title>Recipient ID:</v-list-item-title>
                            <v-list-item-subtitle>{{ form.id }}</v-list-item-subtitle>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-title>Amount:</v-list-item-title>
                            <v-list-item-subtitle>{{ form.amount }} Credits</v-list-item-subtitle>
                        </v-list-item>
                    </v-list>

                    <v-row class="mt-4" justify="space-between">
                        <v-btn color="grey" @click="step = 1">Cancel</v-btn>
                        <v-btn color="success" @click="confirmTransfer">Confirm</v-btn>
                    </v-row>
                </template>
            </v-card-text>
        </v-card>

        <v-snackbar v-model="snackbar" color="green">
            Transfer successful!
        </v-snackbar>
    </v-container>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const step = ref(1)
const formValid = ref(false)
const formRef = ref(null)
const snackbar = ref(false)

const form = ref({
    name: '',
    id: '',
    amount: ''
})

// Validation rules
const requiredRule = v => !!v || 'This field is required'
const stringRule = v => isNaN(v) || 'Must be a string'
const integerRule = v => Number.isInteger(Number(v)) || 'Must be an integer'

function resetForm() {
    form.value = { name: '', id: '', amount: '' }
    formRef.value.resetValidation()
}

function validateAndProceed() {
    if (!form.value.name || !form.value.id || !form.value.amount) {
        alert('All fields are required.')
        return
    }

    formRef.value.validate().then(success => {
        if (success) {
            step.value = 2
        }
    })
}


async function confirmTransfer() {
    try {
        const response = await fetch('/api/transfer', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                from_id: 1, 
                to_id: Number(form.value.id),
                amount: Number(form.value.amount)
            })
        })

        const data = await response.json()
        if (!response.ok) throw new Error(data.error || 'Transfer failed')

        snackbar.value = true
        step.value = 1
        resetForm()

        setTimeout(() => {
            router.push('/user-profile')
        }, 1000)
    } catch (err) {
        alert(err.message)
    }
}

</script>
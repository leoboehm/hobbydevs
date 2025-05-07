import './bootstrap'
import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import { useAuthStore } from './stores/auth'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import DayJsAdapter from '@date-io/dayjs'

import '@mdi/font/css/materialdesignicons.css'
const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: 'dark',
    },
    icons: {
        defaultSet: 'mdi',
    },
    date: {
        adapter: DayJsAdapter,
    },
})

const app = createApp(App)

app.use(vuetify)

app.use(createPinia())

const authStore = useAuthStore()
await authStore.fetchUser()

app.use(router)

app.mount('#app')

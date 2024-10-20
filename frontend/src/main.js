import { createApp } from 'vue'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

// Components
import App from './App.vue'
import router from './router'
import store from './store'

const vuetify = createVuetify({
  components,
  directives,
})

createApp(App).use(vuetify).use(store).use(router).mount('#app')

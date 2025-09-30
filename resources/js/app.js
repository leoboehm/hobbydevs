import './bootstrap'            // polyfills, globals, etc.
import './assets/main.css'      // global styles

import { createApp } from 'vue'
import App            from './App.vue'
import { registerPlugins } from './plugins'

const app = createApp(App)

registerPlugins(app)

app.mount('#app')

import vuetify      from './vuetify'
import { createPinia } from 'pinia'
import router       from '../router'

export function registerPlugins(app) {
  app.use(vuetify)
  app.use(createPinia())
  app.use(router)
}
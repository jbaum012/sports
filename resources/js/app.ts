require('./bootstrap')
const route = (window as any).route

// Import modules...
import { createApp, h } from 'vue'
import {
  App as InertiaApp,
  plugin as InertiaPlugin,
} from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

const el = document.getElementById('app') as HTMLElement

const app = createApp({
  render: () =>
    h(InertiaApp, {
      initialPage: JSON.parse(el.dataset.page ?? ''),
      resolveComponent: (name: String) => require(`./Pages/${name}`).default,
    }),
})

app.mixin({ methods: { route } }).use(InertiaPlugin).mount(el)

InertiaProgress.init({ color: '#4B5563' })

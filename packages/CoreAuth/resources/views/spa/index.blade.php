@extends('coreauth::layouts.base')

@section('content')
<div class="header" style="margin-bottom:8px;">
  <h2 style="margin:0;">CoreAuth SPA (Vue + Vuetify)</h2>
  <a href="{{ route('dashboard') }}">‚Üê Back to Dashboard</a>
</div>

<div id="app"></div>

<link href="https://cdn.jsdelivr.net/npm/vuetify@3.7.4/dist/vuetify.min.css" rel="stylesheet">
<script type="module">
  import { createApp, ref, computed, onMounted } from 'https://cdn.jsdelivr.net/npm/vue@3.5.12/dist/vue.esm-browser.prod.js'
  import { createVuetify } from 'https://cdn.jsdelivr.net/npm/vuetify@3.7.4/dist/vuetify.esm.js'
  import * as components from 'https://cdn.jsdelivr.net/npm/vuetify@3.7.4/dist/vuetify-components.esm.js'
  import * as directives from 'https://cdn.jsdelivr.net/npm/vuetify@3.7.4/dist/vuetify-directives.esm.js'

  const vuetify = createVuetify({ components, directives })

  const App = {
    setup() {
      const tab = ref('tenant')
      const ctx = ref({ user: null, tenant: null, roles: [], impersonating: false })
      const loading = ref(true)
      const themeColor = computed(() => ctx.value.tenant ? (ctx.value.tenant.license === 'active' ? '#16a34a' : '#dc2626') : '#2563eb')
      const roleList = computed(() => (ctx.value.roles || []).join(', ') || 'none')

      const pages = [
        { key: 'tenant', label: 'Tenant', desc: 'Tenant dashboard and status' },
        { key: 'billing', label: 'Billing', url: '/billing' },
        { key: 'roles', label: 'Roles', url: '/admin/roles' },
        { key: 'mfa', label: 'MFA', url: '/mfa/setup' },
        { key: 'profile', label: 'Profile', url: '{{ route('account.profile') }}' },
        { key: 'sessions', label: 'Sessions', url: '{{ route('account.sessions') }}' },
      ]

      const fetchContext = async () => {
        try {
          const res = await fetch('{{ route('coreauth.context') }}', { headers: { 'Accept': 'application/json' } })
          ctx.value = await res.json()
        } finally { loading.value = false }
      }

      onMounted(fetchContext)

      return { tab, ctx, pages, loading, themeColor, roleList }
    },
    template: `
      <v-app>
        <v-container class="pa-0">
          <v-alert :type="ctx.tenant && ctx.tenant.license !== 'active' ? 'error' : 'success'" variant="tonal" class="mb-2">
            <div><strong v-if="ctx.tenant">Tenant:</strong> @{{ ctx.tenant ? ctx.tenant.name + ' ('+ctx.tenant.slug+')' : 'No tenant selected' }}</div>
            <div v-if="ctx.tenant">License: <strong>@{{ (ctx.tenant.license || 'active').toUpperCase() }}</strong></div>
            <div v-if="ctx.user">User: @{{ ctx.user.name }} (@{{ ctx.user.email }}) ó Roles: @{{ roleList }}</div>
            <div v-if="ctx.impersonating" class="text-warning">Impersonating active ó actions are logged.</div>
          </v-alert>

          <v-tabs v-model="tab" color="white" :style="{ background: themeColor, borderRadius: '10px' }" class="mb-3">
            <v-tab value="tenant">Tenant</v-tab>
            <v-tab value="nav">Navigate</v-tab>
          </v-tabs>

          <v-window v-model="tab">
            <v-window-item value="tenant">
              <v-card>
                <v-card-title>Tenant Dashboard</v-card-title>
                <v-card-text>
                  <div v-if="loading">Loading...</div>
                  <div v-else>
                    <p v-if="!ctx.tenant">No tenant selected. Go to <a href="{{ route('tenant.select') }}">/tenant/select</a>.</p>
                    <p v-else>Welcome to the SPA demo. Use the Navigate tab to open pages.</p>
                  </div>
                </v-card-text>
              </v-card>
            </v-window-item>
            <v-window-item value="nav">
              <v-card>
                <v-card-title>Navigate</v-card-title>
                <v-card-text>
                  <v-list>
                    <v-list-item
                      v-for="p in pages"
                      :key="p.key"
                      :title="p.label"
                      :subtitle="p.url || p.desc"
                      :href="p.url"
                      link
                    />
                  </v-list>
                </v-card-text>
              </v-card>
            </v-window-item>
          </v-window>
        </v-container>
      </v-app>
    `
  }

  createApp(App).use(vuetify).mount('#app')
</script>
@endsection


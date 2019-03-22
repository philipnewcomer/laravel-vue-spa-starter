<template>
    <div>
        <nav class="bg-blue-darkest shadow mb-8 py-6">
            <div class="container mx-auto px-6 md:px-0">
                <div class="flex justify-between">
                    <div class="mr-6">
                        <router-link class="text-lg font-semibold text-white no-underline" :to="{ name: 'home' }">
                            {{ appName }}
                        </router-link>
                    </div>

                    <div v-if="$auth.ready()">
                        <router-link class="no-underline hover:underline text-grey-lightest text-sm p-3" :to="{ name: 'login' }" v-if="!$auth.check()">Login</router-link>
                        <router-link class="no-underline hover:underline text-grey-lightest text-sm p-3" :to="{ name: 'register' }" v-if="!$auth.check()">Register</router-link>
                        <span class="text-grey-lightest text-sm pr-4" v-if="$auth.check()">{{ $auth.user().name }}</span>
                        <a href="#"
                           class="no-underline hover:underline text-grey-lightest text-sm p-3"
                           v-if="$auth.check()"
                           @click.prevent="handleLogout">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container mx-auto">
            <div class="spinner mt-24 mx-auto" v-show="!$auth.ready()"></div>

            <router-view v-show="$auth.ready()"></router-view>
        </div>
    </div>
</template>

<script>
    import config from '../config'

    export default {
      computed: {
        appName() {
          return config.APP_NAME
        }
      },

      methods: {
        handleLogout() {
          this.$auth.logout({
            makeRequest: true,
            success: () => {
              this.$router.push({name: 'login'})
              this.setStatus('You are now logged out.')
            },
            redirect: false
          })
        }
      }
    }
</script>

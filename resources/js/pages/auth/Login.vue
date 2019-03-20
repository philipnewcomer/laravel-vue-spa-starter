<template>
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">
            <status></status>

            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
                <div class="font-semibold bg-grey-lightest text-grey-darkest py-3 px-6 mb-0 shadow-inner">
                    Login
                </div>

                <form class="w-full p-6" @submit.prevent="handleLogin">
                    <div class="flex flex-wrap mb-6">
                        <label for="email" class="block text-grey-darker text-sm font-bold mb-2">
                            E-Mail Address:
                        </label>

                        <input
                            id="email"
                            type="email"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                            :class="{'bg-grey-lighter': submitting, 'border-red': errors.email}"
                            v-model="email"
                            :readonly="submitting"
                            required
                            autofocus>

                        <div class="text-red text-xs italic mt-2" v-if="errors.email">
                            <p v-for="error in errors.email">{{ error }}</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="password" class="block text-grey-darker text-sm font-bold mb-2">
                            Password:
                        </label>

                        <input
                            id="password"
                            type="password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                            :class="{'bg-grey-lighter': submitting, 'border-red': errors.password}"
                            v-model="password"
                            :readonly="submitting"
                            required>

                        <div class="text-red text-xs italic mt-2" v-if="errors.password">
                            <p v-for="error in errors.password">{{ error }}</p>
                        </div>
                    </div>

                    <div class="flex mb-6">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            v-model="rememberMe"
                            :readonly="submitting">

                        <label class="text-sm text-grey-dark ml-3" for="remember">
                            Remember Me
                        </label>
                    </div>

                    <div class="flex flex-wrap items-center">
                        <button
                            type="submit"
                            class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            :class="{'bg-blue-lighter': submitting}"
                            :disabled="submitting">
                                Login
                        </button>

                        <router-link :to="{name: 'forgotPassword'}" class="text-sm text-blue hover:text-blue-dark whitespace-no-wrap no-underline ml-auto">
                            Forgot Your Password?
                        </router-link>

                        <p class="w-full text-xs text-center text-grey-dark mt-8 -mb-4">
                            Don't have an account?

                            <router-link :to="{name: 'register'}" class="text-blue hover:text-blue-dark no-underline">
                                Register
                            </router-link>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
  import Status from '../../components/Status'

  export default {
    components: { Status },

    data() {
      return {
        email: null,
        password: null,
        rememberMe: false,
        errors: {},
        submitting: false
      }
    },

    methods: {
      handleLogin() {
        this.errors = {}
        this.submitting = true

        this.$auth.login({
          data: {
            email: this.email,
            password: this.password
          },
          error: (error) => {
            this.errors = error.response.data.data
            this.submitting = false
          },
          rememberMe: this.rememberMe
        })
      }
    }
  }
</script>

<template>
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">
            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
                <div class="font-semibold bg-grey-lightest text-grey-darkest py-3 px-6 mb-0 shadow-inner">
                    Register
                </div>

                <form class="w-full p-6" @submit.prevent="handleRegister">
                    <div class="flex flex-wrap mb-6">
                        <label for="name" class="block text-grey-darker text-sm font-bold mb-2">
                            Name:
                        </label>

                        <input
                            id="name"
                            type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                            :class="{'bg-grey-lighter': submitting, 'border-red': errors.name}"
                            v-model="name"
                            :readonly="submitting"
                            required
                            autofocus>

                        <div class="text-red text-xs italic mt-2" v-if="errors.name">
                            <p v-for="error in errors.email">{{ error }}</p>
                        </div>
                    </div>

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
                            required>

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

                    <div class="flex flex-wrap mb-6">
                        <label for="password-confirm" class="block text-grey-darker text-sm font-bold mb-2">
                            Confirm Password:
                        </label>

                        <input
                            id="password-confirm"
                            type="password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                            :class="{'bg-grey-lighter': submitting}"
                            v-model="passwordConfirmation"
                            :readonly="submitting"
                            required>
                    </div>

                    <div class="flex flex-wrap">
                        <button
                            type="submit"
                            class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light"
                            :class="{'bg-blue-lighter': submitting}"
                            :disabled="submitting">
                                Register
                        </button>

                        <p class="w-full text-xs text-center text-grey-dark mt-8 -mb-4">
                            Already have an account?

                            <router-link :to="{name: 'login'}" class="text-blue hover:text-blue-dark no-underline">
                                Login
                            </router-link>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      data() {
        return {
          name: null,
          email: null,
          password: null,
          passwordConfirmation: null,
          errors: {},
          responseMessage: null,
          submitting: false
        }
      },

      methods: {
        handleRegister() {
          this.errors = {}
          this.submitting = true

          this.$auth.register({
            data: {
              name: this.name,
              email: this.email,
              password: this.password,
              password_confirmation: this.passwordConfirmation
            },
            error: (error) => {
              this.errors = error.response.data.data
              this.password = null
              this.passwordConfirmation = null
              this.submitting = false
            },
            autoLogin: true,
            redirect: {name: 'home'}
          })
        }
      }
    }
</script>

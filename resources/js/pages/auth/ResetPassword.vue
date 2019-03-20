<template>
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">
            <status></status>

            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
                <div class="font-semibold bg-grey-lightest text-grey-darkest py-3 px-6 mb-0 shadow-inner">
                    Reset Password
                </div>

                <form class="w-full p-6" @submit.prevent="handleResetPassword">
                    <div class="flex flex-wrap mb-6">
                        <label for="email" class="block text-grey-darker text-sm font-bold mb-2">
                            E-Mail Address:
                        </label>

                        <input
                            id="email"
                            type="email"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                            :class="{'bg-grey-lighter': email || submitting, 'border-red': errors.email}"
                            v-model="email"
                            :autofocus="!email"
                            :readonly="email || submitting"
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
                            :autofocus="email"
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
                            class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            :class="{'bg-blue-lighter': submitting}"
                            :disabled="submitting">
                                Reset Password
                        </button>
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
          token: null,
          password: null,
          passwordConfirmation: null,
          errors: {},
          submitting: false,
          success: false
        }
      },

      methods: {
        handleResetPassword() {
          this.errors = {}
          this.submitting = true

          this.axios.post('user/resetPassword', {
            email: this.email,
            password: this.password,
            password_confirmation: this.passwordConfirmation,
            token: this.token
          })
          .then(
            () => {
              this.$router.push({name: 'login'})
              this.setStatus('Your password has been reset.')
            },
            (error) => {
              this.errors = error.response.data.data
              this.submitting = false
            }
          )
        }
      },

      created () {
        this.email = this.$route.query.email
        this.token = this.$route.params.token
      }
    }
</script>

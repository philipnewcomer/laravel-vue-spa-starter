<template>
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">
            <status></status>

            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
                <div class="font-semibold bg-grey-lightest text-grey-darkest py-3 px-6 mb-0 shadow-inner">
                    Reset Password
                </div>

                <form class="w-full p-6" @submit.prevent="handleSendResetLink">
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
                            :disabled="submitting"
                            required>

                        <div class="text-red text-xs italic mt-2" v-if="errors.email">
                            <p v-for="error in errors.email">{{ error }}</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <button
                            type="submit"
                            class="bg-blue hover:bg-blue-dark text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            :class="{'bg-blue-lighter': submitting}"
                            :disabled="submitting">
                                Send Password Reset Link
                        </button>

                        <p class="w-full text-xs text-center text-grey-dark mt-8 -mb-4">
                            <router-link :to="{name: 'login'}" class="text-blue hover:text-blue-dark no-underline">
                                Back to login
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
          errors: {},
          submitting: false,
        }
      },

      methods: {
        handleSendResetLink() {
          this.errors = {}
          this.submitting = true

          this.axios.post('user/forgotPassword', {
            email: this.email
          })
          .then(
            () => {
              this.submitting = false
              this.setStatus('We have e-mailed your password reset link.')
            },
            (error) => {
              this.errors = error.response.data.data
              this.submitting = false
            }
          )
        }
      }
    }
</script>

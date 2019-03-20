<template>
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">
            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
                <div class="font-semibold bg-grey-lightest text-grey-darkest py-3 px-6 mb-0 shadow-inner">
                    Verify Your Email Address
                </div>

                <div class="w-full flex flex-wrap p-6">
                    <p class="leading-normal mb-6">
                        Before proceeding, please check your email for a verification link.
                    </p>

                    <button
                        type="button"
                        class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-auto"
                        :class="{'bg-blue-lighter': submitting}"
                        @click.prevent="resendVerificationEmail"
                        :disabled="submitting">
                            Resend verification email
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      data() {
        return {
          submitting: false
        }
      },

      methods: {
        resendVerificationEmail() {
          this.submitting = true
          this.$store.dispatch('clearStatus')

          this.axios.post('auth/resendVerificationEmail')
          .then(
            () => {
              this.submitting = false
              this.setStatus('A fresh verification link has been sent to your email address.')
            },
            () => {
              this.submitting = false
            }
          )
        }
      }
    }
</script>

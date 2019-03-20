<template>
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">
            <status></status>
        </div>
    </div>
</template>

<script>
    import Status from '../../components/Status'

    export default {
      components: { Status },

      data() {
        return {
          user: null,
          expires: null,
          signature: null,
        }
      },

      created() {
        this.user = this.$route.params.user
        this.expires = this.$route.query.expires
        this.signature = this.$route.query.signature

        this.setStatus('Please wait...', 'info')
      },

      mounted() {
        this.axios.post('auth/verifyEmail/' + this.user, {}, {
          params: {
            expires: this.expires,
            signature: this.signature
          }
        })
        .then(
          () => {
            this.setStatus('Your email has been verified successfully.')

            if (this.$auth.check()) {
              this.$auth.fetch()
            }
          },
          (error) => {
            let message = 'An error occurred.'
            if (error.response.data.message) {
              message = 'Error: ' + error.response.data.message
            }

            this.setStatus(message, 'error')
          }
        )
      }
    }
</script>

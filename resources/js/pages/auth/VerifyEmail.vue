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
          userId: null,
          expires: null,
          signature: null,
        }
      },

      created() {
        this.userId = this.$auth.user().id
        this.expires = this.$route.query.expires
        this.signature = this.$route.query.signature

        this.setStatus('Please wait...', 'info')
      },

      mounted() {
        this.axios.post('auth/verifyEmail/' + this.userId, {
          expires: this.expires,
          signature: this.signature
        })
        .then(
          () => {
            const callback = () => {
              this.$router.push({name: 'home'})
              this.setStatus('Your email has been verified successfully.')
            }

            if (this.$auth.check()) {
              this.$auth.fetch()
                .then(callback)
            } else {
              callback()
            }
          },
          (error) => {
            const errors = this.parseErrors(error)
            if (errors.message) {
              this.setStatus(errors.message, 'error')
            }
          }
        )
      }
    }
</script>

<template></template>

<script>
    export default {
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

        this.setLoading()
      },

      mounted() {
        this.axios.post('auth/verifyEmail/' + this.userId, {
          expires: this.expires,
          signature: this.signature
        })
        .then(
          () => {
            this.$auth.fetch().then(() => {
              this.$router.push({name: 'home'})
              this.clearLoading()
              this.setStatus('Your email has been verified successfully.')
            })
          },
          (error) => {
            this.$router.push({name: 'home'})
            this.clearLoading()
            this.handleError(error)
          }
        )
      }
    }
</script>

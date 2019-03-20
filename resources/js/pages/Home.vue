<template>
    <div>
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">
                <status></status>
            </div>
        </div>

        <div class="flex flex-wrap justify-center" v-if="!this.$auth.user().email_verified_at">
            <div class="w-full max-w-sm">
                <email-verification></email-verification>
            </div>
        </div>
    </div>
</template>

<script>
  import EmailVerification from '../components/EmailVerification'
  import Status from '../components/Status'

  export default {
    components: { EmailVerification, Status }
  }
</script>

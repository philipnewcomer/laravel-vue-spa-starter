<template>
    <div>
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm">
                <status></status>
            </div>
        </div>

        <div class="flex flex-wrap justify-center" v-if="!isUserEmailVerified">
            <div class="w-full max-w-sm">
                <email-verification-required></email-verification-required>
            </div>
        </div>
    </div>
</template>

<script>
  import EmailVerificationRequired from '../components/EmailVerificationRequired'
  import Status from '../components/Status'

  export default {
    components: { EmailVerificationRequired, Status },
  }
</script>

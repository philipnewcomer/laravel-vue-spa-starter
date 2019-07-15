<template>
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">
            <div
                class="text-sm border border-t-8 rounded px-3 py-4 mb-4"
                :class="['text-' + color + '-darker', 'border-' + color + '-dark', 'bg-' + color + '-lightest']"
                role="alert"
                v-if="message">
                    {{ message }}
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    computed: {
      message() {
        return this.$store.state.status ? this.$store.state.status.message : null
      },

      color() {
        let color

        switch (this.$store.state.status ? this.$store.state.status.type : null) {
          case 'error':
            color = 'red'
            break

          case  'info':
            color = 'yellow'
            break

          default:
            color = 'green'
        }

        return color
      }
    },
  }
</script>

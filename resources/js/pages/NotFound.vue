<template>
    <div>
        <status></status>

        <div
            class="text-sm border border-t-8 rounded text-red-darker border-red-dark bg-red-lightest px-3 py-4 mb-4"
            role="alert">
                404 Not Found
        </div>
    </div>
</template>

<script>
  import Status from '../components/Status'

  export default {
    components: { Status }
  }
</script>

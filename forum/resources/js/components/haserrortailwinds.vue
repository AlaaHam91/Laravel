 // vform using bbotstrap by defualt


<template>
  <div v-if="form.errors.has(field)"
  class="text-bold text-red-500"
  v-html="form.errors.get(field)"/>
</template>

<script>
export default {
  name: 'errortailwinds',
  props: {
    form: {
      type: Object,
      required: true
    },
    field: {
      type: String,
      required: true
    }
  }
}
</script>

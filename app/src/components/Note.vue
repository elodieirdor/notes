<template>
  <div>
    <b-card
      :title="title"
      tag="article"
      style="max-width: 20rem;"
      class="mb-2"
    >
      <b-card-text>{{text }}</b-card-text>
    </b-card>
  </div>
</template>

<script>
export default {
  props: ['title', 'text']
}
</script>

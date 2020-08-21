<template>
  <div>
    <b-card class="mb-4 add-note-container" >
      <b-card-text>
        <NoteForm />
      </b-card-text>
    </b-card>
  </div>
</template>

<script>
import NoteForm from './NoteForm'
export default {
  data () {
    return {
      form: {
        title: '',
        text: '',
        id: null
      }
    }
  },
  components: {
    NoteForm
  }
}
</script>
<style scoped>
.add-note-container {
  width: 50%;
  margin-left: auto;
  margin-right: auto;
}
</style>

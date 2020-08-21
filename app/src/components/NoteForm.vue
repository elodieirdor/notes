<template>
  <b-form @submit="onSubmit">
    <b-form-input
      id="title"
      v-model="form.title"
      type="text"
      placeholder="Title"
      class="mb-2"
      autocomplete="off"
    >
    </b-form-input>

    <b-form-textarea
      id="textarea"
      v-model="form.text"
      placeholder="Take a note..."
      rows="3"
      max-rows="6"
      required
    >
    </b-form-textarea>
    <div class="button-container mt-3">
      <b-button type="submit" variant="primary">Submit</b-button>
    </div>
  </b-form>
</template>

<script>
import {bus} from '../main.js'
export default {
  props: ['note'],
  data () {
    return {
      form: {
        title: '',
        text: '',
        id: null
      }
    }
  },
  created () {
    if (this.note) {
      this.form = Object.assign({}, this.note)
    }
  },
  methods: {
    onSubmit (evt) {
      evt.preventDefault()
      let note = Object.assign({}, this.form)
      if (this.note) {
        bus.$emit('updated', note)
      } else {
        note.id = new Date().getTime()
        bus.$emit('created', note)
      }
      this.reset()
    },
    reset () {
      // Reset our form values
      this.form.title = ''
      this.form.text = ''
      this.form.id = null
    }
  }
}
</script>
<style scoped>
  .button-container {
      text-align: center;
  }
</style>

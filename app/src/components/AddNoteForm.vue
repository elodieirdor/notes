<template>
  <div>
    <b-card class="mt-3 add-note-container" >
      <b-form @submit="onSubmit">
      <b-card-text>
        <b-form-input
          id="title"
          v-model="form.title"
          type="text"
          required
          placeholder="Title"
        >
        </b-form-input>

      <b-form-textarea
      id="textarea"
      v-model="form.text"
      placeholder="Take a note..."
      rows="3"
      max-rows="6"
    >
    </b-form-textarea>
      </b-card-text>

      <b-button type="submit" variant="primary">Submit</b-button>
    </b-form>
    </b-card>

  </div>
</template>

<script>
import {bus} from '../main.js'
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
  methods: {
    onSubmit (evt) {
      evt.preventDefault()
      alert(JSON.stringify(this.form))
      this.form.id = new Date().getTime()
      const note = Object.assign({}, this.form)
      bus.$emit('created', note)
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
.add-note-container {
      width: 50%;
    margin: 20px auto 20px auto;
}
</style>

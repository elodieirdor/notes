<template>
  <div>
    <!-- <b-form @submit="onSubmit" @reset="onReset"> -->
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
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card>
  </div>
</template>

<script>
export default {
  data () {
    return {
      form: {
        title: '',
        text: ''
      }
    }
  },
  methods: {
    onSubmit (evt) {
      evt.preventDefault()
      alert(JSON.stringify(this.form))
    }
    // ,
    // onReset (evt) {
    //   evt.preventDefault()
    //   // Reset our form values
    //   this.form.email = ''
    //   this.form.name = ''
    //   this.form.food = null
    //   this.form.checked = []
    //   // Trick to reset/clear native browser form validation state
    //   this.show = false
    //   this.$nextTick(() => {
    //     this.show = true
    //   })
    // }
  }
}
</script>
<style scoped>
.add-note-container {
      width: 50%;
    margin: auto;
}
</style>

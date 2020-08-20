<template>
  <div>
    <AddNoteForm />
    <Notes />
  </div>
</template>

<script>
import Notes from './Notes'
import AddNoteForm from './AddNoteForm'

export default {
  name: 'Main',
  components: {
    Notes,
    AddNoteForm
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>

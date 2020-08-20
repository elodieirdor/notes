<template>
<b-container>
  <b-card-group deck>
    <div v-for='note in notes' :key=note.id>
      <Note :title="note.title" :text="note.text" />
    </div>
  </b-card-group>
</b-container>
</template>

<script>
import Note from './Note'
import {bus} from '../main.js'

const getNotes = () => {
  let notes = []
  for (let i = 0; i < 10; i++) {
    notes.push({id: i, title: `Note ${i}`, text: `Some quick example text for the note ${i}`})
  }
  return notes
}

export default {
  name: 'Notes',
  components: {
    Note
  },
  data () {
    return {
      notes: getNotes()
    }
  },
  created () {
    bus.$on('created', (note) => {
      this.notes.push(note)
    })
  }
}
</script>

<template>
<b-container>
  <b-card-group columns>
      <Note v-for='note in filteredNotes' :key=note.id :title="note.title" :text="note.text" :id="note.id"/>
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
  computed: {
    filteredNotes: function () {
      const filterText = this.filterText

      if (filterText === '') {
        return this.notes
      }

      return this.notes.filter(function (note) {
        return note.title.includes(filterText) || note.text.includes(filterText)
      })
    }

  },
  data () {
    return {
      filterText: '',
      notes: getNotes()
    }
  },
  created () {
    bus.$on('created', (note) => {
      this.notes.push(note)
    })

    bus.$on('deleted', (noteId) => {
      let index = null
      for (let i in this.notes) {
        if (this.notes[i].id === noteId) {
          index = i
          break
        }
      }
      if (index) {
        this.notes.splice(index, 1)
      }
    })

    bus.$on('filtered', (text) => {
      this.filterText = text
    })
  }
}
</script>

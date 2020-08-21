<template>
  <b-container>
    <b-modal v-if="selectedNote" id="edit-note-modal" title="Edit note" hide-footer>
      <NoteForm :note="selectedNote" />
    </b-modal>
    <b-card-group columns>
        <Note v-for='note in filteredNotes' :key=note.id :title="note.title" :text="note.text" :id="note.id"/>
    </b-card-group>
  </b-container>
</template>

<script>
import Note from './Note'
import NoteForm from './NoteForm'
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
    Note,
    NoteForm
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
  methods: {
    getNoteFromId (noteId) {
      for (let i in this.notes) {
        if (this.notes[i].id === noteId) {
          return this.notes[i]
        }
      }
      return null
    },
    getNoteIndexFromId (noteId) {
      for (let i in this.notes) {
        if (this.notes[i].id === noteId) {
          return i
        }
      }
      return null
    }
  },
  data () {
    return {
      filterText: '',
      notes: getNotes(),
      selectedNote: null
    }
  },
  created () {
    bus.$on('created', (note) => {
      this.notes.push(note)
    })

    bus.$on('deleted', (noteId) => {
      const index = this.getNoteIndexFromId(noteId)
      if (index === null) {
        return
      }

      this.notes.splice(index, 1)
    })

    bus.$on('filtered', (text) => {
      this.filterText = text
    })

    bus.$on('update', (noteId) => {
      const note = this.getNoteFromId(noteId)
      if (note === null) {
        return
      }

      this.selectedNote = note
      this.$bvModal.show('edit-note-modal')
    })

    bus.$on('updated', (note) => {
      const index = this.getNoteIndexFromId(note.id)
      if (index === null) {
        return
      }

      this.notes.splice(index, 1, note)
      this.selectedNote = null
      this.$bvModal.hide('edit-note-modal')
    })
  }
}
</script>

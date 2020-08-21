<template>
  <b-container>
    <b-alert v-model="showErrorAlert" variant="danger" dismissible>
        Something wrong happened ! Please try again
    </b-alert>
    <b-overlay :show="isLoading" rounded="sm">
      <b-modal v-if="selectedNote" id="edit-note-modal" title="Edit note" hide-footer>
        <NoteForm :note="selectedNote" />
      </b-modal>
      <b-card-group columns>
        <transition-group name="list">
          <Note v-for='note in filteredNotes' :key=note.id :title="note.title" :text="note.text" :id="note.id"/>
        </transition-group>
      </b-card-group>
    </b-overlay>
  </b-container>
</template>

<script>
import Note from './Note'
import NoteForm from './NoteForm'
import {bus} from '../main.js'

export default {
  name: 'Notes',
  components: {
    Note,
    NoteForm
  },
  mounted () {
    this.getNotes()
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
    getNotes () {
      this.isLoading = true
      this.axios
        .get(process.env.API_URL + 'notes')
        .then(response => {
          this.notes = response.data
          this.isLoading = false
        })
        .catch(error => {
          this.handleApiError(error)
        })
    },
    createNote (data) {
      this.isLoading = true
      this.axios
        .post(process.env.API_URL + 'notes', data)
        .then(response => {
          this.notes.push(response.data)
          this.isLoading = false
        })
        .catch(error => {
          this.handleApiError(error)
        })
    },
    updateNote (data) {
      const index = this.getNoteIndexFromId(data.id)
      if (index === null) {
        this.$bvModal.hide('edit-note-modal')
        return
      }

      this.isLoading = true
      this.axios
        .put(process.env.API_URL + 'notes/' + data.id, data)
        .then(response => {
          this.notes.splice(index, 1, response.data)
          this.selectedNote = null
          this.$bvModal.hide('edit-note-modal')
          this.isLoading = false
        })
        .catch(error => {
          this.handleApiError(error)
        })
    },
    deleteNote (id) {
      const index = this.getNoteIndexFromId(id)
      if (index === null) {
        return
      }

      this.isLoading = true
      this.axios
        .delete(process.env.API_URL + 'notes/' + id)
        .then(response => {
          this.notes.splice(index, 1)
          this.isLoading = false
        })
        .catch(error => {
          this.handleApiError(error)
        })
    },
    handleApiError (error) {
      console.log(error)
      this.showErrorAlert = true
      this.isLoading = false
    },
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
      notes: [],
      selectedNote: null,
      isLoading: false,
      showErrorAlert: false
    }
  },
  created () {
    bus.$on('created', (note) => {
      this.createNote(note)
    })

    bus.$on('updated', (note) => {
      this.updateNote(note)
    })

    bus.$on('deleted', (noteId) => {
      this.deleteNote(noteId)
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
  }
}
</script>

<style scoped>
  .list-enter-active, .list-leave-active {
    transition: all 1s;
  }
  .list-enter, .list-leave-to /* .list-leave-active below version 2.1.8 */ {
    opacity: 0;
    transform: translateY(30px);
  }
</style>

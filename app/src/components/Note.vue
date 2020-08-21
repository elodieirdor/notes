<template>
 <b-card
    no-body
    v-b-hover="handleHover"
  >
    <b-card-body>
      <b-card-title>{{title}}</b-card-title>
      <b-card-text>{{text}}</b-card-text>
    </b-card-body>
    <b-card-footer v-bind:style="{opacity: displayOptions ? 1 : 0}">
      <b-button-group>
        <b-button variant="light" title="Delete note" v-on:click="deleteNote(id)">
          <b-icon icon="trash"></b-icon>
        </b-button>
      </b-button-group>
    </b-card-footer>
  </b-card>
</template>

<script>
import {bus} from '../main.js'
export default {
  props: ['title', 'text', 'id'],
  data () {
    return {
      displayOptions: false
    }
  },
  methods: {
    deleteNote (id) {
      bus.$emit('deleted', id)
    },
    handleHover (hovered) {
      this.displayOptions = hovered
    }
  }
}
</script>

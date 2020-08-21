<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="info">
      <b-navbar-brand href="#">Notes</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-nav-form @submit="onSubmit">
            <b-form-input size="sm" class="mr-sm-2" v-model="form.search" placeholder="Search" autocomplete="off"></b-form-input>
            <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
          </b-nav-form>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>
import {bus} from './../main'
export default {
  name: 'Navbar',
  data () {
    return {
      form: {
        search: ''
      }
    }
  },
  methods: {
    onSubmit (evt) {
      evt.preventDefault()
      bus.$emit('filtered', this.form.search)
    }
  }
}
</script>

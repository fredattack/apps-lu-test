<template>
  <div class="input-group input-group-sm m-3 w-50">
    <input type="text" class="form-control" placeholder="Search... " aria-label="Search ... " v-model="searchValue"
           aria-describedby="search-input" @keyup="filterListByTerm">
    <span class="input-group-text" id="search-input">
      <font-awesome-icon icon="search"/>
    </span>
  </div>
</template>
<script>
export default {
  name: 'news-search-input-component',
  data() {
    return {
      searchValue: ''
    }
  },
  props: {
    filterToggle: {},
  },
  methods: {
    filterListByTerm: function () {
      if (this.searchValue.length >= 3 || this.searchValue.length === 0) {
        this.$emit('input-keypressed', this.searchValue)
      }
    },

  }
}
</script>

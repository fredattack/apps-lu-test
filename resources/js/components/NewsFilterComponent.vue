<template>
  <div class="card" v-if="showFilter">
    <div class="d-flex flex-row-reverse justify-content-between">
      <div class="m-3 w-50">
        <v-select multiple placeholder="Filter by Tag"
                  @open="fetchOptions"
                  :options="options"
                  label="name"
                  v-model="selected"></v-select>
      </div>
      <news-search-input-component @input-keypressed="filterListByTerm"></news-search-input-component>
    </div>
  </div>
</template>
<script>
import NewsSearchInputComponent from "./NewsSearchInputComponent";

export default {
  name: 'news-filter-component',
  components: {NewsSearchInputComponent},
  data() {
    return {
      inputValue: '',
      options: [],
      selected: [],
    }
  },
  props: {
    filterToggle: {},
    showFilter: {}
  },
  watch: {
    selected: function(actualValue) {
      this.$emit('filter_list-by_tags', actualValue)
    },
  },
  methods: {
    filterListByTerm: function(inputValue)  {
      this.$emit('filter_list-by_term', inputValue)
    },
    fetchOptions: async  function() {
      this.options = []
      await axios.get(`/tags-select`,).then(({data}) => {
        this.options = data
      }).catch(({response}) => {
        console.error(response)
      })
    },
  }

}
</script>

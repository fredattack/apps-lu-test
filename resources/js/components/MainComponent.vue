<template>
  <div class="container">
    <add-news-button-component
        @show:form="displayForm"
        :active="showForm"
        v-if="!showForm">

    </add-news-button-component>
    <news-form-component
        v-if="Object.keys(news).length !== 0 || showForm" :news="news"
        @toggle:form="hideForm"
        @submit:form="refreshList"
    >
    </news-form-component>

    <news-list-component
        @edit:news="newsSelected"
        :key="index">

    </news-list-component>

  </div>
</template>

<script>
import AddNewsButtonComponent from './AddNewsButtonComponent'
import NewsFormComponent from './NewsFormComponent'
import NewsListComponent from './NewsListComponent'

export default {
  data() {
    return {
      news: {},
      showForm: false,
      index: new Date().getTime()

    }
  },
  components: {
    AddNewsButtonComponent, NewsFormComponent, NewsListComponent
  },
  methods: {
    newsSelected: function (value) {
      this.news = value
      this.showForm =true

    },
    displayForm: function (value) {
      this.showForm = value
      this.news = {}
    },
    refreshList: function (value) {
      this.index = new Date().getTime()
      this.showForm = false
      console.log('refreshList', value)
    },
    hideForm: function () {
      this.news ={}
      this.showForm = false
    }
  }
}
</script>

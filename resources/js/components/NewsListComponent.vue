<template>
  <div class="card">
    <div class="card-header text-center">
      <div class="d-flex flex-row justify-content-between"><h2>News list <small>&nbsp;({{ news_count }})</small>
      </h2>
        <button type="button" class="btn btn-outline-default float-right" @click="filterToggle">
          <font-awesome-icon icon="filter"/>
        </button>
      </div>
    </div>

    <div class="card-body">
      <news-filter-component :filter-toggle="filterToggle"
                             @filter_list-by_term="filterListByTerm"
                             @filter_list-by_tags="filterListByTags"
                             :show-filter="showFilter"/>

      <news-table-component :delete-news="deleteNews"
                            :news-list="newsList"
                            :show-edit-news="showEditNews"
                            :sort-list="sortList"/>

      <pagination align="right"

                  :data="newsList"
                  @pagination-change-page="fetchNews"></pagination>
    </div>
  </div>

</template>

<script>
import _ from 'lodash';

import pagination from 'laravel-vue-pagination'


import NewsTableComponent from "./NewsTableComponent";
import NewsFilterComponent from "./NewsFilterComponent";

export default {
  name: "news",
  components: {
    pagination,
    NewsTableComponent,
    NewsFilterComponent,
  },
  data() {
    return {
      newsList: {},
      news_count: 0,
      showFilter: false,
      options: [],
      search: ''
    }
  },

  mounted() {
    this.fetchNews()
  },
  methods: {

    fetchNews: async function (page = 1) {
      await axios.get(`/news?page=${page}`).then(({data}) => {
        this.newsList = data
        this.news_count = data.total
      }).catch(({response}) => {
        console.error('test', response)
      })
    },
    showEditNews: async function (id) {
      await axios.get(`/news/${id}/edit`).then(({data}) => {
        console.log(data)
        this.$emit('edit:news', data)
        window.scrollTo(0, 0);
      }).catch(({response}) => {
        console.error(response)
      })
    },
    deleteNews: async function (id) {

      await axios.delete(`/news/${id}`).then(({data}) => {
        this.fetchNews()
        this.$toasted.show('News deleted', {
          type: "error",
          theme: "toasted-primary",
          position: "top-right",
          duration: 5000,
          action: [
            {
              text: 'Confirm',
              onClick: (e, toastObject) => {
                toastObject.goAway(0);
              }
            },
            {
              text: 'Undo',
              onClick: (e, toastObject) => {
                toastObject.goAway(0);
                this.undoDeleteNews(id)
              }
            }
          ]
        })
      }).catch(({response}) => {
        console.error(response)
      })
    },
    undoDeleteNews: async function (id) {
      await axios.get(`/news-undo-delete/${id}`).then(({data}) => {
        this.fetchNews()
        this.$toasted.show('News Recovered', {
          type: "success",
          theme: "toasted-primary",
          position: "top-right",
          duration: 5000,

        })
      }).catch(({response}) => {
        console.error(response)
      })
    },
    sortList: function (args) {
      let sortedList = this.newsList.data
      console.log('args', args)
      this.newsList.data = _.orderBy(sortedList, [args[0]], [args[1]])
    },
    filterToggle: function () {
      this.showFilter = !this.showFilter
    },
    filterListByTags: function (arrayOfTags) {
      this.newsList.data = _.filter(this.newsList.data, function (news) {
        return _.map(news.tags, 'id').some(ai => {
          return _.map(arrayOfTags, 'id').includes(ai)
        });
      });
    },
    filterListByTerm: async function (searchTerms) {
      let params = {
        params: {
          searchTerms: searchTerms,
        }
      }
      let page = 1
      await axios.get(`/news?page=${page}`, params).then(({data}) => {
        this.newsList = data
        this.news_count = data.total
      }).catch(({response}) => {
        console.error(response)
      })

    },


  }
}
</script>

<style>
.vs__search, .vs__selected {
  line-height: 2.4;
}

.style-chooser .vs__clear,
.style-chooser .vs__open-indicator {
  fill: #394066;
}

</style>

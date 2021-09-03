<template>
  <!--  <news-form-component></news-form-component>-->
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header text-center">
          News list
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
              <thead>
              <tr>
                <th>Title <span class="ml-5"><font-awesome-icon :icon="icon" :style="{ color: color }" @click="sortList('title')"/></span></th>
                <th>Content <span class="ml-5"><font-awesome-icon :icon="icon" :style="{ color: color }" @click="sortList('content')"/></span></th>
                <th>Published</th>
              </tr>
              </thead>
              <tbody v-if="newsList && newsList.data">
              <tr v-for="(news,index) in newsList.data" :key="index" @click="showEditNews(news.id)" class="news-block">
                <td @click="showEditNews(news.id)">
                  <div class="row justify-content-center">
                  <a href="#"  class="text-decoration-none text-body text-capitalize align-self-center" ><h6>{{ news.title }}</h6></a>
                  </div>
                </td>
                <td >
                  <figure class="text-end">
                    <blockquote class="blockquote" v-html="news.content">
                    </blockquote>

                    <figcaption class="blockquote-footer">
                      creation: <cite >{{ news.created_at }} </cite>
                    </figcaption>

                  </figure>
                </td>
                <td>
                  <font-awesome-icon icon="check" v-if="news.is_published == 1"/>
                  <font-awesome-icon icon="times" v-else/>
                  <!--                  {{news.is_published}}-->
                </td>
              </tr>
              </tbody>
              <tbody v-else>
              <tr>
                <td align="center" colspan="3">No record found.</td>
              </tr>
              </tbody>
            </table>
          </div>
          <pagination align="center" :data="newsList" @pagination-change-page="list"></pagination>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import pagination from 'laravel-vue-pagination'

export default {
  name: "news",
  components: {
    pagination
  },
  data() {
    return {
      color:'#bfbdbd',
      icon:'sort-alpha-down',
      newsList: {
        type: Object,
        default: null
      }
    }
  },

  mounted() {
    this.list()
  },
  methods: {
    async list(page = 1) {
      await axios.get(`/news?page=${page}`).then(({data}) => {
        this.newsList = data
      }).catch(({response}) => {
        console.error(response)
      })
    },

    async showEditNews(id) {

      await axios.get(`/news/${id}/edit`).then(({data}) => {
        this.$emit('edit:news', data)
        window.scrollTo(0,0);
      }).catch(({response}) => {
        console.error(response)
      })
    },

    sortList:function (type){
      // alert(type);
      let sortedList = this.newsList.data
      console.log(type)
      console.log(sortedList)
          sortedList.sort((a, b) => a[type].localeCompare(b[type]))
      this.newsList.data = sortedList;
    }
  }
}
</script>

<style scoped>

</style>

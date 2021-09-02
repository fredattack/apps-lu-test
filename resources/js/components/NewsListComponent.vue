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
            <table class="table table-bordered text-center">
              <thead>
              <tr>

                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Published</th>
              </tr>
              </thead>
              <tbody v-if="newsList && newsList.data.length > 0">
              <tr v-for="(news,index) in newsList.data" :key="index" >

                <td>{{ news.id }}</td>
                <td><a href="#" @click="showEditNews(news.id)">{{ news.title }}</a></td>
                <td>{{ news.content }}</td>
                <td>{{ news.is_published }}</td>
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
  name:"news",
  components:{
    pagination
  },
  data(){
    return {
      newsList:{
        type:Object,
        default:null
      }
    }
  },
  mounted(){
    this.list()
  },
  methods:{
    async list(page=1){
      await axios.get(`/news?page=${page}`).then(({data})=>{
        this.newsList = data
      }).catch(({ response })=>{
        console.error(response)
      })
    },

    async showEditNews(id){

      await axios.get(`/news/${id}/edit`).then(({data})=>{

        this.$emit('edit:news',data)
      }).catch(({ response })=>{
        console.error(response)
      })
    }
  }
}
</script>

<style scoped>

</style>

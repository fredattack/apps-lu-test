<template>
    <div class="container">
      <add-news-button-component
          @show:form="displayForm"
          :active="showForm"
          v-if="Object.keys(news).length === 0 ">

      </add-news-button-component>
      <news-form-component
          v-if="Object.keys(news).length !== 0 || showForm" :news="news"
          @submit:form="refreshList">
      </news-form-component>

      <news-list-component
          @edit:news="newsSelected">

      </news-list-component>

    </div>
</template>

<script>
    import AddNewsButtonComponent from './AddNewsButtonComponent'
    import NewsFormComponent from './NewsFormComponent'
    import NewsListComponent from './NewsListComponent'

    export default {
      data(){
        return {
          news:{},
          showForm:false

        }
      },
      components: {
        AddNewsButtonComponent,NewsFormComponent,NewsListComponent
      },
      methods:{
        newsSelected:function (value){
          this.news = value
        },
        displayForm:function (value){
          this.showForm = value
          this.news ={}
        },
        refreshList:function (value){
          console.log(value)
        }


      }
    }
</script>

<template>
  <div class="table-responsive">
    <table class="table table-bordered table-hover text-center">
      <thead>
      <tr>
        <th>
          Title
          <span class="ml-5">
                      <sort-icon-component :type="'title'" @sort:list="sortList"/>
                  </span>
        </th>
        <th>
          Content
          <span class="ml-5">
                    <sort-icon-component :type="'content'" @sort:list="sortList"/>
                  </span>
        </th>

        <th>Published</th>
        <th></th>
      </tr>
      </thead>
      <tbody v-if="newsList && newsList.data">
      <tr v-for="(news,index) in newsList.data" :key="index" class="news-block">
        <td @click="showEditNews(news.id)">
          <div class="row justify-content-center">
            <a href="#" class="text-decoration-none text-body text-capitalize align-self-center"><h6>
              {{ news.title }}</h6></a>
          </div>
        </td>
        <td @click="showEditNews(news.id)">
          <figure class="text-end">
            <blockquote class="blockquote" v-html="news.content">
            </blockquote>

              <span class="badge  bg-light text-dark border border-dark mx-1" v-for="tag in news.tags">{{ tag.name }}</span>

            <figcaption class="blockquote-footer mt-3">
              creation: <cite>{{ news.created_at }} </cite>
            </figcaption>
            <figcaption class="blockquote-footer mt-3">
              edition: <cite>{{ news.updated_at }} </cite>
            </figcaption>
          </figure>
        </td>
        <td>
          <font-awesome-icon icon="check" v-if="news.is_published == 1"/>
          <font-awesome-icon icon="times" v-else/>
          <!--                  {{news.is_published}}-->
        </td>
        <td>
          <button type="button" class="btn btn-outline-danger" @click="deleteNews(news.id)">
            <font-awesome-icon icon="trash"/>
          </button>
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
</template>
<script>
import SortIconComponent from "./SortIconComponent"

export default {
  name: 'news-table-component',
  components: {SortIconComponent},
  props: {
    deleteNews: {},
    newsList: {},
    showEditNews: {},
    sortList: {}
  }
}
</script>

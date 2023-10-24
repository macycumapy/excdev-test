<template>
  <div>
      <div class="form-floating mb-4">
          <input id="searchInput" v-model="search" type="text" class="form-control" @change="getOperations()">
          <label for="searchInput">Поиск по описанию</label>
      </div>

    <div v-if="items.length === 0" class="container">
      Операции отсутствуют
    </div>
    <div v-else class="row justify-content-center">
      <div>Всего записей: {{ total }}</div>
      <div class="col-md-12">
        <div class="card position-relative">
          <div class="row p-2">
            <div class="col">Дата</div>
            <div class="col">Тип</div>
            <div class="col">Сумма</div>
            <div class="col">Описание</div>
          </div>
          <div v-for="operation in this.items" class="row p-2">
            <div class="col">{{ operation.date }}</div>
            <div class="col">{{ operation.type }}</div>
            <div class="col">{{ operation.sum }}</div>
            <div class="col">{{ operation.description }}</div>
          </div>
        </div>
        <nav class="mt-2">
          <ul class="pagination justify-content-center">
            <li v-for="link in links">
              <a class="page-link cursor-pointer" :class="{'bg-secondary text-light': page == link.label}"
                 v-html="link.label" @click.prevent="getOperations(link.url)"></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'OperationsList',

  data() {
    return {
      items: [],
      links: [],
      page: 1,
      total: 0,
      search: null,
    }
  },
  mounted() {
    this.getOperations();
  },
  methods: {
    getOperations(url = '/api/operation') {
      if (!url) {
        return
      }
      axios.get(url, {
        params: {search: this.search}
      })
          .then((response) => {
            this.items = response.data.items
            this.links = response.data.links
            this.page = response.data.current_page
            this.total = response.data.total
          })
    },
  },
}
</script>

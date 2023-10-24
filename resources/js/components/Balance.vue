<template>
  <div>
    <div>
      Баланс: {{ this.balance }}
    </div>
    <div>
      <div class="row">
        <div class="col">Дата</div>
        <div class="col">Тип</div>
        <div class="col">Сумма</div>
        <div class="col">Описание</div>
      </div>
      <div v-for="operation in this.operations" class="row">
        <div class="col">{{ operation.date }}</div>
        <div class="col">{{ operation.type }}</div>
        <div class="col">{{ operation.sum }}</div>
        <div class="col">{{ operation.description }}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Balance',

  data() {
    return {
      balance: null,
      operations: [],
      timer: null,
    }
  },
  mounted() {
    this.getBalance();
    this.timer = setInterval(() => {
      this.getBalance();
    }, 5000)
  },
  methods: {
    getBalance() {
      axios.get('/api/balance')
          .then((response) => {
            this.balance = response.data.balance;
            this.operations = response.data.operations;
          })
    },
  },
  beforeDestroy() {
    clearInterval(this.timer)
  }
}
</script>

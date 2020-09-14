<template>
  <b-card no-body class="mb-1" v-if="picks">
    <b-card-header header-tag="header" class="p-1" role="tab">
      <b-button block v-b-toggle="'collapse' + week" :variant="variant"
        >Week {{ week }}</b-button
      >
    </b-card-header>
    <b-collapse :id="'collapse' + week" :visible="open" role="tabpanel">
      <b-card-body>
        <b-table-simple hover small responsive>
          <b-thead>
            <b-tr>
              <b-th>Picked By</b-th>
              <b-th>Home Team</b-th>
              <b-th>Away Team</b-th>
              <b-th>Picked By</b-th>
            </b-tr>
          </b-thead>
          <b-tbody>
            <game-bet
              v-for="game in picks"
              :key="game.id"
              :game="game"
            ></game-bet>
          </b-tbody>
        </b-table-simple>
      </b-card-body>
    </b-collapse>
  </b-card>
</template>

<script>
import GameBet from './GameBet.vue'
export default {
  components: {
    GameBet
  },
  props: {
    picks: {
      type: Array,
      required: true
    },
    variant: {
      type: String,
      default: 'secondary'
    },
    open: {
      type: Boolean,
      default: false
    },
    week: {
      required: true
    }
  }
}
</script>

<style scoped></style>

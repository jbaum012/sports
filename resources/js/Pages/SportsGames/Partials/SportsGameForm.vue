<template>
  <jet-form-section @submitted="saveGame">
    <template #title>
      Basic Game Information
    </template>

    <template #form>
      <div class="col-span-6 sm:col-span-4">
        <jet-label>Week</jet-label>
        <VueMultiselect
          v-model="selectedWeek"
          class="mt-1 block w-full"
          :options="weeks"
          :close-on-select="true"
          :clear-on-select="false"
          placeholder="Week #"
          label="label"
        />
        <jet-input-error
          :message="form.errors.game_group_id"
          class="mt-2"
        />
      </div>
      <div class="col-span-6 sm:col-span-4">
        <jet-label>Game Date/Time</jet-label>
        <jet-input
          id="starts_at"
          v-model="form.starts_at"
          type="datetime-local"
          class="mt-1 block w-full"
        />
        <jet-input-error
          :message="form.errors.starts_at"
          class="mt-2"
        />
      </div>
      <div class="col-span-6 sm:col-span-4">
        <jet-label>Home Team</jet-label>
        <VueMultiselect
          v-model="homeTeam"
          class="mt-1 block w-full"
          :options="teams"
          :close-on-select="true"
          :clear-on-select="false"
          placeholder="Home Team"
          :custom-label="nameWithLocation"
          track-by="id"
        />
        <jet-input-error
          :message="form.errors.home_team_id"
          class="mt-2"
        />
      </div>
      <div class="col-span-6 sm:col-span-4">
        <jet-label>Home Team Spread</jet-label>
        <jet-input
          id="starts_at"
          v-model.number="form.home_team_spread"
          type="number"
          step="0.5"
          class="mt-1 block w-full"
        />
        <jet-input-error
          :message="form.errors.home_team_spread"
          class="mt-2"
        />
      </div>
      <div class="col-span-6 sm:col-span-4">
        <jet-label>Away Team</jet-label>
        <VueMultiselect
          v-model="awayTeam"
          class="mt-1 block w-full"
          :options="teams"
          :close-on-select="true"
          :clear-on-select="false"
          placeholder="Away Team"
          :custom-label="nameWithLocation"
          label="name"
        />
        <jet-input-error
          :message="form.errors.away_team_id"
          class="mt-2"
        />
      </div>
      <div class="col-span-6 sm:col-span-4">
        <jet-label>Away Team Spread</jet-label>
        <jet-input
          id="starts_at"
          v-model="form.away_team_spread"
          type="number"
          step="0.5"
          class="mt-1 block w-full"
        />
        <jet-input-error
          :message="form.errors.away_team_spread"
          class="mt-2"
        />
      </div>
    </template>

    <template #actions>
      <jet-action-message
        :on="form.recentlySuccessful"
        class="mr-3"
      >
        Saved.
      </jet-action-message>

      <jet-button
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Save
      </jet-button>
    </template>
  </jet-form-section>
</template>
<script>
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import VueMultiselect from 'vue-multiselect'
import { DateTime } from 'luxon'
import { localizeForInput } from '@/helpers.js'

export default {
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    VueMultiselect,
    // JetSectionBorder,
  },

  props: {
    game: Object,
    weeks: Array,
    teams: Array
  },
  data() {
    return {
      selectedWeek: this.weeks.find(w => w.label === this.game.group),
      homeTeam: this.game.home_team,
      awayTeam: this.game.away_team,
      form: this.$inertia.form({
        game_group_id: this.game.game_group_id,
        home_team_id: this.game.home_team_id,
        away_team_id: this.game.away_team_id,
        home_team_score: this.game.home_team_score,
        away_team_score: this.game.away_team_score,
        home_team_spread: this.game.home_team_spread,
        away_team_spread: this.game.away_team_spread,
        starts_at: localizeForInput(this.game.starts_at),
      })
    }
  },
  watch: {
    'form.home_team_spread': function(newVal) {
      this.form.away_team_spread = newVal * -1 ?? undefined
    },
  },
  methods: {
    nameWithLocation({name, location}) {
      return `${location} ${name}`;
    },
    saveGame() {
      this.form.transform((data) => ({
        ...data,
        game_group_id: this.selectedWeek?.id,
        home_team_id: this.homeTeam?.id,
        away_team_id: this.awayTeam?.id,
        starts_at: DateTime.fromISO(data.starts_at).toUTC()
      }))
      if (this.game.id) {
        this.form.put(route('games.update', this.game.id), {
          errorBag: 'saveGame',
          preserveScroll: true,
          onError: () => {
          }
        })
      }
      else {
        this.form.post(route('games.store'), {
          errorBag: 'saveGame',
          preserveScroll: true,
        })
      }
    },
  }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>

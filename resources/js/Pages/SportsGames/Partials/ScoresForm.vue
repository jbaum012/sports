<template>
  <jet-form-section @submitted="saveScores">
    <template #title>
      Scores
    </template>

    <template #form>
      <div class="col-span-6 sm:col-span-4">
        <jet-label>{{ game.home_team.name }} score</jet-label>
        <jet-input
          id="home_team_score"
          v-model.number="form.home_team_score"
          type="number"
          class="mt-1 block w-full"
        />
        <jet-input-error
          :message="form.errors.home_team_score"
          class="mt-2"
        />
      </div>
      <div class="col-span-6 sm:col-span-4">
        <jet-label>{{ game.away_team.name }} score</jet-label>
        <jet-input
          id="away_team_score"
          v-model.number="form.away_team_score"
          type="number"
          class="mt-1 block w-full"
        />
        <jet-input-error
          :message="form.errors.away_team_score"
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
        class="mr-2 bg-gray-200 text-black hover:text-white"
        :disabled="form.processing"
        @click="clearScores"
      >
        Clear scores
      </jet-button>

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

export default {
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
  },

  props: {
    game: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        home_team_score: this.game.home_team_score,
        away_team_score: this.game.away_team_score,
      })
    }
  },
  methods: {
    saveScores() {
      this.form.put(route('scores.update', {id: this.game.id}), {
        errorBag: 'saveScores',
        preserveScroll: true,
      })
    },
    clearScores() {
      this.form.delete(route('scores.destroy', {id: this.game.id}), {
        errorBag: 'saveScores',
        preserveScroll: true,
        onSuccess: () => {
          this.form.home_team_score = null;
          this.form.away_team_score = null;
        }
      })
    }
  }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>

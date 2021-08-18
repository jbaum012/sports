<template>
    <jet-form-section @submitted="updateTeam">
        <template #title>
          Team Information
        </template>

        <template #description>
            Crud about a team
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" ref="name" autocomplete="Team Name" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="location" value="Location" />
                <jet-input id="location" type="text" class="mt-1 block w-full" v-model="form.location" ref="location" autocomplete="Team Location" />
                <jet-input-error :message="form.errors.location" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="abbreviation" value="Abbreviation" />
                <jet-input id="abbreviation" type="text" class="mt-1 block w-full" maxlength="3" v-model="form.abbreviation" ref="abbreviation" autocomplete="Team Abbreviation" />
                <jet-input-error :message="form.errors.abbreviation" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="division" value="Division" />
                <jet-input id="division" type="text" class="mt-1 block w-full" v-model="form.division" ref="division" autocomplete="Team Division" />
                <jet-input-error :message="form.errors.division" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="primary_color" value="Primary Color" />
                <jet-input id="primary_color" type="color" class="mt-1 block w-full" v-model="form.primary_color" ref="primary_color" />
                <jet-input-error :message="form.errors.primary_color" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="secondary_color" value="Secondary Color" />
                <jet-input id="secondary_color" type="color" class="mt-1 block w-full" v-model="form.secondary_color" ref="secondary_color" />
                <jet-input-error :message="form.errors.secondary_color" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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

        props: ['team'],

        data() {
            return {
                form: this.$inertia.form({
                    name: this.team.name,
                    location: this.team.location,
                    abbreviation: this.team.abbreviation,
                    division: this.team.division,
                    primary_color: this.team.primary_color,
                    secondary_color: this.team.secondary_color
                }),
            }
        },

        methods: {
            updateTeam() {
                this.form.put(route('teams.update', this.team.name), {
                    errorBag: 'updateTeam',
                    preserveScroll: true,
                    onError: () => {
                        if (this.form.errors.name) {
                            this.$refs.name.focus()
                        }

                        if (this.form.errors.location) {
                            this.$refs.location.focus()
                        }

                        if (this.form.errors.abbreviation) {
                            this.$refs.abbreviation.focus()
                        }

                        if (this.form.errors.division) {
                            this.$refs.division.focus()
                        }

                        if (this.form.errors.primary_color) {
                            this.$refs.primary_color.focus()
                        }

                        if (this.form.errors.secondary_color) {
                            this.$refs.secondary_color.focus()
                        }
                    }
                })
            },
        },
    }
</script>

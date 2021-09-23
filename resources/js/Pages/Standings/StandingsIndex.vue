<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Standings
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-flow-row grid-cols-1 gap-4">
          <div
            v-for="(data, weekLabel) in standings"
            :key="weekLabel"
          >
            <div>
              <h1 class="text-lg fong-medium text-gray-900 mb-3">
                {{ weekLabel }}
              </h1>
              <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md grid grid-flow-row grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                  <div
                    v-for="winner in data.winners"
                    :key="winner.id"
                    class="block"
                  >
                    Winners: {{ winner.name }}
                  </div>
                  <table class="table-auto w-full">
                    <thead>
                      <tr>
                        <th />
                        <th class="py-3 px-6 text-right">
                          Points
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(result, userId) in data.results"
                        :key="userId"
                        class="border-b border-gray-200 hover:bg-gray-100"
                      >
                        <td>{{ getUser(userId) }}</td>
                        <td class="text-right">
                          {{ result }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import { ref } from 'vue';
export default {
  components: {
    AppLayout,
  },
  props: ['standings', 'users'],
  setup(props) {
    const getUser = (id) => {
      const matchedUsers = props.users.filter(user => {
        return user.id == id
      });
      if (matchedUsers.length !== 1) {
        return null;
      }
      return matchedUsers[0].name;
    }
    return {
      getUser
    }
  }
}
</script>

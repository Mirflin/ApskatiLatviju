<template>
  <article class="main-panel">
    <div class="panel">
      <div class="panel-header">
        <p>{{ $breadcrumb }}</p>
      </div>

      <div>
        <div class="bg-white rounded-xl shadow-md p-4">
          <div class="header-button-panels flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Users</h2>
            <button
              @click="showModal = true"
              class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600"
            >
              Create new
            </button>
          </div>

          <div class="overflow-x-auto">
            <table class="custom-table min-w-full text-sm text-left text-gray-700">
              <thead>
                <tr>
                  <th class="px-4 py-3 rounded-tl-xl">#</th>
                  <th class="px-4 py-3">User</th>
                  <th class="px-4 py-3">Email</th>
                  <th class="px-4 py-3">Permissions</th>
                  <th class="px-4 py-3">Status</th>
                  <th class="px-4 py-3 rounded-tr-xl text-center">Tools</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="us in users"
                  :key="us.id"
                  class="hover:bg-[#f5f6f8]"
                >
                  <td class="px-4 py-2">{{ us.id }}</td>
                  <td class="px-4 py-2">{{ us.user }}</td>
                  <td class="px-4 py-2">{{ us.email }}</td>
                  <td class="px-4 py-2">{{ us.permissions }}</td>
                  <td class="px-4 py-2">
                    <span :class="statusClass(us.status)">{{ us.status }}</span>
                  </td>
                  <td class="px-4 py-2 text-center">
                    <button
                      class="text-blue-500 hover:text-blue-700 mr-2"
                      title="Edit"
                    >
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button
                      class="text-red-500 hover:text-red-700"
                      title="Delete"
                    >
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </td>
                </tr>
                <tr v-if="users.length === 0">
                  <td colspan="6" class="px-4 py-6 text-center text-gray-400">
                    No users found.
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <baseModal
        v-model="showModal"
        title="Add / Edit User"
        @cancel="cancelModal"
        @save="saveUser"
      >
        <form @submit.prevent="saveUser" class="space-y-4">
          <div>
            <label class="block text-gray-700 mb-1">User</label>
            <input
              v-model="form.user"
              type="text"
              required
              class="w-full border border-gray-300 rounded px-3 py-2"
              placeholder="Enter user name"
            />
          </div>

          <div>
            <label class="block text-gray-700 mb-1">Email</label>
            <input
              v-model="form.email"
              type="email"
              required
              class="w-full border border-gray-300 rounded px-3 py-2"
              placeholder="Enter email"
            />
          </div>

          <div>
            <label class="block text-gray-700 mb-1">Permissions</label>
            <select
              v-model="form.permissions"
              class="w-full border border-gray-300 rounded px-3 py-2"
              required
            >
              <option value="" disabled>Select permission</option>
              <option>Moderator</option>
              <option>Administrator</option>
            </select>
          </div>

          <div>
            <label class="block text-gray-700 mb-1">Status</label>
            <select
              v-model="form.status"
              class="w-full border border-gray-300 rounded px-3 py-2"
              required
            >
              <option value="" disabled>Select status</option>
              <option>Active</option>
              <option>Inactive</option>
            </select>
          </div>
        </form>
      </baseModal>
    </div>
  </article>
</template>

<script setup>
import { ref } from 'vue';
import baseModal from './baseModal.vue';

const showModal = ref(false);

const users = ref([
    {
        id: 1,
        user: 'Test Moder',
        email: 'tmoder@gmail.com',
        permissions: 'Moderator',
        status: 'Active',
    },
    {
        id: 2,
        user: 'Test Admin',
        email: 'tadmin@gmail.com',
        permissions: 'Administrator',
        status: 'Active',
    },
]);

const form = ref({
    user: '',
    email: '',
    permissions: '',
    status: '',
});

const statusClass = (status) => {
    switch (status.toLowerCase()) {
        case 'active':
            return 'text-green-600 font-medium';
        case 'inactive':
            return 'text-gray-600 font-medium';
        default:
            return 'text-gray-600 font-medium';
    }
};

const resetForm = () => {
    form.value = { user: '', email: '', permissions: '', status: '' };
};

const cancelModal = () => {
    resetForm();
    showModal.value = false;
};

const saveUser = () => {
    users.value.push({
        id: users.value.length + 1,
        user: form.value.user,
        email: form.value.email,
        permissions: form.value.permissions,
        status: form.value.status,
    });

    resetForm();
    showModal.value = false;
};
</script>

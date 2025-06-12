<template>
    <article class="main-panel">
        <div class="panel">
            <div class="panel-header">
                <p>{{ "/ moderators" }}</p>
            </div>

            <div>
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div
                        class="header-button-panels flex items-center justify-between mb-4"
                    >
                        <h2 class="text-lg font-semibold text-gray-800">
                            Users
                        </h2>
                        <button
                            @click="showModal = true"
                            class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600"
                        >
                            Create new
                        </button>
                    </div>
                    <universalTable
                        :data="news"
                        :columns="columns"
                        :perPage="10"
                        :searchableFields="['name', 'email', 'permission']"
                        @edit="handleEdit"
                        @delete="handleDelete"
                    >
                        <template #tool="{ row }">
                            <button @click="$emit('edit', row)">
                                <i class="fa-solid fa-pen-to-square fa-xl"></i>
                            </button>
                            <button @click="$emit('delete', row)">
                                <i class="fa-solid fa-trash fa-xl"></i>
                            </button>
                        </template>
                    </universalTable>
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
                        <label class="block text-gray-700 mb-1"
                            >Permissions</label
                        >
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
import universalTable from './universalTable.vue';

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

const news = [
    {
        id: 1,
        header: 'Alice',
        content: 'alice@example.com',
        created_at: '2025',
    },
    { id: 2, header: 'Bob', content: 'bob@example.com', created_at: '2025' },
    {
        id: 3,
        header: 'Charlie',
        content: 'charlie@example.com',
        created_at: '2024',
    },
    {
        id: 4,
        header: 'David',
        content: 'david@example.com',
        created_at: '2025',
    },
    { id: 5, header: 'Fve', content: 'eve@example.com', created_at: '2025' },
    {
        id: 6,
        header: 'Frank',
        content: 'frank@example.com',
        created_at: '2025',
    },
    {
        id: 7,
        header: 'Charlie',
        content: 'charlie@example.com',
        created_at: '2024',
    },
    {
        id: 8,
        header: 'David',
        content: 'david@example.com',
        created_at: '2025',
    },
    { id: 9, header: 'Fve', content: 'eve@example.com', created_at: '2025' },
    {
        id: 10,
        header: 'Frank',
        content: 'frank@example.com',
        created_at: '2025',
    },
];

const columns = [
    { label: 'Id', key: 'id' },
    { label: 'Name', key: 'name' },
    { label: 'Email', key: 'email' },
    { label: 'Permissions', key: 'permission' },
];

function handleEdit(row) {
    alert(`Edit ${row}`);
}

function handleDelete(row) {
    alert(`Delete ${row}`);
}
</script>

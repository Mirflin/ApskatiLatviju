<template>
    <article class="main-panel">
        <div class="panel">
            <div class="panel-header">
                <p>/ action-history</p>
            </div>
            <div>
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div
                        class="header-button-panels flex items-center justify-between mb-4"
                    >
                        <h2 class="text-lg font-semibold text-gray-800">
                            History
                        </h2>
                    </div>
                    <universalTable
                        :data="news"
                        :columns="columns"
                        :perPage="10"
                        :searchableFields="['user','permission', 'status','action','created_at']"
                        @edit="handleEdit"
                        @delete="handleDelete"
                    >
                        <template #tool="{ row }">
                            <button @click="$emit('edit', row)"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button @click="$emit('delete', row)"><i class="fa-solid fa-trash"></i></button>
                        </template>
                    </universalTable>

                </div>
            </div>
        </div>
    </article>
</template>

<script setup>
import { ref } from 'vue';

const showModal = ref(false);

const form = ref({
    user: '',
    action: '',
    date: '',
});

const history = ref([
    {
        id: 1,
        user: 'TestN1 TestSurN1',
        action: 'Deleted item',
        date: '2025-01-01',
        status: 'Success',
    },
    {
        id: 2,
        user: 'TestN1 TestSurN2',
        action: 'Edited item',
        date: '2025-01-01',
        status: 'Pending',
    },
]);

const statusClass = (status) => {
    switch (status.toLowerCase()) {
        case 'success':
            return 'text-green-600 font-medium';
        case 'pending':
            return 'text-yellow-600 font-medium';
        case 'failed':
            return 'text-red-600 font-medium';
        default:
            return 'text-gray-600 font-medium';
    }
};

const submitForm = () => {
    history.value.push({
        id: history.value.length + 1,
        user: form.value.user,
        action: form.value.action,
        date: form.value.date,
        status: 'Pending',
    });

    form.value = {
        user: '',
        action: '',
        date: '',
    };
    showModal.value = false;
};

// import axios from 'axios';
// import { ref, onMounted } from 'vue';

// const history = ref([]);
// const loading = ref(false);

// const loadHistory = async () => {
//     loading.value = true;
//     try {
//         const response = await axios.get('/api/action-histories');
//         history.value = response.data.map((item) => ({
//             id: item.id,
//             user: item.user?.name ?? `ID: ${item.user_id}`,
//             action: item.action,
//             date: new Date(item.created_at).toLocaleDateString(),
//             status:
//                 item.status_id === 1
//                     ? 'Success'
//                     : item.status_id === 2
//                       ? 'Pending'
//                       : item.status_id === 3
//                         ? 'Failed'
//                         : 'Unknown',
//         }));
//     } catch (error) {
//         console.error('History loading failed:', error);
//     } finally {
//         loading.value = false;
//     }
// };

// onMounted(() => {
//     loadHistory();
// });

// const statusClass = (status) => {
//     switch (status.toLowerCase()) {
//         case 'success':
//             return 'text-green-600 font-medium';
//         case 'pending':
//             return 'text-yellow-600 font-medium';
//         case 'failed':
//             return 'text-red-600 font-medium';
//         default:
//             return 'text-gray-600 font-medium';
//     }
// };
import universalTable from './universalTable.vue'

const news = [
  { id: 1, header: 'Alice', content: 'alice@example.com', created_at: "2025" },
  { id: 2, header: 'Bob', content: 'bob@example.com' , created_at: "2025"},
  { id: 3, header: 'Charlie', content: 'charlie@example.com' , created_at: "2024"},
  { id: 4, header: 'David', content: 'david@example.com' , created_at: "2025"},
  { id: 5, header: 'Fve', content: 'eve@example.com' , created_at: "2025"},
  { id: 6, header: 'Frank', content: 'frank@example.com' , created_at: "2025"},
  { id: 7, header: 'Charlie', content: 'charlie@example.com' , created_at: "2024"},
  { id: 8, header: 'David', content: 'david@example.com' , created_at: "2025"},
  { id: 9, header: 'Fve', content: 'eve@example.com' , created_at: "2025"},
  { id: 10, header: 'Frank', content: 'frank@example.com' , created_at: "2025"},

]

const columns = [
  { label: 'Id', key: 'id' },
  { label: 'User', key: 'user' },
  { label: 'Permissions', key: 'permission' },
  { label: 'Action', key: 'action' },
  { label: 'Status', key: 'status' },
  { label: 'Time', key: 'created_at' },
]

function handleEdit(row) {
  alert(`Edit ${row}`)
}

function handleDelete(row) {
  alert(`Delete ${row}`)
}

</script>

<template>
    <article class="main-panel" v-if="loaded">
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
                            Vēsture
                        </h2>
                    </div>
                    <universalTable
                        :data="data"
                        :columns="columns"
                        :perPage="10"
                        :searchableFields="['user','permission', 'status','action','created_at']"
                        @view="handleView"
                    >
                        <template #tool="{ row }">
                            <!--<button @click="handleView(row)"><i class="fa-solid fa-eye"></i></button>
                            <button v-if="row.status == 'Waiting approval' && isAdmin" @click="handleAprove(row)"><i class="fa-solid fa-thumbs-up fa-lg"></i></button>
                            <button v-if="row.status == 'Waiting approval' && isAdmin" @click="handleCancel(row)"><i class="fa-solid fa-ban fa-lg"></i></button>-->
                        </template>
                    </universalTable>

                </div>
            </div>
        </div>
    </article>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import universalTable from './universalTable.vue'

const columns = [
  { label: 'Id', key: 'id' },
  { label: 'User', key: 'user' },
  { label: 'Permissions', key: 'permission' },
  { label: 'Action', key: 'action' },
  { label: 'Status', key: 'status' },
  { label: 'Time', key: 'created_at' },
]

const data = ref([]);
const loaded = ref(false);
const isAdmin = ref(false);
const user = ref();

async function fetchdata(){
    try{
        let response = await axios.get('/api/get-history');
        data.value = response.data;
        data.value.forEach(element => {
            element.created_at = (new Date(element.created_at)).toLocaleString();
        });
        user.value = (await axios.get('/api/get-current-user')).data;
        if(user.value.permision_group == 1){
            isAdmin.value = true
        }

    } catch(error){
        console.log(error)
    } finally {
        loaded.value = true;
    }
}

onMounted( async () => {
    fetchdata();
});

const form = ref({
    user: '',
    action: '',
    date: '',
});

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

</script>

<template>
    <article class="main-panel">
        <div class="panel">
            <div class="panel-header">
                <i class="fa-solid fa-chart-pie fa-2xl"></i>
                <p>{{$breadcrumb}}</p>
            </div>
            <div class="p-6 bg-[#f7f8fa]">
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div class="header-button-panels">
                        <h2 class="text-lg font-semibold mb-4 text-gray-800">News</h2>
                        <button>Create new</button>
                    </div>
                    <vue-good-table :columns="this.columns" :rows="this.rows"></vue-good-table>
                </div>
            </div>
        </div>
    </article>
</template>
<script>
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table';

export default{
    components: {
      VueGoodTable
    },
    data(){
        return{
            columns: [
                {
                label: 'User',
                field: 'user',
                },
                {
                label: 'Action',
                field: 'action',
                },
                {
                label: 'Date',
                field: 'date',
                type: 'date',
                dateInputFormat: 'yyyy-MM-dd hh:mm',
                },
                {
                label: 'Status',
                field: 'status',
                },
                {
                label: 'Tools',
                field: 'tools',
                },
            ],
            rows: [
                { id:1, user:"John", action: 'da', date: '2025-12-05 20:30',status: 'pedning', tools: 'd' },
                { id:2, user:"Jane", action: 'da', createdAt: '2011-10-31 21:30', status: 'pending', tools: 'e' },
            ],
        }
    },
    mounted(){
        try{
            this.news = axios.get('/get-news');
        } catch (error){

        }
    }
}
</script>
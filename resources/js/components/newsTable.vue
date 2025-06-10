<template>

</template>
<script>
import { AgGridVue } from "ag-grid-vue3";
import {ref} from "vue";

export default {
    components: {
        AgGridVue,
    },
    props:{
        news:{
            type: Object
        }
    },
    data(){
        return{
            table:{
                colDefs: ref([
                    {field: "da"},
                    {field: "test"}
                ])
            }
        }
    },
    setup() {

    },
};
</script>
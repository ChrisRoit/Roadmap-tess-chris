<template>
    <button @click="showModal" class="btn btn-warning btn-sm">Edit</button>
</template>


<script lang="ts">
import { defineComponent } from 'vue';

    export default defineComponent({
        emits:[
            "show-edit-user-modal",
        ],
        methods:{
            showModal(){
                this.$emit("show-edit-user-modal");
            }
        }
    })
</script>
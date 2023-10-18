<template>
    <div>
        <button class="btn btn-success" @click="showModal">Create User</button>
    </div>
</template>


<script lang="ts">
    import Vue, { defineComponent } from "vue";

    export default defineComponent({
        emits:[
            "show-create-user-modal"
        ],
        methods:{
            showModal():void{
                this.$emit("show-create-user-modal")
            }
        }
    });
</script>

<style lang="scss">
    #create-user-form-notification{
        margin-top:5px;
        margin-bottom:5px;
    }

    .createUsersModal{
        width:100%;
        height:100%;
    }
</style>
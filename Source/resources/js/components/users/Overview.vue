<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="text-center">
                        <h1>User Management</h1>
                    </div>
                    <hr />
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                        <create-user-button @show-create-user-modal="handleCreateUser"  :route="store_route" :token="csrf_token"/>
                    <hr />
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Role</td>
                                <td>Edit</td>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="tableData.length > 0">
                                <tr v-for="user of tableData">
                                    <td>{{ user.name }}</td>
                                    <td v-if="user.is_admin">Admin</td>
                                    <td v-else-if="user.is_operator">Operator</td>
                                    <td v-else>Student</td>
                                    <td><edit-user-button @show-edit-user-modal="handleEditUser(user)" /></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <div v-if="totalPages > 1">
                        <button v-if="pageNumber == 1" @click="previousPage" disabled> &lt; </button>
                        <button v-else @click="previousPage"> &lt; </button>
                        <button v-if="pageNumber == totalPages" @click="nextPage" disabled> &gt; </button>
                        <button v-else @click="nextPage"> &gt; </button>
                    </div>
                </div>
            </div>
        </div>
        <user-entry-modal 
            @user-data-updated="getResults"
            @modal-closed="handleUserManagementModal" 
            :show="showCreateModal" 
            :route="store_route"
            :update-route="update_route"
            :delete-route="delete_route"
            :token="csrf_token"
            :editUser="editUser"
            :user="user" />
    </div>
</template>


<script lang="ts">
    import { defineComponent } from 'vue';
    import axios, { AxiosResponse } from "axios";
    import {UserInterface} from "../../../interfaces/users";

    export default defineComponent({
        name:"users-overview",

        props:[
            "token",
            "storeRoute",
            "updateRoute",
            "deleteRoute",
            "usersDataRoute",
        ],

        data(){return {
            pageNumber:Number(1),
            tableData: [] as Array<UserInterface>,
            totalPages:Number(1),
            showCreateModal:false,
            store_route:this.$props.storeRoute,
            update_route:this.$props.updateRoute,
            delete_route:this.$props.deleteRoute,
            csrf_token:this.$props.token,
            //these data properties are for the edit user functionality only!
            editUser:false,
            user: {} as UserInterface,

        }},

        methods:{
            getResults():void{
                axios.get(`${this.usersDataRoute}?page=${this.pageNumber}`).then((response:AxiosResponse) => {
                    this.tableData = response.data.data;
                    this.totalPages = response.data.last_page;
                });
            },

            previousPage():void{
                if(this.pageNumber > 1){
                    this.pageNumber -= 1;
                    this.getResults();
                }
            },

            nextPage():void{
                if(this.pageNumber < this.totalPages){
                    this.pageNumber += 1;
                    this.getResults();
                }
            },

            handleUserManagementModal():void{
                this.showCreateModal ? this.showCreateModal = false : this.showCreateModal = true;
            },

            handleCreateUser():void{
                this.editUser = false;
                this.handleUserManagementModal();
            },

            handleEditUser(user:UserInterface):void{
                this.editUser = true;
                this.user = user;
                this.handleUserManagementModal();
            },

        },

        mounted(){
            this.getResults();
        },


    })
</script>
<template>
    <div>
        <modal id="userModal" name="createUserModal" height="auto" :scrollable="true" :styles="'padding:50px;'">
            <div class="container-fluid">
                <div v-if="notification.length > 0" class="row">
                    <div class="col-xs-10 offset-xs-1">
                        <div id="create-user-form-notification" class="card">
                            <div class="card-body">
                                <p class="text-center">{{ notification }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-10 offset-xs-1">
                        <h1 v-if="!editUserForm" class="text-center">Create User</h1>
                        <h1 v-else class="text-center">Edit User</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-10 offset-xs-1">
                        <div>
                            <input v-model="username" id="username" name="userName" class="form-control modal-input" placeholder="name" />
                        </div>
                        <div>
                            <input v-model="email" id="email" name="userEmail" class="form-control modal-input" placeholder="Email" />
                        </div>
                        <div>
                            <input v-model="pw" id="pw" type="password" name="userPassword" class="form-control modal-input" placeholder="Password" />
                        </div>
                        <div>
                            <div class="form-check form-check-inline modal-radio-input">
                                <input v-model="userType" id="usertype" class="form-check-input" type="radio" name="userType" value="user" checked/>
                                <Label>User</Label>
                            </div>
                           
                            <div class="form-check form-check-inline">
                                <input v-model="userType" id="operatortype" class="form-check-input" type="radio" name="userType" value="operator" />
                                <label>Operator</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input v-model="userType" id="admintype" class="form-check-input" type="radio" name="userType" value="admin" />
                                <label>Admin</label>
                            </div>
                        </div>
                        <div v-if="!editUserForm">
                            <button @click="createUser" class="btn btn-success">Create</button>
                            <button @click="closeModal" class="btn btn-danger">Close</button>
                        </div>
                        <div v-else>
                            <button @click="editUserData" class="btn btn-success">Save</button>
                            <button @click="deleteUser" class="btn btn-danger">Delete</button>
                            <button @click="closeModal" class="btn btn-danger">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </modal>
        <modal name="confirmModal" height="auto" :scrollable="true" :styles="'padding:50px;'">
            <h3>{{ confirmMessage }}</h3>
            <button @click="confirmSubmit" class="btn btn-success">Yes</button>
            <button @click="closeConfirmModal" class="btn btn-danger">No</button>
        </modal>
    </div>
</template>


<script lang="ts">
    import Vue, { defineComponent } from "vue";
    import Vmodal from "vue-js-modal";
    import axios, { AxiosResponse } from "axios";
    
    Vue.use(Vmodal)

    export default defineComponent({
       
        name:"createUserComponent",
        emits:[
            "user-data-updated",
            "modal-closed",
        ],
        props:[
            "route",
            "updateRoute",
            "deleteRoute",
            "token",
            "show",
            "editUser",
            "user",
        ],
        data(){
            return {
                username:"",
                email:"",
                pw:"",
                notification:"",
                userType:"user",
                modalScroll:true,
                editUserForm:Boolean(this.$props.editUser),
                confirmMessage:String(""),
                confirmRoute:String(""),
            }
        },

        watch:{
            show : function():void {
                this.showCreateModal();
            },

            editUser: function():void{
                this.$props.editUser ? this.editUserForm = true : this.editUserForm = false;
            }
        },

        methods:{
            showCreateModal():void {
                this.username = this.$props.editUser ? this.$props.user.name : "";
                this.email = this.$props.editUser ? this.$props.user.email : "";
                this.pw = "";
                this.userType = this.$props.editUser ? 
                    this.$props.user.is_admin ? this.userType = "admin" : 
                    this.$props.user.is_operator ? this.userType = "operator" : "user"
                    :"user";
                this.notification = "";
                this.$modal.show("createUserModal");
            },
            closeModal():void {
                this.$modal.hide("createUserModal");
                this.$emit("modal-closed");
              
            },

            closeConfirmModal():void{
                this.$modal.hide("confirmModal");
            },

            createUser():void{
                this.notification = "";
                this.validatePassword() ? null : this.notification = "The given password is not long enough. Please supply a password with at least 8 characters!";
                this.username.length >=5 ? null : this.notification = "The given username is too short. It must be at least 5 characters long.";
                this.userType == "user" || this.userType == "operator" || this.userType == "admin" ? null : this.notification = "The user type is not of the right format!";

                this.notification.length == 0 ?  axios.post(this.$props.route,{
                    "_token":this.$props.token,
                    "name":this.username,
                    "pw": this.pw,
                    "email":this.email,
                    "userType":this.userType,
                }).then((response:AxiosResponse) => {
                    if(response.data){
                        this.closeModal();
                        this.$emit("user-data-updated");
                    }else{
                        this.notification = "Did you use the valid format for each input? Check the email format."
                    }
                }).catch((error) => {
                    this.notification = error.message;
                }) : null;
            },


            editUserData():void{
                this.notification = "";
                this.confirmRoute = this.$props.updateRoute;
                if(this.pw.length > 1){
                    this.validatePassword() ? null : this.notification = "The given password is not long enough. Please supply a password with at least 8 characters!";
                }
                this.username.length >=5 ? null : this.notification = "The given username is too short. It must be at least 5 characters long.";
                this.userType == "user" || this.userType == "operator" || this.userType == "admin" ? null : this.notification = "The user type is not of the right format!";
                if(this.notification.length == 0){
                    //this.confirmSubmitModal("Are you sure you want to edit the user data?");
                    this.confirmSubmit();
                }
            },

            deleteUser():void{
                this.confirmRoute = this.$props.deleteRoute;
                this.confirmSubmitModal("Are you sure you want to delete this user?");
            },

            confirmSubmitModal(message:string):void{
                this.confirmMessage = message;
                this.$modal.show("confirmModal");   
            },

            confirmSubmit():void{
                axios.post(this.confirmRoute,{
                    "_token":this.$props.token,
                    "id":this.user.id,
                    "username":this.username,
                    "email":this.email,
                    "pw":this.pw,
                    "userType":this.userType,
                }).then((response:AxiosResponse) => {
                    //add another main page notification here later!!
                }).catch((error) => {
                    this.notification = error.message;
                });
                this.closeConfirmModal();
                this.closeModal();
                this.$emit("user-data-updated");
            },

            validatePassword():boolean{
                return this.pw.length >= 8 ? true : false;
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
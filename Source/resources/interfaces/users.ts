export interface UserInterface{
    created_at:String,
    email:String,
    email_verified_at: String | null,
    id:Number,
    is_admin:boolean,
    is_operator:boolean,
    name:String,
    updated_at:String
}
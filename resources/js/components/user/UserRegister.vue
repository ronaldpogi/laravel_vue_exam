<template>

    <div class="container">
    <div class="row">
        <div class="col-lg-5 col-md-7 mx-auto">
            
            <div class="panel border bg-white">

                <div class="panel-heading">
                    <h3 class="pt-3 font-weight-bold">Sign up</h3>
                </div>
                <div class="panel-body p-3">
                    <form @submit.prevent="storeUser()">

                        <div class="text-center b" v-for="(v, k) in errors" :key="k">
                            <label v-for="error in v" :key="error" class="text-danger" style="font-size: 13px"> {{ error }} </label>
                        </div>

                        <div class="form-group py-2">
                            <div class="input-field"> <input v-model="form.name" type="text" placeholder="Enter Name" required> </div>
                        </div>

                        <div class="form-group py-2">
                            <div class="input-field"> <input v-model="form.email" type="text" placeholder="Enter Email" required> </div>
                        </div>

                        <div class="form-group py-1 pb-2">
                            <div class="input-field"> <input v-model="form.password" type="password" placeholder="Enter Password" required> <button class="btn bg-white text-muted"> </button> </div>
                        </div>

                        <div class="form-group py-1 pb-2">
                            <div class="input-field"> <input v-model="form.password_confirmation" type="password" placeholder="Confirm Password" required> <button class="btn bg-white text-muted"> </button> </div>
                        </div>
                        
                        <div class="form-group py-1 pb-2">
                            <select v-model="form.role_name" class="form-control" id="role">
                            <option>Admin</option>
                            <option>User</option>
                            </select>
                            <small class="ml-1">Assign role</small>
                        </div>
                        

                        <button class="btn btn-primary btn-block mt-3"> Register </button>
                        <div class="text-center pt-4 text-muted">Already have an account? <router-link :to="{ name: 'UserLogin' }"> Login </router-link> </div>
                    </form>
                </div>
                <div class="mx-3 my-2 py-2 bordert">
                    <div class="text-center py-3"> <a href="https://wwww.facebook.com" target="_blank" class="px-2"> <img src="https://www.dpreview.com/files/p/articles/4698742202/facebook.jpeg" alt=""> </a> <a href="https://www.google.com" target="_blank" class="px-2"> <img src="https://www.freepnglogos.com/uploads/google-logo-png/google-logo-png-suite-everything-you-need-know-about-google-newest-0.png" alt=""> </a> <a href="https://www.github.com" target="_blank" class="px-2"> <img src="https://www.freepnglogos.com/uploads/512x512-logo-png/512x512-logo-github-icon-35.png" alt=""> </a> </div>
                </div>
            </div>
        </div>
    </div>
</div>

</template>



<script>
import { reactive } from 'vue'
import useUser from '../../composables/user.js'

export default {

    setup() {

        const form = reactive({
            'name': '',
            'email': '',
            'password': '',
            'password_confirmation': '',
            'role_name': '',
            'description': ''
        })
        
        const { createUser, errors } = useUser()

        const storeUser = async () => {

            if (form.role_name == 'Admin') {
                form.description = 'Administrator'
            } else {
                form.description = 'Normal user'
            }

            createUser({...form})
        }

        return {
            form,
            errors,
            storeUser
        }

    }

}
</script>



<style scoped>

@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}

body {
    height: 100vh;
    background: linear-gradient(to top, #c9c9ff 50%, #9090fa 90%) no-repeat
}

.container {
    margin: 50px auto
}

.panel-heading {
    text-align: center;
    margin-bottom: 10px
}

#forgot {
    min-width: 100px;
    margin-left: auto;
    text-decoration: none
}

a:hover {
    text-decoration: none
}

.form-inline label {
    padding-left: 10px;
    margin: 0;
    cursor: pointer
}

.btn.btn-primary {
    margin-top: 20px;
    border-radius: 15px
}

.panel {
    min-height: 380px;
    box-shadow: 20px 20px 80px rgb(218, 218, 218);
    border-radius: 12px
}

.input-field {
    border-radius: 5px;
    padding: 5px;
    display: flex;
    align-items: center;
    cursor: pointer;
    border: 1px solid #ddd;
    color: #4343ff
}

input[type='text'],
input[type='password'] {
    border: none;
    outline: none;
    box-shadow: none;
    width: 100%
}

.fa-eye-slash.btn {
    border: none;
    outline: none;
    box-shadow: none
}

img {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 50%;
    position: relative
}

a[target='_blank'] {
    position: relative;
    transition: all 0.1s ease-in-out
}

.bordert {
    border-top: 1px solid #aaa;
    position: relative
}

.bordert:after {
    content: "or connect with";
    position: absolute;
    top: -13px;
    left: 33%;
    background-color: #fff;
    padding: 0px 8px
}

@media(max-width: 360px) {
    #forgot {
        margin-left: 0;
        padding-top: 10px
    }

    body {
        height: 100%
    }

    .container {
        margin: 30px 0
    }

    .bordert:after {
        left: 25%
    }
}

</style>
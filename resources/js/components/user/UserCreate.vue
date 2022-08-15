<template>

  <div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="container justify-content-center">

          <div class="col-md-8 mx-auto">
              <div class="ml-auto col-md-5 mb-2">
                <router-link class="btn btn-info mr-2" :to="{ name: 'userIndex' }"> Home <i class="fas fa-solid fa-house-user"></i> </router-link>
                <button class="btn btn-warning"> Logout <i class="fas fa-thin fa-arrow-right-from-bracket"></i> </button>
              </div>

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create</h4>
                  <p class="card-description">
                    Create new user
                  </p>

                  <div>
                   
                    <form @submit.prevent="newUser()">

                        <div class="text-center b" v-for="(v, k) in errors" :key="k">
                            <label v-for="error in v" :key="error" class="text-danger" style="font-size: 13px"> {{ error }} </label>
                        </div>

                        <div class="form-group">
                            <input v-model="form.name" type="text" class="form-control" aria-describedby="" placeholder="Full name">
                        </div>

                        <div class="form-group">
                            <input v-model="form.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <input v-model="form.password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <input v-model="form.password_confirmation" type="password" class="form-control" placeholder="Confirm password">
                        </div>

                        <div class="form-group">
                            <label for="role">Assign role</label>
                            <select v-model="form.role_name" class="form-control" id="role">
                            <option>Admin</option>
                            <option>User</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                  </div>

                </div>
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

        const newUser = async () => {

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
            newUser
        }

    }

}

</script>

<style scoped>
    body {
     background-color: #f9f9fa
 }

 .flex {
     -webkit-box-flex: 1;
     -ms-flex: 1 1 auto;
     flex: 1 1 auto
 }

 @media (max-width:991.98px) {
     .padding {
         padding: 1.5rem
     }
 }

 @media (max-width:767.98px) {
     .padding {
         padding: 1rem
     }
 }

 .padding {
     padding: 5rem
 }

 .card {
     box-shadow: none;
     -webkit-box-shadow: none;
     -moz-box-shadow: none;
     -ms-box-shadow: none
 }

 .pl-3,
 .px-3 {
     padding-left: 1rem !important
 }

 .card {
     position: relative;
     display: flex;
     flex-direction: column;
     min-width: 0;
     word-wrap: break-word;
     background-color: #fff;
     background-clip: border-box;
     border: 1px solid #d2d2dc;
     border-radius: 0
 }
 
 .card .card-title {
    color: #000000;
    margin-bottom: 0.625rem;
    text-transform: capitalize;
    font-size: 0.875rem;
    font-weight: 500;
}

.card .card-description {
    margin-bottom: .875rem;
    font-weight: 400;
    color: #76838f;
}

p {
    font-size: 0.875rem;
    margin-bottom: .5rem;
    line-height: 1.5rem;
}
</style>
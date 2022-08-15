<template>

  <div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="container justify-content-center">

          <div class="col-md-8 mx-auto">
              <div class="ml-auto col-md-5 mb-2">
                <router-link v-if="users_role.role_name == 'Admin'" class="btn btn-info mr-2" :to="{ name: 'UserCreate' }"> Create-user <i class="fas fa-thin fa-plus"></i> </router-link>
                <button @click="logoutUser()" class="btn btn-warning"> logout <i class="fas fa-thin fa-arrow-right-from-bracket"></i> </button>
              </div>

              <div class="card mb-1">
                <div class="card-body">
                  <h4 class="card-title">Basic Table</h4>
                  <p class="card-description">
                    Basic table with card
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="user in users" :key="user.id">
                          <td>{{ user.name }}</td>
                          <td>{{ user.email }}</td>
                          <td> 
                            <router-link :to="{ name: 'UserUpdateRole', params: { id: user.id } }" class="btn btn-sm btn-info"> Update-role </router-link> 
                              | 
                            <router-link :to="{ name: 'UserUpdateInfo', params: { id: user.id } }" class="btn btn-sm btn-info"> Update-info </router-link>
                              |
                            <button @click="delUser(user.id)" class="btn btn-sm btn-danger"> Delete </button>  
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>



              <!-- <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Basic Table</h4>
                  <p class="card-description">
                    Basic table with card
                  </p>
                  <div class="table-responsive">
                   <table class="table">
                      <thead>
                        <tr>
                          <th>Role name</th>
                          <th>Descripion</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="role in roles" :key="role.id">
                          <td>{{ role.role_name }}</td>
                          <td>{{ role.description }}</td>
                          <td><button class="btn btn-sm btn-info"> Edit </button> | <button class="btn btn-sm btn-danger"> Delete </button></td>
                        </tr>
                      </tbody>
                    </table>

                   

                  </div>
                </div>
              </div> -->



            </div>
            
            </div>
              </div>
            </div>

</template>

<script>

import useUser from '../../composables/user.js'
import { onMounted } from 'vue'

export default {

    setup() {
        
        const { getUsers, users, roles, logout, users_role, destroyUser } = useUser()

        const logoutUser = async () => {
          logout()
        }

        const delUser = async (id) => {

          if (!window.confirm('Are you sure you want to delete?')) {
            return
          }

          await destroyUser(id)
          await getUsers()
        }

        onMounted(getUsers)

        return {
            users,
            roles,
            logoutUser,
            users_role,
            delUser
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

.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}

.table, .jsgrid .jsgrid-table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
}

.table thead th, .jsgrid .jsgrid-table thead th {
    border-top: 0;
    border-bottom-width: 1px;
    font-weight: 500;
    font-size: .875rem;
    text-transform: uppercase;
}

.table td, .jsgrid .jsgrid-table td {
    font-size: 0.875rem;
    padding: .875rem 0.9375rem;
}

.badge {
    border-radius: 0;
    font-size: 12px;
    line-height: 1;
    padding: .375rem .5625rem;
    font-weight: normal;
}
 

</style>
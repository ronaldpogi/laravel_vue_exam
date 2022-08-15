import axios from "axios";
import { reactive, ref } from "vue";
import router from "../router";

export default function useUser(){

    const users = ref([])
    const role = ref({})
    const users_role = ref({})
    const user = ref({})
    const errors = ref([])
    const loginError = reactive({
        'error': ''
    })

    const createUser = async (data) => {
        try {
            let response = await axios.post('/api/user/register', data)
            router.push({ name: 'userIndex' })
            console.log('createUser', response)
        } catch (error) {
            errors.value = error.response.data.errors
            console.log('createUser', error.response)
        }
    }

    const loginUser = async (data) => {
        try {
            let response = await axios.post('/api/user/login', data)
            localStorage.setItem('token', response.data.token)

            location.href = '/user';

            console.log('createUser', response)
        } catch (error) {
            errors.value = error.response.data.errors

            if (error.response.status == 401) {
                loginError.error = error.response.data.message
            } else {
                loginError.error = ''
            }

            console.log('createUser', error.response)
        }
    }
    
    const logout = async () => {
        try {
            let response = await axios.post('http://127.0.0.1:8000/api/user/logout')

            location.href = '/';

            console.log(response)
        } catch (error) {
            console.log(error.response)
        }
    }

    const getUsers = async () => {
        try {
            let response = await axios.get('api/user/index')
            users.value = response.data.user_data
            users_role.value = response.data.role_data
            console.log(response)
        } catch (error) {
            console.log(error.response)
        }
    }

    const getRole = async (id) => {
        try {
            let response = await axios.get('http://127.0.0.1:8000/api/user/role/' + id)
            role.value = response.data
            console.log(response)
        } catch (error) {
            console.log(error.response)
        }
    }
    
    const updateRole = async (id) => {
        try {
            let response = await axios.put('http://127.0.0.1:8000/api/user/role/update/' + id, role.value)
            router.push({ name: 'userIndex' })
            console.log(response)
        } catch (error) {
            errors.value = error.response.data.errors
            console.log(error.response)
        }
    }

    const getUser = async (id) => {
        try {
            let response = await axios.get('http://127.0.0.1:8000/api/user/info/' + id)
            user.value = response.data
            console.log(response)
        } catch (error) {
            console.log(error.response)
        }
    }

    const updateUser = async (id) => {
        try {
            let response = await axios.put('http://127.0.0.1:8000/api/user/info/update/' + id, user.value)
            router.push({ name: 'userIndex' })
            console.log(response)
        } catch (error) {
            errors.value = error.response.data.errors
            console.log(error.response)
        }
    }

    const destroyUser = async (id) => {
        try {
            let response = await axios.delete('http://127.0.0.1:8000/api/user/delete/' + id)

            if(response.data == ''){
                location.href = '/user/login';
            }

            console.log(response)
        } catch (error) {
            console.log(error.response)
        }
    }

    return {
        errors,
        loginError,
        users,
        user,
        updateUser,
        role,
        users_role,
        getRole,
        getUser,
        updateRole,
        getUsers,
        createUser,
        loginUser,
        logout,
        destroyUser
    }
    
}
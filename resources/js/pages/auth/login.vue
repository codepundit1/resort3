<template>
    <div>
        <div class="container">
            <div class="py-5">
                <div class="row">
                    <div class="col-6 offset-3">
                        <div class="card card-default">
                            <div class="card-header">
                                Login
                            </div>
                            <div class="card-body">


                                <form action="" method="post" @submit.prevent="login()">

                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control mb-3" v-model="form.email" placeholder="email">
                                        <div v-if="form.errors.has('email')" v-html="form.errors.get('email')" />

                                    </div>

                                     <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control mb-3" v-model="form.password" placeholder="email">
                                        <div v-if="form.errors.has('password')" v-html="form.errors.get('password')" />

                                    </div>

                                     <div class="form-group">
                                        <button type="submit" :disabled="form.busy" class="btn btn-success px-4">Login</button>
                                    </div>
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
import { Form } from 'vform'

export default {
    data(){
        return {
            form: new Form({
                email: 'jahidhasanshiplo4@gmail.com',
                password: '12345678',
            }),
        }
    },
    methods: {
        async login(){
            await axios.get('/sanctum/csrf-cookie')
            await this.form.post('/login')
            await this.getUserData();

            this.$toast.success({
                title:'Success!',
                message:'Welcome, Dear!'
            });

            this.$router.push({ name: 'dashboard' });
        },
        async getUserData(){
            await axios.get('/api/user').then(response => {
                let user = response.data;
                this.$store.commit('SET_USER', user);
                this.$store.commit('SET_AUTHENTICATED', true);

                localStorage.setItem("auth", true);
            });
        }
    },
    mounted(){
        this.getUserData();
    }
}
</script>

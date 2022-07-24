<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-item-center">
                        <!-- <h5 class="mb-0">Resort List</h5> -->

                       <div class="row">
                           <div class="col">
                             <input type="search" name="search" class="form-control" id="#" placeholder="Jone Due">
                           </div>
                            <div class="col">
                            <a href="#" class="btn btn-primary">Search</a>
                           </div>
                        </div>


                        <router-link  :to="{name:'create-resort'}" class="btn btn-primary">Add Resort</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>S.I</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Price Per Day</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(resort, index ) in resorts" :index="index" :key="resort.id" >
                                    <td>{{ index+1}}</td>
                                    <td>
                                        <div style="max-width:60px; max-height:60px; overflow: hidden;">
                                            <img :src="resort.image" class="img-fluid">
                                        </div>
                                    </td>
                                    <td>{{ resort.name }}</td>
                                    <td>{{ resort.location }}</td>
                                    <td>{{ resort.price }}  </td>
                                    <td>{{ resort.description }}</td>
                                    <td>
                                        <router-link  :to="{name:'edit-resort', params:{id:resort.id}}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></router-link>
                                        <a @click.prevent="deleteResort(resort)" href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return{
                resorts:[]
            }
        },



        methods: {
            loadResorts(){
                axios
                .get('/api/resort').then(response => {
                    this.resorts = response.data;
                });
            },


            deleteResort(resort){
                axios.delete(`/api/resort/${resort.id}`).then(() => {
                    this.$toast.success({
                        title:'Success!',
                        message:'resort deleted successfully.'
                    });
                });

            let index = this.resorts.indexOf(resort);
            this.resorts.splice(index, 1);
        }
        },

        mounted(){
            this.loadResorts();
        },


    }
</script>

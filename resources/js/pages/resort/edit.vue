<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-item-center">
                        <h5 class="mb-0">Edit Resort</h5>
                        <router-link :to="{name:'resort-list'}" class="btn btn-primary">Back</router-link>
                    </div>

                    <div class="card-body">
                        <form @submit.prevent="updateResort" @keydown="form.onKeydown($event)">
                            <div class="row">
                                 <div class="col form-group mb-3">
                                    <label for="ResortName" class="form-label">Resort Name</label>
                                    <input type="text" v-model="form.name" class="form-control" id="ResortName" placeholder="Resort name">
                                    <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                                </div>
                               <div class="col form-group mb-3">
                                    <label for="ResortLocation" class="form-label">Price</label>
                                    <input type="number" v-model="form.price" class="form-control"  min="1" step="any" />


                                </div>
                            </div>

                            <div class="row">
                               <div class="col form-group mb-3">
                                   <label for="ResortLocation" class="form-label">Location</label>
                                    <input type="text" v-model="form.location" class="form-control" id="ResortLocation" placeholder="Address">
                                </div>
                            </div>



                             <div class="row">
                                <div class="col form-group mb-3">
                                    <label for="ResortLocation" class="form-label">Description</label>
                                    <textarea class="form-control"  v-model="form.description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                             </div>


                              <!-- <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3">
                                                <label for="ResortImage" class="form-label">Image</label>
                                                <input type="file" @change="onImageChange" class="form-control" id="">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div style="width: 60%; max-height: 160px; overflow:hidden">
                                                <label for="" class="form-label">Previous Image</label>
                                                <img :src="img" alt="" class="img-fluid">
                                            </div>
                                        </div>
                            </div> -->

                            <div class="">
                                <button type="submit"  href="#" class="btn btn-primary">Update</button>
                            </div>

                        </form>

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
                name: '',
                location: '',
                price: '',
                // image: '',
                description: '',
                _method:'put',
            }),
            // img:'',
        }
    },
    methods: {
        updateResort(){
            let id = this.$route.params.id;

            this.form.post(`/api/resort/${id}`
            // , {
            //         transformRequest: [function (data, headers) {
            //             return objectToFormData(data)
            //         }],
            //         onUploadProgress: e => {
            //             // Do whatever you want with the progress event
            //             console.log(e)
            //         }
            //     }

                ).then(() => {


                this.form.name = '';
                this.form.location = '';
                this.form.price = '';
                // this.form.image = '';
                this.form.description = '';

                this.$toast.success({
                    title:'Success!',
                    message:'Resort updated successfully.'
                });

                this.$toast.success('lol');

            })
        },


        loadResort(){
            let id = this.$route.params.id;

            axios.get(`/api/resort/${id}/edit`).then(response => {
                this.form.name = response.data.name;
                this.form.location = response.data.location;
                this.form.price = response.data.price;
                this.form.description = response.data.description;
                // this.img = resort.image;


            });
        },

        onImageChange(e){
            const file = e.target.files[0]
            // Do some client side validation...
            this.productForm.image = file
        }
    },
        mounted(){
            this.loadResort();
        }
}
</script>


<style src="cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css"></style>




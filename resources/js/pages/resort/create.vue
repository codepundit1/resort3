<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-item-center">
                        <h5 class="mb-0">Create Resort</h5>
                        <router-link :to="{name:'resort-list'}" class="btn btn-primary">Back</router-link>
                    </div>

                    <div class="card-body">
                        <form @submit.prevent="createResort" @keydown="form.onKeydown($event)">
                            <div class="row">
                                 <div class="col form-group mb-3">
                                    <label for="ResortName" class="form-label">Resort Name</label>
                                    <input type="text" v-model="form.name" class="form-control" id="ResortName" placeholder="Resort name">
                                    <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                                </div>
                               <div class="col form-group mb-3">
                                    <label for="ResortLocation" class="form-label">Location</label>
                                    <input type="text" v-model="form.location" class="form-control" id="ResortLocation" placeholder="London">
                                    <div v-if="form.errors.has('location')" v-html="form.errors.get('location')" />

                                </div>
                            </div>

                            <div class="row">
                               <div class="col form-group mb-3">
                                    <label for="ResortPrice" class="form-label">Price</label>
                                    <input type="number" v-model="form.price" class="form-control"  min="1" step="any" />
                                    <div v-if="form.errors.has('price')" v-html="form.errors.get('price')" />

                                </div>


                                <div class="col form-group mb-3">
                                    <label for="ResortImage" class="form-label">Image</label>
                                    <input type="file" @change="onImageChange" class="form-control" id="ResortImage">
                                </div>
                            </div>

                             <div class="row">
                                <div class="col form-group mb-3">
                                    <label for="Resortdescription" class="form-label">Description</label>
                                    <textarea class="form-control"  v-model="form.description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <div v-if="form.errors.has('description')" v-html="form.errors.get('description')" />
                                </div>
                             </div>


                            <div class="">
                                <button type="submit"  href="#" class="btn btn-primary">Add</button>
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
import { objectToFormData } from 'object-to-formdata'

export default {
    data(){
        return {
            form: new Form({
                name: '',
                location: '',
                price: '',
                image: '',
                description: '',
            }),
        }
    },
    methods: {
        createResort(){
            this.form.post('/api/resort' , {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],
                    onUploadProgress: e => {
                        // Do whatever you want with the progress event
                        console.log(e)
                    }
                }).then(({ data }) => {


                this.form.name = '';
                this.form.location = '';
                this.form.price = '';
                this.form.image = '';
                this.form.description = '';

                // message

            })
        },


        onImageChange(e){
             const file = e.target.files[0]
            // Do some client side validation...
            this.form.image = file
        }
    }
}
</script>





<template>

    <div>
        <div class="container">
                <div class="row" style="display: flex;justify-content: center;">
                    <div class="col-md-8 col-centered">
                        <h1 style="text-align: center;">Larave and Inertia JS CRUD</h1>
                        <h3>New product form:</h3>
                        <input type="number" v-model="product.id" hidden>
                        <label for="name">Name:</label>
                        <input id="name" class="form-control" type="text" v-model="product.name">
                        <label for="description">Description:</label>
                        <input id="description" class="form-control" type="text" v-model="product.description">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" v-model="product.price">
                        <br>
                        <button @click="save()" class="btn btn-primary btn-block" >Save</button>
                </div>
            </div>
        </div>
        <div class="container">
                <div class="row" style="display: flex;justify-content: center;">
                    <div class="col-md-8 col-centered">
                        <h2 style="text-align: center;">List of products</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in products" :key="product.id" >
                                    <th scope="row">{{product.id}}</th>
                                    <td>{{product.name}}</td>
                                    <td>{{product.description}}</td>
                                    <td>{{product.price}}</td>
                                    <td>
                                        <button @click="exclude(product.id)" class="btn btn-danger btn-sm" >
                                            <span class="glyphicon glyphicon-trash"></span> Delete
                                        </button>
                                        <button @click="edit(product.id)" class="btn btn-primary btn-sm" >
                                            <span class="glyphicon glyphicon-pencil"></span> Edit
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>

</template>

<script>
export default {
    props: ['products'],
    data(){
        return {
            product: {
                id: null,
                name: null,
                price: null,
                description: null,
            }
        }
    },
    methods: {
        save: function(){
            if(this.product.id){
                this.$inertia.put('api/products/'+this.product.id+'/edit',{
                    name: this.product.name,
                    description: this.product.description,
                    price: this.product.price
                });
            } else {
                this.$inertia.post('api/products/create',{
                    name: this.product.name,
                    description: this.product.description,
                    price: this.product.price
                });
            }
            this.product.id = null,
            this.product.name = null,
            this.product.price = null,
            this.product.description = null
        },
        exclude: function(id){
            this.$inertia.delete('api/products/'+id+'/delete');
        },
        edit: function(id){
            let product = this.products.find(el => el.id == id);
            this.product.id = product.id;
            this.product.name = product.name;
            this.product.description = product.description;
            this.product.price = product.price;
        }
    }
}
</script>

<style>
    @import url("https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");
</style>


<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Назад</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Редактирование продукта</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Штрих-код</label>
                            <input type="text" v-model="product.barcode" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Наименование товара</label>
                            <input type="text" v-model="product.title" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Производитель</label>
                            <input type="text" v-model="product.title_manufacturer" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Обновить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.productId = id;
            axios.get('/api/v1/products/' + id)
                .then(function (resp) {
                    app.product = resp.data;
                })
                .catch(function () {
                    alert("Could not load your product")
                });
        },
        data: function () {
            return {
                productId: null,
                product: {
                    barcode: '',
                    title: '',
                    title_manufacturer: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newProduct = app.product;
                axios.patch('/api/v1/products/' + app.productId, newProduct)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your product");
                    });
            }
        }
    }
</script>

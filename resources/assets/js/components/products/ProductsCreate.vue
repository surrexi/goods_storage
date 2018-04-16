
<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Назад</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Создание нового продукта</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">Штрих-код</label>
                            <input type="text" v-model="product.barcode" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">Наименование продукта</label>
                            <input type="text" v-model="product.title" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">Производитель</label>
                            <input type="text" v-model="product.title_manufacturer" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <button class="btn btn-success">Создать</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
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
                axios.post('/api/v1/products', newProduct)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your product");
                    });
            }
        }
    }
</script>

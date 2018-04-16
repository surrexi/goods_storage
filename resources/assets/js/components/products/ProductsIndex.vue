<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createProduct'}" class="btn btn-success">Добавить продукцию</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h2>Список продуктов</h2></div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Штрих-код</th>
                        <th>Наименование</th>
                        <th>Имя производителя</th>
                        <th colspan="2">&nbsp</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product, index in products">
                        <td>{{ product.barcode }}</td>
                        <td>{{ product.title }}</td>
                        <td>{{ product.title_manufacturer }}</td>
                        <td>
                            <router-link :to="{name: 'editProduct', params: {id: product.id}}" class="btn btn-xs btn-primary">
                                Edit
                            </router-link>
                        </td>
                        <td>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(product.id, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                products: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/products')
                .then(function (resp) {
                    app.products = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Не могу загрузить продукты :(");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Подтвердите удаление")) {
                    var app = this;
                    axios.delete('/api/v1/products/' + id)
                        .then(function (resp) {
                            app.products.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete product");
                        });
                }
            }
        }
    }
</script>

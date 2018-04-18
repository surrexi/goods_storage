<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="h2">Количество товаров <span class="badge badge-secondary">{{ products.length }}</span></p>
                <br />
            </div>
            <div class="col">
                <p class="float-right">
                    <router-link :to="{name: 'createProduct'}" class="btn btn-sm btn-outline-secondary">Добавить товар</router-link>
                </p>
            </div>
        </div>
        <div class="row">
            <table class="table text-center">
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
                    <td class="">
                        <router-link :to="{name: 'editProduct', params: {id: product.id}}" class="btn btn-sm btn-outline-secondary">
                            Изменить
                        </router-link>
                    </td>
                    <td>
                        <a href="#"
                           class="btn btn-sm btn-outline-secondary"
                           v-on:click="deleteEntry(product.id, index)">
                            Удалить
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
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

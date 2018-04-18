<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="h2">Редактирование товара</p>
                <br />
            </div>
            <div class="col">
                <p class="float-right">
                    <router-link :to="{name: 'productsIndex'}" class="btn btn-sm btn-outline-secondary">Назад</router-link>
                </p>
            </div>
        </div>
        <div class="row">
            <form v-on:submit="saveForm()" class="form-custom">
                <div class="form-label-group">
                    <label for="inputBarcode">Штрих-код</label>
                    <input type="text" id="inputBarcode" v-model="product.barcode" class="form-control" placeholder="Штрих-код" required>
                </div>
                <div class="form-label-group">
                    <label for="inputTitle">Наименование товара</label>
                    <input type="text" id="inputTitle" v-model="product.title" class="form-control" placeholder="Наименование товара" required>
                </div>
                <div class="form-label-group">
                    <label for="inputTitleManufacturer">Производитель</label>
                    <input type="text" id="inputTitleManufacturer"
                           v-model="product.title_manufacturer" class="form-control"
                           placeholder="Производитель" required>
                </div>
                <button class="btn btn-lg btn-primary btn-block">Обновить</button>
            </form>
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
                    titleManufacturer: '',
                }
            }
        },
        methods: {
            saveForm() {
                let app = this;
                let newProduct = app.product;
                axios.patch('/api/v1/products/' + app.productId, newProduct)
                    .then(function (resp) {
                        app.$router.push({
                            path: '/products'
                        });
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your product");
                    });
            }
        }
    }
</script>

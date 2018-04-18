<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="h2">Количество товаров в ячейке <span class="badge badge-secondary">{{ goodsCells.length }}</span></p>
                <br />
            </div>
            <div class="col">
                <p class="float-right">
                    <router-link :to="{name: 'cellsIndex'}" class="btn btn-sm btn-outline-secondary">Назад</router-link>
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
                    <th>Количество</th>
                    <th colspan="2">&nbsp</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="goodsCell, index in goodsCells">

                        <td>{{ goodsCell.product.barcode }}</td>
                        <td>{{ goodsCell.product.title }}</td>
                        <td>{{ goodsCell.product.title_manufacturer }}</td>
                        <td>
                            <input v-model="cell_id[index] = goodsCell.cell_id" hidden>
                            <input v-model="product_id[index] = goodsCell.product_id" hidden>
                            <input type="text" v-model="product_amount[index] = goodsCell.product_amount" placeholder="Количество" required>
                        </td>
                        <td>
                            <a v-on:click="editForm(goodsCell.id, index)" class="btn btn-sm btn-outline-secondary">
                                Изменить
                            </a>
                        </td>
                        <td>
                            <a v-on:click="deleteEntry(goodsCell.id, index)" class="btn btn-sm btn-outline-secondary">
                                Удалить
                            </a>
                        </td>
                    </tr>
                    <tr v-if="productsNotInCell.length > 0">
                        <td><input v-model="newGoodsCell.cell_id" hidden></td>
                        <td>
                            <select v-model="selected" class="form-control">
                                <option v-for="product in productsNotInCell" v-bind:value="product.id">
                                    {{ product.title }}
                                </option>
                            </select>
                        </td>
                        <td></td>
                        <td>
                            <input type="text" v-model="newGoodsCell.product_amount" placeholder="Количество" required>
                        </td>
                        <td colspan="2">
                            <button class="btn btn-sm btn-outline-secondary" v-on:click="saveForm()">Добавить</button>
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
                cell: null,
                cell_id: [],
                product_id: [],
                product_amount: [],
                goodsCells: [],
                productsNotInCell: [],
                newGoodsCell: {
                    cell_id: null,
                    product_id: null,
                    product_amount: 1,
                },
                editGoodsCells: [],
                editGoodsCell: {
                    cell_id: null,
                    product_id: null,
                    product_amount: 1,
                },
                selected: null
            }
        },
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            axios.get('/api/v1/cells/' + id)
                .then(function (resp) {
                    app.cell = resp.data;
                    app.newGoodsCell.cell_id = app.cell.id;
                    app.goodsCells = resp.data.goods_cells;
                    app.productsNotInCell = resp.data.productsNotInCell;
                    app.selected = app.productsNotInCell.length > 0 ? app.productsNotInCell[0].id : null;
                })
                .catch(function () {
                    console.log(resp);
                    alert("Could not load goods cell")
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Подтвердите удаление")) {
                    var app = this;
                    axios.delete('/api/v1/goods-cells/' + id)
                        .then(function (resp) {
                            app.$router.go(0);
                        })
                        .catch(function (resp) {
                            console.log(resp);
                            alert("Could not delete goods cell");
                        });
                }
            },
            saveForm() {
                let app = this;
                app.newGoodsCell.product_id = app.selected;
                let newGoodsCell = app.newGoodsCell;
                axios.post('/api/v1/goods-cells', newGoodsCell)
                    .then(function (resp) {
                        app.$router.go(0);
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your goods cell");
                    });
            },
            editForm(id, index) {
                let app = this;
                let editGoodsCell = {
                    cell_id: app.cell_id[index],
                    product_id: app.product_id[index],
                    product_amount: app.product_amount[index]
                };
                axios.patch('/api/v1/goods-cells/' + id, editGoodsCell)
                    .then(function (resp) {
                        app.$router.go(0);
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not change your goods cell");
                    });
            }
        }
    }
</script>

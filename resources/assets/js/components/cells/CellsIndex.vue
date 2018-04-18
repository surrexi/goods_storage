<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="h2">Количество ячеек <span class="badge badge-secondary">{{ cells.length }}</span></p>
                <br />
            </div>
            <div class="col">
                <p class="float-right">
                    <router-link :to="{name: 'createCell'}" class="btn btn-sm btn-outline-secondary">Добавить ячейку</router-link>
                </p>
            </div>
        </div>
        <div class="row">
            <div v-for="cell, index in cells" class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <div class="card-header text-right">
                        <router-link :to="{name: 'editCell', params: {id: cell.id}}" class="btn btn-sm btn-outline-secondary">
                            <span class="fa fa-edit"></span>
                        </router-link>
                        <a href="#"
                           class="btn btn-sm btn-outline-secondary"
                           v-on:click="deleteEntry(cell.id, index)">
                            <span class="fa fa-trash"></span>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <dl class="row">
                                <dt class="col-sm-5">Номер</dt>
                                <dd class="col-sm-7">{{ cell.number}}</dd>

                                <dt class="col-sm-5">Штрих-код</dt>
                                <dd class="col-sm-7">{{ cell.barcode }}</dd>
                            </dl>
                        </div>
                        <div class="text-right">
                            <div class="btn-group">
                                <router-link
                                        :to="{name: 'showCell', params: {id: cell.id}}"
                                        class="btn btn-sm btn-outline-secondary">
                                        Количество товаров <span class="badge badge-light">{{ cell.goods_cells.length }}</span>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                cells: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/cells')
                .then(function (resp) {
                    app.cells = resp.data;
                })
                .catch(function (resp) {
                    alert("Не могу загрузить ячейки :(");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Подтвердите удаление")) {
                    var app = this;
                    axios.delete('/api/v1/cells/' + id)
                        .then(function (resp) {
                            app.cells.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete cell");
                        });
                }
            }
        }
    }
</script>

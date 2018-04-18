<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="h2">Редактирование ячейки</p>
                <br />
            </div>
            <div class="col">
                <p class="float-right">
                    <router-link :to="{name: 'cellsIndex'}" class="btn btn-sm btn-outline-secondary">Назад</router-link>
                </p>
            </div>
        </div>
        <div class="row">
            <form v-on:submit="saveForm()" class="form-custom">
                <div class="form-label-group">
                    <label for="inputBarcode">Штрих-код</label>
                    <input type="text" id="inputBarcode" v-model="cell.barcode" class="form-control" placeholder="Штрих-код" required>
                </div>
                <div class="form-label-group">
                    <label for="inputNumber">Номер ячейки</label>
                    <input type="text" id="inputNumber" v-model="cell.number" class="form-control" placeholder="Номер" required>
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
            app.cellId = id;
            axios.get('/api/v1/cells/' + id)
                .then(function (resp) {
                    app.cell = resp.data;
                })
                .catch(function () {
                    alert("Could not load your cell")
                });
        },
        data: function () {
            return {
                cellId: null,
                cell: {
                    barcode: '',
                    number: '',
                }
            }
        },
        methods: {
            saveForm() {
                let app = this;
                let newCell = app.cell;
                axios.patch('/api/v1/cells/' + app.cellId, newCell)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not change your cell");
                    });
            }
        }
    }
</script>

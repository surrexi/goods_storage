<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="h2">Создание ячейки</p>
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
                <button class="btn btn-lg btn-primary btn-block">Создать</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                cell: {
                    barcode: '',
                    number: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newCell = app.cell;
                axios.post('/api/v1/cells', newCell)
                    .then(function (resp) {
                        app.$router.push({
                            path: '/'
                        });
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your cell");
                    });
            }
        }
    }
</script>

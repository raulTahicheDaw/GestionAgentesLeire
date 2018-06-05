<template>
    <div class="main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <i class="icon-graph"></i>Estadísticas
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col">
                            <div class="input-group">
                                <select class="form-control col-3" v-model="criterio">
                                    <option value="productos">Productos más contratados por fecha</option>
                                    <option value="clientes">Total de Clientes por meses</option>
                                </select>
                                <input v-if="criterio=='productos'" type="date" v-model="desde"
                                       class="form-control col-2"
                                       placeholder="Desde" style="margin-left: 10px">
                                <input v-else type="date" v-model="desde"
                                       class="form-control col-2"
                                       placeholder="Desde" style="margin-left: 10px">
                                <input v-if="criterio=='productos'" type="date" v-model="hasta"
                                       class="form-control col-2"
                                       placeholder="Hasta">
                                <input v-else type="date" v-model="hasta"
                                       class="form-control col-2"
                                       placeholder="Desde" style="margin-left: 10px">
                                <button v-if="criterio=='productos'" type="submit" @click="productosFecha()"
                                        class="btn btn-primary">
                                    <i class="fa fa-search"></i> Filtrar
                                </button>
                                <button v-else type="submit" @click="clientesFecha()"
                                        class="btn btn-primary">
                                    <i class="fa fa-search"></i> Filtrar
                                </button>
                                <button v-if="criterio=='productos'" type="submit" @click="productosTotal()"
                                        class="btn btn-warning" style="margin-left: 10px">
                                    <i class="fa fa-area-chart"></i> Ver Total
                                </button>
                                <button v-else type="submit" @click="clientesTotal()"
                                        class="btn btn-warning" style="margin-left: 10px">
                                    <i class="fa fa-area-chart"></i> Ver Total del Año actual
                                </button>

                            </div>
                        </div>
                    </div>

                    <div v-if="criterio=='productos'" class="chartjs-caption">
                        <h6 class="chartjs-title">Porcentajes de contratación</h6>
                        <pie :chart-data="productosCollection"
                             :options="{responsive: true, maintainAspectRatio: false}"
                             :width="600"
                             :height="300">
                        </pie>
                    </div>
                    <div v-else class="chartjs-caption">
                        <h6 class="chartjs-title">Porcentajes de contratación</h6>
                        <bar :chart-data="clientesCollection"
                             :options="{responsive: true, maintainAspectRatio: false}"
                             :width="600"
                             :height="300">
                        </bar>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Pie from './PieCharts.js'
    import Bar from './BarChart.js'

    export default {
        components: {
            Pie, Bar
        },
        data() {
            return {
                productosCollection: null,
                criterio: 'productos',
                clientesCollection:null,
                desde: '',
                hasta: ''
            }
        },
        mounted() {
            this.productosTotal();
            this.clientesTotal();
        },
        methods: {
            productosTotal() {
                let nombres = [];
                let datos = [];
                let me = this;
                axios
                    .get("clientesproductos/informes")
                    .then(function (response) {
                        for (var i = 0; i < response.data.length; i++) {
                            nombres.push(response.data[i].nombre);
                            datos.push((response.data[i].total * 100) / 4);
                            me.productosCollection = {
                                labels: nombres,
                                datasets: [
                                    {
                                        label: 'Porcentajes de contratación de cada Prod.',
                                        backgroundColor: ['red', 'blue', 'yellow'],
                                        data: datos
                                    }]
                            }
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            productosFecha() {
                let nombres = [];
                let datos = [];
                let me = this;
                let url = "clientesproductos/informes/" + this.desde + "/" + this.hasta;
                axios
                    .get(url)
                    .then(function (response) {
                        for (var i = 0; i < response.data.length; i++) {
                            nombres.push(response.data[i].nombre);
                            datos.push((response.data[i].total * 100) / 4);
                            me.datacollection = {
                                labels: nombres,
                                datasets: [
                                    {
                                        label: 'Porcentajes de contratación de cada Prod.',
                                        backgroundColor: ['red', 'blue', 'yellow'],
                                        data: datos
                                    }]
                            }
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            clientesTotal() {
                let me = this;
                let meses = ['','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic',''];
                let datos = [0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                axios
                    .get("cliente/informecliente")
                    .then(function (response) {
                        for (var i = 0; i < response.data.length; i++) {
                            datos[response.data[i].mes] = response.data[i].total;
                        }
                        me.clientesCollection = {
                            labels: meses,
                            datasets: [
                                {
                                    label: 'Clientes por meses',
                                    backgroundColor: 'red',
                                    data: datos
                                }]
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            clientesFecha() {
                let me = this;
                let meses = ['', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic', ''];
                let datos = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                let url = "cliente/informecliente/" + this.desde + '/' + this.hasta;
                axios
                    .get(url)
                    .then(function (response) {
                        for (var i = 0; i < response.data.length; i++) {
                            datos[response.data[i].mes] = response.data[i].total;
                        }
                        me.clientesCollection = {
                            labels: meses,
                            datasets: [
                                {
                                    label: 'Clientes por meses',
                                    backgroundColor: 'red',
                                    data: datos
                                }]
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },


    }

</script>

<style>
    .small {
        max-width: 400px;
        margin: 50px auto;
    }
</style>
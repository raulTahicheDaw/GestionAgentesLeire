<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol>
        <div class="container-fluid">
            <!-- Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Listado de Productos
                    <button @click="abrirModal('producto','registrar')" type="button" class="btn btn-secondary">
                        <i class="icon-plus"></i>Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nombre">Nombre</option>
                                    <option value="campania">Estado campaña</option>
                                    <option value="ramo">Ramo</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarProductos(1,buscar,criterio)"
                                       class="form-control"
                                       placeholder="Texto a buscar">
                                <button type="submit" @click="listarProductos(1,buscar,criterio)"
                                        class="btn btn-primary">
                                    <i class="fa fa-search"></i> Buscar
                                </button>
                                <button style="margin-left: 10px;" type="submit" @click="mostarTodos()"
                                        class="btn btn-primary">
                                    <i class="fa fa-align-justify"></i>Mostrar todos
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Estado Campaña</th>
                            <th>Fecha de Lazamiento</th>
                            <th>Fecha de Vencimiento</th>
                            <th>Coberturas</th>
                            <th>Ramo</th>
                            <th>observaciones</th>
                            <th>Estado</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="producto in arrayProductos" :key="producto.id">
                            <td>
                                <button @click="abrirModal('producto','actualizar', producto)" type="button"
                                        class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </button>
                                <button v-if="producto.activo" type="button" class="btn btn-danger btn-sm"
                                        @click="desactivarProducto(producto.id)">
                                    <i class="icon-trash"></i>
                                </button>
                                <button v-else type="button" class="btn btn-success btn-sm"
                                        @click="activarProducto(producto.id)">
                                    <i class="icon-check"></i>
                                </button>

                            </td>
                            <td v-text="producto.nombre">
                            </td>
                            <td>
                                <div v-if="producto.campania">
                                    <span class="badge badge-success">Activa</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">No Activa</span>
                                </div>
                            </td>
                            <td v-text="producto.fecha_lanzamiento"></td>
                            <td v-text="producto.fecha_vencimiento"></td>
                            <td v-text="producto.coberturas"></td>
                            <td v-text="producto.nombre_ramo"></td>
                            <td v-text="producto.observaciones"></td>
                            <td>
                                <div v-if="producto.activo">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Desactivado</span>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page >1 ">
                                <a class="page-link" href="#"
                                   @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumbers" :key="page"
                                :class="[page== isActive ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)"
                                   v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#"
                                   @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="form-control-label"
                                           :class="{'text-error' : errorMostrarMsgProducto.includes('Nombre')}">Nombre<sup>*</sup></label>
                                    <input type="text" v-model="nombre" class="form-control"
                                           :class="{'is-invalid' : errorMostrarMsgProducto.includes('Nombre')}"
                                           placeholder="Introduzca el nombre">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <label class="form-control-label">En Campaña?</label>
                                    <input type="radio" value=1 v-model="campania">
                                    <label> Sí </label>
                                    <input type="radio" value=0 v-model="campania">
                                    <label> No </label>
                                </div>
                                <div class="col-6">
                                    <label class="form-control-label">Ramo</label>
                                    <select v-model="id_ramo" class="form-control">
                                        <option value="" disable>Elija un Ramo</option>
                                        <option v-for="ramo in arrayRamos" :key="ramo.id"
                                                :value="ramo.id"
                                                v-text="ramo.nombre">
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <label class="form-control-label">Fecha lanzamiento</label>
                                    <input type="date" class="form-control" v-model="fecha_lanzamiento">
                                </div>
                                <div class="col-6">
                                    <label class="form-control-label">Fecha fin de Campaña</label>
                                    <input type="date" class="form-control" v-model="fecha_vencimiento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label class="form-control-label">Coberturas</label>
                                    <textarea class="form-control" v-model="coberturas"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label class="form-control-label">Observaciones</label>
                                    <textarea class="form-control" v-model="observaciones"></textarea>
                                </div>
                            </div>
                            <div v-show="errorProducto" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <p>Los siguientes campos no pueden estar vacíos o son incorrectos:</p>
                                    <span v-for="error in errorMostrarMsgProducto" :key="error"
                                          v-text="error + ', '"> </span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                                        @click="registrarProducto()">Guardar
                                </button>
                                <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                                        @click="actualizarProducto()">Actualizar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>
</template>

<script>
    export default {
        data() {
            return {
                nombre: "",
                campania: true,
                fecha_lanzamiento: "",
                fecha_vencimiento: "",
                coberturas: "",
                observaciones: "",
                activo: 1,
                id_ramo: "",
                arrayProductos: [],
                arrayRamos: [],
                modal: 0,
                tituloModal: "",
                tipoAccion: 0,
                errorProducto: 0,
                errorMostrarMsgProducto: [],
                producto_id: 0,
                pagination: {
                    total: 0,
                    current_page: 0,
                    per_page: 0,
                    last_page: 0,
                    from: 0,
                    to: 0
                },
                offset: 3,
                criterio: "nombre",
                buscar: ""
            };
        },
        computed: {
            isActive: function () {
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumbers: function () {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + this.offset * 2;
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from < to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods: {
            listarRamos() {
                let me = this;
                axios
                    .get("/ramo/selectramo")
                    .then(function (response) {
                        me.arrayRamos = response.data.ramos;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            listarProductos(page, buscar, criterio) {
                let me = this;
                var url =
                    "/producto?page=" +
                    page +
                    "&buscar=" +
                    buscar +
                    "&criterio="+
                    criterio;
                axios
                    .get(url)
                    .then(function (response) {
                        var respuesta = response.data;
                        me.arrayProductos = respuesta.productos.data;
                        me.pagination = respuesta.pagination;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            mostarTodos() {
                this.listarProductos(1, "", "nombre");
                this.buscar = "";
            },
            cambiarPagina(page, buscar, criterio) {
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                me.listarProductos(page, buscar, criterio);
            },
            registrarProducto() {
                if (this.validarProducto()) {
                    return;
                }
                let me = this;
                axios
                    .post("/producto/registrar", {
                        nombre: this.nombre,
                        campania: this.campania,
                        fecha_lanzamiento: this.fecha_lanzamiento,
                        fecha_vencimiento: this.fecha_vencimiento,
                        coberturas: this.coberturas,
                        observaciones: this.observaciones,
                        id_ramo: this.id_ramo
                    })
                    .then(function (response) {
                        me.cerrarModal();
                        me.listarProductos(1, "", "nombre");
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            actualizarProducto() {
                if (this.validarProducto()) {
                    return;
                }
                let me = this;
                axios
                    .put("/producto/actualizar", {
                        nombre: this.nombre,
                        campania: this.campania,
                        fecha_lanzamiento: this.fecha_lanzamiento,
                        fecha_vencimiento: this.fecha_vencimiento,
                        coberturas: this.coberturas,
                        observaciones: this.observaciones,
                        id_ramo: this.id_ramo,
                        id: this.producto_id
                    })
                    .then(function (response) {
                        me.cerrarModal();
                        me.listarProductos(1, "", "nombre");
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            desactivarProducto(id) {
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: "btn btn-success",
                    cancelButtonClass: "btn btn-danger",
                    buttonsStyling: true
                });
                swalWithBootstrapButtons({
                    title: "¿Está seguro de desactivar este Producto?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Aceptar",
                    cancelButtonText: "Cancelar"
                }).then(result => {
                    if (result.value) {
                        let me = this;
                        axios
                            .put("/producto/desactivar", {
                                id: id
                            })
                            .then(function (response) {
                                me.listarProductos(1, "", "nombre");
                                swalWithBootstrapButtons(
                                    "Desactivado!",
                                    "El Producto ha sido desactivado con éxito.",
                                    "success"
                                );
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons(
                            "Cancelado",
                            "No se ha desactivado el Producto.",
                            "error"
                        );
                    }
                });
            },
            activarProducto(id) {
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: "btn btn-success",
                    cancelButtonClass: "btn btn-danger",
                    buttonsStyling: true
                });
                swalWithBootstrapButtons({
                    title: "¿Está seguro de activar este Producto?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Aceptar",
                    cancelButtonText: "Cancelar"
                }).then(result => {
                    if (result.value) {
                        let me = this;
                        axios
                            .put("/producto/activar", {
                                id: id
                            })
                            .then(function (response) {
                                me.listarProductos(1, "", "nombre");
                                swalWithBootstrapButtons(
                                    "Activado!",
                                    "El Producto ha sido activado con éxito.",
                                    "success"
                                );
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons(
                            "Cancelado",
                            "No se ha activado el Producto.",
                            "error"
                        );
                    }
                });
            },
            validarProducto() {
                this.errorProducto = 0;
                this.errorMostrarMsgProducto = [];
                if (!this.nombre) this.errorMostrarMsgProducto.push("Nombre");
                if (this.errorMostrarMsgProducto.length > 0) this.errorProducto = 1;
                return this.errorProducto;
            },

            cerrarModal() {
                this.modal = 0;
                this.tituloModal = "";
                this.nombre = "";
                this.campania = true;
                this.fecha_lanzamiento =  new Date().toISOString().split('T')[0];
                this.coberturas = "";
                this.observaciones = "";
                this.activo = 1;
                this.id_ramo = 1;
            },
            abrirModal(modelo, accion, data = []) {
                this.listarRamos();
                this.errorMostrarMsgProducto = [];
                this.errorProducto = 0;
                switch (modelo) {
                    case "producto": {
                        switch (accion) {
                            case "registrar": {
                                this.modal = 1;
                                this.nombre = "";
                                this.campania = true;
                                this.fecha_lanzamiento = new Date().toISOString().split('T')[0];
                                this.coberturas = "";
                                this.observaciones = this.tituloModal =
                                    "Registrar Nuevo Producto";
                                this.tipoAccion = 1;
                                this.id_ramo = "";
                                break;
                            }
                            case "actualizar": {
                                this.listarRamos();
                                this.modal = 1;
                                this.tituloModal = "Actualizar Producto";
                                this.tipoAccion = 2;
                                this.nombre = data["nombre"];
                                this.campania = data["campania"];
                                this.fecha_lanzamiento = data["fecha_lanzamiento"];
                                this.fecha_vencimiento = data["fecha_vencimiento"];
                                this.coberturas = data["coberturas"];
                                this.observaciones = data["observaciones"];
                                this.producto_id = data["id"];
                                this.id_ramo = data["id_ramo"];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarRamos();
            this.listarProductos(1, this.buscar, this.criterio);
        }
    };
</script>

<style>
    .modal-content {
        width: 100% !important;
        position: absolute !important;
    }

    .mostrar {
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }

    .div-error {
        display: flex;
        justify-content: center;
    }

    .text-error {
        color: red !important;
        font-weight: bold;
    }
</style>
<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Listado de Ramos
                    <button @click="abrirModal('ramo','registrar')" type="button" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nombre">Nombre</option>
                                    <option value="descripcion">Descripción</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarRamos(1,buscar,criterio)"
                                       class="form-control"
                                       placeholder="Texto a buscar">
                                <button type="submit" @click="listarRamos(1,buscar,criterio)" class="btn btn-primary">
                                    <i class="fa fa-search"></i> Buscar
                                </button>
                                <button style="margin-left: 10px;" type="submit" @click="mostarTodos()" class="btn btn-primary">
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
                            <th>Descripcion</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="ramo in arrayRamos" :key="ramo.id">
                            <td>
                                <button @click="abrirModal('ramo','actualizar', ramo)" type="button"
                                        class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <template v-if="ramo.activo">
                                    <button type="button" class="btn btn-danger btn-sm"
                                            @click="desactivarRamo(ramo.id)">
                                        <i class="icon-trash"></i>
                                    </button>
                                </template>
                                <template v-else>
                                    <button type="button" class="btn btn-success btn-sm"
                                            @click="activarRamo(ramo.id)">
                                        <i class="icon-check"></i>
                                    </button>
                                </template>

                            </td>
                            <td v-text="ramo.nombre"></td>
                            <td v-text="ramo.descripcion"></td>
                            <td>
                                <div v-if="ramo.activo">
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
            <!-- Fin ejemplo de tabla Listado -->
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
                                <div class="col-md-6">
                                    <label class="form-control-label"
                                           :class="{'text-error' : errorMostrarMsgRamo.includes('Nombre')}">Nombre<sup>*</sup></label>
                                    <input type="text" v-model="nombre" class="form-control"
                                           :class="{'is-invalid' : errorMostrarMsgRamo.includes('Nombre')}"
                                           placeholder="Introduzca el nombre">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="form-control-label">Descripción</label>
                                    <input type="text" v-model="descripcion" class="form-control"
                                           placeholder="Introduzca una descripción">
                                </div>
                            </div>
                            <div v-show="errorRamo" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <p>Los siguientes campos no pueden estar vacíos o son incorrectos:</p>
                                    <span v-for="error in errorMostrarMsgRamo" :key="error"
                                          v-text="error + ', '"> </span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                                        @click="registrarRamos()">Guardar
                                </button>
                                <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                                        @click="actualizarRamo()">Actualizar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>    <!-- /.modal-content -->
                <!-- /.modal-dialog -->
                <!--Fin del modal-->
                <!-- Inicio del modal Eliminar -->
            </div><!-- Fin del modal Eliminar -->
        </div>
    </main>
</template>

<script>
    export default {
        data() {
            return {
                nombre: '', 
                descripcion: '',
                arrayRamos: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorRamo: 0,
                errorMostrarMsgRamo: [],
                ramo_id: 0,
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3,
                criterio: 'nombre',
                buscar: ''
            }
        },
        computed: {
            isActive: function () {
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumbers: function () {
                if (!this.pagination.to) {
                    return []
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
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
            listarRamos(page, buscar, criterio) {
                let me = this;
                var url = '/ramo?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRamos = respuesta.ramos.data;
                    me.pagination = respuesta.pagination;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            mostarTodos(){
                this.listarRamos(1,'','nombre');
                this.buscar='';
            },
            cambiarPagina(page, buscar, criterio) {
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                me.listarRamos(page, buscar, criterio);
            },
            registrarRamos() {
                if (this.validarRamo()) {
                    return;
                }
                let me = this;
                axios.post('/ramo/registrar', {
                    'nombre': this.nombre,
                    'descripcion': this.descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarRamos(1, '', 'nombre');
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            actualizarRamo() {
                if (this.validarRamo()) {
                    return;
                }
                let me = this;
                axios.put('/ramo/actualizar', {
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'id': this.ramo_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarRamos(1, '', 'nombre');
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            desactivarRamo(id) {
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true,
                });
                swalWithBootstrapButtons({
                    title: '¿Está seguro de desactivar este Ramo?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/ramo/desactivar', {
                            'id': id
                        }).then(function (response) {
                            me.listarRamos(1, '', 'nombre');
                            swalWithBootstrapButtons(
                                'Desactivado!',
                                'El Ramo ha sido desactivado con éxito.',
                                'success'
                            )
                        })
                            .catch(function (error) {
                                console.log(error);
                            });

                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons(
                            'Cancelado',
                            'No se ha desactivado el Ramo.',
                            'error'
                        )
                    }
                })
            },
            activarRamo(id) {
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true,
                });
                swalWithBootstrapButtons({
                    title: '¿Está seguro de activar este Ramo?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/ramo/activar', {
                            'id': id
                        }).then(function (response) {
                            me.listarRamos(1, '', 'nombre');
                            swalWithBootstrapButtons(
                                'Activado!',
                                'El Ramo ha sido activada con éxito.',
                                'success'
                            )
                        })
                            .catch(function (error) {
                                console.log(error);
                            });

                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons(
                            'Cancelado',
                            'No se ha activado el Ramo.',
                            'error'
                        )
                    }
                })
            },
            validarRamo() {
                this.errorRamo = 0;
                this.errorMostrarMsgRamo = [];
                if (!this.nombre) this.errorMostrarMsgRamo.push('Nombre');
                if (this.errorMostrarMsgRamo.length > 0) this.errorRamo = 1;
                return this.errorRamo;
            },

            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.descripcion = '';
            },
            abrirModal(modelo, accion, data = []) {
                this.errorMostrarMsgRamo = [];
                this.errorRamo = 0;
                switch (modelo) {
                    case "ramo": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.nombre = '';
                                this.descripcion = '';
                                this.tituloModal = 'Registrar Nuevo Ramo';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar': {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = "Actualizar Ramo";
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.descripcion = data['descripcion'];
                                this.ramo_id = data['id'];
                                break;
                            }
                        }
                    }
                }
            },
        },
        mounted() {
            this.modal=0;
            this.listarRamos(1, this.buscar, this.criterio);
        }
    }
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
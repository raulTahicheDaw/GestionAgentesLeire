<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Raúl</a></li>
            <li class="breadcrumb-item active">Clientes</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Listado de Clientes
                    <button @click="abrirModal('cliente','registrar')" type="button" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nombre">Nombre</option>
                                    <option value="descripcion">Apellidos</option>
                                    <option value="descripcion">DNI</option>

                                </select>
                                <input type="text" v-model="buscar" class="form-control"
                                       placeholder="Texto a buscar">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Dni</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Domicilio</th>
                            <th>Localidad</th>
                            <th>Provincia</th>
                            <th>Profesión</th>
                            <th>Contacto</th>
                            <th>Estado</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="cliente in arrayCliente" :key="cliente.id">
                            <td>
                                <button @click="abrirModal('cliente','actualizar', cliente)" type="button"
                                        class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <template v-if="cliente.activo">
                                    <button type="button" class="btn btn-danger btn-sm"
                                            @click="desactivarCliente(cliente.id)">
                                        <i class="icon-trash"></i>
                                    </button>
                                </template>
                                <template v-else>
                                    <button type="button" class="btn btn-success btn-sm"
                                            @click="activarCliente(cliente.id)">
                                        <i class="icon-check"></i>
                                    </button>
                                </template>

                            </td>
                            <td v-text="cliente.nombre"></td>
                            <td v-text="cliente.apellidos"></td>
                            <td v-text="cliente.dni"></td>
                            <td v-text="cliente.email"></td>
                            <td v-text="cliente.telefono"></td>
                            <td v-text="cliente.domicilio"></td>
                            <td v-text="cliente.localidad"></td>
                            <td v-text="cliente.provincia"></td>
                            <td v-text="cliente.profesion"></td>
                            <td v-text="cliente.contacto"></td>
                            <td>
                                <div v-if="cliente.activo">
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
                            <li class="page-item" v-if="pagination.current_page >1 " >
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumbers" :key="page" :class="[page== isActive ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
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
            <div class="modal-dialog modal-primary modal-lg" role="document">
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
                                <div class="col-md-4">
                                    <label class="form-control-label"
                                           :class="{'text-error' : errorMostrarMsgCliente.includes('Nombre')}">Nombre<sup>*</sup></label>
                                    <input type="text" v-model="nombre" class="form-control"
                                           :class="{'is-invalid' : errorMostrarMsgCliente.includes('Nombre')}"
                                           placeholder="Introduzca el nombre">
                                </div>
                                <div class="col-md-5">
                                    <label class=" form-control-label"
                                           :class="{'text-error' : errorMostrarMsgCliente.includes('Apellidos')}">Apellidos<sup>*</sup></label>

                                    <input type="text" v-model="apellidos" class="form-control"
                                           :class="{'is-invalid' : errorMostrarMsgCliente.includes('Apellidos')}"
                                           placeholder="Introduzca los apellidos">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label"
                                           :class="{'text-error' : errorMostrarMsgCliente.includes('DNI')}">DNI<sup>*</sup></label>

                                    <input type="text" v-model="dni" class="form-control"
                                           :class="{'is-invalid' : errorMostrarMsgCliente.includes('DNI')}"
                                           placeholder="Introduzca el DNI/CIF">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="form-control-label"
                                           :class="{'text-error' : errorMostrarMsgCliente.includes('Teléfono')}">Teléfono<sup>*</sup></label>
                                    <input type="text" v-model="telefono" class="form-control"
                                           placeholder="Introduzca teléfono"
                                           :class="{'is-invalid' : errorMostrarMsgCliente.includes('Teléfono')}">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-control-label">Email</label>
                                    <input type="email" v-model="email" class="form-control"
                                           placeholder="Introduzca un email válido">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label">Fec. Nacim.</label>
                                    <input type="date" v-model="fechaNacimiento" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="form-control-label">Domicilio</label>
                                    <input type="text" v-model="domicilio" class="form-control"
                                           placeholder="Introduzca Dirección">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label">Localidad</label>
                                    <input type="text" v-model="localidad" class="form-control"
                                           placeholder="Localidad">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-control-label">C.Postal</label>
                                    <input type="text" v-model="codigoPostal" class="form-control"
                                           placeholder="C.Postal">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label">Provincia</label>

                                    <input type="text" v-model="provicia" class="form-control"
                                           placeholder="Provincia">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="form-control-label">Profesion</label>
                                    <input type="text" v-model="profesion" class="form-control"
                                           placeholder="Profesión">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-control-label">Cuenta</label>
                                    <input type="text" v-model="cuentaBancaria" class="form-control"
                                           placeholder="Introduzca IBAN o número de cuenta">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label">Sexo</label>
                                    <select class="form-control" v-model="sexo">
                                        <option value="Hombre" selected>Hombre</option>
                                        <option value="Mujer">Mujer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="form-control-label col-md-4">Contacto</label>
                                    <input type="text" v-model="contacto" class="form-control col-md-8"
                                           placeholder="Persona contacto">
                                </div>
                                <div class="col-md-5">
                                    <label class="col-md-1 form-control-label">Observac.</label>
                                    <textarea class="form-control" rows="5" v-model="observaciones"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label">Categoría de</label>
                                    <select v-model="id_categoria" class="form-control">
                                        <option v-for="categoria in arrayCategorias" :value="categoria.id">
                                            {{ categoria.nombre }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div v-show="errorCliente" class="form-group row div-error">
                                <div class="text-center text-error">
                                    Los siguientes campos no pueden estar vacíos: <br>
                                    <span v-for="error in errorMostrarMsgCliente" :key="error"
                                          v-text="error + ', '"> </span>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                                        @click="registrarCliente()">Guardar
                                </button>
                                <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                                        @click="actualizarCliente()">Actualizar
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
                nombre: '', apellidos: '', dni: '', email: '', telefono: '', fechaNacimiento: '',
                sexo: 'Hombre', domicilio: '', localidad: '', codigoPostal: '', provicia: '', cuentaBancaria: '',
                profesion: '', contacto: '', id_categoria: 1, observaciones: '',
                arrayCliente: [],
                arrayCategorias: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorCliente: 0,
                errorMostrarMsgCliente: [],
                cliente_id: 0,
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3,
                criterio : 'nombre',
                buscar : ''
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
            listarCategoria() {
                let me = this;
                axios.get('/categoria').then(function (response) {
                    me.arrayCategorias = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            listarCliente(page) {
                let me = this;
                var url = '/cliente?page=' + page;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCliente = respuesta.clientes.data;
                    me.pagination = respuesta.pagination;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            cambiarPagina(page) {
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                me.listarCliente(page);
            },
            registrarCliente() {
                if (this.validarCliente()) {
                    return;
                }
                let me = this;
                axios.post('/cliente/registrar', {
                    'nombre': this.nombre,
                    'apellidos': this.apellidos,
                    'dni': this.dni,
                    'email': this.email,
                    'telefono': this.telefono,
                    'fechaNacimiento': this.fechaNacimiento,
                    'sexo': this.sexo,
                    'domicilio': this.domicilio,
                    'codigoPostal': this.codigoPostal,
                    'provincia': this.provicia,
                    'cuentaBancaria': this.cuentaBancaria,
                    'contacto': this.contacto,
                    'id_categoria': this.id_categoria,
                    'observaciones': this.observaciones,
                    'localidad': this.localidad,
                    'profesion': this.profesion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCliente();
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            actualizarCliente() {
                if (this.validarCliente()) {
                    return;
                }
                let me = this;
                axios.put('/cliente/actualizar', {
                    'nombre': this.nombre,
                    'apellidos': this.apellidos,
                    'dni': this.dni,
                    'email': this.email,
                    'telefono': this.telefono,
                    'fechaNacimiento': this.fechaNacimiento,
                    'sexo': this.sexo,
                    'domicilio': this.domicilio,
                    'codigoPostal': this.codigoPostal,
                    'provincia': this.provicia,
                    'cuentaBancaria': this.cuentaBancaria,
                    'contacto': this.contacto,
                    'id_categoria': this.id_categoria,
                    'observaciones': this.observaciones,
                    'localidad': this.localidad,
                    'profesion': this.profesion,
                    'id': this.cliente_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCliente();
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            desactivarCliente(id) {
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true,
                });
                swalWithBootstrapButtons({
                    title: '¿Está seguro de desactivar este Cliente?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/cliente/desactivar', {
                            'id': id
                        }).then(function (response) {
                            me.listarCliente();
                            swalWithBootstrapButtons(
                                'Desactivado!',
                                'El Cliente ha sido desactivado con éxito.',
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
                            'No se ha desactivado el Cliente.',
                            'error'
                        )
                    }
                })
            },
            activarCliente(id) {
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true,
                });
                swalWithBootstrapButtons({
                    title: '¿Está seguro de activar este Cliente?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/cliente/activar', {
                            'id': id
                        }).then(function (response) {
                            me.listarCliente();
                            swalWithBootstrapButtons(
                                'Desactivado!',
                                'El Cliente ha sido activado con éxito.',
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
                            'No se ha activado el Cliente.',
                            'error'
                        )
                    }
                })
            },
            validarCliente() {
                this.errorCliente = 0;
                this.errorMostrarMsgCliente = [];
                if (!this.nombre) this.errorMostrarMsgCliente.push('Nombre');
                if (!this.apellidos) this.errorMostrarMsgCliente.push('Apellidos');
                if (!this.dni) this.errorMostrarMsgCliente.push('DNI');
                if (!this.telefono) this.errorMostrarMsgCliente.push('Teléfono');
                if (!this.id_categoria) this.errorMostrarMsgCliente.push('Categoría');
                if (this.errorMostrarMsgCliente.length > 0) this.errorCliente = 1;
                return this.errorCliente;
            },
            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.apellidos = '';
                this.dni = '';
                this.email = '';
                this.telefono = '';
                this.fechaNacimiento = '';
                this.sexo = '';
                this.domicilio = '';
                this.codigoPostal = '';
                this.localidad = '';
                this.provicia = '';
                this.cuentaBancaria = '';
                this.contacto = '';
                this.id_categoria = '';
                this.observaciones = '';
                this.profesion = '';
            },
            abrirModal(modelo, accion, data = []) {
                this.errorMostrarMsgCliente = [];
                this.errorCliente = 0;
                switch (modelo) {
                    case "cliente": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.nombre = '';
                                this.apellidos = '';
                                this.dni = '';
                                this.email = '';
                                this.telefono = '';
                                this.fechaNacimiento = '';
                                this.domicilio = '';
                                this.codigoPostal = '';
                                this.provicia = '';
                                this.cuentaBancaria = '';
                                this.contacto = '';
                                this.observaciones = '';
                                this.profesion = '';
                                this.localidad = '';
                                this.tituloModal = 'Registrar Nuevo Cliente';
                                this.tipoAccion = 1;
                                this.sexo = "Hombre";
                                this.id_categoria = 1;
                                break;
                            }
                            case 'actualizar': {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = "Actualizar Cliente";
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.apellidos = data['apellidos'];
                                this.dni = data['dni'];
                                this.email = data['email'];
                                this.telefono = data['telefono'];
                                this.fechaNacimiento = data['fechaNacimiento'];
                                this.sexo = data['sexo'];
                                this.domicilio = data['domicilio'];
                                this.localidad = data['localidad'];
                                this.codigoPostal = data['codigoPostal'];
                                this.provicia = data['provicia'];
                                this.cuentaBancaria = data['cuentaBancaria'];
                                this.profesion = data['profesion'];
                                this.contacto = data['cuentaBancaria'];
                                this.id_categoria = data['id_categoria'];
                                this.observaciones = data['observaciones'];
                                this.cliente_id = data['id'];
                                break;
                            }
                        }
                    }
                }
            },
        },
        mounted() {
            this.listarCliente();
            this.listarCategoria();
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
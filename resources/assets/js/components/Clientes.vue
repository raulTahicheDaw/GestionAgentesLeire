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
                                <select class="form-control col-md-3" id="opcion" name="opcion">
                                    <option value="nombre">Nombre</option>
                                    <option value="descripcion">Apellidos</option>
                                    <option value="descripcion">DNI</option>

                                </select>
                                <input type="text" id="texto" name="texto" class="form-control"
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
                                <button type="button" class="btn btn-danger btn-sm">
                                    <i class="icon-trash"></i>
                                </button>
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
                            <li class="page-item">
                                <a class="page-link" href="#">Ant</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Sig</a>
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
                                        @click="actualizarCliente()">Actualizar</button>
                            </div>

                        </form>
                    </div>
                    <!-- /.modal-content -->
                    <!-- /.modal-dialog -->
                    <!--Fin del modal-->
                    <!-- Inicio del modal Eliminar -->
                    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel"
                         style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-danger" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Eliminar Cliente</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Estas seguro de eliminar este cliente?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-danger">Eliminar</button>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div> <!-- /.modal-dialog -->
                </div>
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
                cliente_id:0

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
            listarCliente() {
                let me = this;
                axios.get('/cliente').then(function (response) {
                    me.arrayCliente = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
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
            actualizarCliente(){
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
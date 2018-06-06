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
                    <i class="fa fa-align-justify"></i> Listado de Usuarios
                    <button @click="abrirModal('usuario','registrar')" type="button" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="usuario">Usuario</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarUsuarios(1,buscar,criterio)"
                                       class="form-control"
                                       placeholder="Texto a buscar">
                                <button type="submit" @click="listarUsuarios(1,buscar,criterio)"
                                        class="btn btn-primary">
                                    <i class="fa fa-search"></i> Buscar
                                </button>
                                <button style="margin-left: 10px;" type="submit" @click="mostarTodos()"
                                        class="btn btn-primary">
                                    <i class="fa fa-align-justify"></i>Mostrar todas
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="usuario in arrayUsuarios" :key="usuario.id">
                            <td>
                                <button @click="abrirModal('usuario','actualizar', usuario)" type="button"
                                        class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <template v-if="usuario.activo">
                                    <button type="button" class="btn btn-danger btn-sm"
                                            @click="desactivarUsuario(usuario.id)">
                                        <i class="icon-trash"></i>
                                    </button>
                                </template>
                                <template v-else>
                                    <button type="button" class="btn btn-success btn-sm"
                                            @click="activarUsuario(usuario.id)">
                                        <i class="icon-check"></i>
                                    </button>
                                </template>

                            </td>
                            <td v-text="usuario.usuario"></td>
                            <td v-text="usuario.roles"></td>
                            <td>
                                <div v-if="usuario.activo">
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
                                <div class="col">
                                    <label class="form-control-label"
                                           :class="{'text-error' : errorMostrarMsgUsuario.includes('Usuario')}">Usuario<sup>*</sup></label>
                                    <input type="text" v-model="usuario" class="form-control"
                                           :class="{'is-invalid' : errorMostrarMsgUsuario.includes('Usuario')}"
                                           placeholder="Introduzca un nombre">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="form-control-label"
                                           :class="{'text-error' : errorMostrarMsgUsuario.includes('Password')}">Password</label>
                                    <input type="password" v-model="password" class="form-control"
                                           :class="{'is-invalid' : errorMostrarMsgUsuario.includes('Password')}"
                                           placeholder="Introduzca un password">
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col">
                                    <label class="form-control-label">Roles</label>
                                    <select v-model="idrol" class="form-control">
                                        <option v-for="rol in arrayRoles" :key="rol.id"
                                                :value="rol.id"
                                                v-text="rol.nombre">
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div v-show="errorUsuario" class="form-group row div-error">
                            <div class="text-center text-error">
                                <p>Los siguientes campos no pueden estar vacíos o son incorrectos:</p>
                                <span v-for="error in errorMostrarMsgUsuario" :key="error"
                                      v-text="error + ', '"> </span>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                                    @click="registrarUsuario()">Guardar
                            </button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                                    @click="actualizarUsuario()">Actualizar
                            </button>
                        </div>

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
                usuario: '', password: '', idrol: 0, id_usuario: '',
                arrayUsuarios: [], arrayRoles: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorUsuario: 0,
                errorMostrarMsgUsuario: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3,
                criterio: 'usuario',
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
            cerrarSesion(){
                axios.post('/logout').then(function (response) {
                    window.location = '/';
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            listarUsuarios(page, buscar, criterio) {
                let me = this;
                var url = '/user?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayUsuarios = respuesta.usuarios.data;
                    me.pagination = respuesta.pagination;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            mostarTodos() {
                this.listarUsuarios(1, '', 'usuario');
                this.buscar = '';
            },
            cambiarPagina(page, buscar, criterio) {
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                me.listarUsuarios(page, buscar, criterio);
            },
            registrarUsuario() {
                if (this.validarUsuario()) {
                    return;
                }
                let me = this;
                axios.post('/user/registrar', {
                    'usuario': this.usuario,
                    'password': this.password,
                    'idrol': this.idrol
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUsuarios(1, '', 'usuario');
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            actualizarUsuario() {
                if (this.validarUsuario()) {
                    return;
                }
                let me = this;
                axios.put('/user/actualizar', {
                    'usuario': this.usuario,
                    'password': this.password,
                    'idrol': this.idrol,
                    'id': this.id_usuario
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUsuarios(1, '', 'usuario');
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            desactivarUsuario(id) {
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true,
                });
                swalWithBootstrapButtons({
                    title: '¿Está seguro de desactivar este Usuario?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/user/desactivar', {
                            'id': id
                        }).then(function (response) {
                            me.listarUsuarios(1, '', 'usuario');
                            swalWithBootstrapButtons(
                                'Desactivada!',
                                'El usuario ha sido desactivado con éxito.',
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
                            'No se ha desactivado el Usuario.',
                            'error'
                        )
                    }
                })
            },
            activarUsuario(id) {
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true,
                });
                swalWithBootstrapButtons({
                    title: '¿Está seguro de activar este Usuario?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/user/activar', {
                            'id': id
                        }).then(function (response) {
                            me.listarUsuarios(1, '', 'usuario');
                            swalWithBootstrapButtons(
                                'Activada!',
                                'El usuario ha sido activado con éxito.',
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
                            'No se ha activado el Usuario.',
                            'error'
                        )
                    }
                })
            },
            validarUsuario() {
                this.errorUsuario = 0;
                this.errorMostrarMsgUsuario = [];
                if (!this.usuario) this.errorMostrarMsgUsuario.push('Nombre');
                if (this.errorMostrarMsgUsuario.length > 0) this.errorUsuario = 1;
                return this.errorUsuario;
            },
            listarRoles() {
                let me = this;
                axios
                    .get("/rol/selectrol")
                    .then(function (response) {
                        me.arrayRoles = response.data.roles;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.usuario = '';
                this.password = '';
                this.idrol = 0;
            },
            abrirModal(modelo, accion, data = []) {
                this.errorMostrarMsgUsuario = [];
                this.errorUsuario = 0;
                switch (modelo) {
                    case "usuario": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.usuario = '';
                                this.password = '';
                                this.tituloModal = 'Registrar nuevo usuario';
                                this.idrol = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar': {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = "Actualizar Usuario";
                                this.tipoAccion = 2;
                                this.usuario = data['usuario'];
                                this.password = data['descripcion'];
                                this.id_usuario = data['id'];
                                this.idrol = data['idrol'];
                                break;
                            }
                        }
                    }
                }
            },
        },
        mounted() {
            this.listarUsuarios(1, this.buscar, this.criterio);
            this.listarRoles()
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
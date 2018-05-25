<template>
    <div id="main">
        <div class="calendar-controls" id="addCitas">
            <div v-if="message" class="notification is-success">{{ message }}</div>
            <div class="box">
                <h4 class="title is-5">Calendario de citas</h4>
                <div class="field">
                    <label class="label">Ver por: </label>
                    <div class="control">
                        <div class="select">
                            <select v-model="displayPeriodUom" class="form-control-sm">
                                <option value="month">Mes</option>
                                <option value="week">Semana</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Número de meses a ver</label>
                    <div class="control">
                        <div class="select">
                            <select v-model="displayPeriodCount" class="form-control">
                                <option :value="1">1</option>
                                <option :value="2">2</option>
                                <option :value="3">3</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="field">
                    <div class="control">
                        <label class="label">Hora</label>
                        <select v-model="hora" class="form-control">
                            <option value="08:00">08:00</option>
                            <option value="08:30">08:30</option>
                            <option value="09:00">09:00</option>
                            <option value="09:30">09:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                            <option value="13:00">13:00</option>
                            <option value="13:30">13:30</option>
                            <option value="14:00">14:00</option>
                            <option value="14:30">14:30</option>
                            <option value="15:00">15:00</option>
                            <option value="15:30">15:30</option>
                            <option value="16:00">16:00</option>
                            <option value="16:30">16:30</option>
                            <option value="17:00">17:00</option>
                            <option value="17:30">17:30</option>
                            <option value="18:00">18:00</option>
                            <option value="18:30">18:30</option>
                            <option value="19:00">19:00</option>
                            <option value="19:30">19:30</option>
                            <option value="20:00">20:00</option>
                            <option value="20:30">20:30</option>
                            <option value="21:00">21:00</option>
                            <option value="21:30">21:30</option>
                            <option value="22:00">22:00</option>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label class="label">Cliente</label>
                        <input v-model="cliente" class="input form-control" type="text">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label class="label">Lugar</label>
                        <input v-model="lugar" class="input form-control" type="text">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label class="label">Motivo</label>
                        <input v-model="motivo" class="input form-control" type="text">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Fecha Inicio</label>
                    <div class="control">
                        <input v-model="newEventStartDate" class="input form-control" type="date">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Fecha Fin</label>
                    <div class="control">
                        <input v-model="newEventEndDate" class="input form-control" type="date">
                    </div>
                </div>

                <button class="btn btn-primary mb-2" @click="clickTestAddEvent">Añadir cita al calendario
                </button>
            </div>
        </div>

        <div class="calendar-parent">
            <calendar-view
                    :events="events"
                    :show-date="showDate"
                    :time-format-options="{hour: 'numeric', minute:'2-digit'}"
                    :enable-drag-drop="true"
                    :disable-past="disablePast"
                    :disable-future="disableFuture"
                    :show-event-times="showEventTimes"
                    :display-period-uom="displayPeriodUom"
                    :display-period-count="displayPeriodCount"
                    :starting-day-of-week="startingDayOfWeek"
                    :class="themeClasses"
                    @drop-on-date="onDrop"
                    @click-date="onClickDay"
                    @click-event="onClickEvent"
                    @show-date-change="setShowDate"
            />

        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" :class="{'mostrar': modal}"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cita</h5>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-control-label">Fecha</label>
                                <input type="text" class="form-control" v-model="fecha" v-bind:disabled="activo">
                            </div>
                            <div class="col-md-6">
                                <label class="form-control-label">Hora</label>
                                <select v-model="hora" class="form-control" id="hora" v-bind:disabled="activo">
                                    <option value="08:00">08:00</option>
                                    <option value="08:30">08:30</option>
                                    <option value="09:00">09:00</option>
                                    <option value="09:30">09:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:30">21:30</option>
                                    <option value="22:00">22:00</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-control-label">Lugar</label>
                                <input type="text" class="form-control" v-model="lugar" v-bind:disabled="activo">
                            </div>
                            <div class="col-md-6">
                                <label class="form-control-label">Cliente</label>
                                <input type="text" class="form-control" v-model="cliente" v-bind:disabled="activo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-control-label">Acuerdos</label>
                                <textarea rows="5" class="form-control" v-model="acuerdos"
                                          v-bind:disabled="activo"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-control-label">Observaciones</label>
                                <textarea rows="5" class="form-control" v-model="observaciones"
                                          v-bind:disabled="activo"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="button" class="btn btn-success"><i
                                    class="icon-check"></i>
                            </button>
                            <button type="button" class="btn btn-danger"><i class="icon-trash"></i>
                            </button>
                        </div>
                        <div>
                            <button type="button" v-if="!activo" class="btn btn-success"
                                    @click="desactivarEditar()"><i
                                    class="icon-note"></i>
                            </button>
                            <button type="button" v-if="activo" class="btn btn-warning" @click="editarCita()">
                                <i class="icon-lock-open"></i>
                            </button>
                            <button type="button" v-else class="btn btn-danger" @click="editarCita()">
                                <i class="icon-lock"></i>
                            </button>

                            <button type="button" class="btn btn-secondary" @click="cerrarModal()"
                                    data-dismiss="modal">
                                <i class="icon-close"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import CalendarView from "./CalendarView"
    import CalendarMathMixin from "vue-simple-calendar/dist/calendar-math-mixin.js"

    require("vue-simple-calendar/dist/static/css/default.css");
    require("vue-simple-calendar/dist/static/css/holidays-us.css");
    // For live testing while making changes to the component, assumes repo pulled to sister folder
    /*
    import CalendarView from "../../vue-simple-calendar/src/CalendarView.vue"
    import CalendarMathMixin from "../../vue-simple-calendar/src/CalendarMathMixin.js"
    require("../../vue-simple-calendar/static/css/default.css")
    require("../../vue-simple-calendar/static/css/holidays-us.css")
    */
    export default {
        name: "Main",
        components: {
            CalendarView,
        },
        mixins: [CalendarMathMixin],
        data() {
            return {
                /* Show the current month, and give it some fake events to show */
                showDate: this.thisMonth(1),
                message: "",
                startingDayOfWeek: 1,
                disablePast: false,
                disableFuture: false,
                displayPeriodUom: "month",
                displayPeriodCount: 1,
                showEventTimes: true,
                newEventTitle: '',
                newEventStartDate: "",
                newEventEndDate: "",
                useDefaultTheme: true,
                useHolidayTheme: true,
                events: [],
                modal: 0,
                fecha: '',
                lugar: '',
                cliente: '',
                acuerdos: '',
                observaciones: '',
                motivo: '',
                fin: '',
                hora: '08:00',
                resumen: '',
                activo: true


            }
        },
        computed: {
            userLocale() {
                return this.getDefaultBrowserLocale;
            },
            dayNames() {
                return this.getFormattedWeekdayNames(this.userLocale, "long", 0);
            },
            themeClasses() {
                return {
                    "theme-default": this.useDefaultTheme,
                    "holiday-us-traditional": this.useHolidayTheme,
                    "holiday-us-official": this.useHolidayTheme,
                }
            },
        },

        methods: {
            listarEventos() {
                let me = this;
                axios.get('/agenda').then(function (response) {
                    me.events = response.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            recuperaEvento(id) {
                let me = this;
                axios.get('/agenda/recuperaCita', {
                    params: {
                        'id': id
                    }
                })
                    .then(function (response) {
                        me.lugar = response.data[0].lugar;
                        me.cliente = response.data[0].nombre;
                        me.fecha = response.data[0].fecha.substr(0, 10).replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3/$2/$1');
                        me.hora = response.data[0].fecha.substr(11, 5);
                        me.acuerdos = response.data[0].acuerdos;
                        me.observaciones = response.data[0].observaciones;
                        me.motivo = response.data[0].motivo;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            thisMonth(d, h, m) {
                const t = new Date();
                return new Date(t.getFullYear(), t.getMonth(), d, h || 0, m || 0);
            },
            onClickDay(d) {
                this.message = `You clicked: ${d.toLocaleDateString()}`
            },
            onClickEvent(e) {
                this.recuperaEvento(e.id);
                this.modal = 1;

                this.message = `You clicked: ${e.id}`;

            },
            setShowDate(d) {
                this.message = `Changing calendar view to ${d.toLocaleDateString()}`;
                this.showDate = d;
            },
            onDrop(event, date) {
                this.message = `You dropped ${event.id} on ${date.toLocaleDateString()}`;
                // Determine the delta between the old start date and the date chosen,
                // and apply that delta to both the start and end date to move the event.
                const eLength = this.dayDiff(event.startDate, date);
                event.originalEvent.startDate = this.addDays(event.startDate, eLength);
                event.originalEvent.endDate = this.addDays(event.endDate, eLength);
            },
            clickTestAddEvent() {
                let me = this;
                let fechaAux = this.newEventStartDate.split('-');
                let hora = this.hora.split(':');
                let fechaMontada = new Date(fechaAux[0], fechaAux[1] - 1, fechaAux[2], hora[0], hora[1]).toISOString().slice(0, 19).replace('T', ' ');
                console.log(fechaMontada);

                axios.post('/agenda/registrar', {
                    'id_cliente': me.cliente,
                    'motivo': me.motivo,
                    'lugar': me.lugar,
                    'color': me.color,
                    'fecha': fechaMontada,
                    'acuerdos': me.acuerdos,
                    'observaciones': me.observaciones

                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEventos();
                })
                    .catch(function (error) {
                        console.log(error.response);
                    });


            },
            editarCita() {
                this.activo = false;
            },
            desactivarEditar() {
                this.activo = true;
            },
            cerrarModal() {
                this.modal = 0;
                this.fecha = '';
                this.lugar = '';
                this.cliente = '';
                this.acuerdos = '';
                this.observaciones = '';
                this.motivo = '';
                this.hora = '08:00';
                this.resumen = '';
                this.desactivarEditar()
            }
        },
        mounted() {
            this.listarEventos();
            this.newEventStartDate = this.isoYearMonthDay(this.today());
            this.newEventEndDate = this.isoYearMonthDay(this.today());
        },
    }
</script>

<style>
    html,
    body {
        height: 100%;
        margin: 0;
        background-color: #f7fcff;
    }

    #main {
        display: flex;
        flex-direction: row;
        font-family: Calibri, sans-serif;
        width: 70vw;
        min-width: 30rem;
        max-width: 80rem;
        min-height: 40rem;
        margin-top: 20px;
        margin-left: 20%;
        margin-right: 10%;
    }

    .calendar-controls {
        margin-right: 1rem;
        min-width: 14rem;
        max-width: 14rem;
    }

    .calendar-parent {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        overflow-x: hidden;
        overflow-y: hidden;
        max-height: 80vh;
        background-color: white;
    }

    /* For long calendars, ensure each week gets sufficient height. The body of the calendar will scroll if needed */
    .cv-wrapper.period-month.periodCount-2 .cv-week,
    .cv-wrapper.period-month.periodCount-3 .cv-week,
    .cv-wrapper.period-year .cv-week {
        min-height: 6rem;
    }

    /* These styles are optional, to illustrate the flexbility of styling the calendar purely with CSS. */
    /* Add some styling for events tagged with the "birthday" class */
    .calendar .event.birthday {
        background-color: #e0f0e0;
        border-color: #d7e7d7;
    }

    .calendar .event.birthday::before {
        content: "\1F382";
        margin-right: 0.5em;
    }

    .label {
        margin-top: 8px;
    }

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
</style>
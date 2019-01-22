<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-default">
                <div class="panel-heading main__panel">
                    <div class="panel-heading__left">
                        <p class="panel__title"></p>
                        <p class="panel__subtitle">Event activity</p>
                    </div>
                </div>
                <div class="panel-heading__right">
                    <ul class="list-inline">
                        <li>
                            <fieldset>
                                <a @click="showCreateForm" class="btn btn-success">
                                    Create new event
                                </a>
                            </fieldset>
                        </li>
                        <br>
                        <li>
                            <div>
                                <fieldset class="form-inline">
                                    <input type="text"
                                           class="form-control"
                                           name="search"
                                           v-model="search"
                                           placeholder="Search by title"
                                           @change="refreshTable()"
                                    >
                                </fieldset>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-body">

                    <!-- Modal -->
                    <div class="modal fade" id="event-activity" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 v-if="dataForm.id" class="modal-title">Edit</h5>
                                    <h5 v-else class="modal-title">Create</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <fieldset class="form-control" :class="classFor('title')">
                                            <label for="Title">Title</label>
                                            <input type="text" class="form-control"
                                                   id="Title"
                                                   name="title"
                                                   v-model="dataForm.title"
                                                   required>
                                            <span class="help-block"><strong>{{ errors.first('title') }}</strong></span>
                                        </fieldset>

                                        <fieldset class="form-control" :class="classFor('start_date')">
                                            <label for="start_date">Date start</label>
                                            <input type="date"
                                                   class="form-control"
                                                   id="start_date"
                                                   name="start_date"
                                                   v-model="dataForm.start_date"
                                                   required>
                                            <span class="help-block"><strong>{{ errors.first('start_date') }}</strong></span>
                                        </fieldset>

                                        <div class="row">
                                            <fieldset class="form-control col-sm-3" :class="classFor('start_time')">
                                                <label for="start_hours">Start hours</label>
                                                <div class="spinner">
                                                    <input type="number"
                                                           class="form-control"
                                                           id="start_hours"
                                                           name="start_hours"
                                                           max="23"
                                                           min="0"
                                                           v-model="dataForm.start_hours"
                                                           required>
                                                    <div class="input-group-btn-vertical">
                                                        <button class="btn btn-default"
                                                                @click='increment("start_hours", 24)' type="button">
                                                            <i
                                                                class="fa fa-plus"></i></button>
                                                        <button class="btn btn-default"
                                                                @click='decrement("start_hours", 0)' type="button">
                                                            <i
                                                                class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <span class="help-block"><strong>{{ errors.first('start_time') }}</strong></span>
                                            </fieldset>

                                            <fieldset class="form-control col-sm-3" :class="classFor('start_time')">
                                                <label for="start_minutes">Start minutes</label>

                                                <div class="spinner">
                                                    <input type="number"
                                                           class="form-control"
                                                           id="start_minutes"
                                                           name="start_minutes"
                                                           step="5"
                                                           max="55"
                                                           min="0"
                                                           v-model="dataForm.start_minutes"
                                                           required>
                                                    <div class="input-group-btn-vertical">
                                                        <button class="btn btn-default"
                                                                @click='increment("start_minutes", 55, 5)'
                                                                type="button"><i
                                                            class="fa fa-plus"></i></button>
                                                        <button class="btn btn-default"
                                                                @click='decrement("start_minutes", 0, 5)'
                                                                type="button"><i
                                                            class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <fieldset class="form-control" :class="classFor('reminder_date')">
                                            <label for="reminder_date">Reminder date</label>
                                            <input type="date"
                                                   class="form-control"
                                                   id="reminder_date"
                                                   name="reminder_date"
                                                   v-model="dataForm.reminder_date"
                                                   required>
                                            <span class="help-block"><strong>{{ errors.first('reminder_date') }}</strong></span>
                                        </fieldset>

                                        <div class="row">
                                            <fieldset class="form-control col-sm-3" :class="classFor('reminder_time')">
                                                <label for="reminder_hours">Reminder hours</label>
                                                <div class="spinner">
                                                    <input type="number"
                                                           class="form-control"
                                                           id="reminder_hours"
                                                           name="reminder_hours"
                                                           max="23"
                                                           min="0"
                                                           v-model="dataForm.reminder_hours"
                                                           required>
                                                    <div class="input-group-btn-vertical">
                                                        <button class="btn btn-default"
                                                                @click='increment("reminder_hours", 24)' type="button"><i
                                                            class="fa fa-plus"></i></button>
                                                        <button class="btn btn-default"
                                                                @click='decrement("reminder_hours", 0)' type="button"><i
                                                            class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <span class="help-block"><strong>{{ errors.first('reminder_time') }}</strong></span>
                                            </fieldset>

                                            <fieldset class="form-control col-sm-3" :class="classFor('reminder_time')">
                                                <label for="reminder_minutes">Reminder minutes</label>

                                                <div class="spinner">
                                                    <input type="number"
                                                           class="form-control"
                                                           id="reminder_minutes"
                                                           name="reminder_minutes"
                                                           step="5"
                                                           max="55"
                                                           min="0"
                                                           v-model="dataForm.reminder_minutes"
                                                           required>
                                                    <div class="input-group-btn-vertical">
                                                        <button class="btn btn-default"
                                                                @click='increment("reminder_minutes", 55, 5)'
                                                                type="button"><i
                                                            class="fa fa-plus"></i></button>
                                                        <button class="btn btn-default"
                                                                @click='decrement("reminder_minutes", 0, 5)'
                                                                type="button"><i
                                                            class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <fieldset class="form-control" :class="classFor('end_date')">
                                            <label for="end_date">End date</label>
                                            <input type="date"
                                                   class="form-control"
                                                   id="end_date"
                                                   name="end_date"
                                                   v-model="dataForm.end_date"
                                                   required>
                                            <span class="help-block"><strong>{{ errors.first('end_date') }}</strong></span>
                                        </fieldset>

                                        <div class="row">
                                            <fieldset class="form-control col-sm-3" :class="classFor('end_time')">
                                                <label for="end_hours">End hours</label>
                                                <div class="spinner">
                                                    <input type="number"
                                                           class="form-control"
                                                           id="end_hours"
                                                           name="end_hours"
                                                           max="23"
                                                           min="0"
                                                           v-model="dataForm.end_hours"
                                                           required>
                                                    <div class="input-group-btn-vertical">
                                                        <button class="btn btn-default"
                                                                @click='increment("end_hours", 24)' type="button"><i
                                                            class="fa fa-plus"></i></button>
                                                        <button class="btn btn-default"
                                                                @click='decrement("end_hours", 0)' type="button"><i
                                                            class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <span class="help-block"><strong>{{ errors.first('end_time') }}</strong></span>
                                            </fieldset>

                                            <fieldset class="form-control col-sm-3" :class="classFor('end_time')">
                                                <label for="end_minutes">End minutes</label>

                                                <div class="spinner">
                                                    <input type="number"
                                                           class="form-control"
                                                           id="end_minutes"
                                                           name="end_minutes"
                                                           step="5"
                                                           max="55"
                                                           min="0"
                                                           v-model="dataForm.end_minutes"
                                                           required>
                                                    <div class="input-group-btn-vertical">
                                                        <button class="btn btn-default"
                                                                @click='increment("end_minutes", 55, 5)'
                                                                type="button"><i
                                                            class="fa fa-plus"></i></button>
                                                        <button class="btn btn-default"
                                                                @click='decrement("end_minutes", 0, 5)'
                                                                type="button"><i
                                                            class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <fieldset class="form-control" :class="classFor('message')">
                                            <label for="message">Message</label>
                                            <textarea class="form-control"
                                                      id="message"
                                                      name="message"
                                                      v-model="dataForm.message"
                                                      maxlength="1000"></textarea>
                                            <span class="help-block"><strong>{{ errors.first('message') }}</strong></span>
                                        </fieldset>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" v-if="dataForm.id" @click="deleteEventActivity"
                                            class="btn btn-danger">Delete
                                    </button>

                                    <a type="button" data-dismiss="modal"
                                       class="btn btn-link pull-right">Back</a>

                                    <button type="button" @click="storeEventActivityForm"
                                            class="btn btn-secondary">Store
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <full-calendar ref="calendar"
                                   :config="config"
                                   :event-sources="eventSources"
                                   default-view="month"
                                   @event-resize="eventUpdatePosition"
                                   @event-drop="eventUpdatePosition"
                                   @event-selected="showEditForm"
                                   @event-created="drawEvent"></full-calendar>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FullCalendar from 'vue-full-calendar'
    import VueSweetalert2 from 'vue-sweetalert2'
    import Vue from 'vue'
    import validation from '../mixins/validation'

    Vue.use(FullCalendar).use(VueSweetalert2)

    export default {
        mixins: [ validation ],
        data() {
            return {
                search: '',
                echo: null,
                eventSources: [
                    {
                        events: function (start, end, timezone, callback) {
                            this.$swal({
                                title: 'Loading',
                                text: 'Waiting for load events...',
                                showCloseButton: false,
                                showCancelButton: false,
                                showConfirmButton: false,
                                onOpen: () => {
                                    this.$swal.showLoading()
                                }
                            });

                            axios.get('/api/event_activity/data', {
                                params: {
                                    'search': this.search
                                }
                            }).then(response => {
                                callback(response.data.data);
                            })
                        }.bind(this),
                    }
                ],
                config: {
                    firstDay: 1,
                    eventAfterAllRender: function () {
                        this.$swal.close();
                    }.bind(this),
                    header: {
                        right: 'month,agendaWeek,agendaDay',
                    },
                    views: {
                        week: {
                            columnHeaderHtml: function (day) {
                                let dayOfWeek = day.format('ddd');
                                let month = day.format('MMM');

                                return '<div class="c__date">' + day.format('DD') + '</div>'
                                    + '<div class="c__right">' + '<span class="c__month">' + month + '</span>'
                                    + '<span class="c__day">' + dayOfWeek + '</div>';
                            }.bind(this)
                        },
                    },
                    editable: true,
                    droppable: true,
                    allDaySlot: false,
                    drop: function (date, event) {
                        this.resetForm();
                        this.dataForm.start_time = date.format('HH:mm');
                        this.dataForm.start_hours = date.format('HH');
                        this.dataForm.start_minutes = date.format('mm');
                        this.dataForm.start_date = date.format('YYYY-MM-DD');
                        this.dataForm.reminder_time = date.format('HH:mm');
                        this.dataForm.reminder_hours = date.format('HH');
                        this.dataForm.reminder_minutes = date.format('mm');
                        this.dataForm.reminder_date = date.subtract(1, 'day').format('YYYY-MM-DD');
                        this.dataForm.end_time = date.add(30, 'minutes').format('HH:mm');
                        this.dataForm.end_hours = date.add(30, 'minutes').format('HH');
                        this.dataForm.end_minutes = date.add(30, 'minutes').format('mm');
                        this.storeDroppedData();
                    }.bind(this)
                },
                dataForm: {
                    id: null,
                    start_date: null,
                    start_time: null,
                    start_hours: null,
                    start_minutes: null,
                    end_time: null,
                    end_date: null,
                    end_hours: null,
                    end_minutes: null,
                    reminder_time: null,
                    reminder_date: null,
                    reminder_hours: null,
                    reminder_minutes: null,
                    message: null,
                    title: null,
                },
            }
        },
        mounted() {
            Echo.private('App.User.' + this.$store.getters.user.id)
                .notification((notification) => {
                    this.$swal({
                        title: 'Reminder',
                        text: 'Dont remind about' + notification.eventActivity.title + 'event at' + notification.eventActivity.start_date + notification.eventActivity.start_time,
                        showCloseButton: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        onOpen: () => {
                            this.$swal.showLoading()
                        }
                    });
                });
        },
        methods: {
            eventUpdatePosition(event) {
                /* Redundant data for update position */
                var data = {
                    '_method': 'put',
                    'start_time': event.start.format('HH:mm'),
                    'start_hours': event.start.format('HH'),
                    'start_minutes': event.start.format('mm'),
                    'start_date': event.start.format('YYYY-MM-DD'),
                    'reminder_time': event.start.format('HH:mm'),
                    'reminder_hours': event.start.format('HH'),
                    'reminder_minutes': event.start.format('mm'),
                    'reminder_date': event.start.format('YYYY-MM-DD'),
                    'end_time': event.end.format('HH:mm'),
                    'end_hours': event.end.format('HH'),
                    'end_minutes': event.end.format('mm'),
                    'end_date': event.end.format('YYYY-MM-DD'),
                    'message': event.message,
                    'title': event.title,
                };

                axios.post('/api/event_activity/' + event.id, data).then((response) => {
                    this.$refs.calendar.fireMethod('refetchEvents')
                });
            },
            storeEventActivityForm() {
                var url = '/api/event_activity';

                this.dataForm.start_time = moment(this.dataForm.start_hours + ':' + this.dataForm.start_minutes, 'HH:mm').format('HH:mm');
                this.dataForm.end_time = moment(this.dataForm.end_hours + ':' + this.dataForm.end_minutes, 'HH:mm').format('HH:mm');
                this.dataForm.reminder_time = moment(this.dataForm.reminder_hours + ':' + this.dataForm.reminder_minutes, 'HH:mm').format('HH:mm');

                if (this.dataForm.id) {
                    url += '/' + this.dataForm.id;
                    this.dataForm._method = 'put';
                }

                axios.post(url, this.dataForm).then(response => {
                    this.modalToggle();
                    this.$refs.calendar.fireMethod('refetchEvents')
                }).catch(function (error) {
                    this.validErrors(error);

                    this.$refs.calendar.fireMethod('refetchEvents')
                }.bind(this));
            },
            showEditForm(event) {
                this.resetForm();

                this.dataForm.id = event.id;
                this.dataForm.message = event.message;
                this.dataForm.title = event.title;
                this.dataForm.start_date = event.start_date ? moment(event.start_date.date).format('YYYY-MM-DD') : event.start.format('YYYY-MM-DD');
                this.dataForm.start_time = event.start.format('HH:mm');
                this.dataForm.start_hours = event.start.format('HH');
                this.dataForm.start_minutes = event.start.format('mm');
                this.dataForm.reminder_date = event.reminder_date ? moment(event.reminder_date.date).format('YYYY-MM-DD') : event.start.subtract(1, 'day').format('YYYY-MM-DD');
                this.dataForm.reminder_time = event.start.format('HH:mm');
                this.dataForm.reminder_hours = event.start.format('HH');
                this.dataForm.reminder_minutes = event.start.format('mm');
                this.dataForm.end_time = event.end.format('HH:mm');
                this.dataForm.end_date = event.end_date ? moment(event.end_date.date).format('YYYY-MM-DD') : event.end.format('YYYY-MM-DD');
                this.dataForm.end_hours = event.end.format('HH');
                this.dataForm.end_minutes = event.end.format('mm');

                this.modalToggle();
            },
            storeDroppedData() {
                var url = '/api/event_activity';

                axios.post(url, this.dataForm).then(response => {
                    this.$refs.calendar.fireMethod('refetchEvents')
                }).catch(function (error) {
                    this.validErrors(error);

                    this.$refs.calendar.fireMethod('refetchEvents')
                }.bind(this));
            },
            showCreateForm() {
                function round5(x) {
                    return Math.ceil(x / 5) * 5;
                }

                this.resetForm();
                this.dataForm.start_date = moment().format('YYYY-MM-DD');
                this.dataForm.start_hours = moment().format('HH');
                this.dataForm.start_minutes = round5(moment().format('mm'));
                this.dataForm.start_time = this.start_hours + ':' + this.start_minutes;
                this.dataForm.reminder_date = moment().subtract(1, 'day').format('YYYY-MM-DD');
                this.dataForm.reminder_hours = moment().format('HH');
                this.dataForm.reminder_minutes = round5(moment().format('mm'));
                this.dataForm.reminder_time = this.reminder_hours + ':' + this.reminder_minutes;
                this.dataForm.end_hours = moment().format('HH');
                this.dataForm.end_minutes = round5(moment().format('mm'));
                this.dataForm.end_time = this.start_hours + ':' + this.start_minutes;
                this.modalToggle();
            },
            drawEvent(event) {
                this.resetForm();
                this.dataForm.start_date = event.start.format('YYYY-MM-DD');
                this.dataForm.start_time = event.start.format('HH:mm');
                this.dataForm.start_hours = event.start.format('HH');
                this.dataForm.start_minutes = event.start.format('mm');
                this.dataForm.reminder_date = event.start.subtract(1, 'day').format('YYYY-MM-DD');
                this.dataForm.reminder_time = event.start.format('HH:mm');
                this.dataForm.reminder_hours = event.start.format('HH');
                this.dataForm.reminder_minutes = event.start.format('mm');
                this.dataForm.end_time = event.end.format('HH:mm');
                this.dataForm.end_date = event.end.format('YYYY-MM-DD');
                this.dataForm.end_hours = event.end.format('HH');
                this.dataForm.end_minutes = event.end.format('mm');
                this.modalToggle();
            },
            deleteEventActivity() {
                this.dataForm._method = 'delete';

                axios.post('/api/event_activity/' + this.dataForm.id, this.dataForm).then((response) => {
                    this.$refs.calendar.fireMethod('refetchEvents')
                    this.modalToggle();
                    this.resetForm();
                });
            },
            refreshTable() {
                this.$refs.calendar.fireMethod('refetchEvents')
            },
            resetForm() {
                delete this.dataForm._method;
                Object.assign(this.$data.dataForm, this.$options.data.call(this).dataForm);
            },
            modalToggle() {
                $('#event-activity').modal('toggle');
            },
            increment(selector, restrict, step = 1) {
                if (this.dataForm[selector] < restrict) {
                    this.dataForm[selector] = parseInt(this.dataForm[selector]) + step;
                }
            },
            decrement(selector, restrict, step = 1) {
                if (this.dataForm[selector] > restrict) {
                    this.dataForm[selector] = parseInt(this.dataForm[selector]) - step;
                }
            },
            validErrors(error) {
                if (error.response.status === 422) {
                    // this.errors = error.response.data.errors
                }
            }
        }
    }
</script>

<style scoped lang="scss">
</style>

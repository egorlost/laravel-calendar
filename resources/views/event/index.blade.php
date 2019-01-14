@extends('layouts.app')

@section('content')
    <event_activity :user="{{auth()->user()}}" inline-template>
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
                                {{-- Create --}}
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
                                            {{-- title --}}
                                            <fieldset :class="['form-group', errors.title ? 'has-error' : '']">
                                                <label for="Title">Title</label>
                                                <input type="text" class="form-control"
                                                       id="Title"
                                                       name="title"
                                                       v-model="dataForm.title"
                                                       required>
                                                <span v-if="errors.title" class="help-block"><strong>@{{ errors.title[0] }}</strong></span>
                                            </fieldset>

                                            {{-- Start --}}
                                            <fieldset :class="['form-group', errors.start_date ? 'has-error' : '']">
                                                <label for="start_date">Date start</label>
                                                <input type="date"
                                                       class="form-control"
                                                       id="start_date"
                                                       name="start_date"
                                                       v-model="dataForm.start_date"
                                                       required>
                                                <span v-if="errors.start_date" class="help-block"><strong>@{{ errors.start_date[0] }}</strong></span>
                                            </fieldset>

                                            <div class="row">
                                                <fieldset
                                                    :class="['form-group', 'col-sm-3', errors.start_time ? 'has-error' : '']">
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
                                                    <span v-if="errors.start_time" class="help-block"><strong>@{{ errors.start_time[0] }}</strong></span>
                                                </fieldset>

                                                <fieldset
                                                    :class="['form-group', 'col-sm-3', errors.start_time ? 'has-error' : '']">
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

                                            {{-- Reminder --}}
                                            <fieldset :class="['form-group', errors.reminder_date ? 'has-error' : '']">
                                                <label for="reminder_date">Reminder date</label>
                                                <input type="date"
                                                       class="form-control"
                                                       id="reminder_date"
                                                       name="reminder_date"
                                                       v-model="dataForm.reminder_date"
                                                       required>
                                                <span v-if="errors.reminder_date" class="help-block"><strong>@{{ errors.reminder_date[0] }}</strong></span>
                                            </fieldset>

                                            <div class="row">
                                                <fieldset
                                                    :class="['form-group', 'col-sm-3', errors.reminder_time ? 'has-error' : '']">
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
                                                    <span v-if="errors.reminder_time" class="help-block"><strong>@{{ errors.reminder_time[0] }}</strong></span>
                                                </fieldset>

                                                <fieldset
                                                    :class="['form-group', 'col-sm-3', errors.reminder_time ? 'has-error' : '']">
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

                                            {{-- End --}}
                                            <fieldset :class="['form-group', errors.end_date ? 'has-error' : '']">
                                                <label for="end_date">End date</label>
                                                <input type="date"
                                                       class="form-control"
                                                       id="end_date"
                                                       name="end_date"
                                                       v-model="dataForm.end_date"
                                                       required>
                                                <span v-if="errors.end_date" class="help-block"><strong>@{{ errors.end_date[0] }}</strong></span>
                                            </fieldset>

                                            <div class="row">
                                                <fieldset
                                                    :class="['form-group', 'col-sm-3', errors.end_time ? 'has-error' : '']">
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
                                                    <span v-if="errors.end_time" class="help-block"><strong>@{{ errors.end_time[0] }}</strong></span>
                                                </fieldset>

                                                <fieldset
                                                    :class="['form-group', 'col-sm-3', errors.end_time ? 'has-error' : '']">
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

                                            {{-- Message --}}
                                            <fieldset :class="['form-group', errors.message ? 'has-error' : '']">
                                                <label for="message">Message</label>
                                                <textarea class="form-control"
                                                          id="message"
                                                          name="message"
                                                          v-model="dataForm.message"
                                                          maxlength="1000"></textarea>
                                                <span v-if="errors.message" class="help-block"><strong>@{{ errors.message[0] }}</strong></span>
                                            </fieldset>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        {{-- Delete --}}
                                        <button type="button" v-if="dataForm.id" @click="deleteEventActivity"
                                                class="btn btn-danger">Delete
                                        </button>

                                        {{-- Back --}}
                                        <a type="button" data-dismiss="modal"
                                           class="btn btn-link pull-right">Back</a>

                                        {{-- Submit --}}
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
    </event_activity>
@endsection

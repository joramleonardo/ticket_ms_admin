<template>
    <div>
        <div class="main-menu-area mg-tb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                            <li>
                                <router-link to="/ticket/sa/dashboard">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                    Dashboard
                                </router-link>
                            </li>
                            <li class="active">
                                <router-link to="/ticket/sa/newtickets">
                                    <i class="fa fa-bell" aria-hidden="true"></i>
                                    New Tickets
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/ticket/sa/mytickets">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    Tickets
                                    <span v-if="this.totalNew != '0'">
                                            <div class="spinner4 spinner-4"></div>
                                            <div class="ntd-ctn">
                                                <span>{{this.totalNew}}</span>
                                            </div>
                                    </span>
                                    <span v-else>
                                    </span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="breadcomb-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcomb-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="breadcomb-wp">
                                        <div class="breadcomb-icon">
                                            <i class="fa fa-list" aria-hidden="true"></i>
                                        </div>
                                        <div class="breadcomb-ctn">
                                            <h2>New Tickets</h2>
                                            <p style="font-size: 12px;">Home> <span class="bread-ntd">New Tickets</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="data-table-area"  style="margin-bottom: 30px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="data-table-list">
                            <div class="basic-tb-hd">
                                <b-container fluid>
                                        <b-row class="mb-3">
                                            <b-col lg="5" class="my-1">
                                                <b-form-group label="Filter" label-for="filter-input" label-cols-sm="2" label-align-sm="right" label-size="sm" class="mb-0" >
                                                    <b-input-group size="sm">
                                                        <b-form-input id="filter-input" v-model="filter" type="search" placeholder="Type to Search" ></b-form-input>
                                                        <button :disabled="!filter" @click="filter = ''">Clear</button>
                                                    </b-input-group>
                                                </b-form-group>
                                            </b-col>
                                            <b-col lg="5" class="my-1">
                                                <b-form-group label="Sort" label-for="sort-by-select" label-cols-sm="3" label-align-sm="right" label-size="sm" class="mb-0" v-slot="{ ariaDescribedby }">
                                                    <b-input-group size="sm">

                                                        <b-form-select v-model="sortDesc" :disabled="!sortBy" :aria-describedby="ariaDescribedby" size="sm" class="w-25">
                                                            <option :value="false">Asc</option>
                                                            <option :value="true">Desc</option>
                                                        </b-form-select>
                                                    </b-input-group>
                                                </b-form-group>
                                            </b-col>
                                        </b-row>
                                            <b-table striped hover
                                            :items="ticket"
                                            :fields="fields_APPROVED"
                                            :current-page="currentPage"
                                            :per-page="perPage"
                                            :filter="filter"
                                            :filter-included-fields="filterOn"
                                            :sort-by.sync="sortBy"
                                            :sort-desc.sync="sortDesc"
                                            :sort-direction="sortDirection"
                                            stacked="md"
                                            show-empty
                                            >
                                                <template #cell(supportType)="row">
                                                    <b style="color:rgb(35, 132, 179)">{{ row.value}}</b>
                                                </template>
                                                <template #cell(reference_code)="row">
                                                    <b>{{ row.value}}</b>
                                                </template>
                                                <template #cell(externalName)="row">
                                                    {{ row.value.toUpperCase()}}
                                                </template>
                                                <template #cell(status)="row">
                                                    <div v-if="row.item.status === 'New'">
                                                        <b-badge class="mr-1 badge" style="background-color: #f0ad4e;">New</b-badge>
                                                    </div>
                                                </template>
                                                <template #cell(actions)="row">
                                                    <div v-if="row.item.status === 'New'">
                                                        <button @click="assignTicket(row.item, row.index, $event.target)" class="btn btn-info notika-btn-info">View Ticket</button>
                                                    </div>

                                                </template>
                                                <template #cell(details)="row">
                                                    <button @click="viewTicketDetails(row.item, row.index, $event.target)" class="btn btn-primary notika-btn-primary" >View Details</button>
                                                </template>
                                            </b-table>
                                        <b-row>
                                                <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" align="center" ></b-pagination>
                                        </b-row>
                                </b-container>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="assignModalForm_internal" role="dialog">

            <div class="modal-dialog modal-large">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <span v-if="ticketDetails.status === 'New'">
                                <div class="inbox-left-sd" >
                                    <div class="compose-ml">
                                        <h4>Date Tracking</h4>
                                    </div>
                                    <hr>
                                    <div class="inbox-status">
                                        <p class="first-ph">
                                            <b>Requested: </b>
                                            {{ticketDetails.ticket_created}}
                                        </p>
                                    </div>
                                </div>
                            </span>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <div class="inbox-text-list sm-res-mg-t-30">
                                <div class="view-mail-hd">
                                    <div class="view-mail-hrd">
                                        <h2>Ticket Details</h2>
                                    </div>
                                    <div class="view-ml-rl">
                                        <span v-if="ticketDetails.status === 'New'">
                                            <button class="btn btn-warning notika-btn-warning" disabled="disabled">
                                                New
                                            </button>
                                        </span>

                                    </div>
                                </div>
                                <hr>
                                <div class="inbox-status">
                                    <p class="first-ph" style="font-style: italic; font-size: 12px;">
                                        <b>Reference No: </b>
                                        {{ticketDetails.reference_code}}
                                    </p>
                                    <hr>
                                    <p class="first-ph">
                                        <b>Support Type: </b>
                                        {{ticketDetails.supportType}}
                                    </p>
                                    <p class="first-ph">
                                        <b>Problem that needed support: </b>
                                        <span style="font-size: 18px; font-weight: 600; color: #021346;">
                                            {{ticketDetails.clientNote}}
                                        </span>
                                    </p>
                                    <hr>

                                </div>
                                <div class="inbox-status">
                                    <p class="first-ph">
                                        <b>Client Name: </b>
                                        {{ticketDetails.externalName}}
                                    </p>
                                    <p class="first-ph">
                                        <b>Client Division: </b>
                                        {{ticketDetails.empDiv}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>
</template>


<script>
    import { concat } from 'lodash';
import * as ticket_service from '../../services/ticket_service';

    export default {
        name: 'employee',
        data() {
            return {
                totalNew: 0,
                name: '',
                thisAudio: '',
                total: '',
                totalStaff: '',

                ticket2: [],
                ticket: [],
                ticketDetails: [],
                ticketData:{
                    status:'',
                    reference_code:''
                },
                assignedTicketData:{},
                completedTicketData:{},
                completedTicketData_update:{},
                completedTicketDataTechRemarks_update:{},
                completedTicketDataTechRemarks:{},
                errors : '',
                infoModal: {
                    id: 'info-modal',
                    title: '',
                    content: ''
                },
                pageOptions: [5, 10, 15, { value: 100, text: "Show a lot" }],
                totalRows: 0,
                currentPage: 1,
                perPage: 10,
                filterOn: [],
                filter: null,
                sortDirection: 'asc',
                sortBy: 'id',
                sortDesc: true,
                selected1: 'None',
                selected2: 'None',
                ratingStatus:'',
                ratingLink:'',
                ratingCSMLink:'',
                internal_external:'',

                fields: [
                    { key: 'id', label: 'ID'},
                    { key: 'type', label: 'Request Type'},
                    // { key: 'priority', label: 'Priority'},
                    { key: 'ifGov', label: 'Client Type'},
                    // { key: 'name', label: 'Client Name'},
                    { key: 'ticket_created', label: 'Date Submitted'},
                    { key: 'status', label: 'Status'},
                    { key: 'actions', label: 'Action' }
                ],
                fields_APPROVED: [
                    { key: 'reference_code', label: 'Reference Code'},
                    { key: 'externalName', label: 'Client Name'},
                    { key: 'ticket_created', label: 'Date Requested'},
                    { key: 'status', label: 'Status'},
                    { key: 'actions', label: 'Details' }
                ],
                fields_internal: [
                    { key: 'reference_code', label: 'Reference Code'},
                    { key: 'ticket_created', label: 'Date Requested'},
                    { key: 'externalName', label: 'Client Name'},
                    { key: 'division_id', label: 'Division'},
                    { key: 'supportType', label: 'Support Type'},
                ],
                fields_external: [
                    { key: 'reference_code', label: 'Reference Code'},
                    { key: 'ticket_created', label: 'Date Submitted'},
                    { key: 'externalName', label: 'Client Name'},
                    { key: 'externalAgency', label: 'Agency'},
                    { key: 'internal_external', label: 'Client Type'},
                    { key: 'supportType', label: 'Support Type'},
                    { key: 'externalOtherType', label: 'Specific Support Type'},
                ],
                fields_external_event: [
                    { key: 'externalEventTitle', label: 'Event Title'},
                    { key: 'externalStartDate', label: 'Start Date'},
                    { key: 'externalEndDate', label: 'End Date'},
                ],
                fields_moreInfo: [
                    { key: 'clientNote', label: ''},
                ],
                fields2: [
                    { key: 'status', label: 'Status'},
                    { key: 'reference_code', label: 'Reference Code'},
                    { key: 'externalName', label: 'Requested By'},
                    { key: 'type', label: 'Request Type'},
                    { key: 'concerned_division', label: 'Concerned Division'},
                    { key: 'concerned_section', label: 'Concerned Section'},
                    { key: 'note', label: 'Concern'},
                ],
                fields3: [
                        { key: 'ticket_created', label: 'Date Submitted'},
                        { key: 'ticket_approved', label: 'Date Approved'},
                ],
                drop_assistedBy: [
                    { value: 'None', text: 'None' },
                    { value: 'Etienne Wayne Amparado', text: 'Amparado, Etienne Wayne ' },
                    { value: 'Mc Gyver Basaya', text: 'Basaya, Mc Gyver' },
                    { value: 'Michael Binondo', text: 'Binondo, Michael' },
                    { value: 'John Michael Cagadas', text: 'Cagadas, John Michael' },
                    { value: 'Chester Francisco', text: 'Francisco, Chester' },
                    { value: 'Jefferson Jalandoon', text: 'Jalandoon, Jefferson' },
                    { value: 'Joram Kate Leonardo', text: 'Leonardo, Joram Kate' },
                    { value: 'Lloyd Mandapat', text: 'Mandapat, Lloyd' },
                    { value: 'Jomar Rabanera', text: 'Rabanera, Jomar' },
                    { value: 'Mark Jayson Sison', text: 'Sison, Mark Jayson' },
                ],
                drop_type: [{ text: '(SELECT HERE)', value: null, disabled: true}, 	'Hardware',
                                                                            'Software'],
                drop_hardware: [{ text: '(SELECT HERE)', value: null, disabled: true }, 	'Troubleshooting',
                                                                            'Evaluation',
                                                                            'Network',
                                                                            'Testing',
                                                                            'Consultation',
                                                                            'Assistance'],
                drop_software: [{ text: '(SELECT HERE)', value: null, disabled: true }, 	'Installation',
                                                                            'Data Retrieval',
                                                                            'Virus/Malwares',
                                                                            'Data Conversion/Uploading/Processing',
                                                                            'Reformat',
                                                                            'Download',
                                                                            'Assistance'],
                options_supportType: [
                    { value: null, text: 'Please select an option', disabled: true },
                    { value: 'Technical Support', text: 'Technical Support' },
                    { value: 'Livestream', text: 'Livestream' },
                    { value: 'IS', text: 'Information System' },
                    { value: 'TWG', text: 'Technical Working Group' }
                ],
                selected: null,
                selected_staff: null,
                options_staff: [
                    { value: null, text: 'Please select staff', disabled: true},
                    { value: 'Etienne Wayne Amparado', text: 'Amparado, Etienne Wayne ' },
                    { value: 'Mc Gyver Basaya', text: 'Basaya, Mc Gyver' },
                    { value: 'Michael Binondo', text: 'Binondo, Michael' },
                    { value: 'John Michael Cagadas', text: 'Cagadas, John Michael' },
                    { value: 'Chester Francisco', text: 'Francisco, Chester' },
                    { value: 'Jefferson Jalandoon', text: 'Jalandoon, Jefferson' },
                    { value: 'Joram Kate Leonardo', text: 'Leonardo, Joram Kate' },
                    { value: 'Lloyd Mandapat', text: 'Mandapat, Lloyd' },
                    { value: 'Jomar Rabanera', text: 'Rabanera, Jomar' },
                    { value: 'Mark Jayson Sison', text: 'Sison, Mark Jayson' },
                ],
                selected_priority:'Low',
                options_priority: [
                    { value: null, text: 'Please select priority level', disabled: true},
                    { value: 'Low', text: 'Low' },
                    { value: 'Medium', text: 'Medium' },
                    { value: 'Urgent', text: 'Urgent' },
                ]

            }
        },
        mounted() {
            this.countData();
            this.loadAllTicketDetails();
        },
        computed: {
            sortOptions() {
                // Create an options list from our fields
                return this.fields
                .filter(f => f.sortable)
                .map(f => {
                    return { text: f.label, value: f.key }
                })
            }
        },
        methods: {
            playAudio() {
                const audio = new Audio('../sound/notif_sound.mp3');
                audio.play().catch(error => {
                    console.error('Audio playback failed:', error);
                });
            },
            initWebSocket(){
                // Create WebSocket connection.
                const socket = new WebSocket("ws://10.10.140.36:6000");

                // Connection opened
                socket.addEventListener("open", (event) => {
                socket.send("Hello Server!");
                });

                // Listen for messages
                socket.addEventListener("message", (event) => {
                    console.log("Message from server ", event.data);
                });
            },
            viewTicketDetails: async function(data) {
                this.assignedTicketData = {...data}

                let govTypeId = this.assignedTicketData.internal_external;

                if (govTypeId == "Internal"){
                    try{
                        const response = await ticket_service.loadTicketDetails(this.assignedTicketData.id);
                        this.ticketDetails = response.data[0];
                    }
                    catch (error){

                    }
                    $('#modalDetails_Internal').modal('show');
                    // this.$refs['showDetails_internal'].show();

                } else if (govTypeId == "External"){
                    try{
                        const response = await ticket_service.loadTicketDetails_external(this.assignedTicketData.id);
                        this.ticketDetails = response.data;
                    }
                    catch (error){

                    }
                    this.$refs['showDetails_external'].show();
                }
            },
            countData: async function() {
                const response_getUserData = await ticket_service.getUserData();
                this.displayName=response_getUserData.data.user.name;
                try{
                    const total1 = await ticket_service.countNew_All();

                    const aa = await ticket_service.countStaffTickets_PerStatus(this.displayName)

                    this.totalStaff = aa.data;
                    this.totalNew = total1.data;

                    if (this.totalNew === 0){
                        console.log("No New Ticket");
                    }
                    else{
                        this.playAudio();
                    }

                } catch(error) {
                    this.flashMessage.error({
                    message: 'Some error occured! Please try again.',
                    time: 5000
                    });
                }
            },
            loadAllTicketDetails: async function() {

                const response_getUserData = await ticket_service.getUserData();

                this.displayName=response_getUserData.data.user.name;

                let name = this.displayName;
                const response_name = await ticket_service.setName(name);

                try{
                    const response_set_refCode = await ticket_service.setDisplayName(response_name.data);
                    const response = await ticket_service.loadTicketDetails_New();
                    this.ticket = response.data;
                    this.totalRows = this.ticket.length;
                } catch(error) {
                    this.flashMessage.error({
                    message: 'Some error occured! Please try again.',
                    time: 5000
                    });
                }
            },
            assignTicket: async function(data) {
                this.assignedTicketData = {...data}
                let govTypeId = this.assignedTicketData.internal_external;

                if (govTypeId == "Internal"){
                    try{
                        const response = await ticket_service.loadTicketDetails(this.assignedTicketData.id);
                        this.ticketDetails = response.data[0];
                        console.log("AAA");
                        console.log(this.ticketDetails);
                    }
                    catch (error){

                    }
                    // this.$refs['assignModalForm_internal'].show();
                    $('#assignModalForm_internal').modal('show');

                } else if (govTypeId == "External"){
                    try{
                        const response = await ticket_service.loadTicketDetails_external(this.assignedTicketData.id);
                        this.ticketDetails = response.data[0];
                    }
                    catch (error){

                    }
                    this.$refs['assignModalForm_external'].show();
                }

            },
            assignStaff: async function(){
                const date = new Date();
                const months = [
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December'
                    ];
                const monthIndex = date.getMonth()
                const monthName = months[monthIndex]
                let currentDay= String(date.getDate()).padStart(2, '0');
                let currentYear = date.getFullYear();
                let getHours = date.getHours();
                let getMinutes = date.getMinutes();
                let getSeconds = date.getSeconds();
                // Check whether AM or PM
                let newformat = getHours >= 12 ? 'PM' : 'AM';
                // Find current hour in AM-PM Format
                getHours = getHours % 12;
                // To display "0" as "12"
                getHours = getHours ? getHours : 12;
                getMinutes = getMinutes < 10 ? '0' + getMinutes : getMinutes;
                let date_ticketCreatedComplete = monthName + " " + currentDay + " " + currentYear + " " + getHours + ":" + getMinutes + " " + newformat;

                const response_getUserData = await ticket_service.getUserData();
                this.displayName=response_getUserData.data.user.name;

                try {

                    let formData = new FormData();
                    formData.append('reference_code', this.assignedTicketData.reference_code);
                    formData.append('approved_by', this.displayName);
                    formData.append('assignedStaff', this.selected_staff);
                    formData.append('priority', this.selected_priority);
                    formData.append('ticket_approved', date_ticketCreatedComplete);
                    formData.append('ticket_updated', date_ticketCreatedComplete);
                    formData.append('status', 'Approved');

                    const response = await ticket_service.updatePending(this.assignedTicketData.id, formData);



                    let formData_Ticket = new FormData();
                    formData_Ticket.append('supportType', this.assignedTicketData.supportType);

                    const response_Ticket = await ticket_service.updatePending_Ticket(this.assignedTicketData.id, formData_Ticket);



                } catch (error) {
                    this.flashMessage.warning({
                        message: 'Please fill out the form!'
                    });
                }

                let username = this.selected_staff;
                let activity_id = 4;
                let activity_date = date_ticketCreatedComplete;
                let ticket_id = this.assignedTicketData.reference_code;

                let formData_activityLog = new FormData();
                formData_activityLog.append('username', username);
                formData_activityLog.append('activity_id', activity_id);
                formData_activityLog.append('activity_date', activity_date);
                formData_activityLog.append('ticket_id', ticket_id);
                const response_activityLog = await ticket_service.addActivityLog(formData_activityLog);


                this.loadAllTicketDetails();
                this.countData();

                this.flashMessage.success({
                        message: 'Ticket Assigned Successfully!'
                });
                $('#assignModalForm_internal').modal('hide');
                this.selected_staff = null;
                // window.location.reload();
            },
        }
    }

</script>



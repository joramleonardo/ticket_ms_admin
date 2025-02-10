<template>
    <div>
        <div class="main-menu-area mg-tb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                            <li class="active">
                                <router-link to="/ticket/admin/dashboard">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                    Dashboard
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/ticket/admin/newtickets">
                                    <i class="fa fa-bell" aria-hidden="true"></i>
                                    New Tickets
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/ticket/admin/mytickets">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    My Ticket
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
                            <li>
                                <router-link to="/ticket/admin/create">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                    Create Ticket
                                    <span v-if="this.totalStaff.total_Pending != '0'">
                                        <div class="spinner4 spinner-4"></div>
                                        <div class="ntd-ctn">
                                            <span>{{this.totalStaff.total_Pending}}</span>
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
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                        </div>
                                        <div class="breadcomb-ctn">
                                            <h2>Dashboard</h2>
                                            <p style="font-size: 12px;">Home> <span class="bread-ntd">Dashboard</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="notika-status-area" style="margin-bottom: 30px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                            <div class="website-traffic-ctn">
                                <h2><span class="counter">{{this.totalNew}}</span></h2>
                                <p>Total New Tickets</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                            <div class="website-traffic-ctn">
                                <h2><span class="counter">{{this.total.total_Pending}}</span></h2>
                                <p>Total Assigned Tickets</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                            <div class="website-traffic-ctn">
                                <h2><span class="counter">{{this.total.total_InProgress}}</span></h2>
                                <p>Total In Progress Tickets</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                            <div class="website-traffic-ctn">
                                <h2><span class="counter">{{this.total.total_Completed}}</span></h2>
                                <p>Total Completed Tickets</p>
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
                                            <b-table striped hover
                                            :items="ticketSummary"
                                            :fields="fields_ticketSummary"
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
                                                    <div v-if="row.item.status === 'Approved'">
                                                        <b-badge class="mr-1 badge" style="background-color: #f0ad4e;">PENDING</b-badge>
                                                    </div>
                                                    <div v-if="row.item.status === 'In Progress'">
                                                        <b-badge class="mr-1 badge" style="background-color: #5cb85c;">IN PROGRESS</b-badge>
                                                    </div>
                                                    <div v-if="row.item.status === 'Completed'">
                                                        <b-badge class="mr-1 badge" style="background-color: #5bc0de;">COMPLETED</b-badge>
                                                    </div>
                                                </template>
                                                <template #cell(actions)="row">
                                                    <div v-if="row.item.status === 'Approved'">
                                                        <button @click="setStatus(row.item, row.index, $event.target)" class="btn btn-warning notika-btn-warning">Attend Ticket</button>

                                                    </div>
                                                    <div v-if="row.item.status === 'In Progress'">
                                                        <button @click="completeTicket(row.item, row.index, $event.target)" class="btn btn-success notika-btn-success">Mark Complete</button>
                                                        <button @click="addRemarksModal(row.item, row.index, $event.target)" class="btn btn-danger notika-btn-danger">Add Remarks</button>
                                                    </div>
                                                    <div v-if="row.item.status === 'Completed'">
                                                        <button @click="viewRating(row.item, row.index, $event.target)" class="btn btn-info notika-btn-info">Submit Rating</button>
                                                    </div>

                                                </template>
                                                <template #cell(details)="row">
                                                    <button @click="viewTicketDetails(row.item, row.index, $event.target)" class="btn btn-primary notika-btn-primary" >View Details</button>
                                                </template>
                                            </b-table>
                                </b-container>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>


<script>
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
                ticketSummary:[],
                fields_ticketSummary: [
                    { key: 'assignedStaff', label: 'Name'},
                    { key: 'pending_count', label: 'Total Pending Tickets' },
                    { key: 'in_progress_count', label: 'Total In Progress Tickets' },
                    { key: 'completed_count', label: 'Total Completed Tickets'},
                ],
                pageOptions: [5, 10, 15, { value: 100, text: "Show a lot" }],
                totalRows: 0,
                currentPage: 1,
                perPage: 15,
                filterOn: [],
                filter: null,
                sortDirection: 'asc',
                sortBy: 'id',
                sortDesc: true,
            }
        },
        mounted() {
            this.countData();
        },
        methods: {
            // playAudio() {
            //     const audio = new Audio('../sound/notif_sound.mp3');
            //     audio.play().catch(error => {
            //         console.error('Audio playback failed:', error);
            //     });
            // },

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

            countData: async function() {
                const response_getUserData = await ticket_service.getUserData();
                this.displayName=response_getUserData.data.user.name;
                try{
                    const total1 = await ticket_service.countNew_All();

                    const aa = await ticket_service.countStaffTickets_PerStatus(this.displayName)
                    const bb = await ticket_service.countTickets_PerStatus(this.displayName)

                    this.totalStaff = aa.data;
                    this.total = bb.data;
                    this.totalNew = total1.data;

                    const dd = await ticket_service.countTickets_Status_Staff()
                    this.ticketSummary = dd.data;
                    console.log("hello");
                    console.log(this.ticketSummary);




                } catch(error) {
                    this.flashMessage.error({
                    message: 'Some error occured! Please try again.',
                    time: 5000
                    });
                }
            }

        }
    }

</script>



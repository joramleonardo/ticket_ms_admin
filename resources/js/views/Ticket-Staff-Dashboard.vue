<template>
    <div>
        <div class="main-menu-area mg-tb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                            <li class="active">
                                <router-link to="/ticket/staff/dashboard">
                                    <i class="notika-icon notika-house"></i>
                                    Dashboard
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/ticket/staff/mytickets">
                                    <i class="notika-icon notika-form"></i>
                                    My Ticket
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/ticket/staff/create">
                                    <i class="notika-icon notika-edit"></i>
                                    Create Ticket

                                        <span v-if="this.totalStaff.total_Pending === '0'">

                                        </span>
                                        <span v-else>
                                            <div class="spinner4 spinner-4"></div>
                                            <div class="ntd-ctn">
                                                <span>{{this.totalStaff.total_Pending}}</span>
                                            </div>
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
                                            <i class="notika-icon notika-house"></i>
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

    </div>
</template>


<script>
    import * as ticket_service from '../services/ticket_service';

    export default {
        name: 'employee',
        data() {
            return {
                totalNew: 0,
                name: '',
                thisAudio: '',
                total: '',
                totalStaff: ''
                }
        },
        mounted() {
            this.countData();
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
            }

        }
    }

</script>



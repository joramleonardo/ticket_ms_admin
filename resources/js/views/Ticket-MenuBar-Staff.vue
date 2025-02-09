<template>
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li class="active">
                            <a data-toggle="tab" href="#Home">
                                <i class="notika-icon notika-house"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#manageTicket">
                                <i class="notika-icon notika-form"></i>
                                Manage Ticket
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#createTicket">
                                <i class="notika-icon notika-edit"></i>
                                Create Ticket
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="Home" class="tab-pane active in notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <router-link to="/ticket/staff/dashboard">
                                        My Dashboard
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                        <div id="manageTicket" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro notika-main-menu-dropdown">

                                <li class="active">
                                    <router-link to="/ticket/staff/mytickets">
                                        My Tickets
                                    </router-link>
                                </li>
                                <li>
                                    <a data-toggle="tab" >
                                        <!-- <div class="spinner4 spinner-4"></div>
                                        <div class="ntd-ctn">
                                            <span>{{this.total.total_Pending}}</span>
                                        </div> -->

                                        <span v-if="this.totalStaff.total_Pending === '0'">

                                        </span>
                                        <span v-else>
                                            <div class="spinner4 spinner-4"></div>
                                            <div class="ntd-ctn">
                                                <span>{{this.totalStaff.total_Pending}}</span>
                                            </div>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div id="createTicket" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="animations.html">DOST-STII Employee</a>
                                </li>
                                <li>
                                    <a href="google-map.html">STARBOOKS</a>
                                </li>
                                <li>
                                    <a href="data-map.html">Other Agency</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Menu area End-->
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
                    console.log("HELLOOOOOO");
                    console.log(aa.data);
                    console.log(aa.data.total_Completed);

                    this.total = aa.data;
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

<template>
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <!-- <div class="logo-area">
                        <a href="#"><img src="img/logo/logo.png" alt="" /></a>
                    </div> -->
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">

                            <li class="nav-item nc-al">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                    <span>
                                        <i class="fa fa-bell" aria-hidden="true"></i>
                                        <span style="font-size: 12px;">Tickets</span>
                                    </span>

                                </a>
                                <div role="menu" class="dropdown-menu message-dd notification-dd animated zoomIn">

                                    <span v-if="this.totalNew != '0'">
                                            <div class="hd-mg-tt">
                                                <h2>New Tickets</h2>
                                            </div>
                                            <div class="hd-mg-va">
                                                <router-link to="/ticket/sa/newtickets">
                                                    View All
                                                </router-link>
                                            </div>
                                    </span>
                                    <span v-else>
                                        <div class="hd-mg-tt">
                                            <h2>No New Tickets</h2>
                                        </div>
                                    </span>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                    <span>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span style="font-size: 12px;">{{this.displayName}}</span>
                                    </span>

                                    <span v-if="this.totalNew != '0'">
                                            <div class="spinner4 spinner-4"></div>
                                            <div class="ntd-ctn">
                                                <span>{{this.totalNew}}</span>
                                            </div>
                                    </span>
                                    <span v-else>
                                    </span>
                                </a>
                                <div role="menu" class="dropdown-menu message-dd task-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>Profile</h2>
                                    </div>
                                    <div class="hd-mg-va">
                                        <router-link to="/login">
                                            Logout
                                        </router-link>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
</template>

<script>
    import * as ticket_service from '../services/ticket_service';

    export default {
        data(){
            return {
                isLoggedIn: false,
                ticketData_update:{
                    reference_code:''
                },
                displayName: '',
                totalNew: 0,
                name: '',
                thisAudio: '',
                total: '',
                totalStaff: '',
                userRole: ''
            }
        },
        mounted(){
            this.loadEmployees();
            this.countData();
        },
        methods:{
            loadEmployees: async function(){
                try{
                    const response = await ticket_service.getUserData();
                    this.userRole = response.data.user.role;
                    this.displayName=response.data.user.name;
                } catch(error) {
                    this.flashMessage.error({
                    message: 'Some error occured! Please try again.',
                    time: 5000
                    });
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

                }
            }
        }

    }
</script>

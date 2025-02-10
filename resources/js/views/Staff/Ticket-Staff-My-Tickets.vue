<template>
    <div>
        <div class="main-menu-area mg-tb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                            <li>
                                <router-link to="/ticket/staff/dashboard">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                    Dashboard
                                </router-link>
                            </li>
                            <li class="active">
                                <router-link to="/ticket/staff/mytickets">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    My Ticket
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/ticket/staff/create">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
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
                                            <i class="fa fa-list" aria-hidden="true"></i>
                                        </div>
                                        <div class="breadcomb-ctn">
                                            <h2>My Ticket</h2>
                                            <p style="font-size: 12px;">Home> <span class="bread-ntd">My Ticket</span></p>
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
                                <h2><span class="counter">{{this.totalStaff.total_Pending}}</span></h2>
                                <p>My Pending Tickets</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                            <div class="website-traffic-ctn">
                                <h2><span class="counter">{{this.totalStaff.total_InProgress}}</span></h2>
                                <p>My In Progress Tickets</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                            <div class="website-traffic-ctn">
                                <h2><span class="counter">{{this.totalStaff.total_Completed}}</span></h2>
                                <p>My Completed Tickets</p>
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

        <div class="modal fade" id="modalDetails_Internal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h1>TICKET DETAILS</h1>
                        <br>
                        <div class="past-statistic-ctn">
                            <h3>Reference Code:</h3>
                            <p>{{ticketDetails.reference_code}}</p>
                            <h3>Client Name:</h3>
                            <p>{{ticketDetails.externalName}}</p>
                            <h3>Date Requested:</h3>
                            <p>{{ticketDetails.ticket_created}}</p>
                            <h3>Support Type:</h3>
                            <p>{{ticketDetails.supportType}}</p>
                        </div>




                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDetails_rating" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h1>RATING DETAILS</h1>
                        <br>
                        <div class="past-statistic-ctn">
                            <h3>Status:</h3>
                            <p>{{this.ratingStatus}}</p>
                            <br>
                            <h3>Link:</h3>
                            <p>
                                <button @click="copyRatingLink" >
                                    Copy
                                </button>
                            </p>
                            <br>
                            <h3>CSM Form:</h3>
                            <p>
                                <button @click="copyCSMLink" >
                                    Copy
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="assignModalForm_1" role="dialog">
            <div class="modal-dialog modal-large">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h2>Please fill out this form to mark the ticket as complete.</h2>
                        <br>
                        <form class="loginForm" id="loginForm" v-on:submit.prevent="assignStaff_1">
                            <div class="">
                                <div class="">
                                    <div class="row">
                                        <div style="margin-botton: 15px">
                                            <span style="font-size: 12px; color: red; font-style: italic; ">* Required Fields</span>
                                        </div>
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group" id="form_ITURequestType_internal">
                                                <label for="supportType" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Request Type:</label>
                                                <select required  @change="switchSelect_ITURequestType($event)" v-model="completedTicketData_update.supportType">
                                                    <option value="" disabled>Select here</option>
                                                    <option value="Livestream">Livestream</option>
                                                    <option value="Other">Other..</option>
                                                </select>
                                            </b-form-group>
                                        </div>
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group">
                                                <label for="mode" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Mode:</label>
                                                <select required v-model="completedTicketData.mode" id="mode" name="mode">
                                                    <option value="" disabled>Select here</option>
                                                    <option value="Service Form">Service Form</option>
                                                    <option value="Online Form">Online Form</option>
                                                </select>
                                            </b-form-group>
                                        </div>
                                    </div>
                                    <b-form-group class="group" id="form_RequestTypeOther">
                                        <label for="externalOtherType" class="label" style="color:black; font-weight: bold">Specific Request:</label>
                                        <b-form-input v-model="completedTicketData_update.externalOtherType" id="externalOtherType" type="text" class="input" style="background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                    </b-form-group>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group" id="optionAssistedBy">
                                                <label required for="assisted_by_1" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Assisted by:<span style="font-style: italic; font-size: 10px; text-transform: none;">  (Please select below... )</span></label>
                                                <b-form-select style="background-color: rgb(239 239 239);" :options="drop_assistedBy"  id="assisted_by_1" v-model="selected1"></b-form-select>
                                            </b-form-group>
                                        </div>
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group">
                                            <b-form-group class="group" id="optionAssistedBy">
                                                <label required for="assisted_by_2" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Assisted by:<span style="font-style: italic; font-size: 10px; text-transform: none;">  (Please select below... )</span></label>
                                                <b-form-select style="background-color: rgb(239 239 239);" :options="drop_assistedBy"  id="assisted_by_2" v-model="selected2"></b-form-select>
                                            </b-form-group>
                                            </b-form-group>
                                        </div>
                                    </div>



                                    <!-- <b-form-group class="group" id="groupProblem_that_needed_support" style="display:none">
                                        <label for="problem_that_needed_support" class="label" style="color:black; font-weight: bold">Describe the problem that needed support</label>
                                        <b-form-textarea id="problem_that_needed_support"  v-model="completedTicketData.problem_that_needed_support" placeholder="Enter remarks here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                    </b-form-group> -->
                                    <b-form-group class="group" id="groupProblem_that_needed_support">
                                        <label for="problem_that_needed_support" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Describe the problem that needed support:</label>
                                        <b-form-textarea id="problem_that_needed_support"  v-model="completedTicketData_update.clientNote" placeholder="Enter here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                    </b-form-group>
                                    <b-form-group class="group" id="groupActions_taken">
                                        <label for="actions_taken" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Describe actions taken:</label>
                                        <b-form-textarea id="actions_taken"  v-model="completedTicketData.actions_taken" placeholder="Enter here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                    </b-form-group>
                                    <b-form-group class="group" id="groupRemarks">
                                        <label for="remarks" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>REMARKS:</label>
                                        <b-form-textarea id="remarks"  v-model="completedTicketData.remarks" placeholder="Enter here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                    </b-form-group>
                                    <b-form-group class="group" id="form_ITURequestType_internal">
                                        <label for="type" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Type:<span style="font-style: italic; font-size: 10px; text-transform: none"></span></label>
                                        <select required v-model="completedTicketData.type" id="type" name="type">
                                            <option value="" disabled>Select here</option>
                                            <option value="PC Setup & Troubleshooting">PC Setup & Troubleshooting</option>
                                            <option value="Network related">Network related</option>
                                            <option value="Printer related">Printer related</option>
                                            <option value="Zoom related">Zoom related</option>
                                            <option value="Website related">Website related</option>
                                            <option value="STARBOOKS related">STARBOOKS related</option>
                                            <option value="Installation related">Installation related</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </b-form-group>
                                </div>
                            </div>
                            <b-form-group class="group" style="margin-top: 50px">
                                <b-button type="submit" class="tab button" style="background-color: #1161ee !important;" variant="outline-success">Submit</b-button>
                            </b-form-group>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="assignModalForm_2" role="dialog">
            <div class="modal-dialog modal-large">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h2>Please fill out this form to mark the ticket as complete.</h2>
                        <br>
                        <form class="loginForm" id="loginForm" v-on:submit.prevent="assignStaff_2">
                            <div class="">
                            <div class="">
                                <b-form-group class="group">
                                    <label for="type" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Select Nature of Support<span style="font-style: italic; font-size: 10px; text-transform: none"></span></label>
                                    <select required @change="switchSelect_Division($event)" id="natureOfSupport" v-model="completedTicketData.natureOfSupport">
                                        <option value="" disabled>Choose</option>
                                        <option value="Hardware">Hardware</option>
                                        <option value="Software">Software</option>
                                        <option value="Hardware and Software">Hardware and Software</option>
                                        <option value="System update / development">System update / development</option>
                                        <option value="NA">NA</option>
                                    </select>
                                </b-form-group>
                                <b-form-group class="group" id="optionHardware" style="display:none">
                                    <label for="type" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Hardware:<span style="font-style: italic; font-size: 10px; text-transform: none;">  (Please select below... )</span></label>
                                    <b-form-select style="background-color: rgb(239 239 239);" :options="drop_hardware" id="supportType_hardware" v-model="completedTicketData.supportType_hardware"></b-form-select>
                                </b-form-group>
                                <b-form-group class="group" id="optionSoftware" style="display:none">
                                    <label for="type" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Software:<span style="font-style: italic; font-size: 10px; text-transform: none;">  (Please select below... )</span></label>
                                    <b-form-select style="background-color: rgb(239 239 239);" :options="drop_software"  id="supportType_software" v-model="completedTicketData.supportType_software"></b-form-select>
                                </b-form-group>
                                        <b-form-group class="group" id="form_ITURequestType_internal">
                                            <label for="supportType" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Request Type:<span style="font-style: italic; font-size: 10px; text-transform: none"></span></label>
                                            <select required v-model="completedTicketData.supportType" id="supportType" name="supportType">
                                                <option value="" disabled>Select here</option>
                                                <option value="Livestream">Livestream</option>
                                                <option value="Technical Support">Technical Support</option>
                                                <option value="IS">Information System</option>
                                                <option value="TWG">TWG</option>
                                            </select>
                                        </b-form-group>
                                        <b-form-group class="group">
                                            <label for="mode" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Mode:<span style="font-style: italic; font-size: 10px; text-transform: none"></span></label>
                                            <select required v-model="completedTicketData.mode" id="mode" name="mode">
                                                <option value="" disabled>Select here</option>
                                                <option value="Service Form">Service Form</option>
                                                <option value="Online Form">Online Form</option>
                                            </select>
                                        </b-form-group>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 mb-0">
                                        <b-form-group class="group" id="optionAssistedBy">
                                            <label required for="assisted_by_1" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Assisted by:<span style="font-style: italic; font-size: 10px; text-transform: none;">  (Please select below... )</span></label>
                                            <b-form-select style="background-color: rgb(239 239 239);" :options="drop_assistedBy"  id="assisted_by_1" v-model="selected1"></b-form-select>

                                        </b-form-group>
                                    </div>
                                    <div class="col-md-6 col-lg-6 mb-0">
                                        <b-form-group class="group">
                                        <b-form-group class="group" id="optionAssistedBy">
                                            <label required for="assisted_by_2" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Assisted by:<span style="font-style: italic; font-size: 10px; text-transform: none;">  (Please select below... )</span></label>
                                            <b-form-select style="background-color: rgb(239 239 239);" :options="drop_assistedBy"  id="assisted_by_2" v-model="selected2"></b-form-select>

                                        </b-form-group>
                                        </b-form-group>
                                    </div>
                                </div>
                                <!-- <b-form-group class="group" id="groupProblem_that_needed_support" style="display:none">
                                    <label for="problem_that_needed_support" class="label" style="color:black; font-weight: bold">Describe the problem that needed support</label>
                                    <b-form-textarea id="problem_that_needed_support"  v-model="completedTicketData.problem_that_needed_support" placeholder="Enter remarks here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                </b-form-group> -->
                                <b-form-group class="group" id="groupProblem_that_needed_support">
                                    <label for="problem_that_needed_support" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Describe the problem that needed support</label>
                                    <b-form-textarea required id="problem_that_needed_support"  v-model="completedTicketData_update.clientNote" placeholder="Enter here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                </b-form-group>
                                <b-form-group class="group" id="groupActions_taken">
                                    <label for="actions_taken" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Describe actions taken</label>
                                    <b-form-textarea required id="actions_taken"  v-model="completedTicketData.actions_taken" placeholder="Enter here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                </b-form-group>
                                <b-form-group class="group" id="groupRemarks">
                                    <label for="remarks" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>REMARKS/RECOMMENDATION</label>
                                    <b-form-textarea required id="remarks"  v-model="completedTicketData.remarks" placeholder="Enter here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                </b-form-group>
                                <b-form-group class="group" id="form_ITURequestType_internal">
                                    <label for="type" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Type:<span style="font-style: italic; font-size: 10px; text-transform: none"></span></label>
                                    <select required v-model="completedTicketData.type" id="type" name="type">
                                        <option value="" disabled>Select here</option>
                                        <option value="PC Setup & Troubleshooting">PC Setup & Troubleshooting</option>
                                        <option value="Network related">Network related</option>
                                        <option value="Printer related">Printer related</option>
                                        <option value="Zoom related">Zoom related</option>
                                        <option value="Website related">Website related</option>
                                        <option value="STARBOOKS related">STARBOOKS related</option>
                                        <option value="Installation related">Installation related</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </b-form-group>
                            </div>
                            </div>
                            <b-form-group class="group" style="margin-top: 50px">
                                <b-button type="submit" class="tab button" style="background-color: #1161ee !important;" variant="outline-success">Submit</b-button>
                            </b-form-group>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addRemarksModalForm" role="dialog">
            <div class="modal-dialog modal-large">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h2>Leave a message/remark for client here.</h2>
                        <br>
                        <form class="loginForm" id="loginForm" v-on:submit.prevent="addRemarks">
                            <div class="">
                                <div class="">
                                    <b-form-group class="group" id="groupRemarks">
                                        <label for="remarks" class="label" style="color:black; font-weight: bold">Leave a note here</label>
                                        <b-form-textarea id="tech_remarks"  v-model="completedTicketDataTechRemarks.tech_remarks" placeholder="Enter remarks here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                    </b-form-group>
                                </div>
                            </div>
                            <b-form-group class="group" style="margin-top: 50px">
                                <b-button type="submit" class="tab button" style="background-color: #1161ee !important;" variant="outline-success">Submit</b-button>
                            </b-form-group>
                        </form>
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

                    // { key: 'supportType', label: 'Support Type'},
                    { key: 'status', label: 'Status'},

                    { key: 'details', label: 'Details'},
                    { key: 'actions', label: 'Action' }
                ],
                fields_internal: [
                    { key: 'reference_code', label: 'Reference Code'},
                    { key: 'ticket_created', label: 'Date Submitted'},
                    { key: 'externalName', label: 'Client Name'},
                    { key: 'division_id', label: 'Division'},
                    { key: 'internal_external', label: 'Client Type'},
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
            countData: async function() {
                const response_getUserData = await ticket_service.getUserData();
                this.displayName=response_getUserData.data.user.name;
                try{
                    const total1 = await ticket_service.countNew_All();

                    const aa = await ticket_service.countStaffTickets_PerStatus(this.displayName)

                    this.totalStaff = aa.data;
                    this.totalNew = total1.data;
                    console.log(this.totalNew);

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
            viewTicketDetails: async function(data) {
                this.assignedTicketData = {...data}

                let govTypeId = this.assignedTicketData.internal_external;

                if (govTypeId == "Internal"){
                    try{
                        const response = await ticket_service.loadTicketDetails(this.assignedTicketData.id);
                        this.ticketDetails = response.data[0];
                        console.log("AAAA");
                        console.log(this.ticketDetails);
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
            viewRating: async function(data) {
                this.assignedTicketData = {...data}

                this.ratingStatus = this.assignedTicketData.rating_status;
                this.ratingLink = "http://127.0.0.1:8000/#/" + "rating/" + this.assignedTicketData.id;


            this.internal_external = this.assignedTicketData.internal_external;

            if (this.internal_external === "Internal"){

                const date = new Date(this.assignedTicketData.date1);
                let currentDay= String(date.getDate()).padStart(2, '0');
                let currentMonth = String(date.getMonth()+1).padStart(2,"0");
                let currentYear = date.getFullYear();
                let currentDateTime = currentYear + "-" + currentMonth + "-" + currentDay;

                const date2 = new Date(this.assignedTicketData.date1);
                let currentDay2 = String(date.getDate()).padStart(2, '0');
                let currentMonth2 = String(date.getMonth()+1).padStart(2,"0");
                let currentYear2 = date.getFullYear();
                let currentDateTime2 = currentYear2 + "-" + currentMonth2 + "-" + currentDay2;

                let a1 = "Government (Employee or another agency)".replaceAll(" ", "+");
                let a2 = "National Capital Region (NCR)".replaceAll(" ", "+");
                let a3 = "Technical Support Services".replaceAll(" ", "+");
                let a4 = "Gobyerno (Empleyado o Ahensya)".replaceAll(" ", "+");
                let a5 = this.assignedTicketData.reference_code.replaceAll(" ", "+");
                let a6 = this.assignedTicketData.externalName.replaceAll(" ", "+");
                let a7 = this.assignedTicketData.empEmail.replaceAll(" ", "+");
                let a8 = this.assignedTicketData.empDiv.replaceAll(" ", "+");
                let a9 = currentDateTime; // request date
                let a10 = currentDateTime2; // completed date
                let a11 = this.assignedTicketData.clientNote.replaceAll(" ", "+");
                let a12 = this.assignedTicketData.actions_taken.replaceAll(" ", "+");
                let a13 = this.assignedTicketData.natureOfSupport.replaceAll(" ", "+");
                let a14 = this.assignedTicketData.attended_by.replaceAll(" ", "+");
                let a15 = this.assignedTicketData.remarks.replaceAll(" ", "+");
                let a16 = this.assignedTicketData.assisted_by_1.replaceAll(" ", "+");

                this.ratingCSMLink = "https://docs.google.com/forms/d/e/1FAIpQLSfda5Huf3g5zB5kIoemYLrM-SPR41VmTYRQ2gyeGwaeTtXPsg/viewform?usp=pp_url"
                + "&entry.1725600=" + "0"
                + "&entry.1819805617=" + "0"
                + "&entry.298800992=" + a5
                + "&entry.855472974=" + a6
                + "&entry.738949883=" + a9
                + "&entry.2079193609=" + a10
                + "&entry.1449935561=" + a5
                + "&entry.1990048049=" + a6
                + "&entry.249930846=" + a9
                + "&entry.1821298=" + a10;


            }

            else if (this.internal_external === "External"){

                const date = new Date(this.assignedTicketData.date1);
                let currentDay= String(date.getDate()).padStart(2, '0');
                let currentMonth = String(date.getMonth()+1).padStart(2,"0");
                let currentYear = date.getFullYear();
                let currentDateTime = currentYear + "-" + currentMonth + "-" + currentDay;

                const date2 = new Date(this.assignedTicketData.date2);
                let currentDay2 = String(date2.getDate()).padStart(2, '0');
                let currentMonth2 = String(date2.getMonth()+1).padStart(2,"0");
                let currentYear2 = date2.getFullYear();
                let currentDateTime2 = currentYear2 + "-" + currentMonth2 + "-" + currentDay2;

                console.log("this is external");
                let a1 = "Government (Employee or another agency)".replaceAll(" ", "+");
                let a2 = "National Capital Region (NCR)".replaceAll(" ", "+");
                let a3 = "Technical Support Services".replaceAll(" ", "+");
                let a4 = "Gobyerno (Empleyado o Ahensya)".replaceAll(" ", "+");
                let a5 = this.assignedTicketData.reference_code.replaceAll(" ", "+"); //reference code
                let a6 = this.assignedTicketData.externalName.replaceAll(" ", "+"); //client name
                let a7 = this.assignedTicketData.externalAgency.replaceAll(" ", "+"); //external Agency
                let a8 = currentDateTime; // request date
                let a9 = currentDateTime2; // completed date
                let a10 = this.assignedTicketData.clientNote.replaceAll(" ", "+");
                let a11 = this.assignedTicketData.actions_taken.replaceAll(" ", "+");
                let a12 = this.assignedTicketData.supportType.replaceAll(" ", "+");
                let a13 = this.assignedTicketData.externalOtherType_.replaceAll(" ", "+");
                let a14 = this.assignedTicketData.attended_by.replaceAll(" ", "+");
                let a15 = this.assignedTicketData.remarks.replaceAll(" ", "+");
                let a16 = this.assignedTicketData.assisted_by_1.replaceAll(" ", "+");

                this.ratingCSMLink = "https://docs.google.com/forms/d/e/1FAIpQLSdG0armoL-XLSz6T2BpXJ_JUMU1tg-NDxaf40q6qgpsMmJjhg/viewform?usp=pp_url"
                + "&entry.478303025=" + a6
                + "&entry.1637951943=" + a5
                + "&entry.292814853=" + a7
                + "&entry.1555563534=" + a8
                + "&entry.1650701328=" + a9;

            }

            console.log(this.ratingLink);
            console.log(this.ratingCSMLink);

                $('#modalDetails_rating').modal('show');

            },
            switchSelect_ITURequestType(event) {
                this.selected = event.target.value;
                if(this.selected == "Other"){
                    document.getElementById("form_RequestTypeOther").style.display = "block";
                }
                else if(this.selected == "Livestream"){
                    document.getElementById("form_RequestTypeOther").style.display = "none";
                }
                else if(this.selected == "Technical Support"){
                    document.getElementById("form_RequestTypeOther").style.display = "none";
                }
                else if(this.selected == "Information System"){
                    document.getElementById("form_RequestTypeOther").style.display = "none";
                }
                else if(this.selected == "TWG"){
                    document.getElementById("form_RequestTypeOther").style.display = "none";
                }
            },
            switchSelect_Division(event) {
                this.selected = event.target.value;
                if(this.selected == "Software"){
                    document.getElementById("optionSoftware").style.display = "block";
                    document.getElementById("optionHardware").style.display = "none";
                    document.getElementById("optionAssistedBy").style.display = "block";
                    document.getElementById("groupProblem_that_needed_support").style.display = "block";
                    document.getElementById("groupActions_taken").style.display = "block";
                    document.getElementById("groupRemarks").style.display = "block";
                }
                else if(this.selected == "Hardware"){
                    document.getElementById("optionSoftware").style.display = "none";
                    document.getElementById("optionHardware").style.display = "block";
                    document.getElementById("optionAssistedBy").style.display = "block";
                    document.getElementById("groupProblem_that_needed_support").style.display = "block";
                    document.getElementById("groupActions_taken").style.display = "block";
                    document.getElementById("groupRemarks").style.display = "block";
                }
                else if(this.selected == "Hardware and Software"){
                    document.getElementById("optionSoftware").style.display = "block";
                    document.getElementById("optionHardware").style.display = "block";
                    document.getElementById("optionAssistedBy").style.display = "block";
                    document.getElementById("groupProblem_that_needed_support").style.display = "block";
                    document.getElementById("groupActions_taken").style.display = "block";
                    document.getElementById("groupRemarks").style.display = "block";
                }
                else if(this.selected == "NA"){
                    document.getElementById("optionSoftware").style.display = "none";
                    document.getElementById("optionHardware").style.display = "none";
                    document.getElementById("optionAssistedBy").style.display = "block";
                    document.getElementById("groupProblem_that_needed_support").style.display = "block";
                    document.getElementById("groupActions_taken").style.display = "block";
                    document.getElementById("groupRemarks").style.display = "block";
                }
                else if(this.selected == "System update / development"){
                    document.getElementById("optionSoftware").style.display = "none";
                    document.getElementById("optionHardware").style.display = "none";
                    document.getElementById("optionAssistedBy").style.display = "block";
                    document.getElementById("groupProblem_that_needed_support").style.display = "block";
                    document.getElementById("groupActions_taken").style.display = "block";
                    document.getElementById("groupRemarks").style.display = "block";
                }
            },
            loadAllTicketDetails: async function() {

                const response_getUserData = await ticket_service.getUserData();

                this.displayName=response_getUserData.data.user.name;

                let name = this.displayName;
                const response_name = await ticket_service.setName(name);

                try{
                    const response_set_refCode = await ticket_service.setDisplayName(response_name.data);
                    const response = await ticket_service.getAllTicketDetails_Assigned(response_name.data);
                    this.ticket = response.data;
                    this.totalRows = this.ticket.length;
                } catch(error) {
                    this.flashMessage.error({
                    message: 'Some error occured! Please try again.',
                    time: 5000
                    });
                }
            },
            setStatus: async function(data) {

                var ticket_data = {...data}

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
                let date_ticketCreated = monthName + " " + currentDay + " " + currentYear + " " + getHours + ":" + getMinutes + " " + newformat;

                const response_getUserData = await ticket_service.getUserData();

                this.displayName=response_getUserData.data.user.name;

                try{
                    let formData = new FormData();
                    formData.append('status', 'In Progress');
                    formData.append('ticket_attended', date_ticketCreated);
                    formData.append('ticket_updated', date_ticketCreated);
                    formData.append('attended_by', this.displayName);


                    const response = await ticket_service.updateApproved(ticket_data.id, formData);


                }
                catch (error) {
                    this.flashMessage.warning({
                        message: 'Error!'
                    });
                }

                let username = this.ticket[0].assignedStaff;
                let activity_id = 5;
                let activity_date = date_ticketCreated;
                let ticket_id = this.ticket[0].reference_code;

                let formData_activityLog = new FormData();
                formData_activityLog.append('username', username);
                formData_activityLog.append('activity_id', activity_id);
                formData_activityLog.append('activity_date', activity_date);
                formData_activityLog.append('ticket_id', ticket_id);
                const response_activityLog = await ticket_service.addActivityLog(formData_activityLog);


                this.flashMessage.success({
                        message: 'Ticket Attended Successfully!'
                    });
                this.loadAllTicketDetails();
            },
            completeTicket: async function(data) {
                this.completedTicketData = {...data}
                this.completedTicketData_update = {...data}
                let govTypeId = this.completedTicketData_update.supportType;
                console.log("AAAA");
                console.log(govTypeId);
                if (govTypeId == "Livestream" || govTypeId == "IS" || govTypeId == "TWG"|| govTypeId == "Other"){
                    $('#assignModalForm_1').modal('show');
                } else if (govTypeId == "Technical Support" ){
                    $('#assignModalForm_2').modal('show');
                }
            },
            assignStaff_1: async function(data) {
                this.loadAllTicketDetails();

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
                let currentMonth = String(date.getMonth()+1).padStart(2,"0");
                let currentYear = date.getFullYear();
                // let date_ticketCreated = monthName + " " + currentDay + " " + currentYear;
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
                let date_ticketCreated = monthName + " " + currentDay + " " + currentYear + " " + getHours + ":" + getMinutes + " " + newformat;

                let currentDateTime = currentYear + "-" + currentMonth + "-" + currentDay;
                const response_getUserData = await ticket_service.getUserData();
                this.displayName=response_getUserData.data.user.name;
                try {
                    let formData_ = new FormData(); //Ticket Status table


                    formData_.append('date2', currentDateTime);
                    formData_.append('natureOfSupport', "NA");
                    // formData_.append('hardware', this.completedTicketData.supportType_hardware);
                    // formData_.append('software', this.completedTicketData.supportType_software);
                    formData_.append('supportType_', this.completedTicketData.supportType);
                    formData_.append('externalOtherType_', this.completedTicketData_update.externalOtherType);
                    formData_.append('mode_', this.completedTicketData.mode);
                    formData_.append('assisted_by_1', this.selected1);
                    formData_.append('assisted_by_2', this.selected2);
                    formData_.append('clientNote_', this.completedTicketData_update.clientNote);
                    formData_.append('type', this.completedTicketData.type);
                    formData_.append('ticket_completed', date_ticketCreated);

                    formData_.append('actions_taken', this.completedTicketData.actions_taken);
                    formData_.append('remarks', this.completedTicketData.remarks);
                    formData_.append('ticket_updated', date_ticketCreated);
                    formData_.append('status', 'Completed');
                    formData_.append('feedback_status', 'Pending');
                    formData_.append('rating_status', 'Pending');

                    const response_ = await ticket_service.updateInProg_TicketStatus_1(this.completedTicketData.id, formData_);

                    this.flashMessage.success({
                        message: 'Ticket Completed Successfully!'
                    });

                }
                catch (error) {
                    this.flashMessage.warning({
                        message: 'Please fill out the form!'
                    });
                }

                let username = this.completedTicketData.assignedStaff;
                let activity_id = 6;
                let activity_date = date_ticketCreated;
                let ticket_id = this.completedTicketData.reference_code;

                let formData_activityLog = new FormData();
                formData_activityLog.append('username', username);
                formData_activityLog.append('activity_id', activity_id);
                formData_activityLog.append('activity_date', activity_date);
                formData_activityLog.append('ticket_id', ticket_id);
                const response_activityLog = await ticket_service.addActivityLog(formData_activityLog);


                this.loadAllTicketDetails();
                // this.$refs['assignModalForm_1'].hide();
                // this.$refs['assignModalForm_2'].hide();

                $('#assignModalForm_1').modal('hide');
                $('#assignModalForm_2').modal('hide');
            },
            assignStaff_2: async function(data) {
                this.loadAllTicketDetails();

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
                let currentMonth = String(date.getMonth()+1).padStart(2,"0");
                let currentYear = date.getFullYear();
                // let date_ticketCreated = monthName + " " + currentDay + " " + currentYear;
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
                let date_ticketCreated = monthName + " " + currentDay + " " + currentYear + " " + getHours + ":" + getMinutes + " " + newformat;

                let currentDateTime = currentYear + "-" + currentMonth + "-" + currentDay;
                const response_getUserData = await ticket_service.getUserData();
                this.displayName=response_getUserData.data.user.name;

                try {
                    let formData_ = new FormData(); //Ticket Status table


                    formData_.append('date2', currentDateTime);
                    formData_.append('natureOfSupport', this.completedTicketData.natureOfSupport);
                    formData_.append('hardware', this.completedTicketData.supportType_hardware);
                    formData_.append('software', this.completedTicketData.supportType_software);
                    formData_.append('supportType_', this.completedTicketData.supportType);
                    formData_.append('externalOtherType_', this.completedTicketData_update.externalOtherType);
                    formData_.append('mode_', this.completedTicketData.mode);
                    formData_.append('assisted_by_1', this.selected1);
                    formData_.append('assisted_by_2', this.selected2);
                    formData_.append('clientNote_', this.completedTicketData_update.clientNote);
                    formData_.append('type', this.completedTicketData.type);
                    formData_.append('ticket_completed', date_ticketCreated);

                    formData_.append('actions_taken', this.completedTicketData.actions_taken);
                    formData_.append('remarks', this.completedTicketData.remarks);
                    formData_.append('ticket_updated', date_ticketCreated);
                    formData_.append('status', 'Completed');
                    formData_.append('feedback_status', 'Pending');
                    formData_.append('rating_status', 'Pending');

                    const response_ = await ticket_service.updateInProg_TicketStatus_1(this.completedTicketData.id, formData_);

                    this.flashMessage.success({
                        message: 'Ticket Completed Successfully!'
                    });

                }
                catch (error) {
                    this.flashMessage.warning({
                        message: 'Please fill out the form!'
                    });
                }

                let username = this.completedTicketData.assignedStaff;
                let activity_id = 6;
                let activity_date = date_ticketCreated;
                let ticket_id = this.completedTicketData.reference_code;

                let formData_activityLog = new FormData();
                formData_activityLog.append('username', username);
                formData_activityLog.append('activity_id', activity_id);
                formData_activityLog.append('activity_date', activity_date);
                formData_activityLog.append('ticket_id', ticket_id);
                const response_activityLog = await ticket_service.addActivityLog(formData_activityLog);


                this.loadAllTicketDetails();
                // this.$refs['assignModalForm_1'].hide();
                // this.$refs['assignModalForm_2'].hide();
                $('#assignModalForm_1').modal('hide');
                $('#assignModalForm_2').modal('hide');
            },
            addRemarksModal: async function(data) {
                this.completedTicketData = {...data}
                this.completedTicketDataTechRemarks_update = {...data}
                // this.$refs['addRemarksModalForm'].show();
                $('#addRemarksModalForm').modal('show');
            },
            addRemarks: async function(data) {
                this.loadAllTicketDetails();

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
                let date_ticketCreated = monthName + " " + currentDay + " " + currentYear + " " + getHours + ":" + getMinutes + " " + newformat;

                const response_getUserData = await ticket_service.getUserData();
                this.displayName=response_getUserData.data.user.name;

                try {
                    let formData = new FormData();
                    formData.append('ticket_updated', date_ticketCreated);

                    formData.append('tech_remarks', this.completedTicketDataTechRemarks.tech_remarks);

                    const response = await ticket_service.updateRemarks(this.completedTicketData.id, formData);

                    let username = this.completedTicketData.assignedStaff;
                    let activity_id = 7;
                    let activity_date = date_ticketCreated;
                    let ticket_id = this.completedTicketData.reference_code;

                    let formData_activityLog = new FormData();
                    formData_activityLog.append('username', username);
                    formData_activityLog.append('activity_id', activity_id);
                    formData_activityLog.append('activity_date', activity_date);
                    formData_activityLog.append('ticket_id', ticket_id);
                    formData_activityLog.append('remarks_data', this.completedTicketDataTechRemarks.tech_remarks);
                    const response_activityLog = await ticket_service.addActivityLog(formData_activityLog);


                    this.flashMessage.success({
                        message: 'Remarks Added Successfully!'
                    });

                    $('#addRemarksModalForm').modal('hide');

                    this.completedTicketDataTechRemarks.tech_remarks = '';



                } catch (error) {
                    this.flashMessage.warning({
                        message: 'Please fill out the form!'
                    });
                }



                // let formData_remarksLog = new FormData();
                // formData_remarksLog.append('ticket_id', this.completedTicketData.reference_code);
                // formData_remarksLog.append('remarks_data', this.completedTicketDataTechRemarks_update.tech_remarks);
                // formData_remarksLog.append('assigned_staff', this.completedTicketData.assignedStaff);
                // formData_remarksLog.append('remarks_date', date_ticketCreated);
                // const response_remarksLog = await ticket_service.addRemarksLog(formData_remarksLog);
                // this.loadAllTicketDetails();
            },
            async copyRatingLink() {
                try {
                    await navigator.clipboard.writeText(this.ratingLink);
                    this.flashMessage.success({
                        message: "Rating Link Copied!"
                    });
                } catch (err) {
                    console.error("Failed to copy: ", err);
                    this.flashMessage.warning({
                        message: "Failed to copy Rating Link."
                    });
                }
            },
            async copyCSMLink() {
                try {
                    await navigator.clipboard.writeText(this.ratingCSMLink);
                    this.flashMessage.success({
                        message: "CSM Link Copied!"
                    });
                } catch (err) {
                    console.error("Failed to copy: ", err);
                    this.flashMessage.warning({
                        message: "Failed to copy CSM Link."
                    });
                }
            }
        }
    }

</script>



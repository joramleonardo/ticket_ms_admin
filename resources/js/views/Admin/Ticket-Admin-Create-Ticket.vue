<template>
    <div>
        <div class="main-menu-area mg-tb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                            <li>
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
                            <li class="active">
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
                                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                                        </div>
                                        <div class="breadcomb-ctn">
                                            <h2>Create Ticket</h2>
                                            <p style="font-size: 12px;">Home> <span class="bread-ntd">Create Ticket</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="notika-email-post-area"  style="margin-bottom: 30px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="email-statis-inner notika-shadow" style="background-color: #021346;">
                            <div class="email-ctn-round">
                                <div class="email-rdn-hd">
                                    <h2>DOST-STII Employee</h2>
                                </div>
                                <div class="form-example-int mg-t-15">
                                    <button class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#modalCreate_Employee">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="email-statis-inner notika-shadow" style="background-color: #021346;">
                            <div class="email-ctn-round">
                                <div class="email-rdn-hd">
                                    <h2>STARBOOKS</h2>
                                </div>
                                <div class="form-example-int mg-t-15">
                                    <button class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#modalCreate_starbooks">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="email-statis-inner notika-shadow" style="background-color: #021346;">
                            <div class="email-ctn-round">
                                <div class="email-rdn-hd">
                                    <h2>Other Agency</h2>
                                </div>
                                <div class="form-example-int mg-t-15">
                                    <button class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#modalCreate_agency">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCreate_Employee" role="dialog">
            <div class="modal-dialog modal-large">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h2>Create a Ticket</h2>
                        <p>DOST-STII Employee</p>
                        <form class="loginForm" id="loginForm" v-on:submit.prevent="createTicket">
                                <div style="margin-botton: 15px">
                                    <span style="font-size: 12px; color: red; font-style: italic; ">* Required Fields</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 mb-0">
                                        <b-form-group class="group" id="form_externalEventDate">
                                            <label for="entryDate" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Date of Request:</label>
                                            <b-form-input pattern="\d{1,2}/\d{1,2}/\d{4}" required v-model="ticketData.ticket_created" id="entryDate" type="date" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                        </b-form-group>
                                    </div>
                                    <div class="col-md-3 col-lg-3 mb-0">
                                        <b-form-group class="group" id="form_externalEventDate">
                                            <label for="entryDate" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Date Accomplished:</label>
                                            <b-form-input pattern="\d{1,2}/\d{1,2}/\d{4}" required v-model="ticketData.ticket_completed" id="entryDate" type="date" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                        </b-form-group>
                                    </div>
                                    <div class="col-md-3 col-lg-3 mb-0">
                                        <b-form-group class="group" id="form_employeeId">
                                            <label for="employee_code" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Employee ID:</label>
                                            <b-form-input required v-model="ticketData.employee_code" id="employee_code" name="employee_code" type="text" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                        </b-form-group>
                                    </div>
                                    <div class="col-md-3 col-lg-3 mb-0">
                                        <b-form-group class="group" id="form_employeeId">
                                            <label for="employee_code" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Request Type:</label>
                                            <b-form-select v-model="selected_supportType" :options="options_supportType"></b-form-select>
                                        </b-form-group>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 mb-0">
                                        <b-form-group class="group">
                                            <label for="type" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Select Nature of Support<span style="font-style: italic; font-size: 10px; text-transform: none"></span></label>
                                            <select required @change="switchSelect_Division($event)" id="natureOfSupport" v-model="ticketData.natureOfSupport">
                                                <option value="" disabled>Choose</option>
                                                <option value="Hardware">Hardware</option>
                                                <option value="Software">Software</option>
                                                <option value="Hardware and Software">Hardware and Software</option>
                                                <option value="System update / development">System update / development</option>
                                                <option value="NA">NA</option>
                                            </select>
                                        </b-form-group>
                                    </div>
                                    <div class="col-md-6 col-lg-6 mb-0">
                                        <b-form-group class="group" id="optionHardware" style="display:none">
                                            <label for="type" class="label" style="color:black; font-weight: bold">Hardware:<span style="font-style: italic; font-size: 10px; text-transform: none;">  (Please select below... )</span></label>
                                            <b-form-select :options="drop_hardware" id="supportType_hardware" v-model="ticketData.supportType_hardware"></b-form-select>
                                        </b-form-group>
                                        <b-form-group class="group" id="optionSoftware" style="display:none">
                                            <label for="type" class="label" style="color:black; font-weight: bold">Software:<span style="font-style: italic; font-size: 10px; text-transform: none;">  (Please select below... )</span></label>
                                            <b-form-select :options="drop_software"  id="supportType_software" v-model="ticketData.supportType_software"></b-form-select>
                                        </b-form-group>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 mb-0">
                                        <span style="font-weight: bold"> Assigned Staff:</span>
                                        <b-form-group class="group">
                                            <label for="type" class="label"><span style="font-style: italic; font-size: 10px; text-transform: none">  Please select below... </span></label>
                                            <b-form-select  size="sm" id="assignedStaff" v-model="selected_staff" :options="options_staff" required></b-form-select>
                                        </b-form-group>
                                    </div>
                                    <div class="col-md-4 col-lg-4 mb-0">
                                        <span style="font-weight: bold"> Assisted By:</span>
                                        <b-form-group class="group">
                                            <label for="type" class="label"><span style="font-style: italic; font-size: 10px; text-transform: none">  Please select below... </span></label>
                                            <b-form-select  size="sm" id="assignedStaff" v-model="selected1" :options="drop_assistedBy" required></b-form-select>
                                        </b-form-group>
                                    </div>
                                    <div class="col-md-4 col-lg-4 mb-0">
                                        <span style="font-weight: bold"> Assisted By:</span>
                                        <b-form-group class="group">
                                            <label for="type" class="label"><span style="font-style: italic; font-size: 10px; text-transform: none">  Please select below... </span></label>
                                            <b-form-select  size="sm" id="assignedStaff" v-model="selected2" :options="drop_assistedBy" required></b-form-select>
                                        </b-form-group>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-lg-4 mb-0">
                                    </div>
                                </div>
                                <b-form-group class="group" id="form_remarks">
                                    <label for="clientNote" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Describe the problem that needed support: <span style="font-style: italic; font-size: 10px"></span></label>
                                    <b-form-textarea required v-model="ticketData.clientNote" id="clientNote" name="clientNote" placeholder="Type here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                </b-form-group>
                                <b-form-group class="group" id="groupActions_taken">
                                    <label for="actions_taken" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Describe actions taken:</label>
                                    <b-form-textarea required id="actions_taken"  v-model="ticketData.actions_taken" placeholder="Enter here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                </b-form-group>
                                <b-form-group class="group" id="groupRemarks">
                                    <label for="remarks" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Remarks:</label>
                                    <b-form-textarea required id="remarks"  v-model="ticketData.remarks" placeholder="Enter here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                </b-form-group>
                                <b-form-group class="group" id="form_ITURequestType_internal">
                                    <label for="type" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Type:<span style="font-style: italic; font-size: 10px; text-transform: none"></span></label>
                                    <b-form-select  size="sm" id="assignedStaff" v-model="ticketData.type" :options="options_type" required></b-form-select>
                                </b-form-group>

                                <b-form-group class="group">
                                    <b-button id="sub-btn" type="submit" class="sub-btn button" style="color:white; background-color: rgb(20 73 171) !important;">Submit</b-button>
                                </b-form-group>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCreate_starbooks" role="dialog">
            <div class="modal-dialog modal-large">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h2>Create a Ticket</h2>
                        <p>STARBOOKS</p>
                        <b-form class="loginForm" id="loginForm" v-on:submit.prevent="createTicket_starbooks">
                    <div class="">
                        <div style="margin-botton: 15px">
                            <span style="font-size: 12px; color: red; font-style: italic; ">* Required Fields</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 mb-0">
                                <b-form-group class="group" id="form_externalEventDate">
                                    <label for="entryDate" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Entry Date:</label>
                                    <b-form-input pattern="\d{1,2}/\d{1,2}/\d{4}" required v-model="ticketData.entryDate" id="entryDate" type="date" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                </b-form-group>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-0">
                                <b-form-group class="group" id="form_externalName">
                                    <label for="externalName" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Support Type:</label>
                                    <b-form-select v-model="ticketData.softwareType" :options="drop_software_sb"></b-form-select>
                                </b-form-group>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-lg-3 mb-0">
                                <b-form-group class="group" id="form_externalName">
                                    <label for="externalName" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Last Name:</label>
                                    <b-form-input required v-model="ticketData.lName" id="lName" type="text" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                </b-form-group>
                            </div>
                            <div class="col-md-3 col-lg-3 mb-0">
                                <b-form-group class="group" id="form_externalName">
                                    <label for="externalName" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>First Name:</label>
                                    <b-form-input required v-model="ticketData.fName" id="fName" type="text" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                </b-form-group>
                            </div>
                            <div class="col-md-3 col-lg-3 mb-0">
                                <b-form-group class="group" id="form_employeeId">
                                    <label for="sex" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Sex:</label>
                                    <b-form-select v-model="ticketData.sex" :options="options_sex"></b-form-select>
                                </b-form-group>
                            </div>
                            <div class="col-md-3 col-lg-3 mb-0">
                                <b-form-group class="group" id="form_externalName">
                                    <label for="externalName" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Email:</label>
                                    <b-form-input required v-model="ticketData.email" id="email" type="text" class="input" style="background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                </b-form-group>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 mb-0">
                                <b-form-group class="group" id="form_employeeId">
                                    <label for="externalAgency" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Agency:</label>
                                    <b-form-input required v-model="ticketData.externalAgency" id="externalAgency" name="externalAgency" type="text" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                </b-form-group>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-0">
                                <b-form-group class="group" id="form_employeeId">
                                    <label for="sex" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Assisted By:</label>
                                    <b-form-select v-model="selected3" :options="drop_assistedBy_sb"></b-form-select>
                                </b-form-group>
                            </div>
                        </div>
                        <b-form-group class="group" id="form_remarks">
                            <label for="clientNote" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Describe the problem that needed support: <span style="font-style: italic; font-size: 10px"></span></label>
                            <b-form-textarea required v-model="ticketData.clientNote" id="clientNote" name="clientNote" placeholder="Type here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                        </b-form-group>
                        <b-form-group class="group" id="groupActions_taken">
                            <label for="actions_taken" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Describe actions taken:</label>
                            <b-form-textarea required id="actions_taken"  v-model="ticketData.actions_taken" placeholder="Enter here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                        </b-form-group>
                    </div>
                    <b-form-group class="group">
                        <b-button type="submit" class="block" style="background-color: #1161ee !important;" variant="outline-success">Submit</b-button>
                    </b-form-group>
            </b-form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCreate_agency" role="dialog">
            <div class="modal-dialog modal-large">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h2>Create a Ticket</h2>
                        <p>DOST-STII Employee</p>
                        <b-form class="loginForm" id="loginForm" v-on:submit.prevent="createTicket_external">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group" id="form_externalEventDate">
                                                <label for="entryDate" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Entry Date <span style="font-style:italic">(Same as date of request)</span></label>
                                                <label style="font-size: 10px; color: red; font-style:italic">(For reference number)</label>
                                                <b-form-input pattern="\d{1,2}/\d{1,2}/\d{4}" required v-model="ticketData.entryDate" id="entryDate" type="date" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                            </b-form-group>
                                        </div>
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group">
                                                <label for="mode" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Mode:<span style="font-style: italic; font-size: 10px; text-transform: none"></span></label>
                                                <!-- <select required v-model="ticketData.mode" id="mode" name="mode">
                                                    <option value="" disabled>Select here</option>
                                                    <option value="Service Form">Service Form</option>
                                                    <option value="Online Form">Online Form</option>
                                                </select> -->
                                                <b-form-select v-model="ticketData.mode" :options="options_mode"></b-form-select>
                                            </b-form-group>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div style="margin-botton: 15px">
                                                <span style="font-size: 12px; color: red; font-style: italic; ">* Required Fields</span>
                                            </div>
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group" id="form_externalName">
                                                <label for="externalName" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Last Name</label>
                                                <b-form-input required v-model="ticketData.lName" id="lName" type="text" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                            </b-form-group>
                                        </div>
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group" id="form_externalName">
                                                <label for="externalName" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>First Name</label>
                                                <b-form-input required v-model="ticketData.fName" id="fName" type="text" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                            </b-form-group>
                                        </div>
                                        <!-- <div class="col-md-2 col-lg-2 mb-0">
                                            <b-form-group class="group" id="form_externalName">
                                                <label for="externalName" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>M. I.</label>
                                                <b-form-input required v-model="ticketData.mName" id="mName" type="text" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                            </b-form-group>
                                        </div> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group" id="form_employeeId">
                                                <label for="externalAgency" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Agency:</label>
                                                <b-form-input required v-model="ticketData.externalAgency" id="externalAgency" name="externalAgency" type="text" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>

                                            </b-form-group>
                                        </div>
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group" id="form_employeeId">
                                                <label for="sex" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Sex:</label>
                                                <b-form-select v-model="ticketData.sex" :options="options_sex"></b-form-select>
                                            </b-form-group>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group" id="form_externalEventDate">
                                                <label for="externalStartDate" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Event Start Date</label>
                                                <b-form-input required v-model="ticketData.externalStartDate" id="externalStartDate" type="date" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                            </b-form-group>
                                        </div>
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group" id="form_externalEventDate">
                                                <label for="externalEndDate" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Event End Date</label>
                                                <b-form-input required v-model="ticketData.externalEndDate" id="externalEndDate" type="date" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                            </b-form-group>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 mb-0">
                                            <b-form-group class="group" id="form_externalEventTitle">
                                                <label for="externalEventTitle" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Title of Event</label>
                                                <!-- <b-form-input required v-model="ticketData.externalEventTitle" id="externalEventTitle" type="text" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input> -->
                                                <b-form-textarea required v-model="ticketData.externalEventTitle" id="externalEventTitle" placeholder="Type here..." rows="2" max-rows="2" style="background: #fff !important; color: black"></b-form-textarea>
                                            </b-form-group>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group" id="form_employeeId">
                                                <label for="employee_code" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Request Type:</label>
                                                <b-form-select v-model="ticketData.supportType" :options="options_supportType_external"></b-form-select>
                                            </b-form-group>
                                        </div>
                                        <div class="col-md-6 col-lg-6 mb-0">
                                            <b-form-group class="group" id="form_RequestTypeOther">
                                                <label for="externalOtherType" class="label" style="color:black; font-weight: bold">If other, please enter Specific Request</label>
                                                <b-form-input v-model="ticketData.externalOtherType" id="externalOtherType" type="text" class="input" style="text-transform:uppercase; background: #fff; border: 1px solid #ced4da !important; color: black"></b-form-input>
                                            </b-form-group>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 mb-0">
                                            <span style="font-weight: bold"> Assigned Staff:</span>
                                            <b-form-group class="group">
                                                <label for="type" class="label"><span style="font-style: italic; font-size: 10px; text-transform: none">  Please select below... </span></label>
                                                <b-form-select  size="sm" id="assignedStaff" v-model="ticketData.attended_by" :options="options_staff" required></b-form-select>
                                            </b-form-group>
                                        </div>
                                        <div class="col-md-4 col-lg-4 mb-0">
                                            <span style="font-weight: bold"> Assisted By:</span>
                                            <b-form-group class="group">
                                                <label for="type" class="label"><span style="font-style: italic; font-size: 10px; text-transform: none">  Please select below... </span></label>
                                                <b-form-select  size="sm" id="assignedStaff" v-model="ticketData.assisted_by_1" :options="drop_assistedBy" required></b-form-select>
                                            </b-form-group>
                                        </div>
                                        <div class="col-md-4 col-lg-4 mb-0">
                                            <span style="font-weight: bold"> Assisted By:</span>
                                            <b-form-group class="group">
                                                <label for="type" class="label"><span style="font-style: italic; font-size: 10px; text-transform: none">  Please select below... </span></label>
                                                <b-form-select  size="sm" id="assignedStaff" v-model="ticketData.assisted_by_2" :options="drop_assistedBy" required></b-form-select>
                                            </b-form-group>
                                        </div>
                                    </div>
                                    <b-form-group class="group" id="form_remarks">
                                        <label for="clientNote" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Describe the problem that needed support: <span style="font-style: italic; font-size: 10px"></span></label>
                                        <b-form-textarea required v-model="ticketData.clientNote" id="clientNote" name="clientNote" placeholder="Type here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                    </b-form-group>
                                    <b-form-group class="group" id="groupActions_taken">
                                        <label for="actions_taken" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Describe actions taken:</label>
                                        <b-form-textarea required id="actions_taken"  v-model="ticketData.actions_taken" placeholder="Enter here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                    </b-form-group>
                                    <b-form-group class="group" id="groupRemarks">
                                        <label for="remarks" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Remarks:</label>
                                        <b-form-textarea required id="remarks"  v-model="ticketData.remarks" placeholder="Enter here..." rows="3" max-rows="3" style="background: #fff !important; color: black"></b-form-textarea>
                                    </b-form-group>
                                    <b-form-group class="group" id="form_ITURequestType_internal">
                                        <label for="type" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Type:<span style="font-style: italic; font-size: 10px; text-transform: none"></span></label>
                                        <b-form-select  size="sm" id="assignedStaff" v-model="ticketData.type" :options="options_type" required></b-form-select>
                                    </b-form-group>

                                    <!-- <b-form-group class="group" id="form_remarks">
                                        <label for="clientNote" class="label" style="color:black; font-weight: bold"><span style="font-size: 12px; color: red">*</span>Remarks: <span style="font-style: italic; font-size: 10px">(Venue, other deatils, etc.)</span><span style="font-style: italic; font-size: 10px"></span></label>
                                        <b-form-textarea required v-model="ticketData.clientNote" id="clientNote" placeholder="Type here..." rows="5" max-rows="5" style="background: #fff !important; color: black"></b-form-textarea>
                                    </b-form-group> -->
                                </div>
                                <b-form-group class="group">
                                    <b-button type="submit" class="block" style="background-color: #1161ee !important;" variant="outline-success">Submit</b-button>
                                </b-form-group>
                        </b-form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="showReferenceCode" role="dialog" ref="showReferenceCode">
            <div class="modal-dialog modal-large">
                <div class="modal-content">
                    <h2>Reference Code: </h2>
                    <input type="text" v-model="this.ticketData_update.reference_code" id="referenceCode"   disabled style="color:black; font-weight: bold">
                    <button @click="copyReferenceCode" >
                        Copy
                    </button>
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

                ref_code:'',
                ticket: [],
                ticketData:{
                    status:'',
                    reference_code:''
                },
                ticketDataStatus:{
                    employee_code:'',
                    type:'',
                    hardware:'',
                    software:'',
                    note:'',
                    reference_code:''
                },
                selected: '',
                ticketData_update:{
                    reference_code:''
                },
                empName: '',
                empSex: '',
                empDiv: '',
                empEmail: '',
                errors : '',
                totalRows: 1,
                currentPage: 1,
                perPage: 10,
                filterOn: [],
                filter: null,
                sortDirection: 'desc',
                sortBy: 'id',
                sortDesc: true,
                specificRequest: '',
                selected_supportType: 'Technical Support',
                options_supportType: [
                    { value: null, text: 'Please select an option', disabled: true },
                    { value: 'Technical Support', text: 'Technical Support' },
                    { value: 'Livestream', text: 'Livestream' },
                    { value: 'IS', text: 'Information System' },
                    { value: 'TWG', text: 'Technical Working Group' }
                ],
                options_mode: [
                    { value: null, text: 'Please select an option', disabled: true },
                    { value: 'Service Form', text: 'Service Form' },
                    { value: 'Online Mode', text: 'Online Mode' }
                ],
                options_type: [
                    { value: null, text: 'Please select an option', disabled: true },
                    { value: 'PC Setup & Troubleshooting', text: 'PC Setup & Troubleshooting' },
                    { value: 'Network related', text: 'Network related' },
                    { value: 'Printer related', text: 'Printer related' },
                    { value: 'Zoom related', text: 'Zoom related' },
                    { value: 'Website related', text: 'Website related' },
                    { value: 'STARBOOKS related', text: 'STARBOOKS related' },
                    { value: 'Installation related', text: 'Installation related' },
                    { value: 'Others', text: 'Others' },
                ],
                options_supportType_external: [
                    { value: null, text: 'Please select an option', disabled: true },
                    { value: 'Livestream', text: 'Livestream' },
                    { value: 'Other', text: 'Other..' }
                ],
                options_sex: [
                    { value: null, text: 'Please select an option', disabled: true },
                    { value: 'Male', text: 'Male' },
                    { value: 'Female', text: 'Female' },
                ],
                fields2: [
                    { key: 'reference_code', label: 'Reference Code'},
                    { key: 'name', label: 'Requested By'},
                    { key: 'type', label: 'Request Type'},
                    // { key: 'concerned_division', label: 'Concerned Division'},
                    // { key: 'concerned_section', label: 'Concerned Section'},
                    { key: 'note', label: 'Concern'},
                ],
                fields3: [
                    { key: 'ticket_created', label: 'Date Submitted'},
                    { key: 'ticket_approved', label: 'Date Approved'},
                    { key: 'ticket_approved', label: 'Date Assigned'},
                    { key: 'ticket_attended', label: 'Date Attended'},
                    { key: 'ticket_completed', label: 'Date Completed'},
                ],
                fields4: [
                    { key: 'status', label: ''},
                ],
                fields5: [
                    { key: 'approved_by', label: 'Approved By'},
                    { key: 'assignedStaff', label: 'Assigned To'},
                    { key: 'assisted_by', label: 'Assisted By'},
                    { key: 'tech_remarks', label: 'Note'},
                ],
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
                options_priority: [
                    { value: null, text: 'Please select priority level', disabled: true},
                    { value: 'Low', text: 'Low' },
                    { value: 'Medium', text: 'Medium' },
                    { value: 'Urgent', text: 'Urgent' },
                ],
                selected1: 'None',
                selected2: 'None',
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
                selected3: 'None',
                drop_assistedBy_sb: [
                    { value: 'None', text: 'None' },
                    { value: 'Jomar Rabanera', text: 'Rabanera, Jomar' },
                ],
                drop_hardware: [{ text: '(SELECT HERE)', value: null, disabled: true }, 	'Troubleshooting',
                                                                            'Evaluation',
                                                                            'Network',
                                                                            'Testing',
                                                                            'Consultation',
                                                                            'Assistance',
                                                                            'None'],
                drop_software: [{ text: '(SELECT HERE)', value: null, disabled: true }, 	'Installation',
                                                                            'Data Retrieval',
                                                                            'Virus/Malwares',
                                                                            'Data Conversion/Uploading/Processing',
                                                                            'Reformat',
                                                                            'Download',
                                                                            'Assistance' ,
                                                                            'None'],
                drop_software_sb: [{ text: '(SELECT HERE)', value: null, disabled: true }, 	'Installation',
                                                                            'Assistance',
                                                                            'None'],
                }
        },
        mounted() {
            this.countData();
        },
        methods: {
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

                    this.totalStaff = aa.data;
                    this.totalNew = total1.data;



                } catch(error) {
                    this.flashMessage.error({
                    message: 'Some error occured! Please try again.',
                    time: 5000
                    });
                }
            },
            createTicket: async function() {
                const date = new Date(this.ticketData.ticket_created);
                const months = ['January','February','March','April','May','June',
                                'July','August','September','October','November','December'];
                const monthIndex = date.getMonth()
                const monthName = months[monthIndex]
                let currentDay= String(date.getDate()).padStart(2, '0');
                let currentMonth = String(date.getMonth()+1).padStart(2,"0");
                let currentYear = date.getFullYear();
                let time = date.getHours() + "" + date.getMinutes() + "" + date.getSeconds();
                let date_ticketCreated = monthName + " " + currentDay + " " + currentYear;
                let getHours = date.getHours();
                let getMinutes = date.getMinutes();
                let newformat = getHours >= 12 ? 'PM' : 'AM';
                getHours = getHours % 12;
                getHours = getHours ? getHours : 12;
                getMinutes = getMinutes < 10 ? '0' + getMinutes : getMinutes;

                const date_created = new Date(this.ticketData.ticket_created);
                const months2 = ['January','February','March','April','May','June',
                                'July','August','September','October','November','December'];
                const monthIndex2 = date_created.getMonth()
                const monthName2 = months2[monthIndex2]
                let currentDay2 = String(date_created.getDate()).padStart(2, '0');
                let currentMonth2 = String(date_created.getMonth()+1).padStart(2,"0");
                let currentYear2 = date_created.getFullYear();
                let time2 = date_created.getHours() + "" + date_created.getMinutes() + "" + date_created.getSeconds();
                let date_ticketCreated2 = monthName2 + " " + currentDay2 + " " + currentYear2;
                let getHours2 = date_created.getHours();
                let getMinutes2 = date_created.getMinutes();
                let newformat2 = getHours2 >= 12 ? 'PM' : 'AM';
                getHours2 = getHours2 % 12;
                getHours2 = getHours2 ? getHours2 : 12;
                getMinutes2 = getMinutes2 < 10 ? '0' + getMinutes2 : getMinutes2;
                let date_ticketCreatedComplete2 = monthName2 + " " + currentDay2 + " " + currentYear2 + " " + getHours2 + ":" + getMinutes2 + " " + newformat2;

                const date_completed = new Date(this.ticketData.ticket_completed);
                const months3 = ['January','February','March','April','May','June',
                                'July','August','September','October','November','December'];
                const monthIndex3 = date_completed.getMonth()
                const monthName3 = months3[monthIndex3]
                let currentDay3 = String(date_completed.getDate()).padStart(2, '0');
                let currentMonth3 = String(date_completed.getMonth()+1).padStart(2,"0");
                let currentYear3 = date_completed.getFullYear();
                let time3 = date_completed.getHours() + "" + date_completed.getMinutes() + "" + date_completed.getSeconds();
                let date_ticketCreated3 = monthName3 + " " + currentDay3 + " " + currentYear3;
                let getHours3 = date_completed.getHours();
                let getMinutes3 = date_completed.getMinutes();
                let newformat3 = getHours3 >= 12 ? 'PM' : 'AM';
                getHours3 = getHours3 % 12;
                getHours3 = getHours3 ? getHours3 : 12;
                getMinutes3 = getMinutes3 < 10 ? '0' + getMinutes3 : getMinutes3;
                let date_ticketCreatedComplete3 = monthName3 + " " + currentDay3 + " " + currentYear3 + " " + getHours3 + ":" + getMinutes3 + " " + newformat3;

                const countEntry_data = await ticket_service.countEntry(date_ticketCreated);
                let totalEntry = countEntry_data.data;
                let new_totalEntry = totalEntry + 1;

                if (new_totalEntry < 10){
                    this.ref_code = currentYear + currentMonth + currentDay + "-" + "00" + new_totalEntry;
                } else if (new_totalEntry >= 10){
                    this.ref_code = currentYear + currentMonth + currentDay + "-" + "0" + new_totalEntry;
                }

                const empID = await ticket_service.validateEmpID(this.ticketData.employee_code);
                let _govType = empID.data;

                if (_govType == 1){ // 1 if STII Employee
                    try {
                        const empID_1 = await ticket_service.getEmpDetails(this.ticketData.employee_code);
                        this.ticketDetails = empID_1.data[0];
                        this.empName = this.ticketDetails.fname + " " + this.ticketDetails.lname ;
                        this.empSex = this.ticketDetails.sex
                        this.empEmail = this.ticketDetails.email
                        let div_id = this.ticketDetails.division_id;
                        if (div_id == "1"){
                            this.empDiv = "FAD";
                        } else if (div_id == "2"){
                            this.empDiv = "IRAD";
                        } else if (div_id == "3"){
                            this.empDiv = "CRPD";
                        }else if (div_id == "4"){
                            this.empDiv = "OD-MISPS";
                        }

                        if (this.empEmail === ""){
                            this.empEmail = "-"
                            console.log("No Email");
                        } else if (this.empEmail != ""){
                            this.empEmail = this.empEmail
                            console.log(this.empEmail);
                        }

                        let formData_ticketData = new FormData();
                        formData_ticketData.append('reference_code', this.ref_code);
                        formData_ticketData.append('ticket_created', date_ticketCreatedComplete2);
                        formData_ticketData.append('employee_code', this.ticketData.employee_code);
                        formData_ticketData.append('sex', this.empSex);
                        formData_ticketData.append('internal_external', "Internal");
                        formData_ticketData.append('concerned_division', "OD-MISPS");
                        formData_ticketData.append('concerned_section', "ITU");
                        formData_ticketData.append('externalName', this.empName);
                        formData_ticketData.append('empDiv', this.empDiv);
                        formData_ticketData.append('empEmail', this.empEmail);
                        formData_ticketData.append('clientType', "Government");
                        formData_ticketData.append('date1', date_ticketCreatedComplete2);
                        formData_ticketData.append('clientNote', this.ticketData.clientNote);
                        formData_ticketData.append('supportType', this.selected_supportType);
                        formData_ticketData.append('mode', "Service Form");

                        this.ticketData_update.reference_code = this.ref_code;

                        let formData_ticketDataStatus = new FormData();
                        formData_ticketDataStatus.append('reference_code', this.ref_code);
                        formData_ticketDataStatus.append('status', 'Completed');
                        formData_ticketDataStatus.append('entry_date', date_ticketCreated);
                        formData_ticketDataStatus.append('assignedStaff', this.selected_staff);
                        formData_ticketDataStatus.append('approved_by', "Lloyd Mandapat");
                        formData_ticketDataStatus.append('attended_by', this.selected_staff);
                        formData_ticketDataStatus.append('priority', "Low");
                        formData_ticketDataStatus.append('ticket_approved', date_ticketCreatedComplete3);
                        formData_ticketDataStatus.append('ticket_attended', date_ticketCreatedComplete3);
                        formData_ticketDataStatus.append('problem_that_needed_support', this.ticketData.clientNote);
                        formData_ticketDataStatus.append('actions_taken', this.ticketData.actions_taken);
                        formData_ticketDataStatus.append('remarks', this.ticketData.remarks);
                        formData_ticketDataStatus.append('feedback_status', "Pending");
                        formData_ticketDataStatus.append('rating_status', "Pending");
                        formData_ticketDataStatus.append('date2', date_ticketCreatedComplete3); //date requested
                        formData_ticketDataStatus.append('natureOfSupport', this.ticketData.natureOfSupport);
                        formData_ticketDataStatus.append('hardware', this.ticketData.supportType_hardware);
                        formData_ticketDataStatus.append('software', this.ticketData.supportType_software);
                        formData_ticketDataStatus.append('supportType_', this.ticketData.supportType);
                        formData_ticketDataStatus.append('mode_', "Service Form");
                        formData_ticketDataStatus.append('assisted_by_1', this.selected1);
                        formData_ticketDataStatus.append('assisted_by_2', this.selected2);
                        formData_ticketDataStatus.append('clientNote_', this.ticketData.clientNote);
                        formData_ticketDataStatus.append('type', this.ticketData.type);
                        formData_ticketDataStatus.append('ticket_completed', date_ticketCreatedComplete3);

                        const response_ticketData = await ticket_service.technical_addTicket_internal(formData_ticketData);
                        const response_ticketDataStatus = await ticket_service.technical_addTicketStatus_Pending(formData_ticketDataStatus);
                    }
                    catch (error) {
                        this.flashMessage.warning({
                            message: 'Please fill out the form!'
                        });
                    }

                    let username = this.ticketData.attended_by;
                    let activity_id = 10;
                    let activity_date = date_ticketCreatedComplete3;
                    let ticket_id = this.ref_code;

                    let formData_activityLog = new FormData();
                    formData_activityLog.append('username', username);
                    formData_activityLog.append('activity_id', activity_id);
                    formData_activityLog.append('activity_date', activity_date);
                    formData_activityLog.append('ticket_id', ticket_id);
                    const response_activityLog = await ticket_service.addActivityLog(formData_activityLog);


                    this.flashMessage.success({
                        message: 'Ticket Submitted Successfully!'
                    });

                    $('#modalCreate_Employee').modal('hide');
                    $('#showReferenceCode').modal('show');

                    this.ticketData.ticket_created = '';
                    this.ticketData.ticket_completed = '';
                    this.ticketData.employee_code = '';
                    selected_supportType = null;
                    this.ticketData.natureOfSupport = '';
                    selected_staff = null;
                    this.ticketData.clientNote = '';
                    this.ticketData.actions_taken = '';
                    this.ticketData.type = '';
                }
                else if (_govType == 0){ // 0 employee id not found; not STII employee
                    this.flashMessage.warning({
                        message: 'Employee ID does not exist! Please enter a valid Employee ID'
                    });
                    console.log("Employee ID does not exist! Please enter a valid Employee ID");

                    this.$refs.showErrorModal.show()

                }
            },
            createTicket_external: async function() {

                let specificRequest = document.getElementById("externalOtherType").value;
                if (specificRequest === ""){
                    this.specificRequest = "None";
                }
                else if (specificRequest != ""){
                    this.specificRequest = specificRequest;
                }
                let _comment = this.specificRequest;
                const date = new Date(this.ticketData.entryDate);
                const months = ['January','February','March','April','May','June',
                                'July','August','September','October','November','December'];
                const monthIndex = date.getMonth()
                const monthName = months[monthIndex]
                let currentDay= String(date.getDate()).padStart(2, '0');
                let currentMonth = String(date.getMonth()+1).padStart(2,"0");
                let currentYear = date.getFullYear();
                let time = date.getHours() + "" + date.getMinutes() + "" + date.getSeconds();
                let date_ticketCreated = monthName + " " + currentDay + " " + currentYear;
                let getHours = date.getHours();
                let getMinutes = date.getMinutes();
                let newformat = getHours >= 12 ? 'PM' : 'AM';
                getHours = getHours % 12;
                getHours = getHours ? getHours : 12;
                getMinutes = getMinutes < 10 ? '0' + getMinutes : getMinutes;

                const date_created = new Date(this.ticketData.entryDate);
                const months2 = ['January','February','March','April','May','June',
                                'July','August','September','October','November','December'];
                const monthIndex2 = date_created.getMonth()
                const monthName2 = months2[monthIndex2]
                let currentDay2 = String(date_created.getDate()).padStart(2, '0');
                let currentMonth2 = String(date_created.getMonth()+1).padStart(2,"0");
                let currentYear2 = date_created.getFullYear();
                let time2 = date_created.getHours() + "" + date_created.getMinutes() + "" + date_created.getSeconds();
                let date_ticketCreated2 = monthName2 + " " + currentDay2 + " " + currentYear2;
                let getHours2 = date_created.getHours();
                let getMinutes2 = date_created.getMinutes();
                let newformat2 = getHours2 >= 12 ? 'PM' : 'AM';
                getHours2 = getHours2 % 12;
                getHours2 = getHours2 ? getHours2 : 12;
                getMinutes2 = getMinutes2 < 10 ? '0' + getMinutes2 : getMinutes2;
                let date_ticketCreatedComplete2 = monthName2 + " " + currentDay2 + " " + currentYear2 + " " + getHours2 + ":" + getMinutes2 + " " + newformat2;

                const date_completed = new Date(this.ticketData.externalEndDate);
                const months3 = ['January','February','March','April','May','June',
                                'July','August','September','October','November','December'];
                const monthIndex3 = date_completed.getMonth()
                const monthName3 = months3[monthIndex3]
                let currentDay3 = String(date_completed.getDate()).padStart(2, '0');
                let currentMonth3 = String(date_completed.getMonth()+1).padStart(2,"0");
                let currentYear3 = date_completed.getFullYear();
                let time3 = date_completed.getHours() + "" + date_completed.getMinutes() + "" + date_completed.getSeconds();
                let date_ticketCreated3 = monthName3 + " " + currentDay3 + " " + currentYear3;
                let getHours3 = date_completed.getHours();
                let getMinutes3 = date_completed.getMinutes();
                let newformat3 = getHours3 >= 12 ? 'PM' : 'AM';
                getHours3 = getHours3 % 12;
                getHours3 = getHours3 ? getHours3 : 12;
                getMinutes3 = getMinutes3 < 10 ? '0' + getMinutes3 : getMinutes3;
                let date_ticketCreatedComplete3 = monthName3 + " " + currentDay3 + " " + currentYear3 + " " + getHours3 + ":" + getMinutes3 + " " + newformat3;

                const countEntry_data = await ticket_service.countEntry(date_ticketCreated);
                let totalEntry = countEntry_data.data;
                let new_totalEntry = totalEntry + 1;

                if (new_totalEntry < 10){
                    this.ref_code = currentYear + currentMonth + currentDay + "-" + "00" + new_totalEntry;
                } else if (new_totalEntry >= 10){
                    this.ref_code = currentYear + currentMonth + currentDay + "-" + "0" + new_totalEntry;
                }

                // let finalName = this.ticketData.fName + " " + this.ticketData.mName + " " + this.ticketData.lName;
                let finalName = this.ticketData.fName + " " + this.ticketData.lName;


                try {
                    let formData_ticketData = new FormData();
                    formData_ticketData.append('date1', date_ticketCreatedComplete2);
                    formData_ticketData.append('externalName', finalName);
                    formData_ticketData.append('externalAgency', this.ticketData.externalAgency);
                    formData_ticketData.append('sex', this.ticketData.sex);
                    formData_ticketData.append('externalStartDate', this.ticketData.externalStartDate);
                    formData_ticketData.append('externalEndDate', this.ticketData.externalEndDate);
                    formData_ticketData.append('externalEventTitle', this.ticketData.externalEventTitle);
                    formData_ticketData.append('supportType', this.ticketData.supportType);
                    formData_ticketData.append('externalOtherType', _comment);
                    formData_ticketData.append('clientNote', this.ticketData.clientNote);
                    formData_ticketData.append('reference_code', this.ref_code);
                    formData_ticketData.append('ticket_created', date_ticketCreatedComplete2);
                    formData_ticketData.append('internal_external', "External");
                    formData_ticketData.append('mode', "Online Form");
                    formData_ticketData.append('clientType', "Government");

                    this.ticketData_update.reference_code = this.ref_code;
                    let formData_ticketDataStatus = new FormData();

                    formData_ticketDataStatus.append('reference_code', this.ref_code);
                    formData_ticketDataStatus.append('status', 'Completed');
                    formData_ticketDataStatus.append('entry_date', date_ticketCreated);


                    formData_ticketDataStatus.append('assignedStaff', this.ticketData.attended_by);
                    formData_ticketDataStatus.append('approved_by', "Lloyd Mandapat");
                    formData_ticketDataStatus.append('attended_by', this.ticketData.attended_by);
                    formData_ticketDataStatus.append('priority', "Low");
                    formData_ticketDataStatus.append('ticket_approved', date_ticketCreatedComplete3);
                    formData_ticketDataStatus.append('ticket_attended', date_ticketCreatedComplete3);
                    formData_ticketDataStatus.append('problem_that_needed_support', this.ticketData.clientNote);
                    formData_ticketDataStatus.append('actions_taken', this.ticketData.actions_taken);
                    formData_ticketDataStatus.append('remarks', this.ticketData.remarks);
                    formData_ticketDataStatus.append('feedback_status', "Pending");
                    formData_ticketDataStatus.append('rating_status', "Pending");
                    formData_ticketDataStatus.append('date2', date_ticketCreatedComplete3); //date requested
                    formData_ticketDataStatus.append('supportType_', this.ticketData.supportType);
                    formData_ticketDataStatus.append('mode_', "Online Form");
                    formData_ticketDataStatus.append('assisted_by_1', this.ticketData.assisted_by_1);
                    formData_ticketDataStatus.append('assisted_by_2', this.ticketData.assisted_by_2);
                    formData_ticketDataStatus.append('clientNote_', this.ticketData.clientNote);
                    formData_ticketDataStatus.append('type', this.ticketData.type);
                    formData_ticketDataStatus.append('ticket_completed', date_ticketCreatedComplete3);



                    const response_ticketData = await ticket_service.technical_addTicket_external(formData_ticketData);
                    const response_ticketDataStatus = await ticket_service.technical_addTicketStatus_Pending_external(formData_ticketDataStatus);

                    document.getElementById("form_RequestTypeOther").style.display = "none";

                } catch (error) {
                    this.flashMessage.warning({
                        message: 'Please fill out the form!'
                    });
                    console.log("Please fill out the form!");
                }

                this.flashMessage.success({
                        message: 'Ticket Submitted Successfully!'
                });
                console.log("Ticket Submitted Successfully!");

                $('#modalCreate_agency').modal('hide');
                $('#showReferenceCode').modal('show');
            },
            createTicket_starbooks: async function() {
                const date = new Date(this.ticketData.entryDate);
                const months = ['January','February','March','April','May','June',
                                'July','August','September','October','November','December'];
                const monthIndex = date.getMonth()
                const monthName = months[monthIndex]
                let currentDay= String(date.getDate()).padStart(2, '0');
                let currentMonth = String(date.getMonth()+1).padStart(2,"0");
                let currentYear = date.getFullYear();
                let time = date.getHours() + "" + date.getMinutes() + "" + date.getSeconds();
                let date_ticketCreated = monthName + " " + currentDay + " " + currentYear;
                let getHours = date.getHours();
                let getMinutes = date.getMinutes();
                let newformat = getHours >= 12 ? 'PM' : 'AM';
                getHours = getHours % 12;
                getHours = getHours ? getHours : 12;
                getMinutes = getMinutes < 10 ? '0' + getMinutes : getMinutes;

                const date_created = new Date(this.ticketData.entryDate);
                const months2 = ['January','February','March','April','May','June',
                                'July','August','September','October','November','December'];
                const monthIndex2 = date_created.getMonth()
                const monthName2 = months2[monthIndex2]
                let currentDay2 = String(date_created.getDate()).padStart(2, '0');
                let currentMonth2 = String(date_created.getMonth()+1).padStart(2,"0");
                let currentYear2 = date_created.getFullYear();
                let time2 = date_created.getHours() + "" + date_created.getMinutes() + "" + date_created.getSeconds();
                let date_ticketCreated2 = monthName2 + " " + currentDay2 + " " + currentYear2;
                let getHours2 = date_created.getHours();
                let getMinutes2 = date_created.getMinutes();
                let newformat2 = getHours2 >= 12 ? 'PM' : 'AM';
                getHours2 = getHours2 % 12;
                getHours2 = getHours2 ? getHours2 : 12;
                getMinutes2 = getMinutes2 < 10 ? '0' + getMinutes2 : getMinutes2;
                let date_ticketCreatedComplete2 = monthName2 + " " + currentDay2 + " " + currentYear2 + " " + getHours2 + ":" + getMinutes2 + " " + newformat2;

                const date_completed = new Date(this.ticketData.ticket_completed);
                const months3 = ['January','February','March','April','May','June',
                                'July','August','September','October','November','December'];
                const monthIndex3 = date_completed.getMonth()
                const monthName3 = months3[monthIndex3]
                let currentDay3 = String(date_completed.getDate()).padStart(2, '0');
                let currentMonth3 = String(date_completed.getMonth()+1).padStart(2,"0");
                let currentYear3 = date_completed.getFullYear();
                let time3 = date_completed.getHours() + "" + date_completed.getMinutes() + "" + date_completed.getSeconds();
                let date_ticketCreated3 = monthName3 + " " + currentDay3 + " " + currentYear3;
                let getHours3 = date_completed.getHours();
                let getMinutes3 = date_completed.getMinutes();
                let newformat3 = getHours3 >= 12 ? 'PM' : 'AM';
                getHours3 = getHours3 % 12;
                getHours3 = getHours3 ? getHours3 : 12;
                getMinutes3 = getMinutes3 < 10 ? '0' + getMinutes3 : getMinutes3;
                let date_ticketCreatedComplete3 = monthName3 + " " + currentDay3 + " " + currentYear3 + " " + getHours3 + ":" + getMinutes3 + " " + newformat3;

                const countEntry_data = await ticket_service.countEntry(date_ticketCreated);
                let totalEntry = countEntry_data.data;
                let new_totalEntry = totalEntry + 1;

                if (new_totalEntry < 10){
                    this.ref_code = currentYear + currentMonth + currentDay + "-" + "00" + new_totalEntry;
                } else if (new_totalEntry >= 10){
                    this.ref_code = currentYear + currentMonth + currentDay + "-" + "0" + new_totalEntry;
                }

                    try {
                        let formData_ticketData = new FormData();
                        formData_ticketData.append('reference_code', this.ref_code);
                        formData_ticketData.append('ticket_created', date_ticketCreatedComplete2);
                        formData_ticketData.append('sex', this.ticketData.sex);
                        formData_ticketData.append('internal_external', "External");
                        formData_ticketData.append('externalName', this.ticketData.fName + " " + this.ticketData.lName);
                        formData_ticketData.append('empEmail', this.ticketData.email);
                        formData_ticketData.append('externalAgency', this.ticketData.externalAgency);
                        formData_ticketData.append('date1', date_ticketCreatedComplete2);
                        formData_ticketData.append('clientNote', this.ticketData.clientNote);
                        formData_ticketData.append('supportType', "Technical Support");
                        formData_ticketData.append('mode', "Online Remote");

                        this.ticketData_update.reference_code = this.ref_code;

                        let formData_ticketDataStatus = new FormData();
                        formData_ticketDataStatus.append('reference_code', this.ref_code);
                        formData_ticketDataStatus.append('status', 'Completed');
                        formData_ticketDataStatus.append('entry_date', date_ticketCreated);
                        formData_ticketDataStatus.append('assignedStaff', "Mc Gyver Basaya");
                        formData_ticketDataStatus.append('approved_by', "Mc Gyver Basaya");
                        formData_ticketDataStatus.append('attended_by', "Mc Gyver Basaya");
                        formData_ticketDataStatus.append('priority', "Low");
                        formData_ticketDataStatus.append('ticket_approved', date_ticketCreatedComplete2);
                        formData_ticketDataStatus.append('ticket_attended', date_ticketCreatedComplete2);
                        formData_ticketDataStatus.append('problem_that_needed_support', this.ticketData.clientNote);
                        formData_ticketDataStatus.append('actions_taken', this.ticketData.actions_taken);
                        formData_ticketDataStatus.append('remarks', "-");
                        formData_ticketDataStatus.append('feedback_status', "Pending");
                        formData_ticketDataStatus.append('rating_status', "Pending");
                        formData_ticketDataStatus.append('date2', date_ticketCreatedComplete2); //date requested
                        formData_ticketDataStatus.append('natureOfSupport', "Software");
                        formData_ticketDataStatus.append('hardware', "-");
                        formData_ticketDataStatus.append('software', this.ticketData.softwareType);
                        formData_ticketDataStatus.append('supportType_', "Technical Support");
                        formData_ticketDataStatus.append('mode_', "Online Remote");
                        formData_ticketDataStatus.append('assisted_by_1', selected3);
                        formData_ticketDataStatus.append('assisted_by_2', "None");
                        formData_ticketDataStatus.append('clientNote_', this.ticketData.clientNote);
                        formData_ticketDataStatus.append('type', "Starbooks related");
                        formData_ticketDataStatus.append('ticket_completed', date_ticketCreatedComplete2);

                        const response_ticketData = await ticket_service.technical_addTicket_starbooks(formData_ticketData);
                        const response_ticketDataStatus = await ticket_service.technical_addTicketStatus_starbooks(formData_ticketDataStatus);
                    }
                    catch (error) {
                        this.flashMessage.warning({
                            message: 'Please fill out the form!'
                        });
                        console.log("Please fill out the form!");
                    }


                    this.flashMessage.success({
                        message: 'Ticket Submitted Successfully!'
                    });
                    console.log("Ticket Submitted Successfully!");

                    $('#modalCreate_starbooks').modal('hide');
                    $('#showReferenceCode').modal('show');
            },
            async copyReferenceCode() {
                try {
                    await navigator.clipboard.writeText(this.ref_code);
                    this.flashMessage.success({
                        message: "Reference Code Copied!"
                    });
                } catch (err) {
                    console.error("Failed to copy: ", err);
                    this.flashMessage.warning({
                        message: "Failed to copy reference code."
                    });
                }
            }


        }
    }

</script>



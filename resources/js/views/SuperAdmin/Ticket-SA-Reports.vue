<template>
    <div>
        <div class="main-menu-area mg-tb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                            <!-- <li class="">
                                <router-link to="/ticket/sa/dashboard">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                    Dashboard
                                </router-link>
                            </li> -->
                            <li class="active">
                                <router-link to="/ticket/sa/reports">
                                    <i class="fa fa-pie-chart" aria-hidden="true"></i>
                                    Dashboard
                                </router-link>
                            </li>
                            <li>
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

        <!-- <div class="breadcomb-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcomb-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="breadcomb-wp">
                                        <div class="breadcomb-icon">
                                            <i class="fa fa-area-chart" aria-hidden="true"></i>
                                        </div>
                                        <div class="breadcomb-ctn">
                                            <h2>Reports</h2>
                                            <p style="font-size: 12px;">Home > <span class="bread-ntd">Reports</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

         <!-- Filters -->
         <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcomb-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="monthSelect">Select Month:
                                        <span style="color: red; font-weight: 700; font-size: 16px;">
                                            {{ this.selectedMonth }}
                                        </span>
                                    </label>
                                    <select v-model="selectedMonth" class="form-control">
                                        <option value="">All Months</option>
                                        <option v-for="month in months" :key="month.value" :value="month.value">{{ month.label }}</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="yearSelect">Select Year:
                                        <span style="color: red; font-weight: 700; font-size: 16px;">
                                            {{ this.selectedYear }}
                                        </span>
                                    </label>
                                    <select v-model="selectedYear" class="form-control">
                                        <option value="">All Years</option>
                                        <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                </div>

            </div>
        </div>

         <!-- 4 box -->
        <div class="container" >
            <div class="row" >
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"  style="margin: 10px 0">
                    <div class="breadcomb-list-noBG">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{total_status_count}}</span></h2>
                            <p>Total Requested Tickets</p>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"  style="margin: 10px 0">
                    <div class="breadcomb-list-noBG">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{ticketStatusCounts.pending_count1}}</span></h2>
                            <p>Total Pending Tickets</p>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="margin: 10px 0">
                    <div class="breadcomb-list-noBG">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{ticketStatusCounts.in_progress_count1}}</span></h2>
                            <p>Total In Progress Tickets</p>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="margin: 10px 0">
                    <div class="breadcomb-list-noBG">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{ticketStatusCounts.completed_count1}}</span></h2>
                            <p>Total Completed Tickets</p>
                        </div>
                    </div>
                    </div>
                </div>

            </div>
        </div>

         <!-- INTERNAL/EXTERNAL TICKETS | TICKET SUMMARY -->
        <div class="container" >
            <div class="row" >
                <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                    <div class="breadcomb-list"  style="margin: 20px 0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h5 style="text-align: center;">
                                    {{ this.selectedMonth }} {{ this.selectedYear }} Internal / External Ticket
                                </h5>
                                <canvas ref="internalExternalChart"></canvas>
                                <div class="chart-info">
                                    <p><strong>Internal:</strong> {{ this.total_internal_ticket }} tickets</p>
                                    <p><strong>External:</strong> {{ this.total_external_ticket }} tickets</p>
                                    <!-- <p><strong>Total:</strong> {{ this.total_internal_ticket + this.total_external_ticket }}</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="breadcomb-list" style="margin: 20px 0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h5 style="text-align: center;">
                                    {{ this.selectedMonth }} {{ this.selectedYear }}  Technical Support - Internal
                                </h5>
                                <b-container fluid>
                                    <b-table striped hover
                                    :items="ticketDetails_hardware"
                                    :fields="fields_technicalSupport"
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
                                    </b-table>
                                    <b-row>
                                            <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" align="center" ></b-pagination>
                                    </b-row>
                                </b-container>
                            </div>
                        </div>
                    </div>
                    <div class="breadcomb-list"  style="margin: 20px 0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h5 style="text-align: center;">
                                    {{ this.selectedMonth }} {{ this.selectedYear }}Agency / Division Tickets
                                </h5>
                                <canvas ref="divisionChart"></canvas>
                                <div class="chart-info">
                                    <p><strong>CRPD:</strong> {{ this.total_divTicket_CRPD }} tickets</p>
                                    <p><strong>IRAD:</strong> {{ this.total_divTicket_IRAD }} tickets</p>
                                    <p><strong>FAD:</strong> {{ this.total_divTicket_FAD }} tickets</p>
                                    <p><strong>OD-MISPS:</strong> {{ this.total_divTicket_MISPS }} tickets</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                    <div class="breadcomb-list" style="margin: 20px 0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h5 style="text-align: center;">
                                    {{ this.selectedMonth }} {{ this.selectedYear }} Ticket Summary - Internal
                                </h5>
                                <b-container fluid>
                                    <b-table striped hover
                                    :items="ticketDetails_hardware"
                                    :fields="fields_internal_technicalSupport"
                                    :current-page="currentPage"
                                    :per-page="perPage_ticketSummary"
                                    :filter="filter"
                                    :filter-included-fields="filterOn"
                                    :sort-by.sync="sortBy"
                                    :sort-desc.sync="sortDesc"
                                    :sort-direction="sortDirection"
                                    stacked="md"
                                    show-empty
                                    >
                                    </b-table>
                                    <b-row>
                                            <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage_ticketSummary" align="center" ></b-pagination>
                                    </b-row>
                                </b-container>
                            </div>
                        </div>
                    </div>
                    <div class="breadcomb-list" style="margin: 20px 0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h5 style="text-align: center;">
                                    {{ this.selectedMonth }} {{ this.selectedYear }} Rating Summary
                                </h5>
                                <b-container fluid>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Excellent (5⭐)</th>
                                                <th>Very Good (4⭐)</th>
                                                <th>Good (3⭐)</th>
                                                <th>Poor (2⭐)</th>
                                                <th>Very Poor (1⭐)</th>
                                                <th>CSM</th> <!-- ✅ New CSM Column -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ ratingSummary.rating_5 }}</td>
                                                <td>{{ ratingSummary.rating_4 }}</td>
                                                <td>{{ ratingSummary.rating_3 }}</td>
                                                <td>{{ ratingSummary.rating_2 }}</td>
                                                <td>{{ ratingSummary.rating_1 }}</td>
                                                <td>{{ ratingSummary.csm }}</td> <!-- ✅ New CSM Data -->
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- <b-table striped hover
                                        :items="[ratingSummary]"
                                        :fields="fields_rating_summary"
                                        stacked="md"
                                        show-empty
                                    >
                                    </b-table> -->

                                </b-container>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>


<style scoped>

.chart-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.chart-info {
    margin-left: 20px;
    font-size: 14px;
}


</style>

<script>
    import * as ticket_service from '../../services/ticket_service';
    import Chart from "chart.js";


    export default {
        name: 'employee',
        data() {
            return {
                totalNew: 0,
                totalStaff: '',
                name: '',
                total: '',
                pageOptions: [5, 10, 15, { value: 100, text: "Show a lot" }],
                totalRows: 0,
                currentPage: 1,
                perPage: 5,
                perPage_ticketSummary: 4,
                filterOn: [],
                filter: null,
                sortDirection: 'asc',
                sortBy: 'id',
                sortDesc: true,

                selectedMonth: '', // Store selected month
                selectedYear: '',  // Selected year filter
                months: [
                    { value: 'January', label: 'January' },
                    { value: 'February', label: 'February' },
                    { value: 'March', label: 'March' },
                    { value: 'April', label: 'April' },
                    { value: 'May', label: 'May' },
                    { value: 'June', label: 'June' },
                    { value: 'July', label: 'July' },
                    { value: 'August', label: 'August' },
                    { value: 'September', label: 'September' },
                    { value: 'October', label: 'October' },
                    { value: 'November', label: 'November' },
                    { value: 'December', label: 'December' },
                ],
                years: [2024, 2025], // Example years (modify as needed)

                ticketCompletedPerMonth:[],
                fields_ticketCopletedPerMonth_2: [
                    { key: 'printer_related', label: 'Printer'},
                    { key: 'network_related', label: 'Network'},
                    { key: 'installation_related', label: 'Installation'},
                    { key: 'zoom_related', label: 'Zooom'},
                    { key: 'starbooks_related', label: 'STARBOOKS'},
                    { key: 'pc_setup_troubleshooting', label: 'PC Setup'},
                    { key: 'others_type', label: 'Others'},
                    { key: 'website_related', label: 'Website'},
                ],

                ticketDetails_division:[],
                fields_ticketDetails_division: [
                    { key: 'month', label: 'Month'},
                    { key: 'year', label: 'Year'},
                    { key: 'CRPD', label: 'CRPD'},
                    { key: 'FAD', label: 'FAD'},
                    { key: 'IRAD', label: 'IRAD'},
                    { key: 'OD_MISPS', label: 'OD-MISPS'},
                    { key: 'others_total', label: 'Others/External'},
                    { key: 'total', label: 'TOTAL'}

                ],
                ticketDetails_hardware:[],
                fields_technicalSupport: [
                    { key: 'total_hardware', label: 'Hardware'},
                    { key: 'total_software', label: 'Software'},
                    { key: 'total_both', label: 'Both'},
                    { key: 'total_tech_support', label: 'Total'},
                ],
                fields_ticket_summary: [
                    { key: 'month', label: 'Month'},
                    { key: 'year', label: 'Year'},
                    // { key: 'total_tech_support', label: 'Technical Support'},
                    // { key: 'total_livestream', label: 'Livestream'},
                    // { key: 'total_infoSystem', label: 'IS'},
                    // { key: 'total_twg', label: 'TWG'},
                    { key: 'total_external', label: 'External'},
                    { key: 'total_internal', label: 'Internal'},
                    { key: 'total_internal_external', label: 'TOTAL'},
                ],
                fields_internal_technicalSupport: [
                    { key: 'month', label: 'Month'},
                    { key: 'year', label: 'Year'},
                    { key: 'total_tech_support', label: 'Technical Support'},
                    { key: 'total_livestream', label: 'Livestream'},
                    { key: 'total_infoSystem', label: 'IS'},
                    { key: 'total_twg', label: 'TWG'},
                    { key: 'total_internal', label: 'TOTAL'},
                ],
                ticketDetails_type:[],
                fields_ticketDetails_type: [
                    { key: 'month', label: 'Month'},
                    { key: 'year', label: 'Year'},
                    { key: 'printer_related', label: 'Printer'},
                    { key: 'network_related', label: 'Network'},
                    { key: 'installation_related', label: 'Installation'},
                    { key: 'zoom_related', label: 'Zooom'},
                    { key: 'starbooks_related', label: 'STARBOOKS'},
                    { key: 'pc_setup_troubleshooting', label: 'PC Setup'},
                    { key: 'others_type', label: 'Others'},
                    { key: 'website_related', label: 'Website'},
                ],
                internalExternalCounts:{
                    internal_count: 0,
                    external_count: 0
                },
                ticketStatusCounts: {
                    new_count: 0,
                    pending_count: 0,
                    in_progress_count: 0,
                    completed_count: 0,
                },
                total_status_count: 0,
                chartInstances: {},
                total_external_ticket: 0,
                total_internal_ticket: 0,
                ratingSummary: {
                    rating_5: 0,
                    rating_4: 0,
                    rating_3: 0,
                    rating_2: 0,
                    rating_1: 0
                },
                fields_rating_summary: [
                    { key: 'excellent', label: 'Excellent (5 ⭐)' },
                    { key: 'very_good', label: 'Very Good (4 ⭐)' },
                    { key: 'good', label: 'Good (3 ⭐)' },
                    { key: 'poor', label: 'Poor (2 ⭐)' },
                    { key: 'very_poor', label: 'Very Poor (1 ⭐)' },
                    { key: 'csm', label: 'CSM' }
                ],
                total_divTicket_CRPD: 0,
                total_divTicket_IRAD: 0,
                total_divTicket_FAD: 0,
                total_divTicket_MISPS: 0,

            }
        },
        computed: {
            filteredTicketData() {
                return this.ticketCompletedPerMonth.filter(ticket => {
                    const monthMatch = this.selectedMonth ? ticket.month === this.selectedMonth : true;
                    const yearMatch = this.selectedYear ? ticket.year == this.selectedYear : true;
                    return monthMatch && yearMatch;
                });
            }
        },
        watch: {
            selectedMonth() {
                this.updateCharts();
            },
            selectedYear() {
                this.updateCharts();
            }
        },
        mounted() {
            this.updateCharts();
            this.countData();

        },
        methods: {
            async updateCharts() {
                await this.$nextTick(); // Wait for DOM update
                await this.loadInternalExternalChart();
                await this.loadDivisionChart();
                await this.loadHardwareSoftwareChart();
                await this.loadTicketTypeChart();
                await this.fetchTicketStatusCounts();
                await this.fetchRatingSummary();

            },
            async countData() {
                const response_getUserData = await ticket_service.getUserData();
                this.displayName=response_getUserData.data.user.name;
                try {
                    const total1 = await ticket_service.countNew_All();
                    const aa = await ticket_service.countStaffTickets_PerStatus(this.displayName)
                    this.totalStaff = aa.data;
                    this.totalNew = total1.data;

                } catch (error) {
                    console.error("Error fetching data:", error);
                    this.flashMessage.error({
                        message: 'Some error occurred! Please try again.',
                        time: 5000
                    });
                }
            },
            async fetchTicketStatusCounts() {
                try {
                    const response = await ticket_service.fetchTicketStatusCounts(this.selectedMonth, this.selectedYear);
                    this.ticketStatusCounts = response.data;

                    this.total_status_count =   Number(this.ticketStatusCounts.new_count1) +
                                                Number(this.ticketStatusCounts.pending_count1) +
                                                Number(this.ticketStatusCounts.in_progress_count1) +
                                                Number(this.ticketStatusCounts.completed_count1);
                } catch (error) {
                    console.error("Error fetching ticket status counts:", error);
                }
            },
            async loadInternalExternalChart() {
                await this.$nextTick();
                // Fetch Internal vs External Ticket Counts
                const response = await ticket_service.fetchInternalExternalCounts(this.selectedMonth, this.selectedYear);

                if (!response || !response.data) {
                    console.error("No response data received for Internal vs External chart.");
                    return;
                }

                // Extract values (Set default to 0 if missing)
                const internal = Number(this.total_internal_ticket) || 0;
                const external = Number(this.total_external_ticket) || 0;


                this.createChart(
                    "internalExternalChart",
                    ["Internal", "Enternal"],
                    [internal  , external],
                    "Internal External",
                    [
                        "#eaf2f8",
                        "#7fb3d5"
                    ],
                    "pie",
                    {
                        plugins: {
                            legend: {
                                display: true,
                                position: 'right' // Moves the legend beside the chart
                            }
                        }
                    }

                );

            },
            async loadDivisionChart() {
                await this.$nextTick();
                const response = await ticket_service.fetchEmployeeDivisionCounts(this.selectedMonth, this.selectedYear);
                this.ticketDetails_division = response.data;
                this.totalRows = this.ticketDetails_division.length;
                const data = response.data[0];

                if (!this.$refs.divisionChart) {
                    console.error("divisionChart not found in the DOM.");
                    return;
                }
                this.total_divTicket_CRPD = Number(data.CRPD);
                this.total_divTicket_IRAD = Number(data.IRAD);
                this.total_divTicket_FAD = Number(data.FAD);
                this.total_divTicket_MISPS = Number(data.OD_MISPS);
                console.log("CRPD: " + this.total_divTicket_CRPD);

                const CRPD = this.total_divTicket_CRPD || 0;
                const IRAD = this.total_divTicket_IRAD || 0;
                const FAD = this.total_divTicket_FAD|| 0;
                const OD_MISPS = this.total_divTicket_MISPS || 0;

                // ✅ Compute total number of tickets
                const totalTickets = CRPD + IRAD + FAD + OD_MISPS;


                this.createChart(
                    "divisionChart",
                    ["CRPD", "IRAD", "FAD", "OD-MISPS"],
                    [CRPD, IRAD, FAD, OD_MISPS],
                    "Tickets per Division",
                    [
                        "#eaf2f8",
                        "#7fb3d5",
                        "#2980b9",
                        "#154360"
                    ], // Pie Chart Colors
                    "pie" // ✅ Change Chart Type to Pie

                    );

            },
            async loadHardwareSoftwareChart() {
                await this.$nextTick();
                const response = await ticket_service.fetchHardwareSoftwareCounts(this.selectedMonth, this.selectedYear);
                this.ticketDetails_hardware = response.data;
                this.total_internal_ticket = Number(this.ticketDetails_hardware[0].total_internal);
                this.total_external_ticket = Number(this.ticketDetails_hardware[0].total_external);
                const data = response.data[0];

                if (!this.$refs.hardwareSoftwareChart) {
                    console.error("hardwareSoftwareChart not found in the DOM.");
                    return;
                }

                this.createChart(
                    "hardwareSoftwareChart",
                    ["Hardware", "Software", "Both", "Livestream"],
                    [data.hardware_count, data.software_count, data.both_count, data.total_livestream],
                    "Support Type Counts",
                    ["#FF5733", "#33B5E5", "#FFC300", "#8E44AD"], // Pie Chart Colors
                    "pie" // ✅ Change Chart Type to Pie
                    );
            },
            async loadTicketTypeChart() {
                await this.$nextTick();
                const response = await ticket_service.fetchTicketTypeCounts(this.selectedMonth, this.selectedYear);
                this.ticketDetails_type = response.data;


                const data = response.data[0];

                if (!this.$refs.ticketTypeChart) {
                    console.error("ticketTypeChart not found in the DOM.");
                    return;
                }

                this.createChart(
                    "ticketTypeChart",
                    ["PC Setup", "Network", "Printer", "Zoom", "Website", "STARBOOKS", "Installation", "Others"],
                    [data.pc_setup_troubleshooting, data.network_related, data.printer_related, data.zoom_related, data.website_related, data.starbooks_related, data.installation_related, data.others_type],
                    "Ticket Types",
                    ["#3498db", "#2ecc71", "#f39c12", "#e74c3c", "#9b59b6", "#34495e", "#1abc9c", "#95a5a6"], // Pie Chart Colors
                    "doughnut");
            },
            // async fetchRatingSummary() {
            //     try {
            //         const response = await ticket_service.fetchRatingSummary(this.selectedMonth, this.selectedYear);
            //         if (response.data) {
            //             this.ratingSummary = {
            //                 rating_5: response.data.rating_5 || 0,
            //                 rating_4: response.data.rating_4 || 0,
            //                 rating_3: response.data.rating_3 || 0,
            //                 rating_2: response.data.rating_2 || 0,
            //                 rating_1: response.data.rating_1 || 0
            //             };
            //         } else {
            //             this.ratingSummary = { rating_5: 0, rating_4: 0, rating_3: 0, rating_2: 0, rating_1: 0 };
            //         }

            //         console.log("Rating Summary:", this.ratingSummary);
            //     } catch (error) {
            //         console.error("Error fetching rating summary:", error);
            //     }
            // },
            async fetchRatingSummary() {
                try {
                    const response = await ticket_service.fetchRatingSummary(this.selectedMonth, this.selectedYear);

                    if (response.data) {
                        this.ratingSummary = {
                            rating_5: response.data.rating_5 || 0,
                            rating_4: response.data.rating_4 || 0,
                            rating_3: response.data.rating_3 || 0,
                            rating_2: response.data.rating_2 || 0,
                            rating_1: response.data.rating_1 || 0,
                            csm: this.getCSMValue(this.selectedMonth, this.selectedYear) // ✅ Add CSM Value
                        };
                    } else {
                        this.ratingSummary = {
                            rating_5: 0, rating_4: 0, rating_3: 0, rating_2: 0, rating_1: 0,
                            csm: this.getCSMValue(this.selectedMonth, this.selectedYear) // ✅ Default CSM Value
                        };
                    }
                } catch (error) {
                    console.error("Error fetching rating summary:", error);
                    this.ratingSummary = {
                        rating_5: 0, rating_4: 0, rating_3: 0, rating_2: 0, rating_1: 0,
                        csm: this.getCSMValue(this.selectedMonth, this.selectedYear) // ✅ Default CSM Value
                    };
                }
            },

            // createChart(chartRef, labels, data, label, colors) {
            createChart(chartRef, labels, data, label, colors, chartType = "bar") {
                if (!this.$refs[chartRef]) {
                    console.error(`Chart element '${chartRef}' not found.`);
                    return;
                }

                // Destroy previous chart instance if it exists
                if (this.chartInstances[chartRef]) {
                    this.chartInstances[chartRef].destroy();
                }

                this.chartInstances[chartRef] = new Chart(this.$refs[chartRef], {
                    type: chartType,
                    data: {
                        labels,
                        datasets: [{
                            label,
                            data,
                            backgroundColor: colors
                        }]
                    }
                });
            },
            getCSMValue(month, year) {
                const csmValues = {
                    "2024": { "January": 2, "February": 15, "March": 19, "April": 13, "May": 5, "June": 9, "July": 19, "August": 9, "September": 14, "October": 11, "November": 10, "December": 5 },
                    "2025": { "January": 18, "February": 21, "March": 19, "April": 0, "May": 0, "June": 0, "July": 0, "August": 0, "September": 0, "October": 0, "November": 0, "December": 0 }
                };

                // If "All Years" and "All Months" are selected
                if ((year === "" || year === "All Years") && (month === "" || month === "All Months")) {
                    return Object.values(csmValues).reduce((total, months) => {
                        return total + Object.values(months).reduce((sum, val) => sum + val, 0);
                    }, 0);
                }

                // If "All Months" is selected
                if (month === "" || month === "All Months") {
                    return Object.values(csmValues[year] || {}).reduce((sum, val) => sum + val, 0);
                }

                return csmValues[year] && csmValues[year][month] ? csmValues[year][month] : 0; // ✅ Default to 0 if not found
            }



        }
    }

</script>



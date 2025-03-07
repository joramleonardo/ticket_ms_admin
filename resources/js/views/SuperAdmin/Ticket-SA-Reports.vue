<template>
    <div>
        <div class="main-menu-area mg-tb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                            <li class="">
                                <router-link to="/ticket/sa/dashboard">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                    Dashboard
                                </router-link>
                            </li>
                            <li class="active">
                                <router-link to="/ticket/sa/reports">
                                    <i class="fa fa-area-chart" aria-hidden="true"></i>
                                    Reports
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

        <div class="breadcomb-area">
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
        </div>

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

        <div class="container" >
            <div class="row" >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin: 30px 0">
                    <div class="breadcomb-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <h5>Employee Division Count</h5>
                                <canvas ref="divisionChart"></canvas>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <h5>Hardware, Software, Both & Livestream</h5>
                                <canvas ref="hardwareSoftwareChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" >
            <div class="row" >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin: 30px 0">
                    <div class="breadcomb-list">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <b-container fluid>
                                    <b-table striped hover
                                    :items="ticketDetails_type"
                                    :fields="fields_ticketDetails_type"
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
                                </b-container>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- <div class="notika-status-area" style="margin: 30px 0">
            <div class="container mt-4">
                <div class="row" style="margin: 30px 0">
                    <div class="col-lg-6">
                        <h5>Employee Division Count</h5>
                        <canvas ref="divisionChart"></canvas>
                    </div>
                    <div class="col-lg-6">
                        <h5>Hardware, Software, Both & Livestream</h5>
                        <canvas ref="hardwareSoftwareChart"></canvas>
                    </div>
                    <div class="col-lg-6">
                        <b-container fluid>
                            <b-table striped hover
                            :items="ticketDetails_division"
                            :fields="fields_ticketDetails_division"
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
                        </b-container>
                    </div>
                </div>
                <div class="row" style="margin: 30px 0">
                    <div class="col-lg-6">
                        <h5>Hardware, Software, Both & Livestream</h5>
                        <canvas ref="hardwareSoftwareChart"></canvas>
                    </div>
                    <div class="col-lg-6">
                        <b-container fluid>
                            <b-table striped hover
                            :items="ticketDetails_hardware"
                            :fields="fields_ticketDetails_hardware"
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
                        </b-container>
                    </div>
                 </div>
                <div class="row">
                    <div class="col-lg-6">
                        <h5>Ticket Type Count</h5>
                        <canvas ref="ticketTypeChart"></canvas>
                    </div>
                    <div class="col-lg-12">
                        <b-container fluid>
                            <b-table striped hover
                            :items="ticketDetails_type"
                            :fields="fields_ticketDetails_type"
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
                        </b-container>
                    </div>
                 </div>

            </div>
        </div> -->

    </div>
</template>


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
                perPage: 15,
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
                chartInstances: {},

                ticketDetails_division:[],
                fields_ticketDetails_division: [
                    { key: 'month', label: 'Month'},
                    { key: 'year', label: 'Year'},
                    { key: 'CRPD', label: 'CRPD'},
                    { key: 'FAD', label: 'FAD'},
                    { key: 'IRAD', label: 'IRAD'},
                    { key: 'OD_MISPS', label: 'OD-MISPS'}
                ],
                ticketDetails_hardware:[],
                fields_ticketDetails_hardware: [
                    { key: 'month', label: 'Month'},
                    { key: 'year', label: 'Year'},
                    { key: 'hardware_count', label: 'Hardware'},
                    { key: 'software_count', label: 'Software'},
                    { key: 'both_count', label: 'Both'},
                    { key: 'count_livestream', label: 'Livestream'},
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

        },
        methods: {


            async updateCharts() {
                await this.$nextTick(); // Wait for DOM update
                await this.loadDivisionChart();
                await this.loadHardwareSoftwareChart();
                await this.loadTicketTypeChart();

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

            async loadDivisionChart() {
                await this.$nextTick();
                const response = await ticket_service.fetchEmployeeDivisionCounts(this.selectedMonth, this.selectedYear);
                this.ticketDetails_division = response.data;
                const data = response.data[0];

                if (!this.$refs.divisionChart) {
                    console.error("divisionChart not found in the DOM.");
                    return;
                }

                const CRPD = Number(data.CRPD) || 0;
                const IRAD = Number(data.IRAD) || 0;
                const FAD = Number(data.FAD) || 0;
                const OD_MISPS = Number(data.OD_MISPS) || 0;


                this.createChart(
                    "divisionChart",
                    ["CRPD", "IRAD", "FAD", "OD-MISPS"],
                    [CRPD, IRAD, FAD, OD_MISPS],
                    "Tickets per Division",
                    ["#FF6384", "#36A2EB", "#FFCE56", "#4CAF50"], // Pie Chart Colors
                    "pie" // ✅ Change Chart Type to Pie

                    );

            },

            async loadHardwareSoftwareChart() {
                await this.$nextTick();
                const response = await ticket_service.fetchHardwareSoftwareCounts(this.selectedMonth, this.selectedYear);
                this.ticketDetails_hardware = response.data;
                const data = response.data[0];

                if (!this.$refs.hardwareSoftwareChart) {
                    console.error("hardwareSoftwareChart not found in the DOM.");
                    return;
                }

                this.createChart(
                    "hardwareSoftwareChart",
                    ["Hardware", "Software", "Both", "Livestream"],
                    [data.hardware_count, data.software_count, data.both_count, data.count_livestream],
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
            }


        }
    }

</script>



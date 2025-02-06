
<template>
	<div class="bg" style="padding:50px">
        <div class="ftco-section" style="height: 2080px;">
            <div class="wrap-login">
                <div class="login-html">
                    <h3 style="color:white;text-align:center">Ticket Management System</h3>
                    <br>
                    <!-- <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab btn-text">Create a Tciket</label> -->
                    <!-- <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab btn-text">Follow Up a Ticket</label> -->
                    <b-form class="login-form" v-on:submit.prevent="createTicket">
                        <!-- <div class="sign-in-htm"> -->
							 <b-form-group class="group">
                                <label for="user" class="label">Please Enter Reference Code</label>
                                <b-form-input id="user" type="text" class="input" style="border: 1px solid #ced4da !important;"></b-form-input>
                            </b-form-group>
                            <!-- <b-form-group class="group">
                                <input type="submit" class="tab button"  style="background-color: #1161ee !important;" value="Submit" >
                            </b-form-group> -->
                            <b-form-group class="group">
								<b-button type="submit" class="tab button" style="background-color: #1161ee !important;" variant="outline-success"	>Submit</b-button>
                            </b-form-group>
                        <!-- </div> -->
                            <!-- <div class="hr"></div> -->
                        <!-- <div class="sign-up-htm mt-5">
                            <b-form-group class="group">
                                <label for="user" class="label">Please Enter Reference Code</label>
                                <b-form-input id="user" type="text" class="input" style="border: 1px solid #ced4da !important;"></b-form-input>
                            </b-form-group>
                            <b-form-group class="group">
                                <input type="submit" class="tab button"  style="background-color: #1161ee !important;" value="Submit" >
                            </b-form-group>
                        </div> -->
                    </b-form>

					<b-modal id="showReferenceCode" ref="showReferenceCode" hide-footer title="Please secure a copy of your Reference Code for follow up.">
						<div class="d-block text-center">
						<input type="text" v-model="this.ticketData_update.reference_code" id="myInput" disabled>
						</div>
						<b-button class="mt-3" variant="info" block @click="copyReferenceCode()">Copy</b-button>
					</b-modal>
                </div>
            </div>
			<FlashMessage></FlashMessage>
        </div>
	</div>
</template>


<script>
import * as ticket_service from '../services/ticket_service';

export default {
    data() {
        return {
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
                remarks:'',
                reference_code:''
            },
            ticketData_update:{
                reference_code:''
			},
			drop_type: [{ text: '(SELECT TYPE HERE)', value: null }, 	'Livestream', 
																		'Technical Support', 
																		'Information System', 
																		'TWG'],
			drop_hardware: [{ text: '(SELECT HARDWARE HERE)', value: null}, 'Troubleshooting', 
																			'Evaluation', 
																			'Network', 
																			'Testing', 
																			'Consultation', 
																			'Assistance' ],
			drop_software: [{ text: '(SELECT SOFTWARE HERE)', value: null}, 'Installation', 
																			'Data Retrieval', 
																			'Virus/Malwares', 
																			'Data Conversion/Uploading/Processing', 
																			'Reformat', 
																			'Download', 
																			'Assistance' ],

            errors : '',
            }
    },
    mounted() {
    },
    methods: {
        createTicket: async function() {

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
			let time = date.getHours() + "" + date.getMinutes() + "" + date.getSeconds();
			let date_ticketCreated = monthName + " " + currentDay + " " + currentYear;

			let currentDateTime = `${currentYear}${currentMonth}${currentDay}`;
			let referenceCode = currentDateTime+'-'+'00'+time;

			let formData_ticketData = new FormData();
            formData_ticketData.append('employee_code', this.ticketData.employee_code); 	//employee code
            formData_ticketData.append('type', this.ticketData.type); 						//type
            // formData_ticketData.append('hardware', this.ticketData.hardware); 				//hardware
            // formData_ticketData.append('software', this.ticketData.software); 				//software
            formData_ticketData.append('remarks', this.ticketData.remarks); 				//remarks
            formData_ticketData.append('reference_code', referenceCode); 					//referenceCode
			this.ticketData_update.reference_code = referenceCode;

			
			let formData_ticketDataStatus = new FormData();
			formData_ticketDataStatus.append('status', 'Pending');
			formData_ticketDataStatus.append('ticket_created', date_ticketCreated);
			formData_ticketDataStatus.append('reference_code', referenceCode);

            try {
                const response_ticketData = await ticket_service.addTicket(formData_ticketData);
                console.log(response_ticketData);

                const response_ticketDataStatus = await ticket_service.addTicketStatus_Pending(formData_ticketDataStatus);
                console.log(response_ticketDataStatus);

                
                
                this.flashMessage.success({
					message: 'Ticket Submitted Successfully!'
				});
				// Swal.fire({
				// 	title: 'Success!',
				// 	text: 'Ticket Submitted Successfully!',
				// 	icon: 'success',
				// 	confirmButtonText: 'Cool'
				// })
				// Swal.fire({
				// 	icon: 'success',
				// 	title: 'Success!...',
				// 	text: 'Ticket Submitted Successfully!',
				// 	footer: '<a href="">Why do I have this issue?</a>'
				// })
                this.ticketData = {
                    employee_code:'',
					type:'',
					hardware:'',
					software:'',
					remarks:'',
                	reference_code:''
                }
                
            } catch (error) {
                switch (error.response.status) {
                    case 422:
                        this.errors = error.response.data.errors;
                        break;
                    default:
                        this.flashMessage.error({
                            message: 'Some error occurred, Please try again!',
                            time: 5000
                        });
                    break;
                }
            }
			this.$refs.showReferenceCode.show()
        },
		copyReferenceCode(){
			var copyText = document.getElementById("myInput");
			copyText.select();
			copyText.setSelectionRange(0, 99999); 
			navigator.clipboard.writeText(copyText.value);
		}
        
    }
}

</script>

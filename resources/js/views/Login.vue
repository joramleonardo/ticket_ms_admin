<template>
    <div class="login-content">
          <!-- Login -->
          <div class="nk-block toggled" id="l-login">
              <div class="nk-form">
                <form id="contactForm login-form" v-on:submit.prevent="login">
                  <div class="input-group">
                      <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                      <div class="nk-int-st">
                          <input type="text" class="form-control" placeholder="Username" v-model="user.username">
                      </div>
                  </div>
                  <div class="input-group mg-t-15">
                      <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                      <div class="nk-int-st">
                          <input type="password" class="form-control" placeholder="Password" v-model="user.password">
                      </div>
                  </div>
                  <br>
                  <b-button id="submit" type="submit" class="block button" style="background-color: rgba(48, 110, 148, 0.9) !important;">Login</b-button>
                </form>
                </div>
  
          </div>
  
          
  
      </div>
  
  </template>
  
  <script>
      import * as authServices from '../services/auth_service';
      import * as ticket_service from '../services/ticket_service';
  
      export default { 
          data() {
              return {
                  user: {
                      username: '',
                      password: '',
                  },
                  isLogging: false
              }
          },
          methods: {
              login: async function () {
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
                  let newformat = getHours >= 12 ? 'PM' : 'AM';
                  getHours = getHours % 12;
                  getHours = getHours ? getHours : 12;
                  getMinutes = getMinutes < 10 ? '0' + getMinutes : getMinutes;
                  let activityDate = monthName + " " + currentDay + " " + currentYear + " " + getHours + ":" + getMinutes + " " + newformat;
              
                  try {
                      const response = await authServices.login(this.user);
  
                      if(response.token_scope == 'superadmin'){
                          this.$router.push('/ticket/superadmin/status');
                      } 
                      else if(response.token_scope == 'admin'){
                          this.$router.push('/ticket/admin/dashboard');
                      } 
                      else if(response.token_scope == 'staff'){
                          this.$router.push('/ticket/staff/dashboard');
                      } 
                      else if(response.token_scope == 'author_lib'){
                          this.$router.push('/ticket/public/completed');
                      } 
  
                      let a_username = this.user.username;
                      let activity_id = 1;
                      let activity_date = activityDate;
  
                      let formData_activityLog = new FormData();
                      formData_activityLog.append('username', a_username);
                      formData_activityLog.append('activity_id', activity_id);
                      formData_activityLog.append('activity_date', activity_date);
                      const response_activityLog = await ticket_service.addActivityLog(formData_activityLog);
                      
  
                  } catch(error) {
                          this.flashMessage.error({
                          message: 'Some error occured! Please try again.',
                          time: 5000
                          });
                  }
              },
          },
      }
  </script>

<template>
    <section>
          <Header />


          <div class="notika-status-area">
              <router-view> </router-view>
          </div>


          <FlashMessage position="right bottom"> </FlashMessage>

      </section>
  </template>

  <script>
      import Header from './Header-Admin.vue';
      import Footer from './Footer.vue';
      import * as ticket_service from '../services/ticket_service';

      export default {
          components: {
              Header,
              Footer
          },
          data(){
              return {
                  isLoggedIn: false,
                  ticketData_update:{
                      reference_code:''
                  },
                  displayName: ''
              }
          },
          mounted(){
              this.loadEmployees();
          },
          methods:{
              loadEmployees: async function(){
                  try{
                      const response = await ticket_service.getUserData();
                      this.displayName=response.data.user.name;
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

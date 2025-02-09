import Vue from 'vue';
import Router from 'vue-router';
import LoginPage from './views/Login.vue';


//TICKETS

import Ticket_Rating from './views/Rating.vue';



import Ticket_Home_Staff from './views/Ticket-Home-Staff.vue';
import Ticket_Staff_Dashboard from './views/Ticket-Staff-Dashboard.vue';
import Ticket_Staff_My_Tickets from './views/Ticket-Staff-My-Tickets.vue';
import Ticket_Staff_Create_Ticket from './views/Ticket-Staff-Create-Ticket.vue';


Vue.use(Router);

const routes = [

    {
        path: '/rating/:id',
        name: 'rating',
        component: Ticket_Rating
    },
    //STAFF ROUTES
    {
        path: '/ticket/staff/',
        name: 'ticket-staff',
        component: Ticket_Home_Staff,
        children: [
            {
                path: '/ticket/staff/dashboard',
                name: 'ticket-staff-dashboard',
                component: Ticket_Staff_Dashboard,
            },
            {
                path: '/ticket/staff/mytickets',
                name: 'ticket-staff-mytickets',
                component: Ticket_Staff_My_Tickets,
            },
            {
                path: '/ticket/staff/create',
                name: 'ticket-staff-create',
                component: Ticket_Staff_Create_Ticket,
            },

        ],
    },

    //Login Routes
    {
        path: '/login',
        name: 'login',
        component: LoginPage
    },
    {
        path: '/',
        name: '',
        component: LoginPage
    }
];

const router = new Router({
    routes: routes,
    linkActiveClass: 'active'
});

export default router;

import Vue from 'vue';
import Router from 'vue-router';
import LoginPage from './views/Login.vue';


//TICKETS

import Ticket_Rating from './views/Rating.vue';



import Ticket_Staff_Home from './views/Ticket-Home-Staff.vue';
import Ticket_Staff_Dashboard from './views/Staff/Ticket-Staff-Dashboard.vue';
import Ticket_Staff_My_Tickets from './views/Staff/Ticket-Staff-My-Tickets.vue';
import Ticket_Staff_Create_Ticket from './views/Staff/Ticket-Staff-Create-Ticket.vue';

import Ticket_Admin_Home from './views/Ticket-Home-Admin.vue';
import Ticket_Admin_Dashboard from './views/Admin/Ticket-Admin-Dashboard.vue';
import Ticket_Admin_New_Tickets from './views/Admin/Ticket-Admin-New-Tickets.vue';
import Ticket_Admin_My_Tickets from './views/Admin/Ticket-Admin-My-Tickets.vue';
import Ticket_Admin_Create_Ticket from './views/Admin/Ticket-Admin-Create-Ticket.vue';

import Ticket_SA_Home from './views/Ticket-Home-SA.vue';
import Ticket_SA_Dashboard from './views/SuperAdmin/Ticket-SA-Dashboard.vue';
import Ticket_SA_New_Tickets from './views/SuperAdmin/Ticket-SA-New-Tickets.vue';
import Ticket_SA_My_Tickets from './views/SuperAdmin/Ticket-SA-My-Tickets.vue';



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
        component: Ticket_Staff_Home,
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
    //ADMIN ROUTES
    {
        path: '/ticket/admin/',
        name: 'ticket-admin',
        component: Ticket_Admin_Home,
        children: [
            {
                path: '/ticket/admin/dashboard',
                name: 'ticket-admin-dashboard',
                component: Ticket_Admin_Dashboard,
            },
            {
                path: '/ticket/admin/newtickets',
                name: 'ticket-admin-newtickets',
                component: Ticket_Admin_New_Tickets,
            },
            {
                path: '/ticket/admin/mytickets',
                name: 'ticket-admin-mytickets',
                component: Ticket_Admin_My_Tickets,
            },
            {
                path: '/ticket/admin/create',
                name: 'ticket-admin-create',
                component: Ticket_Admin_Create_Ticket,
            },

        ],
    },
    //SUPER ADMIN ROUTES
    {
        path: '/ticket/sa/',
        name: 'ticket-sa',
        component: Ticket_SA_Home,
        children: [
            {
                path: '/ticket/sa/dashboard',
                name: 'ticket-sa-dashboard',
                component: Ticket_SA_Dashboard,
            },
            {
                path: '/ticket/sa/newtickets',
                name: 'ticket-sa-newtickets',
                component: Ticket_SA_New_Tickets,
            },
            {
                path: '/ticket/sa/mytickets',
                name: 'ticket-sa-mytickets',
                component: Ticket_SA_My_Tickets,
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

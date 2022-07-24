import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from '../pages/home.vue'
import ResortList from '../pages/resort/index.vue'
import CreateResort from '../pages/resort/create.vue'
import EditResort from '../pages/resort/edit.vue'
import BookingList from '../pages/booking/index.vue'
import CreateBooking from '../pages/booking/create.vue'
import EditBooking from '../pages/booking/edit.vue'

// Authentication
import Login from '../pages/auth/login.vue'

const routes = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [{
            path: '/',
            component: Home,
            name: 'home',

        },

        // resort
        {
            path: '/resort',
            component: ResortList,
            name: 'resort-list',

        },
        {
            path: '/resort/create',
            component: CreateResort,
            name: 'create-resort',

        },

        {
            path: '/resort/edit/:id',
            component: EditResort,
            name: 'edit-resort',

        },

        // Booking
        {
            path: '/booking',
            component: BookingList,
            name: 'booking-list',

        },

        {
            path: '/booking/create',
            component: CreateBooking,
            name: 'create-booking',

        },

        {
            path: '/booking/edit/:id',
            component: EditBooking,
            name: 'edit-booking',

        },

        //Authentication
        {
            path: '/auth/login',
            component: Login,
            name: 'login',

        },
    ]
});


export default routes;
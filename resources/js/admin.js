import Vue from 'vue';
const axios = require('axios').default;


import logoutFormComponent from "./components/logoutFormComponent";



new Vue({
    components: {
        logoutFormComponent
    },
    el: '#adminContainer'
});

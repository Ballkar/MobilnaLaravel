import './bootstrap';
import './core/form';
import logoutFormComponent from "./components/logoutFormComponent";
import formPostComponent from './components/admin/formPostComponent'

import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor );



new Vue({
    components: {
        logoutFormComponent,
        formPostComponent,
    },
    el: '#adminContainer'
});

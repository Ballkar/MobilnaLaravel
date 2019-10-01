import './bootstrap';
import './core/form';
import logoutFormComponent from "./components/logoutFormComponent";
import textEditor from "./components/admin/textEditor";

import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor );



new Vue({
    components: {
        logoutFormComponent,
        textEditor,
    },
    el: '#adminContainer'
});

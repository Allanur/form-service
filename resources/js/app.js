import VueSelect from 'vue-select/src/components/Select';
import {createApp} from "vue";
import Step from "./components/Step";
import CForm from "./components/Form";

require('./bootstrap');

const app = createApp({
    components: {
        Step,
    }
});

app.component('v-select', VueSelect)
    .component('c-form', CForm)
    .mount("#app");

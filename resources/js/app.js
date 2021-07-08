import {createApp} from "vue";
import {createStore} from 'vuex'
import Step from "./components/Step";
import CForm from "./components/Form";
import GroupPropertySelect from "./components/GroupPropertySelect";

require('./bootstrap');

// Create a new store instance.
const store = createStore({
    state() {
        return {
            formProperties: [],
        };
    },
    getters: {
        properties(state) {
            console.log(state.formProperties);
            return state.formProperties.filter(property => property.id !== null);
        },
    },
    mutations: {
        setFormProperties(state, properties) {
            state.formProperties = properties;
        },
    }
});

const app = createApp({
    components: {
        Step,
    }
});

app.use(store);

app.component('gp-select', GroupPropertySelect)
    .component('c-form', CForm)
    .mount("#app");

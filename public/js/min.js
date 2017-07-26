class Errors {
    constructor() {
        this.errors = {};
    }

    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    any() {
        return Object.keys(this.errors).length > 0;
    }

    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    record(errors) {
        this.errors = errors;
    }

    clear(field) {
        if (field) {
            delete this.errors[field];

            return;
        }

        this.errors = {};
    }
}


class Form {
    constructor(data) {
        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }

    data() {
        let data = Object.assign({},this);

        delete data.orginalData;
        delete data.errors;
        this.errors.clear();
        return data;


    }

    reset() {

        for (let field in this.originalData) {
            {
                this[field] = '';
            }
        }

        this.errors.clear();
    }

    post(url) {
        return this.submit('post', url);
    }

    put(url) {
        return this.submit('put', url);
    }

    patch(url) {
        return this.submit('patch', url);
    }

    delete(url) {
        return this.submit('delete', url);
    }

    submit(requestType, url) {
        return new Promise((resolve, reject)=> {
            axios[requestType](url, this.data())
                .then(response => {
                    this.onSuccess(response.data);

                    resolve(response.data);
                })
                .catch(error => {
                    this.onFail(error.response.data);

                    reject(error.response.data);
                });
        });
    }

    onSuccess(data) {
        this.reset();
    }

    onFail(errors) {
        this.errors.record(errors);
    }
}

Vue.component('errors-list',
    {
        props:['errors'],
        data:function () {
            return {
                'showErrors':false,

            }
        },
        watch:{
            errors: function (value) {
                if(value!=null && !this.showErrors) {
                    this.showErrors = true;
                }else if(value==null)
                {
                    this.showErrors = false;
                }


            }
        },
        template : '<div v-if="showErrors" class="alert alert-danger"><button v-on:click="showErrors=false" class="close" type="button" data-dismiss="alert">×</button><ul><div v-for="error in errors"><li v-for="e in error">{{ e }}</li></div></ul></div>',
    });

Vue.component('tabs', {
    template: `
        <div>
            <div class="tabs">
                <ul class="nav nav-tabs">
                    <li v-for="tab in tabs" :class="{ 'active': tab.isActive }">
                        <a :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <slot></slot>
            </div>
        </div>
    `,

    data() {
        return { tabs: [] };
    },

    created() {
        this.tabs = this.$children;
    },

    methods: {
        selectTab(selectedTab) {
            this.tabs.forEach(tab => {
                tab.isActive = (tab.href == selectedTab.href);
            });
        }
    }
});


Vue.component('tab', {
    template: `
        <div class="tab-pane fade in active" v-show="isActive" style="margin-top: 30px"><slot></slot></div>
    `,

    props: {
        name: { required: true },
        selected: { default: false }
    },

    data() {
        return {
            isActive: false
        };
    },

    computed: {
        href() {
            return '#' + this.name.toLowerCase().replace(/ /g, '-');
        }
    },

    mounted() {
        this.isActive = this.selected;
    },
});

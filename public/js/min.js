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

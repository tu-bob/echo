<template>
    <div class="dropdown">
        <input @click.stop.prevent.capture
               @keydown="onKeyDown"
               autocomplete="query"
               autofocus
               class="form-control col-md-12"
               data-toggle="dropdown"
               id="query"
               name="query"
               type="text"
               v-bind:placeholder="placeholder"
               v-model="query"
               :class="{'is-invalid': isInvalid}"
               v-on:blur="hideDropdown" v-on:focus="showDropdown"
               v-on:input="onInputChanged">
        <div :class="{show: showOptions && options.length > 0}"
             class="dropdown-menu"
             id="optionsMenu">
            <div :class="{active: index === activeOptionIndex}"
                 @click.stop.prevent="onOptionSelected(option)"
                 class="dropdown-item"
                 v-bind:property="option"
                 v-for="(option, index) in options"
                 :key="option[keyPropertyName]">
                {{option[displayPropertyName]}}
            </div>
        </div>
    </div>
</template>

<script>
    const CancelToken = axios.CancelToken;
    let source;

    export default {
        created() {
            if (this.providedQuery) {
                this.query = this.providedQuery;
            }

            if (this.providedOptions)
                this.options = this.providedOptions;

            if (this.actionUrl)
                this.fetchData();
        },
        props: {
            providedOptions: {
                type: Array,
                required: false
            },
            actionUrl: String,
            placeholder: String,
            displayPropertyName: String,
            searchPropertyName: String,
            keyPropertyName: {
                type: String,
                default: 'id'
            },
            isInvalid: {
                required: false,
                default: false
            },
            searchInputChange: {
                type: Function,
                required: false
            },
            // optionSelected: {
            //     type: Function,
            //     required: false
            // },
            providedQuery: {
                type: String,
                required: false
            }
        },
        data() {
            return {
                query: '',
                options: [],
                activeOptionIndex: 0,
                showOptions: false
            }
        },
        watch: {
            providedQuery() {
                this.query = this.providedQuery;
            },
            providedOptions() {
                this.options = this.providedOptions
            },
            query() {
                if (this.actionUrl)
                    this.fetchData();
                else
                    this.filterData();
            }
        },
        methods: {
            onInputChanged() {
                if (this.searchInputChange)
                    this.searchInputChange(this.query);
                this.activeOptionIndex = 0
            },
            onOptionSelected(option) {
                this.hideDropdown();
                if (!option) {
                    option = this.options.find((item, index) => {
                        return index === this.activeOptionIndex
                    })
                }
                if (option === 'undefined')
                    option = this.options[0];

                this.activeOptionIndex = 0;

                if (option)
                    this.query = option[this.displayPropertyName];

                this.$emit('selected', option);

                if (this.searchInputChange)
                    this.searchInputChange(this.query);

                $('#query').blur();
            },
            onKeyDown(e) {
                switch (e.keyCode) {
                    case 40:
                        e.preventDefault();
                        this.setActiveItem('down');
                        break;
                    case 38:
                        e.preventDefault();
                        this.setActiveItem('up');
                        break;
                    case 13: //enter
                        e.preventDefault();
                        this.onOptionSelected(null);
                        break;
                    default:
                        return true
                }
            },

            setActiveItem(direction) {
                let newActiveIndex = this.activeOptionIndex;
                if (direction === 'down') newActiveIndex++;
                else newActiveIndex--;

                if (newActiveIndex < 0)
                    newActiveIndex = this.options.length - 1;
                if (newActiveIndex >= this.options.length)
                    newActiveIndex = 0;
                this.activeOptionIndex = newActiveIndex
            },
            showDropdown() {
                this.showOptions = true
            },
            hideDropdown() {
                let self = this;
                setTimeout(function () {
                    self.showOptions = false;
                }, 150);
            },
            fetchData() {
                // if (source) {
                //     source.cancel();
                // }
                //
                // source = CancelToken.source();

                if (this.query && this.query.length > 2)
                    axios.get(this.actionUrl + this.query)
                        .then(response => this.options = response)
                        .catch();
            },
            filterData() {
                if (this.query) {
                    this.options = this.providedOptions
                        .filter(option => option[this.searchPropertyName]
                            .replace(/[^a-zA-Z]/g, '')
                            .toUpperCase()
                            .includes(this.query.replace(/[^a-zA-Z]/g, '').toUpperCase()))
                } else {
                    this.options = this.providedOptions;
                }
            }
        }
    }
</script>

<style>

</style>

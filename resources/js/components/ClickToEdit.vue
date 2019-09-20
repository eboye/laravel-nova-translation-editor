<template>
    <div>
        <div v-if="edit" class="flex">
            <input type="text"
                   class="py-2 w-5/6"
                   v-model="valueLocal"
                   v-focus
            />
            <button @click="save" class="btn btn-primary w-1/6">Save</button>
        </div>
        <p v-else @click="edit = true">
            {{valueLocal}}
        </p>
    </div>
</template>

<script>
    export default {
        props: [
            'value',
            'group',
            'value_key',
            'locale'
        ],
        data() {
            return {
                apiURL: '/nova-vendor/laravel-nova-translation-editor/',
                edit: false,
                groupLocal: this.group,
                value_keyLocal: this.value_key,
                localeLocal: this.locale,
                valueLocal: this.value
            }
        },
        methods: {
            save: function () {
                this.edit = false;
                let payload = {
                    group: this.groupLocal,
                    key: this.value_keyLocal,
                    locale: this.localeLocal,
                    text: this.valueLocal
                };
                Nova.request().post(this.apiURL + 'save', payload).then(response => {
                    this.$toasted.show('Saved', {type: 'success'});
                }).catch(error => {
                    this.$toasted.show(error, {type: 'error'});
                });
            }
        },
        watch: {
            value: function () {
                this.valueLocal = this.value;
                this.groupLocal = this.group;
                this.value_keyLocal = this.value_key;
                this.localeLocal = this.locale;
            }
        },
        directives: {
            focus: {
                inserted(el) {
                    el.focus()
                }
            }
        }
    }
</script>

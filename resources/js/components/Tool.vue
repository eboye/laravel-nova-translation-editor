<template>
    <div>
        <heading class="mb-6">Laravel Nova Translation Editor</heading>

        <card v-if="translations" class="flex flex-col my-6">
            <nav class="flex border-b border-50">
                <button class="btn px-4 py-2"
                        :class="active_tab === translation_file ? 'btn-primary text-white' : 'btn-link' "
                        v-for="(translation, translation_file) in translations" :key="translation_file"
                        @click="active_tab = translation_file">{{translation_file}}
                </button>
            </nav>
            <div v-show="active_tab === translation_file"
                 v-for="(translation, translation_file) in translations" :key="translation_file + 'tab'">
                <h2 class="px-3 py-6 text-80">config('{{translation_file}}')</h2>
                <table cellpadding="0" cellspacing="0" data-testid="resource-table" class="table w-full">
                    <thead>
                    <tr>
                        <th class="text-left">Path</th>
                        <th class="text-left">String</th>
                    </tr>
                    </thead>
                    <tbody v-for="(t_object, t_path) in translation">
                    <tr v-if="typeof t_object == 'string'">
                        <td class="text-left">{{t_path}}</td>
                        <td class="text-left">
                            <ClickToEdit
                                :value="t_object"
                                :group="translation_file"
                                :value_key="t_path"
                                :locale="active_locale"
                            ></ClickToEdit>
                        </td>
                    </tr>
                    <tr v-else v-for="(t_item_object, t_item_path) in t_object">
                        <td class="text-left">{{t_path + '.' + t_item_path}}</td>
                        <td class="text-left">
                            <ClickToEdit
                                :value="t_item_object"
                                :group="translation_file"
                                :value_key="t_path + '.' + t_item_path"
                                :locale="active_locale"
                            ></ClickToEdit>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </card>
    </div>
</template>

<script>
    import ClickToEdit from "./ClickToEdit";

    export default {
        components: {ClickToEdit},
        data: () => {
            return {
                apiURL: '/nova-vendor/laravel-nova-translation-editor/',
                active_locale: Nova.config.locale,
                translations: null,
                active_tab: null
            }
        },
        mounted() {
            this.getTranslations();
        },
        methods: {
            getTranslations() {
                Nova.request().get(this.apiURL + 'index').then(response => {
                    this.translations = response.data.length !== 0 ? response.data : null;
                    this.active_tab = response.data.length !== 0 ? Object.keys(response.data)[0] : null;
                });
            }
        }
    }
</script>

<style>
    /* Scoped Styles */
</style>

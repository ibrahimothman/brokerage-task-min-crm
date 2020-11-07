<template>
    <div>
        <button
            @click="showModal = true"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Employee
        </button>

        <jet-dialog-modal
            :show="showModal"
            @close="onCloseModal">
            <template #title>
                Add New Employee
            </template>

            <template #content>
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="name" value="Name" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                    <jet-input-error :message="form.error('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="email" value="Email" />
                    <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                    <jet-input-error :message="form.error('email')" class="mt-2" />
                </div>

                 <!-- password -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="password" value="Password" />
                    <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" />
                    <jet-input-error :message="form.error('password')" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <jet-primary-button @click.native="createEmployee">
                    Save
                </jet-primary-button>

            </template>

        </jet-dialog-modal>
    </div>

</template>

<script>
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetPrimaryButton from '@/Jetstream/PrimaryButton'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'

    export default {
        components: {
            JetDialogModal,
            JetPrimaryButton,
            JetInput,
            JetInputError,
            JetLabel,
        },
        data() {
            return {
                showModal: false,
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                }, {
                    bag: 'createEmployee',
                })
            }
        },
        methods: {
            onCloseModal() {
                this.showModal = false;
                this.form.name = '';
                this.form.email = '';
                this.form.password = '';
            },
            createEmployee() {
                this.form.post(route('employees.store'), {
                    preserveScroll: true
                }).then(response => {
                    if (!this.form.hasErrors()) {
                        this.showModal = false;
                    }
                })
            },
        }
    }
</script>

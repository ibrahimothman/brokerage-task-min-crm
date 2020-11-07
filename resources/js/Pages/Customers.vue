<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Customers
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <button
                    @click="showModal = true"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add Custoemr
                </button>
                <div class="bg-white   sm:rounded-lg">
                    <div class="mx-auto">

                        <div class="bg-white shadow-md rounded my-6">
                            <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                            <thead>
                                <tr>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Name</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Work With</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">status</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="customer in customers"
                                    :key="customer.id"
                                    class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light"> {{ customer.name }} </td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    {{ customer.work_with ? customer.work_with.name : 'Not Assigned yet'}}
                                </td>

                                <td>
                                    <a
                                        v-if="$page.auth.user.isAdmin"
                                        @click.prevent="onAssignClicked(customer)"
                                        href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Change</a>

                                </td>

                                <td class="py-4 px-6 border-b border-grey-light">
                                    {{ customer.status_id ? setCustomerStatus(customer.status_id) : 'Not Assigned yet'}}
                                </td>
                                <td>
                                    <a
                                        @click.prevent="viewStatusModal(customer)"
                                        href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Change Staus</a>

                                </td>

                                </tr>

                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- add customer modal -->
        <jet-dialog-modal
            :show="showModal"
            @close="onCloseModal">
            <template #title>
                Add New Customer
            </template>

            <template #content>
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="name" value="Name" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                    <jet-input-error :message="form.error('name')" class="mt-2" />
                </div>

            </template>

            <template #footer>
                <jet-primary-button @click.native="createCustomer">
                    Save
                </jet-primary-button>

            </template>

        </jet-dialog-modal>

        <!--  assign customer to employee modal  -->
        <jet-dialog-modal
            :show="showAssignModal"
            @close="showAssignModal = false">
            <template #title>
                Assign Customer To Employee
            </template>

            <template #content>
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="name" value="Name" />
                    <jet-input
                        id="name" type="text" class="mt-1 block w-full"
                        v-model="selectedCustomer.name" autocomplete="name" readOnly />
                </div>

                <div class="col-span-6 sm:col-span-4 mt-2">
                    <div>
                        <jet-label for="employees" value="Choose an employee" />
                        <div class="relative">
                            <select
                                v-model="assign.employee_id"
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="employees">
                            <option v-for="employee in employees"
                                :key="employee.id"
                                :value="employee.id"
                                >
                                {{ employee.name }}
                            </option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        </div>
                </div>

            </template>

            <template #footer>
                <jet-primary-button @click.native="AssignCustomerToEmployee">
                    Assign
                </jet-primary-button>

            </template>

        </jet-dialog-modal>

        <!--  customer status modal -->
        <jet-dialog-modal
            :show="showStatusModal"
            @close="showStatusModal = false">
            <template #title>
                Update Status
            </template>

            <template #content>
                <!-- status -->
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <div>
                        <jet-label for="employees" value="Choose an employee" />
                        <div class="relative">
                            <select
                                v-model="status.status_id"
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="employees">
                            <option v-for="status in statuses"
                                :key="status.id"
                                :value="status.id"
                                >
                                {{ status.name }}
                            </option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-4 mt-2">
                    <textarea
                        v-model="status.result"
                        placeholder="descripe the result here"
                        class="resize border rounded focus:outline-none focus:shadow-outline"></textarea>

                </div>

            </template>

            <template #footer>
                <jet-primary-button @click.native="updateStatus">
                    Update
                </jet-primary-button>

            </template>

        </jet-dialog-modal>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Employees from '@/Jetstream/Welcome'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetPrimaryButton from '@/Jetstream/PrimaryButton'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'



    export default {
        components: {
            AppLayout,
            Employees,
            JetDialogModal,
            JetPrimaryButton,
            JetDangerButton,
            JetInput,
            JetInputError,
            JetLabel,
            JetActionMessage,
        },
        props: ['customers', 'employees', 'statuses'],
        data() {
            return {
                showModal: false,
                showAssignModal: false,
                showStatusModal: false,
                selectedCustomer: {},
                form: this.$inertia.form({
                    name: '',
                }, {
                    bag: 'createCustomer',
                }),
                assign: this.$inertia.form({
                    '_method': 'put',
                    employee_id: '',
                }, {
                }),
                status: this.$inertia.form({
                    '_method': 'put',
                    status_id: 0,
                    result: '',
                }, {
                })

            }
        },
        methods: {
            onCloseModal() {
                console.log('close modal');
                this.showModal = false;
                this.form.name = '';
            },
            createCustomer() {
                this.form.post(route('customers.store'), {
                    preserveScroll: true
                }).then(response => {
                    if (!this.form.hasErrors()) {
                        this.showModal = false;
                    }
                })
            },
            onAssignClicked(customer) {
                console.log(customer);
                this.selectedCustomer = customer;
                this.showAssignModal = true;
            },
            AssignCustomerToEmployee() {
               this.assign.post(route('customers.update', this.selectedCustomer.id), {
                    preserveScroll: true
                }).then(response => {
                    if (!this.form.hasErrors()) {
                        this.showAssignModal = false;
                    }
                })
            },
            viewStatusModal(customer) {
                this.selectedCustomer = customer;
                this.showStatusModal = true;
                this.status.status_id = customer.status_id || 0;
                this.status.result = customer.result || '';
            },
            updateStatus() {
                this.status.post(route('customers.update', this.selectedCustomer.id), {
                    preserveScroll: true
                }).then(response => {
                    if (!this.form.hasErrors()) {
                        this.showStatusModal = false;
                    }
                })
            },
            setCustomerStatus(status_id) {
                console.log(status_id);
                return this.statuses.find((status) => status.id === status_id).name;
            }
        }
    }
</script>

<template>
    <app-layout :isAdmin="$page.auth.user.isAdmin">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Employees
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <add-employee></add-employee>
                <div class="bg-white   sm:rounded-lg">
                    <div class="mx-auto">

                        <div class="bg-white shadow-md rounded my-6">
                            <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                            <thead>
                                <tr>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Name</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="employee in employees"
                                    :key="employee.id"
                                    class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light"> {{ employee.user.name }} </td>
                                <td class="py-4 px-6 border-b border-grey-light"> {{ employee.user.email }} </td>

                                </tr>

                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import AddEmployee from '@/Pages/Employee/Add.vue'

    export default {
        components: {
            AppLayout,
            AddEmployee,
        },
        props: ['employees'],
        data() {
            return {

            }
        },
        methods: {

        }
    }
</script>

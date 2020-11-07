<template>
    <div>
        <div>
            <div class="mx-auto">

                <div class="bg-white shadow-md rounded my-6">
                    <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                    <thead>
                        <tr>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Name</th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Email</th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="employee in employees"
                            :key="employee.id"
                            class="hover:bg-grey-lighter">
                        <td class="py-4 px-6 border-b border-grey-light"> {{ employee.name }} </td>
                        <td class="py-4 px-6 border-b border-grey-light"> {{ employee.email }} </td>
                        <td class="py-4 px-6 border-b border-grey-light">
                            <a href="" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Edit</a>
                            <a href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark">Delete</a>
                        </td>
                        </tr>

                    </tbody>
                    </table>
                </div>
                </div>
        </div>


    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'

    export default {
        components: {
            JetApplicationLogo,
        },
        props: ['employees'],
    }
</script>

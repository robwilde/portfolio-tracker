<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Invested Capital
            </h2>
        </template>

        <div class="py-12">
            <div class="p-6 bg-white border-b border-gray-200 flex items-center space-x-4 mx-auto max-w-7xl">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Month
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Invested Capital
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 overflow-y-scroll">
                    <tr v-for="item in viewModel.monthly" :key="item.month" class="hover:bg-gray-100">
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ item.month }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ item.amount }}</div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import DividendIncomeSummary from '@/Components/Dividend/DividendIncomeSummary.vue'
import PortfolioSummary from '@/Components/Portfolio/PortfolioSummary.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        DividendIncomeSummary,
        PortfolioSummary,
    },
    props: {
        viewModel: {
            type: Object,
            required: true,
        },
    },
}
</script>

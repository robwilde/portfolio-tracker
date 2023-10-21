<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <PortfolioSummary :portfolios="viewModel.portfolios" />
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <DividendIncomeSummary :summary="viewModel.dividend_income_summary" :monthly="viewModel.monthly_dividend_income" />
                </div>
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

<template>
    <Head title="Portfolio" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ viewModel.portfolio.name }}
            </h2>
            <p>
                Market value: {{ viewModel.portfolio.market_value }}
            </p>
            <p>Invested capital: {{ viewModel.portfolio.invested_capital }}</p>
            <p>Gain: {{ viewModel.portfolio.yield }}</p>
            <p>YoC: {{ viewModel.portfolio.yield_on_cost }}</p>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-6 gap-4">
                        <div v-for="holding in viewModel.holdings" :key="holding.id" class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md hover:bg-gray-100 cursor-pointer">
                            <div class="text-xl font-medium text-black">{{ holding.ticker }}</div>
                            <p class="text-gray-500">M: {{ holding.market_value }}</p>
                            <p class="text-gray-500">IC: {{ holding.invested_capital }}</p>
                            <p class="text-gray-500">Y: {{ holding.yield }}</p>
                            <p v-if="holding.yield_on_cost !== '0.00%'" class="text-gray-500">YoC: {{ holding.yield_on_cost }}</p>
                        </div>
                    </div>
                </div>
                <p>{{ viewModel.holdings.length }} holdings</p>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        viewModel: {
            type: Object,
            required: true,
        },
    }
}
</script>

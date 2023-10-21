<template>
    <div class="p-6 bg-white border-b border-gray-200 flex items-center space-x-4">
        <Link :href="getHref(portfolio)" v-for="portfolio in portfolios" :key="portfolio.id" class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex-1 hover:bg-gray-100 cursor-pointer">
            <div>
                <div class="text-xl font-medium text-black">{{ portfolio.name }}</div>
                <p class="text-gray-500">{{ portfolio.market_value }}</p>
                <p class="text-gray-500">{{ portfolio.yield }}</p>
            </div>
        </Link>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link,
    },
    props: {
        portfolios: {
            type: Array,
            required: true,
        },
    },
    methods: {
        getHref(portfolio) {
            return `/portfolios/${portfolio.slug}`;
        }
    },
}
</script>

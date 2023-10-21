<template>
    <div class="p-6 bg-white border-b border-gray-200 flex items-center space-x-4">
        <div v-for="item in summary" :key="item.label" class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex-1 hover:bg-gray-100 cursor-pointer">
            <div>
                <div class="text-xl font-medium text-black">{{ item.label }}</div>
                <p class="text-gray-500">{{ item.value }}</p>
            </div>
        </div>
    </div>

    <div class="p-6 bg-white border-b border-gray-200 flex items-center space-x-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Month
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Dividend Income
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 overflow-y-scroll">
              <tr v-for="item in monthly" :key="item.month" class="hover:bg-gray-100">
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
</template>
<script>
export default {
    props: {
        summary: {
            type: Object,
            required: true,
        },
        monthly: {
            type: Object,
            required: true,
        },
    },
}
</script>

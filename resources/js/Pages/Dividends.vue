<template>
    Total dividend received: ${{ total }}
    <table class="table table-striped">
      <tbody>
        <tr v-for="monthlyItem in monthly" :key="monthlyItem.month">
          <td>{{ monthlyItem.month }}</td>
          <td>{{ monthlyItem.dividendPaid }}</td>
        </tr>
      </tbody>
    </table>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
  },
  props: {
    total: {
      type: String,
      required: true,
    },
    monthly: {
      type: Object,
      required: true,
    },
  },
};
</script>

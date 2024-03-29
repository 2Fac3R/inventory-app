<template>
  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Products Manager
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1">
            <div class="px-4 sm:px0">
              <h3 class="text-lg text-gray-900">List of products</h3>
              <p class="text-sm text-gray-600">
                Select the correct record and perform any function (view or
                edit).
              </p>
            </div>
          </div>
          <div class="mt-4 md:col-span-2 md:mt-0">
            <div class="p-6 bg-white shadow md:rounded-md">
              <div class="flex justify-between">
                <input
                  type="text"
                  class="rounded-md shadow-sm form-input"
                  placeholder="Search..."
                  v-model="q"
                />

                <Link
                  :href="route('products.create')"
                  class="px-4 py-2 font-bold text-white bg-blue-500 rounded-md"
                >
                  Create a new product
                </Link>
              </div>
              <hr class="my-6" />
              <table class="table w-full border-separate border-spacing-4">
                <thead class="table-header-group">
                  <tr class="table-row">
                    <th class="table-cell text-center">SKU</th>
                    <th class="table-cell text-left">Name</th>
                    <th class="table-cell text-left">Price</th>
                    <th class="table-cell text-left">Stock</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="table-row"
                    v-for="product in products"
                    :key="product.id"
                  >
                    <td class="italic text-center">
                      {{ product.sku }}
                    </td>
                    <td class="text-left">
                      {{ product.name }}
                    </td>
                    <td class="text-left text-blue-600">
                      ${{ formatPrice(product.price) }}
                    </td>
                    <td class="text-left">
                      <p
                        :class="
                          product.state ? 'text-green-600' : 'text-red-600'
                        "
                      >
                        {{ product.state ? "Available" : "Not available" }}
                      </p>
                    </td>
                    <td class="text-right underline decoration-dotted">
                      <Link :href="route('products.show', product.id)">
                        View
                      </Link>
                    </td>
                    <td class="text-right underline decoration-dotted">
                      <Link :href="route('products.edit', product.id)">
                        Edit
                      </Link>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    BreezeAuthenticatedLayout,
    Link,
  },
  props: {
    products: Array,
  },
  data() {
    return {
      q: "",
    };
  },
  methods: {
    formatPrice(value) {
      const formattedValue = Number(value)
        .toFixed(2)
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      return formattedValue;
    },
  },
  watch: {
    q: function (value) {
      this.$inertia.replace(this.route("products.index", { q: value }));
    },
  },
};
</script>

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
              <h3 class="text-lg text-gray-900">Create a new product</h3>
              <p class="text-sm text-gray-600">
                You can edit a product after you create one
              </p>
            </div>
          </div>
          <div class="mt-5 md:col-span-2 md:mt-0">
            <div class="p-6 bg-white shadow md:rounded-md">
              <form @submit.prevent="submit" class="flex flex-col space-y-2">
                <label class="self-end block text-sm font-medium text-gray-700">
                  Stock
                </label>
                <input
                  type="checkbox"
                  class="self-end rounded-md shadow-sm form-input"
                  v-model="form.state"
                />
                <label class="block text-sm font-medium text-gray-700">
                  Category
                </label>
                <select
                  class="w-full rounded-md shadow-sm form-input"
                  v-model="form.category_id"
                >
                  <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <label class="block text-sm font-medium text-gray-700">
                  SKU
                </label>
                <input
                  type="text"
                  class="w-full rounded-md shadow-sm form-input"
                  v-model="form.sku"
                  placeholder="A stock-keeping unit (SKU)"
                />
                <label class="block text-sm font-medium text-gray-700">
                  Name
                </label>
                <input
                  type="text"
                  class="w-full rounded-md shadow-sm form-input"
                  v-model="form.name"
                />
                <label class="block text-sm font-medium text-gray-700">
                  Description
                </label>
                <textarea
                  class="w-full rounded-md shadow-sm form-input"
                  v-model="form.description"
                ></textarea>
                <label class="block text-sm font-medium text-gray-700">
                  Price
                </label>
                <input
                  type="number"
                  step="any"
                  class="w-full rounded-md shadow-sm form-input"
                  v-model="form.price"
                />
                <label class="block text-sm font-medium text-gray-700">
                  Quantity
                </label>
                <input
                  type="number"
                  class="w-full rounded-md shadow-sm form-input"
                  v-model="form.quantity"
                />

                <button
                  class="px-4 py-4 font-bold text-white bg-blue-500 rounded-md hover:bg-blue-700"
                >
                  Create
                </button>
              </form>
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
    categories: Array,
  },
  data() {
    return {
      form: {
        category_id: null,
        sku: "",
        name: "",
        description: "",
        price: null,
        quantity: null,
        state: false,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("products.store"), this.form);
    },
  },
};
</script>

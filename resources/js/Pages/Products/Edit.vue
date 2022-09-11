<template>
  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Módulo de Productos
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1">
            <div class="px-4 sm:px0">
              <h3 class="text-lg text-gray-900">Editar un producto</h3>
              <p class="text-sm text-gray-600">
                Si editas no podrás volver al estado anterior
              </p>
            </div>
          </div>
          <div class="mt-5 md:col-span-2 md:mt-0">
            <div class="p-4 bg-white shadow md:rounded-md">
              <form @submit.prevent="submit">
                <label class="block text-sm font-medium text-gray-700">
                  Categoría ({{ product.category.name }})
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
                  Nombre
                </label>
                <input
                  type="text"
                  class="w-full rounded-md shadow-sm form-input"
                  v-model="form.name"
                />
                <label class="block text-sm font-medium text-gray-700">
                  Descripción
                </label>
                <textarea
                  class="w-full rounded-md shadow-sm form-input"
                  v-model="form.description"
                ></textarea>
                <label class="block text-sm font-medium text-gray-700">
                  Precio
                </label>
                <input
                  type="number"
                  step="any"
                  class="w-full rounded-md shadow-sm form-input"
                  v-model="form.price"
                />
                <label class="block text-sm font-medium text-gray-700">
                  Cantidad
                </label>
                <input
                  type="number"
                  class="w-full rounded-md shadow-sm form-input"
                  v-model="form.quantity"
                />
                <label class="block text-sm font-medium text-gray-700">
                  Stock
                </label>
                <input
                  type="checkbox"
                  class="w-full rounded-md shadow-sm form-input"
                  v-model="form.state"
                />
                <button
                  class="px-4 py-2 font-bold text-white bg-blue-500 rounded-md hover:bg-blue-700"
                >
                  Editar
                </button>
              </form>
              <hr class="my-6" />

              <Link href="#" @click.prevent="destroy"> Eliminar Producto </Link>
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
    product: Object,
    categories: Array,
  },
  data() {
    return {
      form: {
        category_id: this.product.category,
        sku: this.product.sku,
        name: this.product.name,
        description: this.product.description,
        price: this.product.price,
        quantity: this.product.quantity,
        state: this.product.state ? true : false,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.put(
        this.route("products.update", this.product.id),
        this.form
      );
    },
    destroy() {
      if (confirm("¿Desea Eliminar?")) {
        this.$inertia.delete(this.route("products.destroy", this.product.id));
      }
    },
  },
};
</script>

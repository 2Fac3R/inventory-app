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
              <h3 class="text-lg text-gray-900">Listado de productos</h3>
              <p class="text-sm text-gray-600">
                Toma el registro correcto y ejecuta cualquier función (ver,
                editar o eliminar)
              </p>
            </div>
          </div>
          <div class="mt-5 md:col-span-2 md:mt-0">
            <div class="p-4 bg-white shadow md:rounded-md">
              <div class="flex justify-between">
                <input
                  type="text"
                  class="rounded-md shadow-sm form-input"
                  placeholder="Buscar..."
                  v-model="q"
                />

                <Link
                  :href="route('products.create')"
                  class="px-4 py-2 font-bold text-white bg-blue-500 rounded-md"
                >
                  Crear
                </Link>
              </div>
              <hr class="my-6" />
              <table>
                <thead>
                  <tr>
                    <th>SKU</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product in products" :key="product.id">
                    <td class="px-4 py-2">
                      {{ product.sku }}
                    </td>
                    <td class="px-4 py-2">
                      {{ product.name }}
                    </td>
                    <td class="px-4 py-2 text-blue-600">
                      ${{ product.price }}
                    </td>
                    <td
                      :class="[
                        product.state ? 'text-green-600' : 'text-red-600',
                      ]"
                    >
                      Stock
                    </td>
                    <td class="px-4 py-2 underline decoration-dotted">
                      <Link :href="route('products.show', product.id)">
                        Ver
                      </Link>
                    </td>
                    <td class="px-4 py-2 underline decoration-dotted">
                      <Link :href="route('products.edit', product.id)">
                        Editar
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
  watch: {
    q: function (value) {
      this.$inertia.replace(this.route("products.index", { q: value }));
    },
  },
};
</script>

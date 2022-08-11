<template>
  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Módulo de Productos
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1">
            <div class="px-4 sm:px0">
              <h3 class="text-xl text-gray-900">Detalle de un producto</h3>
              <p class="text-lg text-gray-800">{{ product.name }}</p>
              <p class="text-sm text-blue-600">${{ product.price }}</p>
              <p :class="[product.state ? 'text-green-600' : 'text-red-600']">
                {{ product.state ? "Disponible" : "No disponible" }}
              </p>
              <p class="text-sm italic text-gray-700">SKU: {{ product.sku }}</p>
              <p class="text-sm text-gray-700">Categoría: {{product.category.name}}</p>
            </div>
          </div>
          <div class="md:col-span-2 mt-5 md:mt-0">
            <div class="shadow bg-white md:rounded-md p-4">
              <p>{{ product.description }}</p>

              <hr class="my-6" />

              <Link :href="route('products.index')"> Volver </Link>
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
  },
};
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4 text-center">📦 Daftar Produk</h1>

    <div class="text-right mb-4">
      <router-link
        to="/add"
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
      >
        ➕ Tambah Produk
      </router-link>
    </div>

    <table class="min-w-full border border-gray-300 rounded-lg">
      <thead class="bg-gray-100">
        <tr>
          <th class="p-2 border">ID</th>
          <th class="p-2 border">Nama</th>
          <th class="p-2 border">Kategori</th>
          <th class="p-2 border">Harga</th>
          <th class="p-2 border">Stok</th>
          <th class="p-2 border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="product in products"
          :key="product.id"
          class="hover:bg-gray-50"
        >
          <td class="border p-2">{{ product.id }}</td>
          <td class="border p-2">{{ product.name }}</td>
          <td class="border p-2">{{ product.category.name }}</td>
          <td class="border p-2">{{ product.price }}</td>
          <td class="border p-2">{{ product.stock }}</td>
          <td class="border p-2 space-x-2">
            <router-link
              :to="`/edit/${product.id}`"
              class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500"
            >
              ✏️ Edit
            </router-link>
            <button
              @click="deleteProduct(product.id)"
              class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
            >
              🗑️ Hapus
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../services/api";

const products = ref([]);

const getProducts = async () => {
  const res = await api.get("/products"); // Mengambil data produk dari API => Misal: api.get("/products") otomatis akan menuju http://127.0.0.1:8000/api/products. url 'api' sudah di set di services/api.js (127.0.0.1:8000/api)
  products.value = res.data;
};

const deleteProduct = async (id) => {
  if (confirm("Yakin hapus produk ini?")) {
    await api.delete(`/products/${id}`);
    getProducts(); // Refresh data setelah hapus
  }
};

onMounted(() => {
  getProducts();
});
</script>

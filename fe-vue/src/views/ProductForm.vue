<template>
  <div class="p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">
      {{ isEdit ? "✏️ Edit Produk" : "➕ Tambah Produk" }}
    </h1>

    <div v-if="errors.length" class="bg-red-100 text-red-700 p-4 rounded mb-4">
      <ul>
        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
      </ul>
    </div>

    <form @submit.prevent="saveProduct" class="space-y-4">
      <div>
        <label class="block font-semibold mb-1">Nama Produk</label>
        <!-- // v-model mengikat input dengan properti form.name -->
        <input v-model="form.name" type="text" class="border p-2 w-full rounded" />
      </div>

      <div>
        <label class="block font-semibold mb-1">Kategori</label>
        <select v-model.number="form.category_id" class="border p-2 w-full rounded">
          <option disabled value="">Pilih Kategori</option>
          <option v-for="cat in categories" :key="cat.id" :value="cat.id">
            {{ cat.name }}
          </option>
        </select>
      </div>

      <div>
        <label class="block font-semibold mb-1">Deskripsi</label>
        <textarea v-model="form.description" class="border p-2 w-full rounded"></textarea>
      </div>

      <div>
        <label class="block font-semibold mb-1">Harga</label>
        <input v-model.number="form.price" type="number" class="border p-2 w-full rounded" />
      </div>

      <div>
        <label class="block font-semibold mb-1">Stok</label>
        <input v-model.number="form.stock" type="number" class="border p-2 w-full rounded" />
      </div>

      <div class="flex justify-between mt-4">
        <router-link to="/" class="bg-gray-400 text-white px-4 py-2 rounded">
          ← Kembali
        </router-link>
        <button
          type="submit"
          class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
        >
          💾 Simpan
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "../services/api";

const route = useRoute(); // untuk membaca parameter dari URL (/edit/:id),
const router = useRouter(); // untuk navigasi setelah simpan (router.push("/")).

// data awal form produk
const form = ref({
  name: "",
  category_id: "",
  description: "",
  price: "",
  stock: "",
});

const categories = ref([]); // untuk menyimpan daftar kategori dari API
const isEdit = ref(false); // menandai apakah sedang dalam mode edit atau tambah
const errors = ref([]); // untuk menyimpan pesan error

// fungsi untuk mengambil daftar kategori dari API jika mode edit
const getCategories = async () => {
  try {
    const res = await api.get("/categories");
    categories.value = res.data;
  } catch (err) {
    errors.value.push("Gagal memuat kategori.");
  }
};

// fungsi untuk mengambil data produk jika mode edit
const getProduct = async () => {
  const id = route.params.id; // membaca parameter id dari URL
  if (id) { // jika ada id, berarti mode edit
    isEdit.value = true;
    try {
      const res = await api.get(`/products/${id}`);
      form.value = {
        name: res.data.name,
        category_id: res.data.category_id,
        description: res.data.description,
        price: res.data.price,
        stock: res.data.stock,
      };
    } catch (err) {
      errors.value.push("Gagal memuat data produk.");
    }
  }
};

// fungsi untuk menyimpan produk (tambah atau edit)
const saveProduct = async () => { // saat tombol simpan ditekan
  errors.value = [];
  
  if (!form.value.name || !form.value.category_id || !form.value.price) {
    errors.value.push("Nama, Kategori, dan Harga harus diisi.");
    return;
  }

  try {
    if (isEdit.value) { // jika mode edit
      await api.put(`/products/${route.params.id}`, form.value); // update produk
    } else { // jika mode tambah
      await api.post("/products", form.value); // tambah produk
    }
    router.push("/"); // kembali ke daftar produk setelah simpan
  } catch (err) {
    if (err.response && err.response.data.errors) {
      errors.value = Object.values(err.response.data.errors).flat();
    } else {
      errors.value.push("Terjadi kesalahan saat menyimpan data.");
    }
  }
};

// Data produk langsung dimuat begitu halaman dibuka.
onMounted(() => {
  getCategories();
  getProduct();
});
</script>

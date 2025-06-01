<script setup>
import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { mdiPlus, mdiApplicationEdit, mdiTrashCan } from "@mdi/js";
import Swal from "sweetalert2";

const props = defineProps({
  title: { type: String, required: true },
  applicants: { type: Object, required: true },
  routeName: { type: String, required: true },
  search: { type: String, required: false },
  order: { type: String, required: false },
  direction: { type: String, required: false },
});

const eliminar = (id) => {
  Swal.fire({
    title: "¿Estás seguro?",
    text: "Esta acción no se puede revertir",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Sí, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(route(`${props.routeName}destroy`, id));
    }
  });
};
</script>

<template>
  <Head :title="title" />
  <LayoutMain>
    <SectionTitleLineWithButton :icon="mdiPlus" :title="title" main>
      <Link :href="route(`${routeName}create`)" class="action-button">Agregar nuevo</Link>
    </SectionTitleLineWithButton>

    <div v-if="applicants.data.length" class="mt-4">
      <table class="table-auto w-full">
        <thead>
          <tr>
            <th class="px-4 py-2">Nombre</th>
            <th class="px-4 py-2">Apellido</th>
            <th class="px-4 py-2">Correo</th>
            <th class="px-4 py-2">Número</th>
            <th class="px-4 py-2">Car</th>
            <th class="px-4 py-2 text-right">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in applicants.data" :key="item.id">
            <td class="border px-4 py-2">{{ item.name }}</td>
            <td class="border px-4 py-2">{{ item.surname }}</td>
            <td class="border px-4 py-2">{{ item.email }}</td>
            <td class="border px-4 py-2">{{ item.phone }}</td>
            <td class="border px-4 py-2">{{ item.car }}</td>
            <td class="border px-4 py-2 text-right">
              <Link :href="route(`${routeName}edit`, item.id)" class="icon-button">
                <i :class="mdiApplicationEdit"></i> Editar
              </Link>
              <button @click="eliminar(item.id)" class="iconred ml-2">
                <i :class="mdiTrashCan"></i> Eliminar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else class="mt-4">
      <p>No hay registros disponibles.</p>
    </div>
  </LayoutMain>
</template>

<style scoped>
.action-button {
  background-color: #4f1f91;
  color: #fff;
  padding: 10px 20px;
  border-radius: 4px;
  text-decoration: none;
  border: none;
  cursor: pointer;
}
.action-button:hover {
  background-color: #fbb034;
}
.icon-button {
  background-color: #fbb034;
  color: #fff;
  padding: 6px 12px;
  border-radius: 4px;
  text-decoration: none;
}
.iconred {
  background-color: #f50003;
  color: #fff;
  padding: 6px 12px;
  border-radius: 4px;
  border: none;
}
</style>

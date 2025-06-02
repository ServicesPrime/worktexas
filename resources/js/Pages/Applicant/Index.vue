<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, reactive, watch } from "vue";
import debounce from "lodash/debounce";
import Swal from "sweetalert2";

import LayoutMain from "@/Layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import Pagination from "@/Shared/Pagination.vue";

const props = defineProps({
  title: String,
  routeName: String,
  applicants: Object,
  search: String,
  order: String,
  direction: String,
});

const search = ref(props.search);
const filters = reactive({
  search: search,
  order: props.order,
  direction: props.direction,
});

watch(search, debounce(() => {
  router.get(route(`${props.routeName}index`), filters, { replace: true });
}, 400));

const clearFilters = () => {
  search.value = "";
  router.get(route(`${props.routeName}index`));
};

const remove = (id) => {
  Swal.fire({
    title: "Are you sure?",
    text: "This action cannot be undone.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#4f1f91",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
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
    <SectionTitleLineWithButton :title="title" main>
      <Link :href="route(`${routeName}create`)" class="action-button ml-auto">
        + Add New
      </Link>
    </SectionTitleLineWithButton>

    <form @submit.prevent class="my-4 flex gap-2">
      <input
        v-model="search"
        type="search"
        placeholder="Search..."
        class="flex-1 border rounded px-3 py-2"
      />
      <button type="button" @click="clearFilters" class="action-button bg-gray-400">
        Clear
      </button>
    </form>

    <div v-if="applicants.data.length">
      <table class="table-auto w-full border">
        <thead>
          <tr>
            <th class="px-4 py-2 border">First name</th>
            <th class="px-4 py-2 border">Last name</th>
            <th class="px-4 py-2 border">Email</th>
            <th class="px-4 py-2 border">Phone</th>
            <th class="px-4 py-2 border">Car</th>
            <th class="px-4 py-2 border text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="applicant in applicants.data" :key="applicant.id">
            <td class="border px-4 py-2">{{ applicant.name }}</td>
            <td class="border px-4 py-2">{{ applicant.surname }}</td>
            <td class="border px-4 py-2">{{ applicant.email }}</td>
            <td class="border px-4 py-2">{{ applicant.phone }}</td>
            <td class="border px-4 py-2">{{ applicant.car }}</td>
            <td class="border px-4 py-2 text-right space-x-2">
              <Link
                :href="route(`${routeName}edit`, applicant.id)"
                class="icon-button"
              >
                Edit
              </Link>
              <button @click="remove(applicant.id)" class="iconred">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <Pagination
        class="mt-4"
        :links="applicants.links"
        :total="applicants.total"
        :to="applicants.to"
        :from="applicants.from"
      />
    </div>

    <div v-else class="mt-4 text-gray-600">
      <p>No applicants found.</p>
    </div>
  </LayoutMain>
</template>

<style scoped>
.action-button {
  background-color: #4f1f91;
  color: white;
  padding: 8px 16px;
  border-radius: 4px;
  text-decoration: none;
  border: none;
  cursor: pointer;
}
.action-button:hover {
  background-color: #6b21a8;
}
.icon-button {
  background-color: #38a169;
  color: white;
  padding: 6px 12px;
  border-radius: 4px;
  border: none;
}
.iconred {
  background-color: #e53e3e;
  color: white;
  padding: 6px 12px;
  border-radius: 4px;
  border: none;
}
</style>

<script setup>
import DeviceCard from "@/Components/DeviceCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps(["devices"]);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <!-- Devices Container -->
        <div
            class="flex-col md:flex-row gap-8 p-4 flex flex-wrap md:justify-between max-w-7xl mx-auto"
        >
            <DeviceCard v-for="device in devices" :device="device" />
        </div>
    </AuthenticatedLayout>
</template>

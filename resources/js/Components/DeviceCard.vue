<script setup>
import { onMounted, ref, toRefs } from "vue";

const props = defineProps(["device"]);
const { device } = toRefs(props);
const updatedDevice = ref(device.value);

onMounted(() => {
    window.Echo.channel(`device-status-updated.${props.device.name}`).listen(
        "DeviceStatusUpdated",
        (e) => {
            Object.assign(updatedDevice.value, e.device);
        }
    );
});
</script>

<template>
    <div class="">
        <div class="min-w-96 sm:w-1/2">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-lg text-gray-900">
                        {{ updatedDevice.name }}
                    </span>
                    <span
                        class="h-3 w-3 rounded-full"
                        :class="[
                            updatedDevice.status
                                ? 'bg-green-500'
                                : 'bg-red-500',
                        ]"
                    >
                        &nbsp;
                    </span>
                </div>

                <div class="text-sm text-gray-400 mt-2">
                    last seen {{ updatedDevice.last_connected_at }}
                </div>
            </div>
        </div>
    </div>
</template>

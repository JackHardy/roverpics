<script setup>
import { onMounted, ref } from 'vue';

defineProps({
  modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        :value="modelValue"
        class="rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>

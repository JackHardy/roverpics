<script setup>
defineProps({
  type: {
    type: String,
    default: 'submit',
  },
});
</script>

<template>
    <button :type="type"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-red-400 focus:bg-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-600">
        <slot/>
    </button>
</template>

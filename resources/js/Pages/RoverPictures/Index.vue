<script setup>
import { useForm } from 'laravel-precognition-vue-inertia';
import PrimaryButton from '@/Components/PrimaryButton.vue';

function logout() {
  useForm('post', route('logout'), {})
    .submit();
}
</script>

<template>
    <PrimaryButton @click="logout">
        Logout
    </PrimaryButton>
    <div>
        <h1>Rover Pictures</h1>
    </div>
</template>

<style scoped>

</style>

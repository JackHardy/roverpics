<script setup>
import axios from 'axios';
import { useForm } from 'laravel-precognition-vue-inertia';
import { onMounted, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { ArrowPathIcon } from '@heroicons/vue/20/solid';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const token = ref(localStorage.getItem('token'));
const roverPictures = ref([]);

async function getRoverPictures() {
  // Function to fetch rover pictures from the API
  await axios.get(route('api.nasa.rover-pictures.index'), {
    headers: {
      // Include token in Authorization header for sanctum as not using EnsureFrontendRequestsAreStateful middleware for the purposes of this test
      Authorization: `Bearer ${token.value}`,
      Accept: 'application/json',
    },
  })
    .then((response) => {
      if (response.data) {
        roverPictures.value = JSON.parse(response.data);
      }
    })
    .catch((response) => {
      console.log(response.response.data.message, response.response.data.errors);
    });
}

async function generateToken() {
  // For the purposes of this test this is a function to emulate the generation of a new token
  if (!token.value) {
    await axios.post(route('api.tokens.store'), {
      // Send user_id to generate a token as no auth can be used for this call controller side
      user_id: usePage().props.auth.user.id,
    })
      .then((response) => {
        if (response.data) {
          token.value = response.data.token;
          // Store token in local storage as if we were some form of vue standalone mobile app
          localStorage.setItem('token', token.value);
          getRoverPictures();
        }
      })
      .catch((response) => {
        console.log(response.response.data.message, response.response.data.errors);
      });
  }
}

function logout() {
  // Function to logout and remove the token
  localStorage.removeItem('token');
  useForm('post', route('logout'), {})
    .submit();
}

onMounted(() => {
  // Fetch rover pictures on component mount if key is already in memory
  if (token.value) {
    getRoverPictures();
  }
});
</script>

<template>
    <div class="flex justify-between">
        <h1>Rover Pictures</h1>
        <!-- Button to logout -->
        <PrimaryButton @click="logout">
            Logout
        </PrimaryButton>
    </div>
    <div class="flex flex-col">
        <div v-if="!token">
            <p>
                You need to generate a token to view the pictures.
            </p>
            <!-- Button to generate a token -->
            <PrimaryButton @click="generateToken">
                Generate token
            </PrimaryButton>
        </div>
        <div v-else class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Rover pictures</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all of rover pictures.</p>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div v-if="!roverPictures.photos">
                            <!-- Loading icon while fetching data -->
                            <ArrowPathIcon class="mx-auto size-6 animate-spin"/>
                        </div>
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                            <tr>
                                <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                                    scope="col">
                                    Camera
                                </th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900" scope="col">
                                    Earth Date
                                </th>
                                <th class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900" scope="col">
                                    Image
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                            <tr v-for="roverPicture in roverPictures.photos" :key="roverPicture.id">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                    {{ roverPicture.camera.full_name }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ roverPicture.earth_date }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4">
                                    <img :alt="`Rover photo ${roverPicture.id}`"
                                         :src="roverPicture.img_src"
                                         class="ml-auto"/>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

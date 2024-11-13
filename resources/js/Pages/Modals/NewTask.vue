<script setup>
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'
import axios from 'axios';

const open = ref(false)
const title = ref(null)
const description = ref(null)
const emit = defineEmits(["savedTask"]);
const errors = ref({})

function processForm() {
    axios.post('/tasks/store', {
        _token: usePage().props.csrf_token,
        title: title.value,
        description: description.value
    })
        .then(response => {
            if( response.status === 200 ) {
                open.value = false;
                emit('savedTask');
            }
        }).catch(error => {
            errors.value = error.response.data.errors
        })
}

</script>

<template>
    <button class="btn btn-primary" @click="open = true">New Task</button>

    <Teleport to="body">
        <div v-if="open" class="modal">
            <div class="m-4">
                <h2 class="text-xl">New Task</h2>
                <form @submit.prevent="processForm">
                    <div class="py-3">
                        <label class="block">Title</label>
                        <input v-model="title" id="title" name="title" type="text" value="" class="form-control" />
                        <span class="block text-red-600" v-if="errors?.title">{{ errors.title[0] }}</span>
                    </div>
                    <div class="py-3">
                        <label class="block">Description</label>
                        <textarea v-model="description" id="description" name="description" rows="4" cols="50" class="form-control"></textarea>
                        <span class="block text-red-600" v-if="errors?.description">{{ errors.description[0] }}</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <button class="btn btn-secondary" @click="open = false">Cancel</button>
            </div>
        </div>
    </Teleport>
</template>

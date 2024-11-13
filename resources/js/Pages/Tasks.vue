<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onBeforeMount } from 'vue';
import NewTask from '@/Pages/Modals/NewTask.vue';

const tasks = ref(null);

onBeforeMount(() => {
    reload()
});

function reload() {
    fetch('/tasks/list')
        .then(response => response.json())
        .then(data => {
            tasks.value = data;
        })
}

function completeTask(id) {
    axios.post('/tasks/complete', {
        _token: usePage().props.csrf_token,
        id: id,
    })
        .then(response => {
            if( response.status === 200 ) {
                reload()
            }
        })
}

function deleteTask(id) {
    axios.post('/tasks/delete', {
        _token: usePage().props.csrf_token,
        id: id,
    })
        .then(response => {
            if( response.status === 200 ) {
                reload()
            }
        })
}

</script>

<template>
    <AppLayout title="Tasks">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tasks
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Head title="Tasks" />
                <NewTask @saved-task="reload"/>
                <main class="mt-6">
                    <div v-for="task in tasks" class="p-6 my-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="pb-6">
                            {{ task.title}}
                        </div>
                        <div class="pb-6">
                            {{ task.description }}
                        </div>
                        <div>
                            {{ task.complete ? 'Completed' : 'In Progress' }}

                            <button v-if="!task.complete" class="btn btn-primary" @click="completeTask(task.id)">Complete</button>
                            <button class="btn btn-secondary" @click="deleteTask(task.id)">Delete</button>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </AppLayout>
</template>

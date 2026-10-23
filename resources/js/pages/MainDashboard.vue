<script setup>
// TODO: AI code... Review

import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

// Controller sends us the server list
const props = defineProps ({
    servers: Array
})

// Hardcoded initial state for game servers
/*
const servers = ref([
    { id: 1, name: 'Main CS2 Server', game: 'Counter-Strike 2', ip: '192.168.1.50:27015', status: 'running', players: '12/16' },
    { id: 2, name: 'Valheim Casual Cluster', game: 'Valheim', ip: '192.168.1.51:2456', status: 'stopped', players: '0/10' },
    { id: 3, name: 'Minecraft Survival', game: 'Minecraft', ip: '192.168.1.52:25565', status: 'running', players: '5/20' },
])
*/

// Actions to simulate starting and stopping servers
const startServer = (id) => {

    router.post(`/servers/${id}/start`, {}, {
        preserveScroll: true,
        // Update button text so user knows background stuff is happening
        onStart: () => {
            const server = props.servers.find(s => s.id === id)
            if (server) server.status = 'starting'
        }
    })
}

const stopServer = (id) => {

    router.post(`/servers/${id}/stop`, {}, {
        preserveScroll: true,
        // Update button text so user knows background stuff is happening
        onStart: () => {
            const server = props.servers.find(s => s.id === id)
            if (server) server.status = 'stopping'
        }
    })
}

</script>

<template>
    <div class="min-h-screen bg-slate-900 text-slate-100 p-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">Game Server Dashboard</h1>
                    <p class="text-slate-400 mt-1">Manage and monitor your edge node game instances.</p>
                </div>
                <button class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg font-medium transition shadow-sm">
                    + Deploy Server
                </button>
            </div>

            <!-- Servers Table Card -->
            <div class="bg-slate-800 border border-slate-700 rounded-xl overflow-hidden shadow-xl">
                <div class="p-6 border-b border-slate-700">
                    <h2 class="text-lg font-semibold">Active Game Instances</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-800/50 text-slate-400 text-xs uppercase tracking-wider border-b border-slate-700">
                                <th class="py-4 px-6 font-medium">Server Name</th>
                                <th class="py-4 px-6 font-medium">Game</th>
                                <th class="py-4 px-6 font-medium">Address</th>
                                <th class="py-4 px-6 font-medium">Status</th>
                                <th class="py-4 px-6 font-medium">Players</th>
                                <th class="py-4 px-6 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700 text-sm">
                            <tr v-for="server in servers" :key="server.id" class="hover:bg-slate-700/30 transition">
                                <td class="py-4 px-6 font-medium text-white">{{ server.name }}</td>
                                <td class="py-4 px-6 text-slate-300">{{ server.game }}</td>
                                <td class="py-4 px-6 font-mono text-xs text-slate-400">{{ server.ip }}</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize"
                                        :class="{
                                            'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20': server.status === 'running',
                                            'bg-rose-500/10 text-rose-400 border border-rose-500/20': server.status === 'stopped',
                                            'bg-amber-500/10 text-amber-400 border border-amber-500/20': server.status === 'starting' || server.status === 'stopping'
                                        }">
                                        <span class="w-1.5 h-1.5 rounded-full mr-1.5 animate-pulse"
                                            :class="{
                                                'bg-emerald-400': server.status === 'running',
                                                'bg-rose-400': server.status === 'stopped',
                                                'bg-amber-400': server.status === 'starting' || server.status === 'stopping'
                                            }"></span>
                                        {{ server.status }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-slate-300">{{ server.players }}</td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <button 
                                        v-if="server.status === 'stopped'"
                                        @click="startServer(server.id)"
                                        class="bg-emerald-600/20 hover:bg-emerald-600 text-emerald-400 hover:text-white border border-emerald-600/30 px-3 py-1.5 rounded text-xs font-medium transition">
                                        Start
                                    </button>
                                    <button 
                                        v-if="server.status === 'running'"
                                        @click="stopServer(server.id)"
                                        class="bg-rose-600/20 hover:bg-rose-600 text-rose-400 hover:text-white border border-rose-600/30 px-3 py-1.5 rounded text-xs font-medium transition">
                                        Stop
                                    </button>
                                    <button 
                                        v-if="server.status === 'starting' || server.status === 'stopping'"
                                        disabled
                                        class="bg-slate-700 text-slate-500 px-3 py-1.5 rounded text-xs font-medium cursor-not-allowed">
                                        Working...
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

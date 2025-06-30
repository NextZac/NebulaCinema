<template>
    <AdminLayout title="Manage Tickets">
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-semibold text-gray-700">Tickets</h1>
                        <!-- Placeholder for potential "Create Ticket" or other actions -->
                    </div>

                    <div v-if="$page.props.flash && $page.props.flash.success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ $page.props.flash.success }}</span>
                    </div>
                    <div v-if="$page.props.flash && $page.props.flash.error" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ $page.props.flash.error }}</span>
                    </div>

                    <!-- Add Filters here later if needed -->
                    <!-- 
                    <div class="mb-4">
                        <input type="text" v-model="search" placeholder="Search tickets..." class="mt-1 block w-1/3 border-gray-300 rounded-md shadow-sm">
                    </div>
                    -->

                    <div class="overflow-x-auto bg-white rounded shadow">
                        <table class="w-full whitespace-nowrap">
                            <thead class="bg-gray-50">
                                <tr class="text-left font-bold">
                                    <th class="px-6 pt-6 pb-4">ID</th>
                                    <th class="px-6 pt-6 pb-4">User</th>
                                    <th class="px-6 pt-6 pb-4">Movie</th>
                                    <th class="px-6 pt-6 pb-4">Cinema Room</th>
                                    <th class="px-6 pt-6 pb-4">Seat Number</th>
                                    <th class="px-6 pt-6 pb-4">Price</th>
                                    <th class="px-6 pt-6 pb-4">Purchased At</th>
                                    <th class="px-6 pt-6 pb-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ticket in tickets.data" :key="ticket.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td class="border-t px-6 py-4">{{ ticket.id }}</td>
                                    <td class="border-t px-6 py-4">
                                        <div v-if="ticket.user">
                                            <div>{{ ticket.user.name }}</div>
                                            <div class="text-xs text-gray-500">{{ ticket.user.email }}</div>
                                        </div>
                                        <div v-else class="text-xs text-gray-500">Guest</div>
                                    </td>
                                    <td class="border-t px-6 py-4">{{ ticket.movie_session?.movie?.title || 'N/A' }}</td>
                                    <td class="border-t px-6 py-4">{{ ticket.movie_session?.cinema_room?.name || 'N/A' }}</td>
                                    <td class="border-t px-6 py-4">{{ ticket.seat_number }}</td>
                                    <td class="border-t px-6 py-4">{{ formatCurrency(ticket.price) }}</td>
                                    <td class="border-t px-6 py-4">{{ formatDate(ticket.created_at) }}</td>
                                    <td class="border-t px-6 py-4 text-right">
                                        <!-- <Link :href="route('admin.tickets.show', ticket.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">View</Link> -->
                                        <!-- Add other actions like "Refund" or "Resend Email" later -->
                                         <button @click="viewTicket(ticket)" class="text-blue-600 hover:text-blue-900">View Details</button>
                                    </td>
                                </tr>
                                <tr v-if="tickets.data.length === 0">
                                    <td class="border-t px-6 py-4" colspan="8">No tickets found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div v-if="tickets.links.length > 3" class="mt-6">
                        <div class="flex flex-wrap -mb-1">
                            <template v-for="(link, key) in tickets.links" :key="key">
                                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
                                <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for viewing ticket details -->
        <Modal :show="showTicketModal" @close="closeTicketModal">
            <div class="p-6" v-if="selectedTicket">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Ticket Details (ID: {{ selectedTicket.id }})</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><strong>User:</strong> {{ selectedTicket.user?.name || 'Guest' }} ({{ selectedTicket.user?.email }})</div>
                    <div><strong>Movie:</strong> {{ selectedTicket.movie_session?.movie?.title }}</div>
                    <div><strong>Cinema Room:</strong> {{ selectedTicket.movie_session?.cinema_room?.name }}</div>
                    <div><strong>Session Time:</strong> {{ formatDate(selectedTicket.movie_session?.start_time, true) }}</div>
                    <div><strong>Seat Number:</strong> {{ selectedTicket.seat_number }}</div>
                    <div><strong>Price:</strong> {{ formatCurrency(selectedTicket.price) }}</div>
                    <div><strong>Purchased At:</strong> {{ formatDate(selectedTicket.created_at, true) }}</div>
                    <div><strong>Status:</strong> <span class="px-2 py-1 text-xs font-semibold rounded-full" :class="selectedTicket.is_used ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800'">{{ selectedTicket.is_used ? 'Used' : 'Active' }}</span></div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button @click="closeTicketModal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Close
                    </button>
                </div>
            </div>
        </Modal>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue'; // Assuming Modal component

const props = defineProps({
    tickets: Object,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const showTicketModal = ref(false);
const selectedTicket = ref(null);

const formatDate = (datetime, includeTime = false) => {
    if (!datetime) return 'N/A';
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    if (includeTime) {
        options.hour = '2-digit';
        options.minute = '2-digit';
    }
    return new Date(datetime).toLocaleDateString(undefined, options);
};

const formatCurrency = (value) => {
    if (typeof value !== 'number') {
        value = parseFloat(value);
    }
    return value.toLocaleString(undefined, { style: 'currency', currency: 'EUR' }); // Adjust currency as needed
};

const viewTicket = (ticket) => {
    selectedTicket.value = ticket; // Potentially fetch full details if needed: router.reload({ only: ['selectedTicketFull']}) after setting ID
    showTicketModal.value = true;
};

const closeTicketModal = () => {
    showTicketModal.value = false;
    selectedTicket.value = null;
};

// Watch for search changes to refetch tickets (example)
// import { watch } from 'vue';
// watch(search, value => {
//     router.get(route('admin.tickets.index'), { search: value }, { preserveState: true, replace: true });
// });
</script>

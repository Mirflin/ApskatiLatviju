<template>
    <article class="main-panel">
        <div class="panel">
            <div class="panel-header">
                <p>{{ $breadcrumb }}</p>
            </div>
            <div class="p-6 bg-[#f7f8fa]">
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div class="header-button-panels">
                        <h2 class="text-lg font-semibold mb-4 text-gray-800">
                            History
                        </h2>
                        <button>Create new</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table
                            class="min-w-full text-sm text-left text-gray-700"
                        >
                            <thead class="bg-[#f0f1f5] text-gray-600">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-4 py-3 rounded-tl-xl"
                                    >
                                        #
                                    </th>
                                    <th scope="col" class="px-4 py-3">User</th>
                                    <th scope="col" class="px-4 py-3">
                                        Action
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-4 py-3 rounded-tr-xl"
                                    >
                                        Date
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-4 py-3">Tools</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr class="border-b hover:bg-[#f5f6f8]">
                                    <td class="px-4 py-2">1</td>
                                    <td class="px-4 py-2">John Doe</td>
                                    <td class="px-4 py-2">Deleted item</td>
                                    <td class="px-4 py-2">2025-06-09</td>
                                    <td
                                        class="px-4 py-2 text-green-600 font-medium"
                                    >
                                        Success
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-[#f5f6f8]">
                                    <td class="px-4 py-2">2</td>
                                    <td class="px-4 py-2">Jane Smith</td>
                                    <td class="px-4 py-2">Edited settings</td>
                                    <td class="px-4 py-2">2025-06-08</td>
                                    <td
                                        class="px-4 py-2 text-yellow-600 font-medium"
                                    >
                                        Pending
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <!-- Modal window -->
</template>

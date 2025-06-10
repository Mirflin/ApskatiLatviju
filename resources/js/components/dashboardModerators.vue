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
                            Moderators
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
                                    <th scope="col" class="px-4 py-3">Email</th>
                                    <th
                                        scope="col"
                                        class="px-4 py-3 rounded-tr-xl"
                                    >
                                        Permisions
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
                                    <td class="px-4 py-2">joe@gmail.com</td>
                                    <td class="px-4 py-2">Moderator</td>
                                    <td
                                        class="px-4 py-2 text-green-600 font-medium"
                                    >
                                        Active
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-[#f5f6f8]">
                                    <td class="px-4 py-2">2</td>
                                    <td class="px-4 py-2">Jane Smith</td>
                                    <td class="px-4 py-2">smith@gmail.com</td>
                                    <td class="px-4 py-2">Administrator</td>
                                    <td
                                        class="px-4 py-2 text-green-600 font-medium"
                                    >
                                        Active
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
</template>

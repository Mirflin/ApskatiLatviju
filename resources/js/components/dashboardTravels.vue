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
                            Travel
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
                                    <th scope="col" class="px-4 py-3">Name</th>
                                    <th scope="col" class="px-4 py-3">City</th>
                                    <th
                                        scope="col"
                                        class="px-4 py-3 rounded-tr-xl"
                                    >
                                        Description
                                    </th>
                                    <th scope="col" class="px-4 py-3">Price</th>
                                    <th scope="col" class="px-4 py-3">
                                        Time term
                                    </th>
                                    <th scope="col" class="px-4 py-3">Tools</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr class="border-b hover:bg-[#f5f6f8]">
                                    <td class="px-4 py-2">1</td>
                                    <td class="px-4 py-2">No Kuldiga</td>
                                    <td class="px-4 py-2">Liepaja</td>
                                    <td class="px-4 py-2">
                                        Lorem ipsum dolor sit amet consectetur
                                        adipisicing elit. Odio, deserunt?
                                        Repellendus quidem aut cumque dolores.
                                        Facere earum id maiores tempore, quod
                                        molestias quaerat quisquam dolorum
                                        commodi voluptate eveniet reiciendis
                                        magnam?
                                    </td>
                                    <td class="px-4 py-2">20</td>
                                    <td
                                        class="px-4 py-2 text-green-600 font-medium"
                                    >
                                        2025.06.30
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-[#f5f6f8]">
                                    <td class="px-4 py-2">2</td>
                                    <td class="px-4 py-2">No Kuldigai</td>
                                    <td class="px-4 py-2">Riga</td>
                                    <td class="px-4 py-2">
                                        Lorem ipsum dolor sit amet consectetur
                                        adipisicing elit. Odio, deserunt?
                                        Repellendus quidem aut cumque dolores.
                                        Facere earum id maiores tempore, quod
                                        molestias quaerat quisquam dolorum
                                        commodi voluptate eveniet reiciendis
                                        magnam?
                                    </td>
                                    <td class="px-4 py-2">40</td>
                                    <td
                                        class="px-4 py-2 text-green-600 font-medium"
                                    >
                                        2025.07.30
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

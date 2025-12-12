@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Product Categories</h1>
            <a href="{{ route('admin.product-categories.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg> Add Category
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-gray-500 font-semibold">
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Image</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Slug</th>
                            <th class="px-6 py-4">Sequence</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->category_name }}" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <span class="text-gray-400">No Image</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-700">
                                    <button onclick='openSubCategoryModal(@json($category))'
                                        class="text-indigo-600 hover:text-indigo-900 hover:underline focus:outline-none">
                                        {{ $category->category_name }}
                                    </button>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $category->slug }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $category->sequence }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button onclick='openViewModal(@json($category))'
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition duration-200"
                                            title="View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <a href="{{ route('admin.product-categories.edit', $category->id) }}"
                                            class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition duration-200"
                                            title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.product-categories.destroy', $category->id) }}"
                                            method="POST" class="inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition duration-200"
                                                title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                        </svg>
                                        <p>No categories found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($categories->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
    <!-- View Category Modal -->
    <div id="viewCategoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm"></div>
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                <div class="bg-indigo-600 px-4 py-3 sm:px-6 flex justify-between items-center">
                    <h3 class="text-base font-semibold leading-6 text-white" id="modal-title">Category Details</h3>
                    <button type="button" class="text-indigo-100 hover:text-white focus:outline-none"
                        onclick="closeViewModal()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="space-y-4">
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">Category Name</dt>
                            <dd class="mt-1 text-sm text-gray-900" id="modalCategoryName">--</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">Slug</dt>
                            <dd class="mt-1 text-sm text-gray-900 font-mono" id="modalCategorySlug">--</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">Subcategories</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <ul id="modalViewSubcategories" class="list-disc list-inside text-gray-600">
                                    <!-- Populated by JS -->
                                </ul>
                                <span id="modalNoSubcategories" class="text-gray-400 italic hidden">None</span>
                            </dd>
                        </div>
                    </div>
                </div>
                <!-- <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                    <button type="button"
                                                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                                        onclick="closeViewModal()">Close</button>
                                                </div> -->
            </div>
        </div>
    </div>

    <!-- Subcategory Modal -->
    <div id="subCategoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm"></div>
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-indigo-600 px-4 py-3 sm:px-6 flex justify-between items-center">
                    <h3 class="text-base font-semibold leading-6 text-white" id="subModalTitle">Subcategories</h3>
                    <button type="button" class="text-indigo-100 hover:text-white focus:outline-none"
                        onclick="closeSubCategoryModal()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <!-- Add Subcategory Form -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Add New Subcategory</h4>
                        <form action="{{ route('admin.product-categories.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="parent_id" id="modalParentId">
                            <div class="space-y-3">
                                <div>
                                    <label for="modalCategoryName" class="sr-only">Name</label>
                                    <input type="text" name="category_name" id="modalCategoryNameInput"
                                        placeholder="Category Name" required
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" name="slug" id="modalSlugInput" placeholder="Slug (Optional)"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <h4 class="text-sm font-medium text-gray-900 mb-2">Existing Subcategories</h4>
                    <ul id="subCategoryList" class="divide-y divide-gray-100 border-t border-gray-200">
                        <!-- List items will be injected here -->
                    </ul>
                    <div id="noSubCategories" class="text-center text-gray-500 py-4 hidden">
                        No subcategories found.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openViewModal(category) {
            document.getElementById('modalCategoryName').innerText = category.category_name;
            document.getElementById('modalCategorySlug').innerText = category.slug;

            const subList = document.getElementById('modalViewSubcategories');
            const noSubMsg = document.getElementById('modalNoSubcategories');
            subList.innerHTML = '';

            if (category.children && category.children.length > 0) {
                noSubMsg.classList.add('hidden');
                category.children.forEach(child => {
                    let li = document.createElement('li');
                    li.innerText = child.category_name;
                    subList.appendChild(li);
                });
            } else {
                noSubMsg.classList.remove('hidden');
            }

            document.getElementById('viewCategoryModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            document.querySelector('#viewCategoryModal .backdrop-blur-sm').addEventListener('click', closeViewModal);
        }

        function closeViewModal() {
            document.getElementById('viewCategoryModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        function openSubCategoryModal(category) {
            document.getElementById('subModalTitle').innerText = 'Subcategories of ' + category.category_name;
            document.getElementById('modalParentId').value = category.id; // Set hidden parent_id

            const list = document.getElementById('subCategoryList');
            list.innerHTML = ''; // Clear existing

            const noSubs = document.getElementById('noSubCategories');

            if (category.children && category.children.length > 0) {
                noSubs.classList.add('hidden');
                category.children.forEach(child => {
                    const li = document.createElement('li');
                    li.className = 'py-3 flex justify-between items-center';
                    li.innerHTML = `
                                                <span class="text-sm font-medium text-gray-900">${child.category_name}</span>
                                                <span class="text-xs text-gray-500 font-mono">${child.slug}</span>
                                            `;
                    list.appendChild(li);
                });
            } else {
                noSubs.classList.remove('hidden');
            }

            document.getElementById('subCategoryModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.querySelector('#subCategoryModal .backdrop-blur-sm').addEventListener('click', closeSubCategoryModal);
        }

        function closeSubCategoryModal() {
            document.getElementById('subCategoryModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('modalCategoryNameInput').addEventListener('input', function () {
            let slug = this.value.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            document.getElementById('modalSlugInput').value = slug;
        });
    </script>
@endsection
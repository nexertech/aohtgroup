@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid p-6">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Add Product</h1>
                <!-- <a href="{{ route('admin.products.index') }}"
                        class="px-4 py-2 text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300 transition duration-300 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg> Back
                    </a> -->
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Product Name -->
                        <div>
                            <label for="product_name" class="block text-sm font-medium text-gray-700 mb-1">Product Name
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="product_name" id="product_name"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                required value="{{ old('product_name') }}">
                            @error('product_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select name="category_id" id="category_id"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Subcategory -->
                        <div>
                            <label for="subcategory_id" class="block text-sm font-medium text-gray-700 mb-1">Subcategory</label>
                            <select name="subcategory_id" id="subcategory_id" disabled
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm bg-gray-100">
                                <option value="">Select Subcategory</option>
                            </select>
                            @error('subcategory_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Child Subcategory -->
                        <div>
                            <label for="child_subcategory_id" class="block text-sm font-medium text-gray-700 mb-1">Child Subcategory</label>
                            <select name="child_subcategory_id" id="child_subcategory_id" disabled
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm bg-gray-100">
                                <option value="">Select Child Subcategory</option>
                            </select>
                            @error('child_subcategory_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Client -->
                        <div>
                            <label for="client" class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                            <input type="text" name="client" id="client"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                value="{{ old('client') }}">
                            @error('client') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                            <input type="number" step="0.01" name="price" id="price"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                value="{{ old('price') }}">
                            @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input type="text" name="location" id="location"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                value="{{ old('location') }}">
                            @error('location') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="date" name="start_date" id="start_date"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                value="{{ old('start_date') }}">
                            @error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="date" name="end_date" id="end_date"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                value="{{ old('end_date') }}">
                            @error('end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Main Image -->
                        <div>
                            <label for="main_image" class="block text-sm font-medium text-gray-700 mb-1">Main Image</label>
                            <input type="file" name="main_image" id="main_image"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('main_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Product Gallery -->
                        <div>
                            <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-1">Product Gallery (Multi)</label>
                            <input type="file" name="gallery_images[]" id="gallery_images" multiple
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('gallery_images.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status -->
                        <div class="flex items-center mt-6">
                            <input type="checkbox" name="status" id="status" value="1" {{ old('status', 1) ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="status" class="ml-2 block text-sm text-gray-900">Active</label>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">{{ old('description') }}</textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.products.index') }}"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">Cancel</a>
                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-200">Create
                            Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('category_id').addEventListener('change', function() {
            var categoryId = this.value;
            var subCategorySelect = document.getElementById('subcategory_id');
            var childSubCategorySelect = document.getElementById('child_subcategory_id');
            
            // Reset Subcategory
            subCategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
            subCategorySelect.disabled = true;
            subCategorySelect.classList.add('bg-gray-100');

            // Reset Child Subcategory
            childSubCategorySelect.innerHTML = '<option value="">Select Child Subcategory</option>';
            childSubCategorySelect.disabled = true;
            childSubCategorySelect.classList.add('bg-gray-100');

            if(categoryId) {
                fetch(`{{ url('admin/get-subcategories') }}/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        if(data.length > 0) {
                            subCategorySelect.disabled = false;
                            subCategorySelect.classList.remove('bg-gray-100');
                            data.forEach(subcategory => {
                                var option = document.createElement('option');
                                option.value = subcategory.id;
                                option.text = subcategory.category_name;
                                subCategorySelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            }
        });

        document.getElementById('subcategory_id').addEventListener('change', function() {
            var subcategoryId = this.value;
            var childSubCategorySelect = document.getElementById('child_subcategory_id');
            
            // Reset
            childSubCategorySelect.innerHTML = '<option value="">Select Child Subcategory</option>';
            childSubCategorySelect.disabled = true;
            childSubCategorySelect.classList.add('bg-gray-100');

            if(subcategoryId) {
                fetch(`{{ url('admin/get-subcategories') }}/${subcategoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        if(data.length > 0) {
                            childSubCategorySelect.disabled = false;
                            childSubCategorySelect.classList.remove('bg-gray-100');
                            data.forEach(child => {
                                var option = document.createElement('option');
                                option.value = child.id;
                                option.text = child.category_name;
                                childSubCategorySelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching child subcategories:', error));
            }
        });

        window.addEventListener('DOMContentLoaded', (event) => {
            if(typeof CKEDITOR !== 'undefined' && document.getElementById('description')) {
                CKEDITOR.replace('description');
            }
        });
    </script>
    @endpush
@endsection
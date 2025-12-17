@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid p-6">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Edit Product</h1>
                <!-- <a href="{{ route('admin.products.index') }}"
                    class="px-4 py-2 text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300 transition duration-300 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg> Back
                </a> -->
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Product Name -->
                        <div>
                            <label for="product_name" class="block text-sm font-medium text-gray-700 mb-1">Product Name
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="product_name" id="product_name"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                required value="{{ old('product_name', $product->product_name) }}">
                            @error('product_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select name="category_id" id="category_id"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Subcategory -->
                        <div>
                            <label for="subcategory_id" class="block text-sm font-medium text-gray-700 mb-1">Subcategory</label>
                            <select name="subcategory_id" id="subcategory_id" {{ $product->subcategory_id ? '' : 'disabled' }}
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm {{ $product->subcategory_id ? '' : 'bg-gray-100' }}">
                                <option value="">Select Subcategory</option>
                                @if($product->category_id && $product->subcategory)
                                    <option value="{{ $product->subcategory_id }}" selected>{{ $product->subcategory->category_name }}</option>
                                @endif
                                <!-- Options will be populated via JS if category changes -->
                            </select>
                            @error('subcategory_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Client -->
                        <div>
                            <label for="client" class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                            <input type="text" name="client" id="client"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                value="{{ old('client', $product->client) }}">
                            @error('client') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input type="text" name="location" id="location"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                value="{{ old('location', $product->location) }}">
                            @error('location') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="date" name="start_date" id="start_date"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                value="{{ old('start_date', $product->start_date ? \Carbon\Carbon::parse($product->start_date)->format('Y-m-d') : '') }}">
                            @error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="date" name="end_date" id="end_date"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                value="{{ old('end_date', $product->end_date ? \Carbon\Carbon::parse($product->end_date)->format('Y-m-d') : '') }}">
                            @error('end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">{{ old('description', $product->description) }}</textarea>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                            <input type="number" name="price" id="price" step="0.01" min="0"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                value="{{ old('price', $product->price) }}" placeholder="0.00">
                            @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Main Image -->
                        <div class="md:col-span-2">
                            <label for="main_image" class="block text-sm font-medium text-gray-700 mb-1">Main Image</label>
                            @if($product->main_image)
                                <div class="mb-2">
                                    <img src="{{ asset($product->main_image) }}" alt="Current Image"
                                        class="h-20 w-auto rounded object-cover border border-gray-300">
                                </div>
                            @endif
                            <input type="file" name="main_image" id="main_image"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            @error('main_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Status -->
                        <div class="md:col-span-2">
                            <div class="flex items-center">
                                <input type="hidden" name="status" value="0">
                                <input type="checkbox" name="status" id="status" value="1"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    {{ $product->status ? 'checked' : '' }}>
                                <label for="status" class="ml-2 block text-sm text-gray-900">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.products.index') }}"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">Cancel</a>
                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-200">Update
                            Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const getSubcategoriesRoute = "{{ url('admin/get-subcategories') }}";
        const currentSubcategoryId = "{{ $product->subcategory_id }}";

        function loadSubcategories(categoryId, selectedId = null) {
            var subCategorySelect = document.getElementById('subcategory_id');
            
            // Clear current options except the placeholder
            subCategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
            subCategorySelect.disabled = true;
            subCategorySelect.classList.add('bg-gray-100');

            if(categoryId) {
                fetch(`${getSubcategoriesRoute}/${categoryId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if(data.length > 0) {
                            subCategorySelect.disabled = false;
                            subCategorySelect.classList.remove('bg-gray-100');
                            data.forEach(subcategory => {
                                var option = document.createElement('option');
                                option.value = subcategory.id;
                                option.text = subcategory.category_name;
                                if(selectedId && subcategory.id == selectedId) {
                                    option.selected = true;
                                }
                                subCategorySelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            }
        }

        document.getElementById('category_id').addEventListener('change', function() {
            loadSubcategories(this.value);
        });

        // Trigger on load if category is selected (to populate full list with selected item)
        const initialCategoryId = document.getElementById('category_id').value;
        if(initialCategoryId) {
            loadSubcategories(initialCategoryId, currentSubcategoryId);
        }
    </script>
    @endpush
@endsection
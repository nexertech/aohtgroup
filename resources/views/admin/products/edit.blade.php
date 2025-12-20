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
                                @if($product->subcategory_id && $product->subcategory)
                                    <option value="{{ $product->subcategory_id }}" selected>{{ $product->subcategory->category_name }}</option>
                                @endif
                            </select>
                            @error('subcategory_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Child Subcategory -->
                        <div>
                            <label for="child_subcategory_id" class="block text-sm font-medium text-gray-700 mb-1">Child Subcategory</label>
                            <select name="child_subcategory_id" id="child_subcategory_id" {{ $product->child_subcategory_id ? '' : 'disabled' }}
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm {{ $product->child_subcategory_id ? '' : 'bg-gray-100' }}">
                                <option value="">Select Child Subcategory</option>
                                @if($product->child_subcategory_id && $product->childSubcategory)
                                    <option value="{{ $product->child_subcategory_id }}" selected>{{ $product->childSubcategory->category_name }}</option>
                                @endif
                            </select>
                            @error('child_subcategory_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Client -->
                        <div>
                            <label for="client" class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                            <input type="text" name="client" id="client"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                value="{{ old('client', $product->client) }}">
                            @error('client') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                            <input type="number" step="0.01" name="price" id="price"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                value="{{ old('price', $product->price) }}">
                            @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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
                                value="{{ old('start_date', $product->start_date) }}">
                            @error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="date" name="end_date" id="end_date"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                value="{{ old('end_date', $product->end_date) }}">
                            @error('end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Main Image -->
                        <div>
                            <label for="main_image" class="block text-sm font-medium text-gray-700 mb-1">Main Image</label>
                            @if($product->main_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="Preview" class="h-20 w-32 object-cover rounded-lg">
                                </div>
                            @endif
                            <input type="file" name="main_image" id="main_image"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('main_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Product Gallery -->
                        <div>
                            <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-1">Product Gallery (Add More)</label>
                            <input type="file" name="gallery_images[]" id="gallery_images" multiple
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('gallery_images.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Existing Gallery -->
                        @if($product->galleries->count() > 0)
                        <div class="col-span-full mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Existing Gallery Images</label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
                                @foreach($product->galleries as $gallery)
                                <div class="relative group gallery-item-{{ $gallery->id }}">
                                    <img src="{{ asset('storage/' . $gallery->image_path) }}" class="h-24 w-full object-cover rounded-lg border border-gray-100 shadow-sm">
                                    <button type="button" onclick="deleteGalleryImage({{ $gallery->id }})" 
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-red-600 shadow-md">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Status -->
                        <div class="flex items-center mt-6">
                            <input type="checkbox" name="status" id="status" value="1" {{ old('status', $product->status) ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="status" class="ml-2 block text-sm text-gray-900">Active</label>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">{{ old('description', $product->description) }}</textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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
        const currentChildSubcategoryId = "{{ $product->child_subcategory_id }}";

        function loadDropdown(parentId, targetSelectId, selectedId = null, nextSelectId = null) {
            var targetSelect = document.getElementById(targetSelectId);
            var placeholder = targetSelect.getAttribute('id') === 'subcategory_id' ? 'Subcategory' : 'Child Subcategory';
            
            // Clear target and disable it
            targetSelect.innerHTML = `<option value="">Select ${placeholder}</option>`;
            targetSelect.disabled = true;
            targetSelect.classList.add('bg-gray-100');

            // If there's a next level, reset it too
            if (nextSelectId) {
                var nextSelect = document.getElementById(nextSelectId);
                var nextPlaceholder = 'Child Subcategory';
                nextSelect.innerHTML = `<option value="">Select ${nextPlaceholder}</option>`;
                nextSelect.disabled = true;
                nextSelect.classList.add('bg-gray-100');
            }

            if(parentId) {
                fetch(`${getSubcategoriesRoute}/${parentId}`)
                    .then(response => response.json())
                    .then(data => {
                        if(data.length > 0) {
                            targetSelect.disabled = false;
                            targetSelect.classList.remove('bg-gray-100');
                            data.forEach(item => {
                                var option = document.createElement('option');
                                option.value = item.id;
                                option.text = item.category_name;
                                if(selectedId && item.id == selectedId) {
                                    option.selected = true;
                                }
                                targetSelect.appendChild(option);
                            });

                            // If we have a selected ID and a next level to load
                            if (selectedId && nextSelectId) {
                                loadDropdown(selectedId, nextSelectId, currentChildSubcategoryId);
                            }
                        }
                    })
                    .catch(error => console.error(`Error fetching ${placeholder}:`, error));
            }
        }

        document.getElementById('category_id').addEventListener('change', function() {
            loadDropdown(this.value, 'subcategory_id', null, 'child_subcategory_id');
        });

        document.getElementById('subcategory_id').addEventListener('change', function() {
            loadDropdown(this.value, 'child_subcategory_id');
        });

        // Initial load
        const initialCategoryId = document.getElementById('category_id').value;
        if(initialCategoryId) {
            loadDropdown(initialCategoryId, 'subcategory_id', currentSubcategoryId, 'child_subcategory_id');
        }

        window.addEventListener('DOMContentLoaded', (event) => {
            if(typeof CKEDITOR !== 'undefined' && document.getElementById('description')) {
                CKEDITOR.replace('description');
            }
        });

        function deleteGalleryImage(id) {
            if(!confirm('Are you sure you want to delete this gallery image?')) return;

            fetch(`{{ url('admin/products/gallery') }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    // Remove the element from UI
                    const element = document.querySelector(`.gallery-item-${id}`);
                    if(element) element.remove();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the image.');
            });
        }
    </script>
    @endpush
@endsection
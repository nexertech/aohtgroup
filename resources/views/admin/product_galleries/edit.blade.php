@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid p-6">
        <div class="max-w-2xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Edit Gallery Image</h1>

            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <form action="{{ route('admin.product-galleries.update', $productGallery->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="product_id" class="block text-sm font-medium text-gray-700 mb-2">Product <span
                                class="text-red-500">*</span></label>
                        <select name="product_id" id="product_id"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                            required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ (old('product_id') ?? $productGallery->product_id) == $product->id ? 'selected' : '' }}>
                                    {{ $product->product_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="image_path" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        @if($productGallery->image_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $productGallery->image_path) }}" alt="Current Image"
                                    class="h-24 w-24 object-cover rounded-lg border border-gray-200">
                            </div>
                        @endif
                        <input type="file" name="image_path" id="image_path"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                            accept="image/*">
                        <p class="mt-1 text-xs text-gray-500">Leave empty to keep current image.</p>
                        @error('image_path')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="caption" class="block text-sm font-medium text-gray-700 mb-2">Caption</label>
                        <input type="text" name="caption" id="caption"
                            value="{{ old('caption') ?? $productGallery->caption }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                        @error('caption')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300 shadow-sm">
                            Update Image
                        </button>
                        <a href="{{ route('admin.product-galleries.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200"
                            style="margin-left: 0.5rem;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
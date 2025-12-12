@extends('admin.layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Certificate</h1>
            <a href="{{ route('admin.certificates.index') }}"
                class="text-gray-600 hover:text-gray-900 font-medium flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Back to List
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden p-6 relative">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

            <form action="{{ route('admin.certificates.update', $certificate) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title Field -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Title <span
                            class="text-gray-400 font-normal">(Optional)</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $certificate->title) }}"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150"
                        placeholder="e.g. ISO 9001 Certification">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Issue Date Field -->
                <div>
                    <label for="issue_date" class="block text-sm font-semibold text-gray-700 mb-1">Issue Date <span
                            class="text-gray-400 font-normal">(Optional)</span></label>
                    <input type="date" name="issue_date" id="issue_date"
                        value="{{ old('issue_date', $certificate->issue_date ? $certificate->issue_date->format('Y-m-d') : '') }}"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150">
                    @error('issue_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Image Field -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-1">Certificate Image</label>
                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg transition-colors hover:border-blue-400 group">
                        <div class="space-y-1 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-blue-500 transition-colors"
                                    stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 mt-2">
                                    <label for="image"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Change image</span>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/*"
                                            onchange="previewImage(this)">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Preview -->
                <div id="imagePreviewContainer" class="{{ $certificate->image ? '' : 'hidden' }} mt-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Current/New Image</label>
                    <div class="relative inline-block">
                        <img id="imagePreview" src="{{ $certificate->image ? asset($certificate->image) : '#' }}"
                            alt="Preview"
                            class="h-32 w-auto rounded-lg border border-gray-200 shadow-sm object-contain bg-gray-50 p-2">
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="button" onclick="window.history.back()"
                        class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-3">
                        Cancel
                    </button>
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        Update Certificate
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('imagePreview').src = e.target.result;
                        document.getElementById('imagePreviewContainer').classList.remove('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection
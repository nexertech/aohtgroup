<x-admin-layout>


    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-6">
                {{ __('Create Role') }}
            </h2>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100">
                <div class="p-8 text-gray-900">
                    <form method="POST" action="{{ route('admin.roles.store') }}">
                        @csrf

                        <!-- Role Name -->
                        <div class="mb-8">
                            <label for="role_name" class="block text-sm font-medium text-gray-700 mb-2">Role
                                Name</label>
                            <input type="text" name="role_name" id="role_name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5 px-3 bg-gray-50 focus:bg-white transition-colors duration-200"
                                placeholder="e.g., Administrator, Editor, User" required>
                            @error('role_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Permissions -->
                        <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-200">
                            <h4 class="text-lg font-medium text-gray-900">Permissions</h4>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="selectAllPermissions"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-600">Select All</span>
                            </label>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($permissions as $permission)
                                    <div class="relative flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                id="perm_{{ $permission->id }}"
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded cursor-pointer permission-checkbox">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="perm_{{ $permission->id }}"
                                                class="font-medium text-gray-700 cursor-pointer select-none">{{ $permission->description ?? $permission->permission_key ?? $permission->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                </div>

                <script>
                    document.getElementById('selectAllPermissions').addEventListener('change', function () {
                        const checkboxes = document.querySelectorAll('.permission-checkbox');
                        checkboxes.forEach(checkbox => {
                            checkbox.checked = this.checked;
                        });
                    });
                </script>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.roles.index') }}"
                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Role
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-admin-layout>
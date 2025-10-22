@extends('user.layouts.app')

@section('title', 'Profile - CRMNOW')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <div class="max-w-3xl mx-auto">
        <!-- Profile Header -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-20 w-20 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-user text-blue-600 text-3xl"></i>
                        </div>
                    </div>
                    <div class="ml-6">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>
                                Active User
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-6">
                    <i class="fas fa-edit mr-2"></i> Edit Profile
                </h3>
                
                <form method="POST" action="{{ route('user.profile') }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Full Name
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email Address
                            </label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" 
                                   disabled class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500 sm:text-sm">
                            <p class="mt-1 text-sm text-gray-500">Email cannot be changed. Contact administrator if needed.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700">
                                Role
                            </label>
                            <input type="text" name="role" id="role" value="{{ ucfirst($user->role) }}" 
                                   disabled class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">
                                Status
                            </label>
                            <div class="mt-1">
                                @if($user->isActive())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="created_at" class="block text-sm font-medium text-gray-700">
                            Member Since
                        </label>
                        <input type="text" name="created_at" id="created_at" value="{{ $user->created_at->format('F j, Y') }}" 
                               disabled class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500 sm:text-sm">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('user.dashboard') }}" 
                           class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Account Information -->
        <div class="bg-white shadow rounded-lg mt-6">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                    <i class="fas fa-info-circle mr-2"></i> Account Information
                </h3>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">User ID</dt>
                        <dd class="mt-1 text-sm text-gray-900">#{{ $user->id }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('F j, Y g:i A') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email Verified</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if($user->email_verified_at)
                                <span class="text-green-600">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Verified
                                </span>
                            @else
                                <span class="text-yellow-600">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Not Verified
                                </span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Account Type</dt>
                        <dd class="mt-1 text-sm text-gray-900">Regular User</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

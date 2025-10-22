@extends('user.layouts.app')

@section('title', 'Dashboard - CRMNOW')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <!-- Welcome Section -->
    <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-user text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h1 class="text-2xl font-bold text-gray-900">Welcome back, {{ $user->name }}!</h1>
                    <p class="text-gray-600">Here's what's happening with your account today.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-6">
        <!-- Total Projects -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-project-diagram text-blue-600 text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Projects</dt>
                            <dd class="text-lg font-medium text-gray-900">12</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Tasks -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-tasks text-green-600 text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Active Tasks</dt>
                            <dd class="text-lg font-medium text-gray-900">8</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed This Month -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-purple-600 text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Completed</dt>
                            <dd class="text-lg font-medium text-gray-900">24</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Members -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-users text-orange-600 text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Team Members</dt>
                            <dd class="text-lg font-medium text-gray-900">5</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                    <i class="fas fa-clock mr-2"></i> Recent Activity
                </h3>
                <div class="flow-root">
                    <ul class="-mb-8">
                        <li>
                            <div class="relative pb-8">
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                            <i class="fas fa-plus text-white text-xs"></i>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Created new project <span class="font-medium text-gray-900">Website Redesign</span></p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time>2h ago</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="relative pb-8">
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                            <i class="fas fa-check text-white text-xs"></i>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Completed task <span class="font-medium text-gray-900">Update Documentation</span></p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time>4h ago</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="relative">
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center ring-8 ring-white">
                                            <i class="fas fa-edit text-white text-xs"></i>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Updated profile information</p>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time>1d ago</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                    <i class="fas fa-bolt mr-2"></i> Quick Actions
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="#" class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-500 rounded-lg border border-gray-200 hover:border-gray-300">
                        <div>
                            <span class="rounded-lg inline-flex p-3 bg-blue-50 text-blue-700 ring-4 ring-white">
                                <i class="fas fa-plus text-xl"></i>
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-lg font-medium">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                New Project
                            </h3>
                            <p class="mt-2 text-sm text-gray-500">Start a new project</p>
                        </div>
                    </a>

                    <a href="#" class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-500 rounded-lg border border-gray-200 hover:border-gray-300">
                        <div>
                            <span class="rounded-lg inline-flex p-3 bg-green-50 text-green-700 ring-4 ring-white">
                                <i class="fas fa-tasks text-xl"></i>
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-lg font-medium">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                View Tasks
                            </h3>
                            <p class="mt-2 text-sm text-gray-500">Manage your tasks</p>
                        </div>
                    </a>

                    <a href="{{ route('user.profile') }}" class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-500 rounded-lg border border-gray-200 hover:border-gray-300">
                        <div>
                            <span class="rounded-lg inline-flex p-3 bg-purple-50 text-purple-700 ring-4 ring-white">
                                <i class="fas fa-user text-xl"></i>
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-lg font-medium">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                Profile
                            </h3>
                            <p class="mt-2 text-sm text-gray-500">Update your profile</p>
                        </div>
                    </a>

                    <a href="#" class="relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-500 rounded-lg border border-gray-200 hover:border-gray-300">
                        <div>
                            <span class="rounded-lg inline-flex p-3 bg-orange-50 text-orange-700 ring-4 ring-white">
                                <i class="fas fa-chart-bar text-xl"></i>
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-lg font-medium">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                Reports
                            </h3>
                            <p class="mt-2 text-sm text-gray-500">View analytics</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

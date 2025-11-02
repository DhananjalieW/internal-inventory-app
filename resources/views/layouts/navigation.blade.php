<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- Products (Admin + Inventory Manager) --}}
                    @if(in_array(Auth::user()->role, ['Admin','Inventory Manager']))
                        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                            {{ __('Products') }}
                        </x-nav-link>
                    @endif

                    {{-- Warehouses (Admin + Inventory Manager) --}}
                    @if(in_array(Auth::user()->role, ['Admin','Inventory Manager']))
                        <x-nav-link :href="route('warehouses.index')" :active="request()->routeIs('warehouses.*')">
                            {{ __('Warehouses') }}
                        </x-nav-link>
                    @endif

                    {{-- Suppliers (Admin + Inventory Manager) --}}
                    @if(in_array(Auth::user()->role, ['Admin','Inventory Manager']))
                        <x-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')">
                            {{ __('Suppliers') }}
                        </x-nav-link>
                    @endif

                    {{-- POs (Admin + Inventory Manager + Clerk) --}}
                    @if(in_array(Auth::user()->role, ['Admin','Inventory Manager','Clerk']))
                        <x-nav-link :href="route('pos.index')" :active="request()->routeIs('pos.*')">
                            {{ __('POs') }}
                        </x-nav-link>
                    @endif

                    {{-- Stock Movements (Admin + Inventory Manager + Clerk) --}}
                    @if(in_array(Auth::user()->role, ['Admin','Inventory Manager','Clerk']))
                        <x-nav-link :href="route('movements.index')" :active="request()->routeIs('movements.*')">
                            {{ __('Stock Movements') }}
                        </x-nav-link>
                    @endif

                    {{-- Transfers (Admin + Inventory Manager + Clerk) --}}
                    @if(in_array(Auth::user()->role, ['Admin','Inventory Manager','Clerk']))
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none transition">
                                    <span>Transfers</span>
                                    <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('transfers.create')" :active="request()->routeIs('transfers.create')">
                                    {{ __('Request Transfer') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('transfers.my')" :active="request()->routeIs('transfers.my')">
                                    {{ __('My Requests') }}
                                </x-dropdown-link>

                                {{-- Pending Transfers (Admin + Inventory Manager only) --}}
                                @if(in_array(Auth::user()->role, ['Admin','Inventory Manager']))
                                    <x-dropdown-link
                                        :href="route('admin.transfers.index')"
                                        :active="request()->routeIs('admin.transfers.*')">
                                        {{ __('Pending Transfers') }}
                                    </x-dropdown-link>
                                @endif
                            </x-slot>
                        </x-dropdown>
                    @endif

                    {{-- Approvals (Admin + Inventory Manager) --}}
                    @if(in_array(Auth::user()->role, ['Admin','Inventory Manager']))
                        <x-nav-link :href="route('admin.approvals.index')" :active="request()->routeIs('admin.approvals.*')">
                            {{ __('Approvals') }}
                        </x-nav-link>
                    @endif

                    {{-- Reports (Admin only) --}}
                    @if(Auth::user()->role === 'Admin')
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none transition">
                                    <span>Reports</span>
                                    <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('reorder.index')" :active="request()->routeIs('reorder.*')">
                                    {{ __('Reorder') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('reports.stock')" :active="request()->routeIs('reports.stock')">
                                    {{ __('Stock by Warehouse') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('reports.movements')" :active="request()->routeIs('reports.movements')">
                                    {{ __('Movements') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @endif

                    {{-- Users & Roles (Admin only) --}}
                    @if(Auth::user()->role === 'Admin')
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                            {{ __('Users & Roles') }}
                        </x-nav-link>
                    @endif

                    {{-- Reports (Viewer only) --}}
                    @if(Auth::user()->role === 'Viewer')
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none transition">
                                    <span>Reports</span>
                                    <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('viewer.reports.stock')" :active="request()->routeIs('viewer.reports.stock')">
                                    {{ __('Stock by Warehouse') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('viewer.reports.movements')" :active="request()->routeIs('viewer.reports.movements')">
                                    {{ __('Movements') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(in_array(Auth::user()->role, ['Admin','Inventory Manager']))
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                    {{ __('Products') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('warehouses.index')" :active="request()->routeIs('warehouses.*')">
                    {{ __('Warehouses') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')">
                    {{ __('Suppliers') }}
                </x-responsive-nav-link>
            @endif

            @if(in_array(Auth::user()->role, ['Admin','Inventory Manager','Clerk']))
                <x-responsive-nav-link :href="route('pos.index')" :active="request()->routeIs('pos.*')">
                    {{ __('POs') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('movements.index')" :active="request()->routeIs('movements.*')">
                    {{ __('Stock Movements') }}
                </x-responsive-nav-link>

                {{-- Transfers (mobile) --}}
                <x-responsive-nav-link :href="route('transfers.create')" :active="request()->routeIs('transfers.create')">
                    {{ __('Request Transfer') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('transfers.my')" :active="request()->routeIs('transfers.my')">
                    {{ __('My Requests') }}
                </x-responsive-nav-link>

                {{-- Pending Transfers (Admin + Inventory Manager only) --}}
                @if(in_array(Auth::user()->role, ['Admin','Inventory Manager']))
                    <x-responsive-nav-link :href="route('admin.transfers.index')" :active="request()->routeIs('admin.transfers.*')">
                        {{ __('Pending Transfers') }}
                    </x-responsive-nav-link>
                @endif
            @endif

            {{-- Approvals (Admin + Manager) --}}
            @if(in_array(Auth::user()->role, ['Admin','Inventory Manager']))
                <x-responsive-nav-link :href="route('admin.approvals.index')" :active="request()->routeIs('admin.approvals.*')">
                    {{ __('Approvals') }}
                </x-responsive-nav-link>
            @endif

            {{-- Reports (Admin) --}}
            @if(Auth::user()->role === 'Admin')
                <x-responsive-nav-link :href="route('reorder.index')" :active="request()->routeIs('reorder.*')">
                    {{ __('Reorder') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reports.stock')" :active="request()->routeIs('reports.stock')">
                    {{ __('Stock by Warehouse') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reports.movements')" :active="request()->routeIs('reports.movements')">
                    {{ __('Movements') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    {{ __('Users & Roles') }}
                </x-responsive-nav-link>
            @endif

            {{-- Reports (Viewer only) --}}
            @if(Auth::user()->role === 'Viewer')
                <x-responsive-nav-link :href="route('viewer.reports.stock')" :active="request()->routeIs('viewer.reports.stock')">
                    {{ __('Stock by Warehouse') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('viewer.reports.movements')" :active="request()->routeIs('viewer.reports.movements')">
                    {{ __('Movements') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

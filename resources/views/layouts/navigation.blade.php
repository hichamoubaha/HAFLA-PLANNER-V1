<!-- Service Providers -->
@if(auth()->check())
    <div class="space-y-1">
        <x-nav-link :href="route('service-providers.index')" :active="request()->routeIs('service-providers.*')">
            <i class="fas fa-users-cog mr-2"></i>
            {{ __('Prestataires') }}
        </x-nav-link>
    </div>
@endif 
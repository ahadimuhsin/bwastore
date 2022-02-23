<div class="border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
      <img src="{{ asset('/images/dashboard-store-logo.svg') }}" alt="" class="my-4" />
    </div>
    <div class="list-group list-group-flush">
      <a
        href="{{ route('dashboard.index') }}"
        class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'dashboard.index' || Route::is('dashboard.index') ? 'active' : '' }}"
        >Dashboard</a
      >
      <a
        href="{{ route('dashboard.products') }}"
        class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'dashboard.products' || Route::is('dashboard.products.*') ? 'active' : '' }}"
        >My Products</a
      >
      <a
        href="{{ route('dashboard.transactions') }}"
        class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'dashboard.transactions' || Route::is('dashboard.transactions.*') ? 'active' : '' }}"
        >Transactions</a
      >
      <a
        href="{{ route('dashboard.settings') }}"
        class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'dashboard.settings' ? 'active' : '' }}"
        >Store Settings</a
      >
      <a
        href="{{ route('dashboard.accounts') }}"
        class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'dashboard.accounts' ? 'active' : '' }}"
        >My Account</a
      >
    </div>
  </div>

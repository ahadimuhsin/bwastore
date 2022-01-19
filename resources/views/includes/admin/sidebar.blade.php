<div class="border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
      <img src="{{ asset('/images/dashboard-store-logo.svg') }}" alt="" class="my-4" />
    </div>
    <div class="list-group list-group-flush">
      <a
        href="{{ route('dashboard.index') }}"
        class="list-group-item list-group-item-action active"
        >Dashboard</a
      >
      <a
        href="{{ route('dashboard.products') }}"
        class="list-group-item list-group-item-action"
        >My Products</a
      >
      <a
        href="/dashboard-transactions.html"
        class="list-group-item list-group-item-action"
        >Transactions</a
      >
      <a
        href="/dashboard-settings.html"
        class="list-group-item list-group-item-action"
        >Store Settings</a
      >
      <a
        href="/dashboard-account.html"
        class="list-group-item list-group-item-action"
        >My Account</a
      >
    </div>
  </div>

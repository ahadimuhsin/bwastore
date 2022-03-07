<div class="border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
      <img src="{{ asset('/images/user.png') }}" alt="" class="my-4" style="max-width: 150px" />
    </div>
    <div class="list-group list-group-flush">
      <a
        href="{{ route('admin-dashboard') }}"
        class="list-group-item list-group-item-action"
        >Dashboard</a
      >
      <a
        href=""
        class="list-group-item list-group-item-action"
        >Products</a
      >
      <a
        href="{{ route('categories.index') }}"
        class="list-group-item list-group-item-action {{ (request()->is('admin/categories*')) ? 'active' : '' }}"
        >Categories</a
      >
      <a
        href=""
        class="list-group-item list-group-item-action"
        >Transactions</a
      >
      <a
        href=""
        class="list-group-item list-group-item-action"
        >Store Settings</a
      >
      <a
        href=""
        class="list-group-item list-group-item-action"
        >Users</a
      >
      <a
        href=""
        class="list-group-item list-group-item-action"
        >Sign Out</a
      >
    </div>
  </div>

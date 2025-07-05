<!-- resources/views/layouts/sidebar.blade.php -->

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark min-vh-100">
  <a href="{{ route('profile.dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <i class="bi bi-speedometer2 me-2"></i>
      <span class="fs-4">Dashboard</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
      @if(auth()->user() && auth()->user()->role === 'admin')
          <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link text-white {{ request()->routeIs('home') ? 'active bg-primary' : '' }}">
                  <i class="bi bi-house-door me-2"></i> Home
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('user.profile', auth()->user()->username) }}" class="nav-link text-white {{ request()->routeIs('user.profile') ? 'active bg-primary' : '' }}">
                  <i class="bi bi-person-circle me-2"></i> View Public Profile
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('profile.edit') }}" class="nav-link text-white {{ request()->routeIs('profile.edit') ? 'active bg-primary' : '' }}">
                  <i class="bi bi-pencil-square me-2"></i> Update Public Profile
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('posts.index') }}" class="nav-link text-white {{ request()->routeIs('posts.index') ? 'active bg-primary' : '' }}">
                  <i class="bi bi-file-earmark-post me-2"></i> Posts
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('admin.posts.index') }}" class="nav-link text-white {{ request()->routeIs('admin.posts.index') ? 'active bg-primary' : '' }}">
                  <i class="bi bi-check2-square me-2"></i> Approve/Reject Posts
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('admin.categories.index') }}" class="nav-link text-white {{ request()->routeIs('admin.categories.index') ? 'active bg-primary' : '' }}">
                  <i class="bi bi-tags me-2"></i> Categories
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('admin.tags.index') }}" class="nav-link text-white {{ request()->routeIs('admin.tags.index') ? 'active bg-primary' : '' }}">
                  <i class="bi bi-bookmarks me-2"></i> Tags
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('admin.users.index') }}" class="nav-link text-white {{ request()->routeIs('admin.users.index') ? 'active bg-primary' : '' }}">
                  <i class="bi bi-people me-2"></i> Users Role Management
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('admin.messages') }}" class="nav-link text-white {{ request()->routeIs('admin.messages') ? 'active bg-primary' : '' }}">
                  <i class="bi bi-chat-left-dots me-2"></i> Messages
              </a>
          </li>
      @else
          <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link text-white {{ request()->routeIs('home') ? 'active bg-primary' : '' }}">
                  <i class="bi bi-house-door me-2"></i> Home
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('user.profile', auth()->user()->username) }}" class="nav-link text-white {{ request()->routeIs('user.profile') ? 'active bg-primary' : '' }}">
                  <i class="bi bi-person-circle me-2"></i> View Public Profile
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('profile.edit') }}" class="nav-link text-white {{ request()->routeIs('profile.edit') ? 'active bg-primary' : '' }}">
                  <i class="bi bi-pencil-square me-2"></i> Update Public Profile
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('posts.index') }}" class="nav-link text-white {{ request()->routeIs('posts.index') ? 'active bg-primary' : '' }}">
                  <i class="bi bi-file-earmark-post me-2"></i> My Posts
              </a>
          </li>
      @endif
  </ul>
</div>

<!-- Ensure this line is included in your layout for Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

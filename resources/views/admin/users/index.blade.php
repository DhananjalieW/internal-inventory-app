{{-- resources/views/admin/users/index.blade.php --}}
<x-app-layout>
  <div class="container py-4">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 fw-bold" style="font-size: 2rem; color: #1a202c;">Users</h1>
        <p class="text-muted mb-0" style="font-size: 0.95rem;">
          <i class="bi bi-people me-1"></i>Manage user accounts and roles
        </p>
      </div>
      <a href="{{ route('admin.users.create') }}" class="btn btn-brand d-flex align-items-center gap-2 px-4 py-2 mt-3 mt-md-0" style="border-radius: 10px; font-weight: 500;">
        <i class="bi bi-plus-circle"></i> New User
      </a>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
      <div class="alert alert-success border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #d4edda 0%, #e8f5e9 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(40, 167, 69, 0.2); border-radius: 10px;">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
          </div>
          <span class="fw-medium" style="color: #155724;">{{ session('success') }}</span>
        </div>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #fee 0%, #ffebee 100%); border-radius: 12px;">
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(220, 38, 38, 0.2); border-radius: 10px;">
            <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
          </div>
          <span class="fw-medium" style="color: #7f1d1d;">{{ session('error') }}</span>
        </div>
      </div>
    @endif

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead style="background: #f8f9fa;">
              <tr>
                <th class="border-0 text-muted small fw-semibold py-3 px-4" style="width:30%">Name</th>
                <th class="border-0 text-muted small fw-semibold py-3" style="width:32%">Email</th>
                <th class="border-0 text-muted small fw-semibold py-3" style="width:18%">Role</th>
                <th class="border-0 text-muted small fw-semibold py-3 text-end px-4" style="width:20%">Actions</th>
              </tr>
            </thead>
            <tbody>
            @forelse($users as $u)
              @php
                $roleConfig = match($u->role){
                  'Admin'             => ['bg' => '#dbeafe', 'color' => '#1e40af', 'icon' => 'bi-shield-check'],
                  'Inventory Manager' => ['bg' => '#e0e7ff', 'color' => '#4338ca', 'icon' => 'bi-person-gear'],
                  'Clerk'             => ['bg' => '#fef3c7', 'color' => '#92400e', 'icon' => 'bi-person-badge'],
                  'Viewer'            => ['bg' => '#f3f4f6', 'color' => '#4b5563', 'icon' => 'bi-eye'],
                  default             => ['bg' => '#f3f4f6', 'color' => '#4b5563', 'icon' => 'bi-person'],
                };
                $config = $roleConfig;
              @endphp
              <tr style="border-bottom: 1px solid #f1f3f5;">
                {{-- Name --}}
                <td class="px-4 py-3">
                  <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0" 
                         style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px;">
                      <span class="text-white fw-bold">{{ strtoupper(substr($u->name, 0, 1)) }}</span>
                    </div>
                    <div>
                      <div class="fw-bold" style="color: #1a202c;">{{ $u->name }}</div>
                      @if($u->id === auth()->id())
                        <span class="badge px-2 py-1" style="background: #fef3c7; color: #92400e; border-radius: 6px; font-weight: 500; font-size: 0.7rem;">
                          You
                        </span>
                      @endif
                    </div>
                  </div>
                </td>

                {{-- Email --}}
                <td class="py-3">
                  <div class="d-flex align-items-center gap-2 text-muted">
                    <i class="bi bi-envelope"></i>
                    <span>{{ $u->email }}</span>
                  </div>
                </td>

                {{-- Role --}}
                <td class="py-3">
                  <span class="badge d-inline-flex align-items-center gap-1 px-3 py-2" 
                        style="background: {{ $config['bg'] }}; color: {{ $config['color'] }}; border-radius: 8px; font-weight: 500; font-size: 0.8rem;">
                    <i class="bi {{ $config['icon'] }}"></i> {{ $u->role }}
                  </span>
                </td>

                {{-- Actions --}}
                <td class="py-3 text-end px-4">
                  <div class="btn-group" role="group">
                    <a href="{{ route('admin.users.edit',$u) }}"
                       class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 px-3"
                       style="border-radius: 8px 0 0 8px; font-weight: 500; border: 2px solid #3b82f6;">
                      <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    <form action="{{ route('admin.users.destroy',$u) }}"
                          method="POST" class="d-inline"
                          onsubmit="return confirm('Delete user {{ $u->name }}? This cannot be undone.');">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 px-3"
                              style="border-radius: 0 8px 8px 0; font-weight: 500; border: 2px solid #ef4444; border-left: 1px solid #ef4444;"
                              {{ $u->id === auth()->id() ? 'disabled' : '' }}>
                        <i class="bi bi-trash"></i> Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center py-5">
                  <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                    <div class="d-flex align-items-center justify-content-center mb-3" 
                         style="width: 64px; height: 64px; background: #f3f4f6; border-radius: 16px;">
                      <i class="bi bi-people text-muted" style="font-size: 2rem; opacity: 0.5;"></i>
                    </div>
                    <h5 class="fw-semibold mb-2" style="color: #6b7280;">No users found</h5>
                    <p class="text-muted mb-3">Create your first user to get started</p>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-brand px-4" style="border-radius: 10px;">
                      <i class="bi bi-plus-circle me-1"></i> New User
                    </a>
                  </div>
                </td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
      @if($users->hasPages())
        <div class="card-footer bg-white border-0 py-3 px-4">
          {{ $users->links() }}
        </div>
      @endif
    </div>
  </div>

  <style>
    .card:hover {
      box-shadow: 0 8px 25px rgba(0,0,0,0.08) !important;
    }
    
    .btn {
      transition: all 0.2s ease;
    }
    
    .btn:hover:not(:disabled) {
      transform: translateY(-1px);
    }
    
    .table tbody tr {
      transition: background-color 0.15s ease;
    }
    
    .table tbody tr:hover {
      background-color: #f8f9fa;
    }
    
    .btn-group .btn:hover:not(:disabled) {
      z-index: 2;
    }
  </style>
</x-app-layout>
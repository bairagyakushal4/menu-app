<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn">
                <i class="bi bi-justify fs-3"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @php
            $userName = auth()->user()->name;
            $parts = explode(' ', trim($userName));
            $initials = collect($parts)
            ->map(fn($word) => strtoupper($word[0]))
            ->take(2)
            ->join('');

            $firstName = $parts[0];

            @endphp

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0"></ul>
                <div class="dropdown">
                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ $userName }}</h6>
                                <p class="mb-0 text-sm text-gray-600">Administrator</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md bg-primary">
                                    <span class="avatar-content">{{ $initials }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem">
                        <li>
                            <h6 class="dropdown-header">Hello, {{ $firstName }}!</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/admin/profile">
                                <i class="icon-mid bi bi-person me-2"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <!-- Authentication -->
                            <form method="POST" action="/admin/logout">
                                @csrf
                                <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    <i class="icon-mid bi bi-box-arrow-left me-2"></i>Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
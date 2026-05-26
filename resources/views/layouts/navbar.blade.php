<nav class="navbar-custom d-flex align-items-center justify-content-between px-4">
    <div>
        <button class="btn btn-light d-md-none border-0" id="sidebarToggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>
    <div class="d-flex align-items-center gap-3">
        <span class="text-secondary fw-medium">{{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</span>
    </div>
</nav>

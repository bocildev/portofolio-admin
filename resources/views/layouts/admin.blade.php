<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Control Center') · Motion Portfolio Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #07090e; color: #f1f5f9; }
        .font-mono-code { font-family: 'JetBrains Mono', monospace; }
        .font-display { font-family: 'Syne', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-[#07090e] text-slate-100 flex">
    <!-- Global Top Loading Progress Bar -->
    <div id="admin-top-progress" class="fixed top-0 left-0 right-0 h-1 z-[999] pointer-events-none transition-all duration-300 opacity-0 bg-transparent">
        <div id="admin-progress-bar" class="h-full bg-gradient-to-r from-cyan-400 via-sky-400 to-indigo-500 w-0 transition-all duration-200 shadow-[0_0_12px_rgba(6,182,212,0.8)]"></div>
    </div>

    <!-- Left Sidebar -->
    <aside class="w-72 bg-[#0d111a] border-r border-[#1e293b] flex flex-col justify-between shrink-0 min-h-screen sticky top-0">
        <div class="p-6 space-y-6">
            <!-- Brand Header -->
            <div class="flex items-center gap-3.5 pb-5 border-b border-[#1e293b]">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-cyan-500 via-sky-500 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-cyan-500/25 shrink-0 font-display font-extrabold text-lg">
                    AA
                </div>
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5">
                        <span class="text-base font-extrabold text-white tracking-tight truncate font-display">
                            ADAM<span class="text-cyan-400">.ATH</span>
                        </span>
                        <span class="px-1.5 py-0.5 rounded bg-cyan-500/20 border border-cyan-500/30 text-cyan-300 text-[10px] font-mono-code font-bold">
                            CMS
                        </span>
                    </div>
                    <p class="text-[11px] text-slate-400 font-medium truncate">
                        Motion Portfolio Control
                    </p>
                </div>
            </div>

            <!-- Identity Card -->
            <div class="p-3.5 rounded-2xl bg-gradient-to-br from-[#131b2e] via-[#0d111a] to-[#131b2e] border border-cyan-500/20 space-y-1.5">
                <div class="flex items-center justify-between">
                    <span class="px-2 py-0.5 rounded-full bg-cyan-500/15 border border-cyan-500/30 text-cyan-300 text-[10px] font-mono-code font-bold">
                        🛡️ PORTFOLIO ADMIN
                    </span>
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                </div>
                <div class="text-sm font-extrabold text-white truncate">{{ $user['name'] ?? 'Moch. Adam Athallahrich' }}</div>
                <div class="text-[11px] text-slate-400 font-mono-code truncate">{{ $user['email'] ?? 'athallahrich@gmail.com' }}</div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1.5">
                <div class="px-3 pb-1 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                    Modul Portofolio
                </div>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition bg-cyan-500/15 text-cyan-300 border border-cyan-500/30"
                >
                    <i data-lucide="sliders" class="w-4 h-4 text-cyan-400"></i>
                    <span>Control Center</span>
                </a>

                <a
                    href="{{ route('api.motion.portfolio') }}"
                    target="_blank"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition text-slate-400 hover:text-white hover:bg-slate-800/50"
                >
                    <i data-lucide="code" class="w-4 h-4 text-emerald-400"></i>
                    <span>REST API Endpoint</span>
                </a>

                <a
                    href="{{ $portfolioUrl ?? 'http://localhost:3000' }}"
                    target="_blank"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition text-slate-400 hover:text-white hover:bg-slate-800/50"
                >
                    <i data-lucide="external-link" class="w-4 h-4 text-sky-400"></i>
                    <span>Buka Client Nuxt 3</span>
                </a>
            </nav>

            <div class="pt-4 border-t border-[#1e293b] space-y-2">
                <div class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                    SSO Ecosystem
                </div>
                <div class="p-3 rounded-xl bg-[#131b2e]/60 border border-[#1e293b] text-[11px] space-y-1">
                    <div class="text-slate-400">Central SSO:</div>
                    <div class="font-mono-code text-cyan-300 text-[10.5px] truncate">{{ config('iam.issuer') }}</div>
                    <div class="text-slate-400 mt-1">Client ID:</div>
                    <div class="font-mono-code text-slate-300 text-[10.5px]">{{ config('iam.client_id') }}</div>
                </div>
            </div>
        </div>

        <!-- Logout Action -->
        <div class="p-6 border-t border-[#1e293b]">
            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 border border-rose-500/30 text-xs font-bold transition cursor-pointer"
                >
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span>Keluar Sesi Backoffice</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 min-w-0 p-8 lg:p-10 space-y-8 overflow-y-auto">
        @if (session('status'))
            <div class="p-4 rounded-2xl bg-cyan-500/10 border border-cyan-500/30 text-cyan-300 text-xs font-bold flex items-center gap-2.5 shadow-lg shadow-cyan-500/5">
                <i data-lucide="check-circle" class="w-4 h-4 text-cyan-400 shrink-0"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        function startAdminLoading() {
            const container = document.getElementById('admin-top-progress');
            const bar = document.getElementById('admin-progress-bar');
            if (container && bar) {
                container.classList.remove('opacity-0');
                bar.style.width = '35%';
                setTimeout(() => { if (bar.style.width === '35%') bar.style.width = '75%'; }, 200);
            }
        }

        function stopAdminLoading() {
            const container = document.getElementById('admin-top-progress');
            const bar = document.getElementById('admin-progress-bar');
            if (container && bar) {
                bar.style.width = '100%';
                setTimeout(() => {
                    container.classList.add('opacity-0');
                    setTimeout(() => { bar.style.width = '0%'; }, 300);
                }, 200);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk · Motion Portfolio Backoffice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=JetBrains+Mono:wght@400;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #07090e; color: #f1f5f9; }
        .font-mono-code { font-family: 'JetBrains Mono', monospace; }
        .font-display { font-family: 'Syne', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-cyan-950/30 via-[#07090e] to-[#040508]">
    <div class="max-w-md w-full bg-[#0d111a]/95 backdrop-blur-xl border border-cyan-500/25 rounded-3xl p-8 shadow-2xl space-y-6">
        <div class="text-center space-y-2">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-tr from-cyan-500 via-sky-500 to-indigo-600 text-white font-display font-extrabold text-2xl shadow-lg shadow-cyan-500/30 mb-1">
                AA
            </div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/15 border border-cyan-500/30 text-cyan-300 text-xs font-bold font-mono-code">
                <span>🛡️ Motion Portfolio Backoffice</span>
            </div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight font-display">
                ADAM<span class="text-cyan-400">.ATH</span>
            </h1>
            <p class="text-xs text-slate-400 leading-relaxed">
                Masuk dengan akun Administrator untuk mengelola konten dan studi kasus portofolio interaktif Anda.
            </p>
        </div>

        @if ($errors->any())
            <div class="p-3.5 rounded-2xl bg-rose-950/60 border border-rose-500/40 text-xs text-rose-200 space-y-1">
                <div class="font-bold text-rose-300">Gagal Masuk</div>
                @foreach ($errors->all() as $err)
                    <div>{{ $err }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-300 mb-1.5 font-mono-code">Email Administrator</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', 'athallahrich@gmail.com') }}"
                    required
                    autofocus
                    placeholder="athallahrich@gmail.com"
                    class="w-full px-4 py-3 rounded-xl bg-[#07090e] border border-[#1e293b] text-sm text-white focus:outline-none focus:border-cyan-400 transition"
                >
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-300 mb-1.5 font-mono-code">Password / Password Sakti</label>
                <input
                    type="password"
                    name="password"
                    required
                    placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-xl bg-[#07090e] border border-[#1e293b] text-sm text-white focus:outline-none focus:border-cyan-400 transition"
                >
            </div>

            <button
                type="submit"
                class="w-full py-3.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs uppercase tracking-wider transition-colors shadow-lg shadow-cyan-500/25 cursor-pointer"
            >
                Masuk ke Backoffice
            </button>
        </form>

        <div class="relative flex items-center justify-center">
            <div class="border-t border-[#1e293b] w-full"></div>
            <span class="bg-[#0d111a] px-3 text-[11px] text-slate-500 font-mono-code uppercase">atau</span>
        </div>

        <a
            href="{{ route('auth.login') }}"
            class="w-full flex items-center justify-center gap-2.5 py-3 rounded-xl bg-[#131b2e] hover:bg-[#1e293b] text-slate-200 border border-[#1e293b] text-xs font-bold transition cursor-pointer"
        >
            <i data-lucide="shield-check" class="w-4 h-4 text-cyan-400"></i>
            <span>Masuk Otomatis via Central IAM SSO</span>
        </a>

        <div class="text-center pt-2">
            <a
                href="{{ config('iam.porto_url', 'http://localhost:3000') }}"
                target="_blank"
                class="text-xs text-slate-400 hover:text-cyan-400 transition flex items-center justify-center gap-1.5 font-mono-code"
            >
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali ke Portofolio Motion (Nuxt 3)</span>
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>

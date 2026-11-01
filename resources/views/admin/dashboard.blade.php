@extends('layouts.admin')

@section('title', 'Portofolio Motion Control Center')

@section('content')
<div class="space-y-6">
    <!-- Header Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-6 rounded-2xl bg-gradient-to-r from-cyan-500/10 via-[#0d111a] to-indigo-500/10 border border-cyan-500/30">
        <div class="space-y-1">
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 text-[10px] font-mono font-bold rounded bg-cyan-500/20 text-cyan-300 border border-cyan-500/40">
                    DEDICATED CMS MODULE
                </span>
                <span class="text-xs font-mono text-slate-400">portofolio-motion · Nuxt 3 + Vue 3 + GSAP</span>
            </div>
            <h1 class="text-2xl font-bold text-white font-sans">
                Portofolio Motion Control Center
            </h1>
            <p class="text-xs text-slate-400 max-w-xl">
                Kelola profil, studi kasus proyek, matriks keahlian, dan software tools yang disajikan secara headless ke frontend Nuxt 3 portofolio Anda.
            </p>
        </div>

        <div class="flex items-center gap-3 shrink-0">
            <a href="{{ route('api.motion.portfolio') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#131b2e] hover:bg-[#1e293b] text-slate-200 hover:text-white font-bold text-xs uppercase tracking-wider transition-colors border border-[#1e293b]">
                <i data-lucide="code" class="w-4 h-4 text-emerald-400"></i>
                <span>JSON API</span>
            </a>
            <a href="{{ $portfolioUrl ?? 'http://localhost:3000' }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs uppercase tracking-wider transition-colors shadow-lg shadow-cyan-500/20">
                <i data-lucide="external-link" class="w-4 h-4"></i>
                <span>Buka Nuxt 3 Client</span>
            </a>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-6 right-6 z-50 flex flex-col gap-2"></div>

    <!-- Tab Navigation -->
    <div class="flex items-center border-b border-[#1e293b] gap-2 overflow-x-auto">
        <button onclick="switchTab('tab-profile', this)" class="tab-btn active px-4 py-2.5 font-bold text-xs border-b-2 border-cyan-400 text-cyan-400 flex items-center gap-2 transition cursor-pointer">
            <i data-lucide="user" class="w-4 h-4"></i>
            <span>Profil &amp; Kontak</span>
        </button>
        <button onclick="switchTab('tab-projects', this)" class="tab-btn px-4 py-2.5 font-semibold text-xs border-b-2 border-transparent text-slate-400 hover:text-slate-200 flex items-center gap-2 transition cursor-pointer">
            <i data-lucide="layers" class="w-4 h-4"></i>
            <span>Studi Kasus Proyek ({{ count($projects) }})</span>
        </button>
        <button onclick="switchTab('tab-skills', this)" class="tab-btn px-4 py-2.5 font-semibold text-xs border-b-2 border-transparent text-slate-400 hover:text-slate-200 flex items-center gap-2 transition cursor-pointer">
            <i data-lucide="cpu" class="w-4 h-4"></i>
            <span>Matriks Keahlian ({{ count($skills) }})</span>
        </button>
        <button onclick="switchTab('tab-tools', this)" class="tab-btn px-4 py-2.5 font-semibold text-xs border-b-2 border-transparent text-slate-400 hover:text-slate-200 flex items-center gap-2 transition cursor-pointer">
            <i data-lucide="wrench" class="w-4 h-4"></i>
            <span>Software Tools ({{ count($softwareTools) }})</span>
        </button>
        <button onclick="switchTab('tab-experiences', this)" class="tab-btn px-4 py-2.5 font-semibold text-xs border-b-2 border-transparent text-slate-400 hover:text-slate-200 flex items-center gap-2 transition cursor-pointer">
            <i data-lucide="briefcase" class="w-4 h-4"></i>
            <span>Pengalaman Kerja ({{ count($experiences) }})</span>
        </button>
        <button onclick="switchTab('tab-api', this)" class="tab-btn px-4 py-2.5 font-semibold text-xs border-b-2 border-transparent text-slate-400 hover:text-slate-200 flex items-center gap-2 transition cursor-pointer">
            <i data-lucide="network" class="w-4 h-4"></i>
            <span>Headless API Sync</span>
        </button>
    </div>

    <!-- TAB 1: PROFIL & KONTAK -->
    <div id="tab-profile" class="tab-content space-y-6">
        <form onsubmit="handleSaveProfile(event)" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            @csrf
            <div class="lg:col-span-8 p-6 rounded-2xl bg-[#0d111a] border border-[#1e293b] space-y-5">
                <h3 class="font-bold text-sm text-white uppercase tracking-wider font-mono flex items-center gap-2">
                    <i data-lucide="badge-check" class="w-4 h-4 text-cyan-400"></i>
                    Informasi Biodata &amp; Karier
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $profile['name'] ?? 'Moch. Adam Athallahrich' }}" required class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Short Name / Brand</label>
                        <input type="text" name="shortName" value="{{ $profile['shortName'] ?? 'ADAM.ATH' }}" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Role Title</label>
                        <input type="text" name="roleTitle" value="{{ $profile['roleTitle'] ?? 'Fullstack & Frontend Developer' }}" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Perusahaan Saat Ini</label>
                        <input type="text" name="currentCompany" value="{{ $profile['currentCompany'] ?? 'PT. Sigma Cipta Caraka (Telkomsigma)' }}" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Kelahiran / Asal</label>
                        <input type="text" name="birthInfo" value="{{ $profile['birthInfo'] ?? '09 Mei 2001 · Surabaya' }}" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Domisili</label>
                        <input type="text" name="location" value="{{ $profile['location'] ?? 'Malang / Indonesia' }}" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Tag Lokasi Foto Avatar (FIG 01 Hero)</label>
                        <input type="text" name="cityTag" value="{{ $profile['cityTag'] ?? 'SURABAYA, ID' }}" placeholder="SURABAYA, ID" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Biografi Ringkas (Bahasa Indonesia)</label>
                    <textarea name="bioId" rows="4" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">{{ $profile['bioId'] ?? '' }}</textarea>
                </div>

                <!-- Spesifikasi Teknis Kartu Profil (FIG 01 Hero) -->
                <div class="pt-4 border-t border-[#1e293b] space-y-4">
                    <div class="flex items-center justify-between">
                        <h4 class="font-bold text-xs text-white uppercase tracking-wider font-mono flex items-center gap-2">
                            <i data-lucide="sliders" class="w-3.5 h-3.5 text-cyan-400"></i>
                            Spesifikasi Teknis Kartu Profil (FIG 01 Hero Dossier)
                        </h4>
                        <span class="text-[10px] text-slate-500 font-mono">4 Kotak Spesifikasi di Bawah Foto Avatar</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-mono text-slate-400 mb-1">1. Primary Stacks</label>
                            <input type="text" name="spec_primary_stacks" value="{{ $profile['techSpecs'][0]['value'] ?? ($profile['spec_primary_stacks'] ?? 'Vue 2/3 · NuxtJS · CI3') }}" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-mono text-slate-400 mb-1">2. Database RDBMS</label>
                            <input type="text" name="spec_database" value="{{ $profile['techSpecs'][1]['value'] ?? ($profile['spec_database'] ?? 'Oracle · MySQL · SSMS') }}" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-mono text-slate-400 mb-1">3. Mobile Ecosystem</label>
                            <input type="text" name="spec_mobile" value="{{ $profile['techSpecs'][2]['value'] ?? ($profile['spec_mobile'] ?? 'Flutter · Android Native') }}" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-mono text-slate-400 mb-1">4. Experience Scope</label>
                            <input type="text" name="spec_experience" value="{{ $profile['techSpecs'][3]['value'] ?? ($profile['spec_experience'] ?? 'Enterprise & POS (6+ Yrs)') }}" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 p-6 rounded-2xl bg-[#0d111a] border border-[#1e293b] space-y-5">
                <h3 class="font-bold text-sm text-white uppercase tracking-wider font-mono flex items-center gap-2">
                    <i data-lucide="send" class="w-4 h-4 text-emerald-400"></i>
                    Kontak &amp; Tautan Sosial
                </h3>

                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">WhatsApp / Phone</label>
                        <input type="text" name="phone" value="{{ $profile['phone'] ?? '+6285335769655' }}" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Email</label>
                        <input type="email" name="email" value="{{ $profile['email'] ?? 'athallahrich@gmail.com' }}" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Instagram URL</label>
                        <input type="text" name="instagram" value="{{ $profile['instagram'] ?? 'https://instagram.com/adamath_' }}" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">GitLab URL</label>
                        <input type="text" name="gitlab" value="{{ $profile['gitlab'] ?? 'https://gitlab.com/athallahrich' }}" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs font-mono text-slate-400">Avatar Path / URL</label>
                            <span class="text-[10px] text-cyan-400 font-mono">&le;500KB Auto-compress</span>
                        </div>
                        <div class="flex gap-2 items-center">
                            <div class="w-10 h-10 rounded-lg bg-[#07090e] border border-[#1e293b] flex items-center justify-center shrink-0 overflow-hidden">
                                <img id="profile_avatar_preview" src="{{ $profile['avatar'] ?? '/profile-pics/profile1.webp' }}" alt="Avatar" class="w-full h-full object-cover">
                            </div>
                            <input type="text" id="profile_avatar_input" name="avatar" value="{{ $profile['avatar'] ?? '/profile-pics/profile1.webp' }}" class="flex-1 px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none" oninput="document.getElementById('profile_avatar_preview').src = this.value">
                            <label class="cursor-pointer px-3 py-2 rounded-xl bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 text-xs font-mono flex items-center gap-1.5 shrink-0 transition" title="Unggah foto avatar ke IAM Core">
                                <i data-lucide="upload-cloud" class="w-3.5 h-3.5"></i>
                                <span id="avatar_upload_text">Unggah</span>
                                <input type="file" class="hidden" accept="image/*" onchange="handleCoreUpload(this, 'profile_avatar_input', 'avatars', 'avatar_upload_text', 'profile_avatar_preview')">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="pt-3">
                    <button type="submit" class="w-full px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs uppercase tracking-wider transition-colors shadow-lg shadow-cyan-500/20 cursor-pointer">
                        Simpan Perubahan Profil
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- TAB 2: STUDI KASUS PROYEK -->
    <div id="tab-projects" class="tab-content hidden space-y-6">
        <div class="flex items-center justify-between">
            <h3 class="font-bold text-sm text-white uppercase tracking-wider font-mono flex items-center gap-2">
                <i data-lucide="briefcase" class="w-4 h-4 text-cyan-400"></i>
                Daftar Studi Kasus Proyek
            </h3>
            <span class="text-xs text-slate-400 font-mono">{{ count($projects) }} Studi Kasus Terdaftar</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($projects as $p)
            <div class="p-5 rounded-2xl bg-[#0d111a] border border-[#1e293b] space-y-3 flex flex-col justify-between">
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="px-2 py-0.5 rounded font-mono text-[10px] font-bold bg-[#131b2e] text-cyan-400 border border-cyan-500/30">
                            #{{ $p->number }} · {{ strtoupper($p->category) }}
                        </span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-mono {{ $p->is_active ? 'bg-emerald-500/15 text-emerald-300 border border-emerald-500/30' : 'bg-slate-800 text-slate-400' }}">
                            {{ $p->is_active ? '● AKTIF' : '○ NONAKTIF' }}
                        </span>
                    </div>

                    <h4 class="text-base font-bold text-white">{{ $p->title }}</h4>
                    <p class="text-xs text-slate-400">{{ $p->subtitle }}</p>
                    <p class="text-[11px] font-mono text-cyan-300/80">{{ $p->company }} · {{ $p->period }}</p>

                    <div class="flex flex-wrap gap-1.5 pt-1">
                        @foreach($p->tech_stack ?? [] as $t)
                        <span class="px-2 py-0.5 rounded bg-[#131b2e] text-slate-300 text-[10.5px] font-mono border border-slate-700/50">
                            {{ $t }}
                        </span>
                        @endforeach
                    </div>
                </div>

                <div class="pt-3 border-t border-[#1e293b] flex items-center justify-between">
                    <div class="text-[11px] text-slate-500 font-mono">
                        {{ count($p->gallery ?? []) }} Foto Galeri
                    </div>
                    @if($p->live_url)
                    <a href="{{ $p->live_url }}" target="_blank" class="text-xs text-cyan-400 hover:underline flex items-center gap-1 font-mono">
                        <span>Live Demo</span>
                        <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- TAB 3: MATRIKS KEAHLIAN -->
    <div id="tab-skills" class="tab-content hidden space-y-6">
        <div class="flex items-center justify-between">
            <h3 class="font-bold text-sm text-white uppercase tracking-wider font-mono flex items-center gap-2">
                <i data-lucide="zap" class="w-4 h-4 text-cyan-400"></i>
                Matriks Keahlian Teknis &amp; Dots
            </h3>
            <span class="text-xs text-slate-400 font-mono">{{ count($skills) }} Skill Terdaftar</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($skills as $s)
            <div class="p-4 rounded-2xl bg-[#0d111a] border border-[#1e293b] space-y-2.5">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-bold text-white">{{ $s['name'] }}</span>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-cyan-500/15 text-cyan-300 border border-cyan-500/30">
                        {{ $s['level'] }}%
                    </span>
                </div>
                <div class="w-full bg-[#131b2e] h-1.5 rounded-full overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-500 to-indigo-500 h-full rounded-full" style="width: {{ $s['level'] }}%"></div>
                </div>
                <p class="text-[11px] text-slate-400 leading-snug">{{ $s['experience'] ?? '' }}</p>
                <div class="text-[10px] text-slate-500 font-mono flex items-center justify-between pt-1 border-t border-[#1e293b]">
                    <span>Kategori: {{ strtoupper($s['category'] ?? 'General') }}</span>
                    <span>Dots: {{ str_repeat('● ', (int) ($s['dots'] ?? 3)) }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- TAB 4: SOFTWARE TOOLS -->
    <div id="tab-tools" class="tab-content hidden space-y-6">
        <div class="flex items-center justify-between">
            <h3 class="font-bold text-sm text-white uppercase tracking-wider font-mono flex items-center gap-2">
                <i data-lucide="cpu" class="w-4 h-4 text-cyan-400"></i>
                Software Tools &amp; Ecosystem
            </h3>
            <span class="text-xs text-slate-400 font-mono">{{ count($softwareTools) }} Tools Aktif</span>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
            @foreach($softwareTools as $tool)
            <div class="p-3.5 rounded-xl bg-[#0d111a] border border-[#1e293b] space-y-1">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-white">{{ $tool['name'] ?? '' }}</span>
                    <span class="px-1.5 py-0.2 rounded text-[9.5px] font-mono bg-[#131b2e] text-cyan-400 border border-cyan-500/30">
                        {{ $tool['badge'] ?? '' }}
                    </span>
                </div>
                <p class="text-[10px] text-slate-400 font-mono">{{ $tool['group'] ?? '' }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- TAB: PENGALAMAN KERJA (EXPERIENCES) -->
    <div id="tab-experiences" class="tab-content hidden space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-sm text-white uppercase tracking-wider font-mono flex items-center gap-2">
                    <i data-lucide="briefcase" class="w-4 h-4 text-cyan-400"></i>
                    Rekam Jejak Pengalaman Kerja (Career Ledger)
                </h3>
                <p class="text-xs text-slate-400 mt-1">
                    Kelola riwayat pekerjaan, perusahaan, pencapaian proyek, dan tech stack yang tampil di section 03 portofolio.
                </p>
            </div>
            <button onclick="openExperienceModal()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold text-xs uppercase tracking-wider transition-colors shadow-lg shadow-cyan-500/20 shrink-0 cursor-pointer">
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                <span>Tambah Pengalaman</span>
            </button>
        </div>

        <div id="experiences-container" class="space-y-4">
            @forelse($experiences as $idx => $exp)
            <div class="p-6 rounded-2xl bg-[#0d111a] border border-[#1e293b] space-y-4 relative group transition-all hover:border-slate-700" data-idx="{{ $idx }}" draggable="true" ondragstart="handleExpDragStart(event, {{ $idx }})" ondragover="handleExpDragOver(event)" ondrop="handleExpDrop(event, {{ $idx }})" ondragend="handleExpDragEnd(event)">
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 pb-4 border-b border-[#1e293b]">
                    <div class="flex items-start gap-3.5">
                        <div class="flex items-center text-slate-500 group-hover:text-cyan-400 cursor-grab active:cursor-grabbing shrink-0 self-center" title="Seret untuk mengubah urutan">
                            <i data-lucide="grip-vertical" class="w-4 h-4"></i>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-[#131b2e] border border-cyan-500/20 flex items-center justify-center shrink-0 overflow-hidden">
                            @if(!empty($exp['logo']))
                                <img src="{{ $exp['logo'] }}" alt="{{ $exp['company'] }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                                <span class="hidden font-mono font-bold text-xs text-cyan-400">{{ strtoupper(substr($exp['company'] ?? 'EX', 0, 2)) }}</span>
                            @else
                                <span class="font-mono font-bold text-xs text-cyan-400">{{ strtoupper(substr($exp['company'] ?? 'EX', 0, 2)) }}</span>
                            @endif
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded font-mono text-[10px] font-bold bg-[#131b2e] text-cyan-400 border border-cyan-500/30" title="Posisi Urutan Publik">
                                    #{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <h4 class="text-base font-bold text-white">{{ $exp['role'] ?? 'Peran Pekerjaan' }}</h4>
                            </div>
                            <div class="flex flex-wrap items-center gap-2 text-xs font-mono text-slate-300">
                                <span class="text-cyan-300 font-semibold">{{ $exp['company'] ?? '' }}</span>
                                @if(!empty($exp['location']))
                                <span class="text-slate-500">•</span>
                                <span class="text-slate-400">{{ $exp['location'] }}</span>
                                @endif
                                @if(!empty($exp['type']))
                                <span class="text-slate-500">•</span>
                                <span class="px-2 py-0.5 rounded text-[10px] bg-[#131b2e] text-slate-300 border border-slate-700/60">{{ $exp['type'] }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        <span class="px-2.5 py-1 rounded-lg bg-sky-500/10 text-sky-300 border border-sky-500/30 text-xs font-mono font-bold">
                            {{ $exp['period'] ?? '' }}
                        </span>

                        <!-- Tombol Urutan Naik & Turun -->
                        <div class="flex items-center bg-[#07090e] rounded-xl border border-[#1e293b] p-0.5">
                            <button type="button" onclick="moveExperience({{ $idx }}, -1)" class="p-1.5 text-slate-400 hover:text-cyan-400 hover:bg-[#131b2e] rounded-lg disabled:opacity-20 disabled:hover:text-slate-400 disabled:hover:bg-transparent transition cursor-pointer" {{ $idx === 0 ? 'disabled' : '' }} title="Geser ke Atas (Prioritas Lebih Tinggi)">
                                <i data-lucide="chevron-up" class="w-3.5 h-3.5"></i>
                            </button>
                            <button type="button" onclick="moveExperience({{ $idx }}, 1)" class="p-1.5 text-slate-400 hover:text-cyan-400 hover:bg-[#131b2e] rounded-lg disabled:opacity-20 disabled:hover:text-slate-400 disabled:hover:bg-transparent transition cursor-pointer" {{ $idx === count($experiences) - 1 ? 'disabled' : '' }} title="Geser ke Bawah">
                                <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>

                        <button onclick="openExperienceModal({{ $idx }})" class="p-2 rounded-xl bg-[#131b2e] hover:bg-[#1e293b] text-slate-300 hover:text-white border border-[#1e293b] transition cursor-pointer" title="Edit Pengalaman">
                            <i data-lucide="edit-3" class="w-4 h-4 text-cyan-400"></i>
                        </button>
                        <button onclick="handleDeleteExperience({{ $idx }})" class="p-2 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 border border-rose-500/30 transition cursor-pointer" title="Hapus Pengalaman">
                            <i data-lucide="trash-2" class="w-4 h-4 text-rose-400"></i>
                        </button>
                    </div>
                </div>

                @if(!empty($exp['summary']))
                <p class="text-xs text-slate-300 leading-relaxed">
                    {{ $exp['summary'] }}
                </p>
                @endif

                @if(!empty($exp['deliverables']) && is_array($exp['deliverables']))
                <div class="space-y-1.5 pt-1">
                    <div class="text-[11px] font-mono uppercase text-slate-400 font-bold">Pencapaian &amp; Tanggung Jawab Kunci:</div>
                    <ul class="space-y-1 text-xs text-slate-300">
                        @foreach($exp['deliverables'] as $del)
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-400 font-bold shrink-0">✓</span>
                            <span>{{ $del }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(!empty($exp['tech']) && is_array($exp['tech']))
                <div class="pt-2 flex flex-wrap gap-1.5 border-t border-[#1e293b]/60">
                    @foreach($exp['tech'] as $t)
                    <span class="px-2 py-0.5 rounded bg-[#07090e] border border-[#1e293b] text-slate-300 font-mono text-[10.5px]">
                        {{ $t }}
                    </span>
                    @endforeach
                </div>
                @endif
            </div>
            @empty
            <div class="p-10 rounded-2xl bg-[#0d111a] border border-[#1e293b] text-center space-y-2">
                <i data-lucide="briefcase" class="w-8 h-8 text-slate-600 mx-auto"></i>
                <div class="text-sm font-bold text-slate-300">Belum ada rekam jejak pengalaman kerja.</div>
                <p class="text-xs text-slate-500">Klik tombol "Tambah Pengalaman" untuk menambahkan riwayat karier baru.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- MODAL FORM: TAMBAH / EDIT PENGALAMAN KERJA -->
    <div id="experience-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm hidden">
        <div class="w-full max-w-2xl bg-[#0d111a] border border-[#1e293b] rounded-2xl p-6 shadow-2xl space-y-5 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-3 border-b border-[#1e293b]">
                <h3 id="modal-exp-title" class="text-base font-bold text-white flex items-center gap-2 font-mono">
                    <i data-lucide="briefcase" class="w-4 h-4 text-cyan-400"></i>
                    <span>Tambah Pengalaman Kerja</span>
                </h3>
                <button type="button" onclick="closeExperienceModal()" class="p-1.5 rounded-lg bg-white/5 hover:bg-white/10 text-slate-400 hover:text-white transition cursor-pointer">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <form id="experience-form" onsubmit="handleSaveExperienceForm(event)" class="space-y-4">
                <input type="hidden" id="exp_idx" value="">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Perusahaan / Organisasi *</label>
                        <input type="text" id="exp_company" required placeholder="PT. Sigma Cipta Caraka (Telkomsigma)" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Peran / Jabatan (Role) *</label>
                        <input type="text" id="exp_role" required placeholder="Fullstack Developer" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Periode Waktu *</label>
                        <input type="text" id="exp_period" required placeholder="Agustus 2020 — Sekarang" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Tipe Pekerjaan</label>
                        <input type="text" id="exp_type" placeholder="Full-Time · Enterprise IT" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Lokasi</label>
                        <input type="text" id="exp_location" placeholder="Indonesia" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs font-mono text-slate-400">Logo Perusahaan / URL Path</label>
                            <span class="text-[10px] text-cyan-400 font-mono">&le;500KB Auto-compress</span>
                        </div>
                        <div class="flex gap-2 items-center">
                            <div class="w-9 h-9 rounded-lg bg-[#07090e] border border-[#1e293b] flex items-center justify-center shrink-0 overflow-hidden">
                                <img id="exp_logo_preview" src="" alt="Logo" class="w-full h-full object-contain p-1 hidden">
                                <i id="exp_logo_placeholder" data-lucide="image" class="w-4 h-4 text-slate-600"></i>
                            </div>
                            <input type="text" id="exp_logo" placeholder="/work/sigma/sigma.jpg atau URL Core" class="flex-1 px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none" oninput="updateLogoPreview(this.value, 'exp_logo_preview', 'exp_logo_placeholder')">
                            <label class="cursor-pointer px-3 py-2 rounded-xl bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 border border-cyan-500/30 text-xs font-mono flex items-center gap-1.5 shrink-0 transition" title="Unggah logo ke IAM Core">
                                <i data-lucide="upload-cloud" class="w-3.5 h-3.5"></i>
                                <span id="exp_upload_text">Unggah</span>
                                <input type="file" class="hidden" accept="image/*" onchange="handleCoreUpload(this, 'exp_logo', 'logos', 'exp_upload_text', 'exp_logo_preview', 'exp_logo_placeholder')">
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Ringkasan Tanggung Jawab (Summary)</label>
                    <textarea id="exp_summary" rows="3" placeholder="Mengembangkan dan memelihara aplikasi internal..." class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">
                        Poin Pencapaian &amp; Deliverables (Pisahkan per baris dengan Enter)
                    </label>
                    <textarea id="exp_deliverables" rows="4" placeholder="Membangun aplikasi Performance Appraisal (PA)&#10;Merancang aplikasi MANGO HCM..." class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">
                        Teknologi yang Digunakan (Pisahkan dengan koma)
                    </label>
                    <input type="text" id="exp_tech" placeholder="NuxtJS, Vue 2/3, CodeIgniter 3, PHP, Oracle, MySQL" class="w-full px-3 py-2 rounded-xl bg-[#07090e] border border-[#1e293b] text-white text-xs focus:border-cyan-400 focus:outline-none">
                </div>

                <div class="flex items-center justify-end gap-3 pt-3 border-t border-[#1e293b]">
                    <button type="button" onclick="closeExperienceModal()" class="px-4 py-2 rounded-xl bg-[#131b2e] hover:bg-[#1e293b] text-slate-300 text-xs font-bold transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 text-xs font-bold uppercase tracking-wider transition shadow-lg shadow-cyan-500/20 cursor-pointer">
                        Simpan Pengalaman
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- TAB 5: HEADLESS API SYNC -->
    <div id="tab-api" class="tab-content hidden space-y-6">
        <div class="p-6 rounded-2xl bg-[#0d111a] border border-[#1e293b] space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-white flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Headless REST API Endpoint Status: OK
                    </h3>
                    <p class="text-xs text-slate-400 mt-1">
                        Endpoint ini dikonsumsi secara real-time oleh composable <code>usePortfolioData.ts</code> pada aplikasi Nuxt 3 di <code>http://localhost:3000</code>.
                    </p>
                </div>
                <a href="{{ route('api.motion.portfolio') }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-emerald-500/15 text-emerald-300 border border-emerald-500/30 text-xs font-mono font-bold hover:bg-emerald-500/25 transition">
                    GET /api/motion/portfolio
                </a>
            </div>

            <div class="p-4 rounded-xl bg-[#07090e] border border-[#1e293b] space-y-2">
                <div class="text-xs font-mono text-cyan-400">Kontrak Payload JSON:</div>
                <pre class="text-[11px] font-mono text-slate-300 overflow-x-auto p-2">{
  "profile": { "name": "{{ $profile['name'] ?? '' }}", "shortName": "{{ $profile['shortName'] ?? '' }}", ... },
  "projects": [ { "project_key": "mango-hcm", "title": "MANGO...", ... }, ... ],
  "skills": [ { "name": "Vue 2 & Vue 3", "level": 85, ... }, ... ],
  "softwareTools": [ { "name": "Visual Studio", "badge": "Primary IDE", ... }, ... ],
  "_auth": { "authenticated": true, "client_app": "Motion Portfolio Nuxt 3 Client" }
}</pre>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function switchTab(tabId, el) {
    document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(b => {
        b.classList.remove('border-cyan-400', 'text-cyan-400', 'font-bold');
        b.classList.add('border-transparent', 'text-slate-400', 'font-semibold');
    });

    const target = document.getElementById(tabId);
    if (target) {
        target.classList.remove('hidden');
    }

    if (!el && tabId) {
        el = document.querySelector(`.tab-btn[onclick*="${tabId}"]`);
    }

    if (el) {
        el.classList.remove('border-transparent', 'text-slate-400', 'font-semibold');
        el.classList.add('border-cyan-400', 'text-cyan-400', 'font-bold');
    }

    try {
        localStorage.setItem('portfolio_admin_active_tab', tabId);
        if (history.replaceState) {
            history.replaceState(null, null, '#' + tabId);
        }
    } catch (e) {}
}

document.addEventListener('DOMContentLoaded', () => {
    let savedTab = null;
    if (window.location.hash && window.location.hash.startsWith('#tab-')) {
        savedTab = window.location.hash.substring(1);
    } else {
        try {
            savedTab = localStorage.getItem('portfolio_admin_active_tab');
        } catch (e) {}
    }

    if (savedTab && document.getElementById(savedTab)) {
        switchTab(savedTab);
    }
});

function setButtonLoading(button, isLoading, loadingText = 'Menyimpan...') {
    if (!button) return;
    if (isLoading) {
        button.dataset.originalHtml = button.innerHTML;
        button.disabled = true;
        button.classList.add('opacity-75', 'cursor-not-allowed');
        button.innerHTML = `<svg class="animate-spin -ml-1 mr-2 h-3.5 w-3.5 inline-block text-slate-950" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span>${loadingText}</span>`;
        if (typeof startAdminLoading === 'function') startAdminLoading();
    } else {
        button.disabled = false;
        button.classList.remove('opacity-75', 'cursor-not-allowed');
        if (button.dataset.originalHtml) {
            button.innerHTML = button.dataset.originalHtml;
        }
        if (typeof stopAdminLoading === 'function') stopAdminLoading();
    }
}

async function handleSaveProfile(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    setButtonLoading(submitBtn, true, 'Menyimpan Profil...');

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    try {
        const res = await fetch('{{ route("admin.portfolio.profile") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });
        const result = await res.json();
        if (result.success) {
            showToast('Profil berhasil disimpan!', 'success');
        } else {
            showToast(result.message || 'Gagal menyimpan profil', 'error');
        }
    } catch (err) {
        showToast('Koneksi server gagal', 'error');
    } finally {
        setButtonLoading(submitBtn, false);
    }
}

function showToast(msg, type = 'info') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = `p-3.5 rounded-xl border text-xs font-bold shadow-xl transition-all ${
        type === 'success' 
            ? 'bg-emerald-950/80 border-emerald-500/40 text-emerald-200' 
            : 'bg-rose-950/80 border-rose-500/40 text-rose-200'
    }`;
    toast.innerText = msg;
    container.appendChild(toast);
    setTimeout(() => {
        toast.remove();
    }, 3500);
}

// ==========================================
// PENGALAMAN KERJA (EXPERIENCES) MANAGEMENT
// ==========================================
let experiencesList = @json($experiences ?? []);

function openExperienceModal(idx = null) {
    const modal = document.getElementById('experience-modal');
    const modalTitle = document.getElementById('modal-exp-title');
    const form = document.getElementById('experience-form');

    form.reset();
    document.getElementById('exp_idx').value = idx !== null ? idx : '';

    if (idx !== null && experiencesList[idx]) {
        const item = experiencesList[idx];
        modalTitle.innerHTML = `<i data-lucide="edit-3" class="w-4 h-4 text-cyan-400"></i><span>Edit Pengalaman Kerja</span>`;
        document.getElementById('exp_company').value = item.company || '';
        document.getElementById('exp_role').value = item.role || '';
        document.getElementById('exp_period').value = item.period || '';
        document.getElementById('exp_type').value = item.type || '';
        document.getElementById('exp_location').value = item.location || '';
        document.getElementById('exp_logo').value = item.logo || '';
        document.getElementById('exp_summary').value = item.summary || '';
        document.getElementById('exp_deliverables').value = Array.isArray(item.deliverables) ? item.deliverables.join('\n') : (item.deliverables || '');
        document.getElementById('exp_tech').value = Array.isArray(item.tech) ? item.tech.join(', ') : (item.tech || '');
        updateLogoPreview(item.logo || '', 'exp_logo_preview', 'exp_logo_placeholder');
    } else {
        modalTitle.innerHTML = `<i data-lucide="plus-circle" class="w-4 h-4 text-cyan-400"></i><span>Tambah Pengalaman Kerja Baru</span>`;
        updateLogoPreview('', 'exp_logo_preview', 'exp_logo_placeholder');
    }

    if (window.lucide) window.lucide.createIcons();
    modal.classList.remove('hidden');
}

function closeExperienceModal() {
    document.getElementById('experience-modal').classList.add('hidden');
}

async function handleSaveExperienceForm(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');

    const idxVal = document.getElementById('exp_idx').value;
    const isEdit = idxVal !== '';
    const idx = isEdit ? parseInt(idxVal, 10) : null;

    const company = document.getElementById('exp_company').value.trim();
    const role = document.getElementById('exp_role').value.trim();
    const period = document.getElementById('exp_period').value.trim();
    const type = document.getElementById('exp_type').value.trim();
    const location = document.getElementById('exp_location').value.trim();
    const logo = document.getElementById('exp_logo').value.trim();
    const summary = document.getElementById('exp_summary').value.trim();
    
    const deliverablesRaw = document.getElementById('exp_deliverables').value;
    const deliverables = deliverablesRaw.split('\n').map(s => s.trim()).filter(s => s.length > 0);

    const techRaw = document.getElementById('exp_tech').value;
    const tech = techRaw.split(',').map(s => s.trim()).filter(s => s.length > 0);

    let id = isEdit && experiencesList[idx]?.id 
        ? experiencesList[idx].id 
        : company.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');

    const newExp = {
        id: id || ('exp-' + Date.now()),
        company,
        role,
        period,
        type: type || 'Full-Time',
        location: location || 'Indonesia',
        logo: logo || '',
        accentColor: isEdit && experiencesList[idx]?.accentColor ? experiencesList[idx].accentColor : '#06b6d4',
        roles: isEdit && experiencesList[idx]?.roles ? experiencesList[idx].roles : ['fullstack', 'frontend'],
        summary,
        deliverables,
        tech
    };

    if (isEdit) {
        experiencesList[idx] = newExp;
    } else {
        experiencesList.unshift(newExp);
    }

    await persistExperiences(submitBtn);
    closeExperienceModal();
}

async function moveExperience(idx, direction) {
    const targetIdx = idx + direction;
    if (targetIdx < 0 || targetIdx >= experiencesList.length) return;

    // Tukar posisi elemen
    const temp = experiencesList[idx];
    experiencesList[idx] = experiencesList[targetIdx];
    experiencesList[targetIdx] = temp;

    if (typeof startAdminLoading === 'function') startAdminLoading();
    showToast(`Menggeser urutan pengalaman #${idx + 1} ke #${targetIdx + 1}...`, 'info');

    await persistExperiences();
}

// Drag & Drop Handlers untuk Pengalaman Kerja
let draggedExpIdx = null;

function handleExpDragStart(e, idx) {
    draggedExpIdx = idx;
    e.dataTransfer.effectAllowed = 'move';
    e.currentTarget.classList.add('opacity-50', 'border-cyan-400');
}

function handleExpDragOver(e) {
    e.preventDefault();
    e.dataTransfer.dropEffect = 'move';
}

async function handleExpDrop(e, targetIdx) {
    e.preventDefault();
    if (draggedExpIdx === null || draggedExpIdx === targetIdx) return;

    const movedItem = experiencesList.splice(draggedExpIdx, 1)[0];
    experiencesList.splice(targetIdx, 0, movedItem);

    if (typeof startAdminLoading === 'function') startAdminLoading();
    showToast(`Urutan pengalaman diperbarui: #${draggedExpIdx + 1} → #${targetIdx + 1}`, 'info');

    await persistExperiences();
}

function handleExpDragEnd(e) {
    e.currentTarget.classList.remove('opacity-50', 'border-cyan-400');
    draggedExpIdx = null;
}

async function handleDeleteExperience(idx) {
    const item = experiencesList[idx];
    if (!item) return;

    if (!confirm(`Hapus pengalaman kerja di "${item.company}" (${item.role})?`)) {
        return;
    }

    experiencesList.splice(idx, 1);
    await persistExperiences();
}

async function persistExperiences(btn = null) {
    if (btn) setButtonLoading(btn, true, 'Menyimpan Pengalaman...');
    else if (typeof startAdminLoading === 'function') startAdminLoading();

    try {
        const res = await fetch('{{ route("admin.portfolio.experiences") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ experiences: experiencesList })
        });
        const result = await res.json();
        if (result.success) {
            showToast(result.message || 'Pengalaman kerja berhasil disimpan!', 'success');
            try {
                localStorage.setItem('portfolio_admin_active_tab', 'tab-experiences');
                window.location.hash = 'tab-experiences';
            } catch (e) {}
            setTimeout(() => {
                window.location.reload();
            }, 500);
        } else {
            showToast(result.message || 'Gagal menyimpan pengalaman', 'error');
            if (btn) setButtonLoading(btn, false);
            if (typeof stopAdminLoading === 'function') stopAdminLoading();
        }
    } catch (err) {
        showToast('Koneksi server gagal', 'error');
        if (btn) setButtonLoading(btn, false);
        if (typeof stopAdminLoading === 'function') stopAdminLoading();
    }
}

// ==========================================
// CENTRALIZED CORE MEDIA UPLOAD HANDLER
// ==========================================
async function handleCoreUpload(inputElem, targetInputId, folder, statusSpanId, previewImgId = null, placeholderIconId = null) {
    if (!inputElem.files || !inputElem.files[0]) return;
    const file = inputElem.files[0];
    const statusSpan = document.getElementById(statusSpanId);
    const originalText = statusSpan ? statusSpan.textContent : 'Unggah';

    if (statusSpan) statusSpan.textContent = 'Memproses...';
    if (typeof startAdminLoading === 'function') startAdminLoading();

    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    const formData = new FormData();
    formData.append('file', file);
    formData.append('folder', folder);
    formData.append('_token', token);

    try {
        const res = await fetch('{{ route("admin.portfolio.upload") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            }
        });

        if (res.status === 419) {
            showToast('Sesi halaman telah kedaluwarsa (CSRF token expired). Sedang memuat ulang...', 'error');
            setTimeout(() => window.location.reload(), 1500);
            return;
        }

        const data = await res.json();
        if (res.ok && data.success) {
            const uploadedUrl = data.asset.url;
            const targetInput = document.getElementById(targetInputId);
            if (targetInput) targetInput.value = uploadedUrl;

            if (previewImgId) {
                updateLogoPreview(uploadedUrl, previewImgId, placeholderIconId);
            }

            const isComp = data.asset.is_compressed;
            const sizeText = data.asset.formatted_size;
            showToast(`File berhasil diunggah ke Core Storage (${sizeText})` + (isComp ? ' · Otomatis Dikompresi ≤500KB' : ''), 'success');
        } else {
            showToast('Gagal unggah: ' + (data.message || 'Terjadi kesalahan sistem'), 'error');
        }
    } catch (err) {
        showToast('Terjadi kesalahan jaringan: ' + err.message, 'error');
    } finally {
        if (statusSpan) statusSpan.textContent = originalText;
        if (typeof stopAdminLoading === 'function') stopAdminLoading();
        inputElem.value = '';
    }
}

function updateLogoPreview(url, previewImgId, placeholderIconId) {
    const img = document.getElementById(previewImgId);
    const icon = placeholderIconId ? document.getElementById(placeholderIconId) : null;
    if (!img) return;

    if (url && (url.startsWith('http://') || url.startsWith('https://') || url.startsWith('/'))) {
        img.src = url;
        img.classList.remove('hidden');
        if (icon) icon.classList.add('hidden');
    } else {
        img.src = '';
        img.classList.add('hidden');
        if (icon) icon.classList.remove('hidden');
    }
}
</script>
@endpush

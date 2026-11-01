<?php

namespace Database\Seeders;

use App\Models\MotionConfig;
use App\Models\MotionProject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Profile Config
        MotionConfig::setValue('profile', [
            'name' => 'Moch. Adam Athallahrich',
            'shortName' => 'ADAM.ATH',
            'roleTitle' => 'Fullstack & Frontend Developer',
            'currentCompany' => 'PT. Sigma Cipta Caraka (Telkomsigma)',
            'birthInfo' => '09 Mei 2001 · Surabaya',
            'location' => 'Malang / Indonesia',
            'cityTag' => 'SURABAYA, ID',
            'techSpecs' => [
                ['label' => 'Primary Stacks', 'value' => 'Vue 2/3 · NuxtJS · CI3'],
                ['label' => 'Database RDBMS', 'value' => 'Oracle · MySQL · SSMS'],
                ['label' => 'Mobile Ecosystem', 'value' => 'Flutter · Android Native'],
                ['label' => 'Experience Scope', 'value' => 'Enterprise & POS (6+ Yrs)'],
            ],
            'bioId' => 'Lulusan Rekayasa Perangkat Lunak dari SMK Telkom Malang yang saat ini berkarya sebagai Fullstack & Frontend Developer sekaligus Technical Researcher di PT. Sigma Cipta Caraka (Telkomsigma). Berfokus merancang aplikasi enterprise berskala besar, arsitektur frontend interaktif berbasis ekosistem Vue/Nuxt, sistem backend PHP/CodeIgniter/Laravel & database Oracle/MySQL, hingga aplikasi mobile Flutter & Android Native.',
            'phone' => '+6285335769655',
            'whatsappUrl' => 'https://wa.me/6285335769655',
            'email' => 'athallahrich@gmail.com',
            'instagram' => 'https://instagram.com/adamath_',
            'instagramHandle' => '@adamath_',
            'gitlab' => 'https://gitlab.com/athallahrich',
            'avatar' => '/profile-pics/profile1.webp',
            'avatarAlt' => '/profile-pics/profile.jpg',
            'cvFiles' => [
                [
                    'label' => 'Download CV Fullstack',
                    'role' => 'Fullstack Developer',
                    'url' => '/cv/Fullstack_Moch_Adam_Athallahrich.pdf',
                ],
                [
                    'label' => 'Download CV Frontend',
                    'role' => 'Frontend Developer',
                    'url' => '/cv/Frontend_Moch_Adam_Athallahrich.pdf',
                ],
            ],
            'education' => [
                'school' => 'SMK Telkom Malang',
                'major' => 'Software Engineering (Rekayasa Perangkat Lunak)',
                'period' => '2016 — 2019',
            ],
        ]);

        // 2. Skills Config
        MotionConfig::setValue('skills', [
            [
                'name' => 'Vue 2 & Vue 3',
                'category' => 'frontend',
                'level' => 85,
                'dots' => 4,
                'logo' => '/logos/vuejs-original.svg',
                'experience' => 'Production Enterprise (MANGO HCM & Web Apps)',
                'highlight' => 'State management, komponen modular, org-chart & tree grid interaktif',
            ],
            [
                'name' => 'Nuxt 2 & Nuxt 3',
                'category' => 'frontend',
                'level' => 85,
                'dots' => 4,
                'logo' => '/logos/nuxtjs-original.svg',
                'experience' => 'SSR/SPA Enterprise & Technical Research',
                'highlight' => 'Arsitektur aplikasi korporasi dengan NuxtJS, Buefy, dan TailwindCSS',
            ],
            [
                'name' => 'PHP Native',
                'category' => 'fullstack',
                'level' => 85,
                'dots' => 4,
                'logo' => '/logos/javascript-original.svg',
                'experience' => 'Core Backend Logic & Enterprise Integration',
                'highlight' => 'Pemrosesan transaksi, laporan KPI, dan integrasi RDBMS',
            ],
            [
                'name' => 'CodeIgniter 3',
                'category' => 'fullstack',
                'level' => 85,
                'dots' => 4,
                'logo' => '/logos/nodejs-original.svg',
                'experience' => 'Performance Appraisal, Bukusaku, CoffeeShop & Sales',
                'highlight' => 'Framework andalan untuk sistem internal enterprise dan aplikasi POS/Gudang',
            ],
            [
                'name' => 'Flutter',
                'category' => 'mobile',
                'level' => 65,
                'dots' => 3,
                'logo' => '/logos/flutter.png',
                'experience' => 'PT. Visionet Data Internasional & Mobile Projects',
                'highlight' => 'Pembuatan aplikasi Company Profile & antarmuka mobile multi-platform',
            ],
            [
                'name' => 'React JS',
                'category' => 'frontend',
                'level' => 65,
                'dots' => 3,
                'logo' => '/logos/react-original.svg',
                'experience' => 'Modern Component UI & Frontend Exploration',
                'highlight' => 'Single Page Application dan eksplorasi ekosistem React modern',
            ],
            [
                'name' => 'Laravel',
                'category' => 'fullstack',
                'level' => 65,
                'dots' => 3,
                'logo' => '/logos/git-original.svg',
                'experience' => 'Modern PHP Fullstack Architecture',
                'highlight' => 'RESTful API, autentikasi, dan manajemen skema database relasional',
            ],
            [
                'name' => 'Android Native (Java/XML)',
                'category' => 'mobile',
                'level' => 65,
                'dots' => 3,
                'logo' => '/logos/java.svg',
                'experience' => 'POS App Diginov & Online Payment UI',
                'highlight' => 'Aplikasi kasir Android native dengan pelacakan stok bahan baku real-time',
            ],
            [
                'name' => 'TailwindCSS & Buefy',
                'category' => 'frontend',
                'level' => 90,
                'dots' => 4,
                'logo' => '/logos/tailwindcss-plain.svg',
                'experience' => 'Design System & Responsive Dashboard',
                'highlight' => 'Implementasi UI/UX responsif, komponen dashboard, dan animasi modern',
            ],
            [
                'name' => 'AngularTS & .NET',
                'category' => 'fullstack',
                'level' => 70,
                'dots' => 3,
                'logo' => '/logos/typescript-original.svg',
                'experience' => 'PT. Visionet Data Internasional (Meikarta App)',
                'highlight' => 'Admin dashboard AngularTS serta bug fixing & code review pada aplikasi .NET',
            ],
            [
                'name' => 'Oracle, MySQL & SQL Server',
                'category' => 'fullstack',
                'level' => 85,
                'dots' => 4,
                'logo' => '/logos/firebase-plain.svg',
                'experience' => 'Enterprise Database Operations (Telkomsigma & Visionet)',
                'highlight' => 'Operasional query kompleks menggunakan SSMS, Toad SQL, DBeaver & Navicat',
            ],
            [
                'name' => 'HTML5, CSS3 & JavaScript/jQuery',
                'category' => 'frontend',
                'level' => 90,
                'dots' => 5,
                'logo' => '/logos/html5-original.svg',
                'experience' => 'Web Standards & Interactive DOM Manipulation',
                'highlight' => 'Fondasi utama seluruh aplikasi web, landing page, dan sistem POS',
            ],
        ]);

        // 3. Software Tools Config
        MotionConfig::setValue('software_tools', [
            ['name' => 'Visual Studio', 'group' => 'IDE & AI Editors', 'badge' => 'Primary IDE'],
            ['name' => 'Cursor', 'group' => 'IDE & AI Editors', 'badge' => 'AI Workflow'],
            ['name' => 'Antigravity', 'group' => 'IDE & AI Editors', 'badge' => 'Agentic Coding'],
            ['name' => 'Kiro', 'group' => 'IDE & AI Editors', 'badge' => 'Spec Driven'],
            ['name' => 'Qoder', 'group' => 'IDE & AI Editors', 'badge' => 'AI Assistant'],
            ['name' => 'Toad SQL', 'group' => 'Database & SQL', 'badge' => 'Oracle DB'],
            ['name' => 'DBeaver', 'group' => 'Database & SQL', 'badge' => 'Multi-DB'],
            ['name' => 'Navicat', 'group' => 'Database & SQL', 'badge' => 'MySQL/MariaDB'],
            ['name' => 'SSMS', 'group' => 'Database & SQL', 'badge' => 'SQL Server'],
            ['name' => 'Docker', 'group' => 'DevOps & Server', 'badge' => 'Container'],
            ['name' => 'MobaXterm', 'group' => 'DevOps & Server', 'badge' => 'SSH & Server'],
            ['name' => 'Sourcetree', 'group' => 'Version Control & API', 'badge' => 'Git GUI'],
            ['name' => 'Postman', 'group' => 'Version Control & API', 'badge' => 'API Testing'],
            ['name' => 'Laragon & XAMPP', 'group' => 'Local Environment', 'badge' => 'PHP Stack'],
        ]);

        // 4. Professional Experience Record Config
        MotionConfig::setValue('experiences', [
            [
                'id' => 'sigma',
                'period' => 'Agustus 2020 — Sekarang',
                'role' => 'Fullstack Developer & Frontend Technical Researcher',
                'company' => 'PT. Sigma Cipta Caraka (Telkomsigma)',
                'location' => 'Indonesia',
                'type' => 'Full-Time · Enterprise IT',
                'logo' => '/work/sigma/sigma.jpg',
                'accentColor' => '#06b6d4',
                'roles' => ['fullstack', 'frontend'],
                'summary' => 'Mengembangkan dan memelihara aplikasi internal kritikal korporasi untuk manajemen struktur organisasi, data kepegawaian, serta penilaian performa karyawan.',
                'deliverables' => [
                    'Membangun aplikasi Performance Appraisal (PA) karyawan dan aplikasi Bukusaku perusahaan menggunakan CodeIgniter 3.',
                    'Merancang aplikasi MANGO (Human Capital Management Online) untuk mengelola struktur organisasi perusahaan dari CEO hingga seluruh divisi serta data lengkap karyawan menggunakan NuxtJS, Vue, dan Buefy.',
                    'Bertindak sebagai Technical Researcher pada divisi Frontend Developer untuk mengevaluasi teknologi dan pola arsitektur antarmuka.',
                    'Mengoperasikan dan mengelola basis data skala enterprise menggunakan Oracle dan MySQL.',
                ],
                'tech' => ['NuxtJS', 'Vue 2/3', 'Buefy', 'CodeIgniter 3', 'PHP', 'Oracle', 'MySQL'],
            ],
            [
                'id' => 'ara-freelance',
                'period' => 'Mei 2022 — Juli 2023',
                'role' => 'Fullstack & Android Native Developer (Project)',
                'company' => 'PT. Ara Infra Indo',
                'location' => 'Indonesia',
                'type' => 'Project / Contract',
                'logo' => '/work/ara/ara.jpeg',
                'accentColor' => '#a855f7',
                'roles' => ['fullstack', 'mobile'],
                'summary' => 'Merancang solusi digital untuk operasional bisnis dan kasir menggunakan ekosistem web CodeIgniter 3 dan aplikasi mobile Android Native.',
                'deliverables' => [
                    'Membangun, menyelesaikan kendala teknis, dan meningkatkan efisiensi proses bisnis menggunakan framework CodeIgniter 3.',
                    'Merancang dan mengembangkan aplikasi sistem Point of Sale (POS) berbasis Android Native (Java & XML).',
                ],
                'tech' => ['CodeIgniter 3', 'PHP', 'Android Native', 'Java', 'XML', 'MySQL'],
            ],
            [
                'id' => 'visionet',
                'period' => 'Juli 2019 — Juni 2020',
                'role' => 'Developer Junior',
                'company' => 'PT. Visionet Data Internasional (VisioNet)',
                'location' => 'Indonesia',
                'type' => 'Full-Time',
                'logo' => '/work/visionet/visionet.jpg',
                'accentColor' => '#f43f5e',
                'roles' => ['frontend', 'fullstack', 'mobile'],
                'summary' => 'Berkontribusi lintas platform mulai dari pengembangan aplikasi mobile Flutter, dashboard AngularTS, hingga pemeliharaan aplikasi .NET Meikarta.',
                'deliverables' => [
                    'Mengembangkan aplikasi mobile Company Profile menggunakan Flutter.',
                    'Membangun aplikasi Admin Dashboard interaktif menggunakan AngularTS.',
                    'Membantu proses bug fixing, migrasi modul, refactoring kode, pembuatan fitur pembelian voucher unit, serta code review pada aplikasi Meikarta menggunakan .NET.',
                    'Mengoperasikan dan memelihara database menggunakan SQL Server Management Studio (SSMS).',
                ],
                'tech' => ['Flutter', 'AngularTS', '.NET', 'SQL Server (SSMS)', 'TypeScript'],
            ],
            [
                'id' => 'ara-intern',
                'period' => '2018',
                'role' => 'Mobile & Web Developer Intern',
                'company' => 'PT. Arainfraindo',
                'location' => 'Indonesia',
                'type' => 'Internship (SMK Telkom Malang)',
                'logo' => '/work/ara/ara.jpeg',
                'accentColor' => '#10b981',
                'roles' => ['mobile', 'frontend'],
                'summary' => 'Pengalaman industri awal merancang antarmuka pembayaran mobile dan landing page web.',
                'deliverables' => [
                    'Merancang dan membuat antarmuka mobile (Mobile UI) untuk layanan pembayaran online.',
                    'Mendesain dan mengimplementasikan halaman web landing page.',
                ],
                'tech' => ['Mobile UI', 'HTML5', 'CSS3', 'JavaScript', 'Web Design'],
            ],
        ]);

        // 5. Stats Config
        MotionConfig::setValue('stats', [
            ['value' => 6, 'suffix' => '+ Thn', 'label' => 'Pengalaman Industri', 'detail' => 'Sejak 2018 (Intern, Junior Dev hingga Fullstack di Telkomsigma)'],
            ['value' => 10, 'suffix' => '+', 'label' => 'Framework & Bahasa Utama', 'detail' => 'Vue 2/3, Nuxt 2/3, Flutter, React, CI3, Laravel, .NET, Android'],
            ['value' => 25, 'suffix' => '+ Modul', 'label' => 'Sistem Enterprise & POS', 'detail' => 'HCM MANGO, Performance Appraisal, Meikarta, POS & Sales'],
            ['value' => 14, 'suffix' => ' Tools', 'label' => 'Ekosistem Engineering', 'detail' => 'Docker, Oracle, Toad SQL, DBeaver, Navicat, Antigravity, Cursor'],
        ]);

        // 6. Role Lenses Config
        MotionConfig::setValue('role_lenses', [
            ['id' => 'all', 'label' => 'All Expertise', 'badge' => 'Full Spectrum', 'headline' => 'Fullstack & Frontend Motion Engineer', 'summary' => 'Menggabungkan arsitektur aplikasi enterprise (Telkomsigma & Visionet), antarmuka reaktif Vue/Nuxt, dan ekosistem mobile Flutter/Android.'],
            ['id' => 'frontend', 'label' => 'Frontend & Web UI', 'badge' => 'Vue · Nuxt · React · Angular', 'headline' => 'Frontend Architect & Technical Researcher', 'summary' => 'Spesialis pembangunan antarmuka modern menggunakan Vue 2/3, Nuxt 2/3, React JS, AngularTS, Buefy, dan TailwindCSS serta riset teknis frontend.'],
            ['id' => 'fullstack', 'label' => 'Fullstack & Backend', 'badge' => 'CI3 · Laravel · .NET · Oracle', 'headline' => 'Enterprise Fullstack & Database Engineer', 'summary' => 'Berpengalaman membangun sistem HCM, Performance Appraisal, POS, dan Warehouse Sales dengan PHP Native, CodeIgniter, Laravel, .NET, Oracle, MySQL & SQL Server.'],
            ['id' => 'mobile', 'label' => 'Mobile Apps', 'badge' => 'Flutter · Android Native', 'headline' => 'Cross-Platform & Native Mobile Developer', 'summary' => 'Merancang aplikasi mobile pembayaran online, company profile, dan sistem kasir POS menggunakan Flutter dan Android Native (Java/XML).'],
        ]);

        // 7. Certifications Config
        MotionConfig::setValue('certifications', [
            ['title' => 'SMK Telkom Malang — Software Engineering', 'issuer' => 'SMK Telkom Malang', 'year' => '2019', 'badge' => 'RPL Graduate', 'detail' => 'Kompetensi inti rekayasa perangkat lunak, algoritma, pemrograman berorientasi objek, basis data relasional, dan arsitektur web.'],
            ['title' => 'Technical Researcher & Frontend Specialist', 'issuer' => 'PT. Sigma Cipta Caraka (Telkomsigma)', 'year' => '2020 — Sekarang', 'badge' => 'Enterprise Active', 'detail' => 'Evaluasi teknologi antarmuka korporasi, standardisasi komponen Vue/Nuxt, dan pemeliharaan aplikasi internal skala besar.'],
            ['title' => 'Fullstack POS & Android Developer', 'issuer' => 'PT. Ara Infra Indo', 'year' => '2022 — 2023', 'badge' => 'Production POS', 'detail' => 'Implementasi arsitektur kasir Point of Sale berbasis Android Native Java/XML dan backend CodeIgniter 3.'],
        ]);

        // 8. Hobbies Config
        MotionConfig::setValue('hobbies', [
            ['title' => 'Exploring New Frameworks', 'description' => 'Eksplorasi mendalam teknologi frontend, mobile (Flutter), dan AI-assisted engineering.', 'image' => '/hobbies/programming.webp'],
            ['title' => 'Touring & Riding', 'description' => 'Menjelajahi suasana baru untuk menjaga perspektif kreatif tetap segar.', 'image' => '/hobbies/riding.webp'],
            ['title' => 'Music Enthusiast', 'description' => 'Playlist koding favorit: MAN WITH A MISSION, HONNE, Forester, Milet, dan YOASOBI.', 'image' => '/hobbies/negative-space-headphones-black-white-corey-blaz.webp'],
        ]);

        // 9. Projects (5 Case Studies)
        $projects = [
            [
                'project_key' => 'mango-hcm',
                'number' => '01',
                'title' => 'MANGO — Human Capital Management Online',
                'subtitle' => 'Enterprise Organization Structure & Employee Ecosystem',
                'company' => 'PT. Sigma Cipta Caraka (Telkomsigma)',
                'period' => '2020 — Present',
                'category' => 'enterprise',
                'roles' => ['frontend', 'fullstack'],
                'cover_image' => '/work/sigma/mango/dashboard.png',
                'logo' => '/work/sigma/mango/logo.png',
                'description' => 'Aplikasi enterprise komprehensif untuk memetakan struktur organisasi perusahaan dari pucuk pimpinan (CEO) hingga seluruh lini jabatan di bawahnya, dilengkapi pengelolaan siklus hidup data karyawan, pengajuan & konfigurasi cuti (Leave Management), PCN, serta laporan kepegawaian.',
                'impact_highlights' => [
                    'Visualisasi interaktif Position Organization Chart & Position Tree Grid secara real-time.',
                    'Sentralisasi data profil karyawan lengkap, riwayat jabatan, manajemen akses user, dan persetujuan PCN.',
                    'Modul pengelolaan dan kuota cuti karyawan terintegrasi (Leave Dashboard & Config Leave).',
                ],
                'tech_stack' => ['NuxtJS', 'Vue.js', 'Buefy', 'JavaScript', 'CSS3', 'REST API', 'Oracle / MySQL'],
                'team' => ['Moch. Adam Athallahrich (Frontend/Fullstack)', 'Mardi Jumari (Team Lead)', 'Almaratus Sholicha (Backend)'],
                'live_url' => null,
                'repo_url' => null,
                'demo_credentials' => null,
                'gallery' => [
                    ['title' => 'MANGO Executive Dashboard', 'src' => '/work/sigma/mango/dashboard.png'],
                    ['title' => 'Position Organization Chart (Interactive Tree)', 'src' => '/work/sigma/mango/treeorgposition.png'],
                    ['title' => 'Position Tree Grid View', 'src' => '/work/sigma/mango/treegridposition.png'],
                    ['title' => 'Modal Edit Position & Hierarchy', 'src' => '/work/sigma/mango/modaleditposition.png'],
                    ['title' => 'Complete Employee Detail & Background', 'src' => '/work/sigma/mango/employeedetail.png'],
                    ['title' => 'Employee Directory Management', 'src' => '/work/sigma/mango/employee.png'],
                    ['title' => 'Leave Management Dashboard', 'src' => '/work/sigma/mango/leavedashboard.png'],
                    ['title' => 'Employee Leave Balance & Check', 'src' => '/work/sigma/mango/checkleaveemployee.png'],
                    ['title' => 'Leave Configuration System', 'src' => '/work/sigma/mango/configleave.png'],
                    ['title' => 'PCN Workflow Management', 'src' => '/work/sigma/mango/pcn.png'],
                    ['title' => 'PCN Review & Approval', 'src' => '/work/sigma/mango/reviewpcn.png'],
                    ['title' => 'Enterprise Master Data', 'src' => '/work/sigma/mango/masterdata.png'],
                    ['title' => 'Analytics & HR Reporting', 'src' => '/work/sigma/mango/report.png'],
                    ['title' => 'User & Role Access Management', 'src' => '/work/sigma/mango/usermanagement.png'],
                ],
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'project_key' => 'sigma-pa',
                'number' => '02',
                'title' => 'PA — Performance Appraisal & Bukusaku',
                'subtitle' => 'KPI-Based Annual Employee Assessment Platform',
                'company' => 'PT. Sigma Cipta Caraka (Telkomsigma)',
                'period' => '2020 — Present',
                'category' => 'enterprise',
                'roles' => ['fullstack', 'frontend'],
                'cover_image' => '/work/sigma/pa/dashboard.png',
                'logo' => '/work/sigma/pa/logo.png',
                'description' => 'Sistem penilaian kinerja tahunan karyawan (Performance Appraisal) yang berjalan sesuai periode aktual korporasi untuk memantau perkembangan kompetensi karyawan berdasarkan indikator KPI yang dinilai berjenjang oleh atasan (Supervisor/Manager).',
                'impact_highlights' => [
                    'Alur penilaian berjenjang antara karyawan dan supervisor berdasarkan bobot KPI terukur.',
                    'Dashboard monitoring status penilaian, rekapitulasi nilai akhir, dan histori performa.',
                    'Manajemen System Master, daftar pengguna PA, dan ekspor laporan evaluasi tahunan.',
                ],
                'tech_stack' => ['CodeIgniter 3', 'PHP Native', 'HTML5', 'CSS3', 'JavaScript', 'jQuery', 'Oracle / MySQL'],
                'team' => ['Moch. Adam Athallahrich (Fullstack Developer)', 'Mardi Jumari (Team Lead)', 'Anindyka Elras Saputri (Backup)'],
                'live_url' => null,
                'repo_url' => null,
                'demo_credentials' => null,
                'gallery' => [
                    ['title' => 'Performance Appraisal Dashboard', 'src' => '/work/sigma/pa/dashboard.png'],
                    ['title' => 'Detail Penilaian KPI Karyawan', 'src' => '/work/sigma/pa/penilaianemployee.png'],
                    ['title' => 'Halaman Evaluasi & Penilaian Supervisor', 'src' => '/work/sigma/pa/penilaianspv.png'],
                    ['title' => 'Detail Matriks Performance Appraisal', 'src' => '/work/sigma/pa/detailpa.png'],
                    ['title' => 'Daftar PA Karyawan', 'src' => '/work/sigma/pa/listpaemployee.png'],
                    ['title' => 'Daftar PA Supervisor', 'src' => '/work/sigma/pa/listpaspv.png'],
                    ['title' => 'Laporan Evaluasi Kinerja (PA Report)', 'src' => '/work/sigma/pa/listreport.png'],
                    ['title' => 'Konfigurasi System Master PA', 'src' => '/work/sigma/pa/listsystemmaster.png'],
                    ['title' => 'Manajemen Peserta & User PA', 'src' => '/work/sigma/pa/listuserpa.png'],
                ],
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'project_key' => 'casier-coffeeshop',
                'number' => '03',
                'title' => 'Casier Coffee Shop POS',
                'subtitle' => 'Web-Based Cafe Point of Sale & Order Management',
                'company' => 'Independent Fullstack Project',
                'period' => 'Production Web App',
                'category' => 'personal',
                'roles' => ['fullstack', 'frontend'],
                'cover_image' => '/project-ss/coffeeshop/dashboard.png',
                'logo' => null,
                'description' => 'Aplikasi web Point of Sale (POS) untuk operasional Coffee Shop yang memungkinkan kasir mencatat pesanan pelanggan dengan cepat serta menyediakan panel Admin untuk mengelola menu, transaksi, dan laporan penjualan harian.',
                'impact_highlights' => [
                    'Dual-role akses terpisah untuk Kasir (pencatatan transaksi cepat) dan Admin (manajemen menu & laporan).',
                    'Antarmuka pemilihan menu interaktif dengan kalkulasi keranjang dan cetak struk instan.',
                    'Tersedia secara live beserta repositori kode sumber terbuka di GitLab.',
                ],
                'tech_stack' => ['CodeIgniter 3', 'PHP', 'JavaScript', 'jQuery', 'HTML5', 'CSS3', 'MySQL'],
                'team' => ['Moch. Adam Athallahrich (Fullstack Developer)'],
                'live_url' => 'https://sistempossederhana.my.id/coffeeshop',
                'repo_url' => 'https://gitlab.com/athallahrich/coffeeshop',
                'demo_credentials' => 'Kasir: kasir / Password1! · Admin: admin / Password1!',
                'gallery' => [
                    ['title' => 'Casier Coffee Shop — Dashboard & Order View', 'src' => '/project-ss/coffeeshop/dashboard.png'],
                ],
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'project_key' => 'warehouse-sales',
                'number' => '04',
                'title' => 'Warehouse Sales & Order System',
                'subtitle' => 'End-to-End Sales Order to Warehouse Inventory Pipeline',
                'company' => 'Commercial Web Application',
                'period' => 'Production Web App',
                'category' => 'personal',
                'roles' => ['fullstack', 'frontend'],
                'cover_image' => '/project-ss/sales/dashboard.png',
                'logo' => null,
                'description' => 'Aplikasi web manajemen pemesanan dan distribusi barang yang menghubungkan alur kerja tim Sales (pembuatan order penjualan) hingga pengelolaan stok dan penyimpanan di gudang (Warehouse Storage).',
                'impact_highlights' => [
                    'Integrasi alur order dari pencatatan tim sales hingga pemenuhan stok gudang.',
                    'Dashboard analitik ringkasan produk, status pesanan, dan pergerakan inventaris.',
                    'Arsitektur terstruktur berbasis CodeIgniter 3 yang ringan dan cepat.',
                ],
                'tech_stack' => ['CodeIgniter 3', 'PHP', 'jQuery', 'JavaScript', 'HTML5', 'CSS3', 'MySQL'],
                'team' => ['Moch. Adam Athallahrich (Fullstack Developer)'],
                'live_url' => 'https://sistempossederhana.my.id/sales',
                'repo_url' => null,
                'demo_credentials' => null,
                'gallery' => [
                    ['title' => 'Warehouse Sales — Order & Inventory Dashboard', 'src' => '/project-ss/sales/dashboard.png'],
                ],
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'project_key' => 'pos-diginov',
                'number' => '05',
                'title' => 'POS App Diginov (Android Native)',
                'subtitle' => 'Native Android Cashier & Real-Time Ingredient Tracker',
                'company' => 'PT. Ara Infra Indo / Diginov Project',
                'period' => 'Android Native App',
                'category' => 'personal',
                'roles' => ['mobile'],
                'cover_image' => '/project-ss/diginov/diginov.png',
                'logo' => null,
                'description' => 'Aplikasi kasir (Point of Sale) berbasis Android Native yang dirancang untuk memproses pemesanan menu secara mobile sekaligus memantau status pesanan dan sisa stok bahan baku (ingredients) secara langsung.',
                'impact_highlights' => [
                    'Dibangun secara native menggunakan Java dan XML untuk performa optimal pada perangkat tablet/smartphone kasir.',
                    'Fitur pelacakan status pesanan aktif dan kalkulasi otomatis sisa bahan baku dapur.',
                    'Antarmuka kasir ergonomis dengan alur transaksi multi-layar.',
                ],
                'tech_stack' => ['Android Native', 'Java', 'XML', 'Mobile POS Architecture'],
                'team' => ['Moch. Adam Athallahrich (Android Developer)'],
                'live_url' => null,
                'repo_url' => 'https://gitlab.com/athallahrich/apps-pos-diginov',
                'demo_credentials' => null,
                'gallery' => [
                    ['title' => 'POS App Diginov — Overview', 'src' => '/project-ss/diginov/diginov.png'],
                    ['title' => 'Mobile Screen — Menu & Category Selection', 'src' => '/project-ss/diginov/Screenshot 2025-04-10 232234.png'],
                    ['title' => 'Mobile Screen — Order Cart & Calculation', 'src' => '/project-ss/diginov/Screenshot 2025-04-10 232325.png'],
                    ['title' => 'Mobile Screen — Transaction & Status', 'src' => '/project-ss/diginov/Screenshot 2025-04-10 232405.png'],
                    ['title' => 'Mobile Screen — Ingredient & Stock View', 'src' => '/project-ss/diginov/Screenshot 2025-04-10 232437.png'],
                    ['title' => 'Mobile Screen — Receipt & Summary', 'src' => '/project-ss/diginov/Screenshot 2025-04-10 232506.png'],
                ],
                'display_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($projects as $proj) {
            MotionProject::updateOrCreate(
                ['project_key' => $proj['project_key']],
                $proj
            );
        }
    }
}

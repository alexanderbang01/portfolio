<?php
// Beregn alder baseret på fødselsdato (7. august)
$birth_year = 2001; // Juster dette til din faktiske fødselsår
$birth_month = 8;
$birth_day = 7;

$today = new DateTime();
$birth_date = new DateTime("$birth_year-$birth_month-$birth_day");
$age = $today->diff($birth_date)->y;

$current_year = date('Y');
?>
<!DOCTYPE html>
<html lang="da">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alexander Bang - Datatekniker</title>
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <style>
        * {
            font-family: 'JetBrains Mono', monospace;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .slide-in {
            opacity: 0;
            transform: translateX(-30px);
            transition: all 0.7s ease;
        }

        .slide-in.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .tech-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .tech-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s;
        }

        .tech-card:hover::before {
            left: 100%;
        }

        .tech-card:hover {
            transform: translateY(-5px);
            background-color: #1a1a1a;
        }

        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: white;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .project-card {
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .project-card:hover {
            transform: translateY(-10px);
        }

        .project-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.05), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .project-card:hover::after {
            opacity: 1;
        }

        .typing-animation {
            border-right: 2px solid white;
            animation: blink 1s infinite;
        }

        @keyframes blink {

            0%,
            50% {
                border-color: white;
            }

            51%,
            100% {
                border-color: transparent;
            }
        }

        .grid-pattern {
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .hero-gradient {
            background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        }

        .section-separator {
            position: relative;
        }

        .section-separator::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 1px;
            background: linear-gradient(90deg, transparent, white, transparent);
        }

        /* Custom Modal - Full Screen Center */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: #000;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            padding: 3rem;
            max-width: 600px;
            width: 90%;
            transform: translateY(-50px) scale(0.9);
            transition: all 0.3s ease;
            text-align: center;
        }

        .modal-overlay.show .modal-content {
            transform: translateY(0) scale(1);
        }

        .terminal-header {
            font-family: 'JetBrains Mono', monospace;
            color: #00ff00;
            margin-bottom: 2rem;
            font-size: 16px;
            text-align: left;
        }

        .modal-message {
            color: white;
            font-size: 18px;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .modal-success {
            border-color: #00ff00;
        }

        .modal-error {
            border-color: #ff0000;
        }

        .modal-success .terminal-header {
            color: #00ff00;
        }

        .modal-error .terminal-header {
            color: #ff0000;
        }
    </style>
</head>

<body class="bg-black text-white">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-black/90 backdrop-blur-sm border-b border-white/10 px-6 py-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <div class="text-lg font-medium">alexander@portfolio:~$</div>
            <div class="hidden md:flex space-x-8">
                <a href="#home" class="nav-link hover:text-gray-300">home</a>
                <a href="#about" class="nav-link hover:text-gray-300">about</a>
                <a href="#skills" class="nav-link hover:text-gray-300">skills</a>
                <a href="#projects" class="nav-link hover:text-gray-300">projects</a>
                <a href="#contact" class="nav-link hover:text-gray-300">contact</a>
            </div>
            <button class="md:hidden text-white" id="menuToggle">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        <div class="hidden md:hidden mt-4 space-y-2" id="mobileMenu">
            <a href="#home" class="block hover:text-gray-300">home</a>
            <a href="#about" class="block hover:text-gray-300">about</a>
            <a href="#skills" class="block hover:text-gray-300">skills</a>
            <a href="#projects" class="block hover:text-gray-300">projects</a>
            <a href="#contact" class="block hover:text-gray-300">contact</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center px-6 relative grid-pattern">
        <div class="hero-gradient absolute inset-0"></div>
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <div class="mb-8 fade-in">
                <img src="assets/person.png" alt="Alexander Bang" class="w-32 h-32 rounded-full mx-auto mb-6 border-2 border-white/20">
            </div>
            <h1 class="text-5xl md:text-7xl font-light mb-6 fade-in">
                Alexander Bang
            </h1>
            <div class="text-xl md:text-2xl text-gray-300 mb-8 fade-in">
                <span class="typing-animation">Datatekniker | <?php echo $age; ?> år</span>
            </div>
            <p class="text-gray-400 mb-12 max-w-2xl mx-auto fade-in text-lg leading-relaxed">
                Færdiguddannet 30. juni 2025 med speciale i programmering.<br>
                Passioneret om at bygge digitale løsninger.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center fade-in">
                <a href="#projects" class="border border-white px-8 py-4 hover:bg-white hover:text-black transition-all font-medium">
                    → Se projekter
                </a>
                <a href="#contact" class="border border-white/30 px-8 py-4 hover:border-white transition-all font-medium">
                    → Kontakt mig
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 px-6 section-separator">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-4xl font-light mb-16 text-center fade-in">om_mig.md</h2>
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="slide-in">
                    <img src="assets/person.png" alt="Alexander Bang" class="w-full max-w-md mx-auto rounded-lg border border-white/10">
                </div>
                <div class="slide-in">
                    <div class="space-y-6 text-gray-300 leading-relaxed">
                        <p>
                            // Hvem er jeg?<br>
                            <span class="text-white">const me</span> = {<br>
                            &nbsp;&nbsp;navn: <span class="text-gray-400">"Alexander Bang"</span>,<br>
                            &nbsp;&nbsp;alder: <span class="text-white"><?php echo $age; ?></span>,<br>
                            &nbsp;&nbsp;rolle: <span class="text-gray-400">"Datatekniker"</span>,<br>
                            &nbsp;&nbsp;uddannelse: <span class="text-gray-400">"Færdig 2025"</span><br>
                            };
                        </p>
                        <p class="text-gray-400">
                            Jeg er nyuddannet datatekniker med fokus på programmering.
                            Under min uddannelse har jeg arbejdet med forskellige teknologier
                            og udviklet færdigheder inden for både frontend og backend udvikling.
                        </p>
                        <p class="text-gray-400">
                            Jeg brænder for at lære nye teknologier og skabe
                            funktionelle digitale løsninger.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-24 px-6 section-separator">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-light mb-16 text-center fade-in">tech_stack.json</h2>

            <!-- Programming Languages -->
            <div class="mb-16 fade-in">
                <h3 class="text-xl font-medium mb-8 text-gray-300">// Programmeringssprog</h3>
                <div class="grid grid-cols-3 md:grid-cols-5 gap-6">
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-html5-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">HTML</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-css3-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">CSS</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-javascript-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">JavaScript</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-php-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">PHP</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-csharp-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">C#</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-flutter-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Flutter</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-dart-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Dart</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-swift-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Swift</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-tailwindcss-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Tailwind</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-bootstrap-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Bootstrap</div>
                    </div>
                </div>
            </div>

            <!-- Databases -->
            <div class="mb-16 fade-in">
                <h3 class="text-xl font-medium mb-8 text-gray-300">// Databaser</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-mysql-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">MySQL</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-postgresql-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">PostgreSQL</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-mysql-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">MariaDB</div>
                    </div>
                </div>
            </div>

            <!-- Design Tools -->
            <div class="mb-16 fade-in">
                <h3 class="text-xl font-medium mb-8 text-gray-300">// Design værktøjer</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-figma-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Figma</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-photoshop-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Photoshop</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-canva-original text-4xl mb-3 block"></i>
                        <div class="text-sm">Canva</div>
                    </div>
                </div>
            </div>

            <!-- Development Tools -->
            <div class="fade-in">
                <h3 class="text-xl font-medium mb-8 text-gray-300">// Udviklingsværktøjer</h3>
                <div class="grid grid-cols-3 md:grid-cols-4 gap-6">
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-git-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Git</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-github-original text-4xl mb-3 block"></i>
                        <div class="text-sm">GitHub</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-vscode-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">VS Code</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-xcode-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Xcode</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-androidstudio-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Android Studio</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-apache-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Laragon</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-apache-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">XAMPP</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-firebase-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Firebase</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-24 px-6 section-separator">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-light mb-16 text-center fade-in">projekter/</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Project 1 -->
                <div class="project-card bg-black border border-white/10 overflow-hidden fade-in">
                    <img src="assets/placeholder.png" alt="E-commerce" class="w-full h-48 object-cover border-b border-white/10">
                    <div class="p-6">
                        <h3 class="text-lg font-medium mb-3">webshop.php</h3>
                        <p class="text-gray-400 mb-4 text-sm leading-relaxed">
                            Fuld e-commerce løsning med brugeradministration og betalingsintegration.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="border border-white/20 px-2 py-1 text-xs">PHP</span>
                            <span class="border border-white/20 px-2 py-1 text-xs">MySQL</span>
                            <span class="border border-white/20 px-2 py-1 text-xs">JavaScript</span>
                        </div>
                    </div>
                </div>

                <!-- Project 2 -->
                <div class="project-card bg-black border border-white/10 overflow-hidden fade-in">
                    <img src="assets/placeholder.png" alt="Mobile App" class="w-full h-48 object-cover border-b border-white/10">
                    <div class="p-6">
                        <h3 class="text-lg font-medium mb-3">mobile_app.dart</h3>
                        <p class="text-gray-400 mb-4 text-sm leading-relaxed">
                            Cross-platform mobil applikation med moderne UI og real-time features.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="border border-white/20 px-2 py-1 text-xs">Flutter</span>
                            <span class="border border-white/20 px-2 py-1 text-xs">Dart</span>
                            <span class="border border-white/20 px-2 py-1 text-xs">Firebase</span>
                        </div>
                    </div>
                </div>

                <!-- Project 3 -->
                <div class="project-card bg-black border border-white/10 overflow-hidden fade-in">
                    <img src="assets/placeholder.png" alt="Desktop App" class="w-full h-48 object-cover border-b border-white/10">
                    <div class="p-6">
                        <h3 class="text-lg font-medium mb-3">desktop_app.cs</h3>
                        <p class="text-gray-400 mb-4 text-sm leading-relaxed">
                            Windows desktop applikation med avanceret funktionalitet.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="border border-white/20 px-2 py-1 text-xs">C#</span>
                            <span class="border border-white/20 px-2 py-1 text-xs">WPF</span>
                            <span class="border border-white/20 px-2 py-1 text-xs">SQL</span>
                        </div>
                    </div>
                </div>

                <!-- Project 4 -->
                <div class="project-card bg-black border border-white/10 overflow-hidden fade-in">
                    <img src="assets/placeholder.png" alt="iOS App" class="w-full h-48 object-cover border-b border-white/10">
                    <div class="p-6">
                        <h3 class="text-lg font-medium mb-3">ios_app.swift</h3>
                        <p class="text-gray-400 mb-4 text-sm leading-relaxed">
                            Native iOS applikation med SwiftUI og moderne arkitektur.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="border border-white/20 px-2 py-1 text-xs">Swift</span>
                            <span class="border border-white/20 px-2 py-1 text-xs">SwiftUI</span>
                            <span class="border border-white/20 px-2 py-1 text-xs">Core Data</span>
                        </div>
                    </div>
                </div>

                <!-- Project 5 -->
                <div class="project-card bg-black border border-white/10 overflow-hidden fade-in">
                    <img src="assets/placeholder.png" alt="Web App" class="w-full h-48 object-cover border-b border-white/10">
                    <div class="p-6">
                        <h3 class="text-lg font-medium mb-3">web_app.js</h3>
                        <p class="text-gray-400 mb-4 text-sm leading-relaxed">
                            Modern web applikation med responsive design og API integration.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="border border-white/20 px-2 py-1 text-xs">JavaScript</span>
                            <span class="border border-white/20 px-2 py-1 text-xs">Tailwind</span>
                            <span class="border border-white/20 px-2 py-1 text-xs">API</span>
                        </div>
                    </div>
                </div>

                <!-- Project 6 -->
                <div class="project-card bg-black border border-white/10 overflow-hidden fade-in">
                    <img src="assets/placeholder.png" alt="Portfolio" class="w-full h-48 object-cover border-b border-white/10">
                    <div class="p-6">
                        <h3 class="text-lg font-medium mb-3">portfolio.php</h3>
                        <p class="text-gray-400 mb-4 text-sm leading-relaxed">
                            Personlig portfolio website med moderne design og animationer.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="border border-white/20 px-2 py-1 text-xs">PHP</span>
                            <span class="border border-white/20 px-2 py-1 text-xs">Tailwind</span>
                            <span class="border border-white/20 px-2 py-1 text-xs">JavaScript</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 px-6 section-separator">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl font-light mb-16 text-center fade-in">kontakt.txt</h2>
            <div class="grid md:grid-cols-2 gap-16">
                <div class="fade-in">
                    <h3 class="text-xl font-medium mb-8 text-gray-300">// Kontakt information</h3>
                    <div class="space-y-6 text-gray-300 font-mono">
                        <div>
                            <span class="text-white">email:</span> <a href="mailto:alexanderbang22@gmail.com" class="text-gray-400 hover:text-white transition-colors cursor-pointer">"alexanderbang22@gmail.com"</a>
                        </div>
                        <div>
                            <span class="text-white">telefon:</span> <a href="tel:+4520255711" class="text-gray-400 hover:text-white transition-colors cursor-pointer">"+45 20 25 57 11"</a>
                        </div>
                        <div>
                            <span class="text-white">lokation:</span> <span class="text-gray-400">"Silkeborg, Danmark"</span>
                        </div>
                        <div>
                            <span class="text-white">linkedin:</span> <a href="https://www.linkedin.com/in/alexander-bang-044b8819b/" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors cursor-pointer">"@alexanderbang"</a>
                        </div>
                        <div>
                            <span class="text-white">github:</span> <a href="https://github.com/alexanderbang01" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors cursor-pointer">"@alexanderbang01"</a>
                        </div>
                    </div>
                </div>

                <div class="fade-in">
                    <form id="contactForm" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300">// navn</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 bg-black border border-white/20 focus:border-white focus:outline-none transition-colors font-mono" placeholder="dit_navn">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300">// email</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 bg-black border border-white/20 focus:border-white focus:outline-none transition-colors font-mono" placeholder="din@email.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300">// besked</label>
                            <textarea name="message" rows="5" required class="w-full px-4 py-3 bg-black border border-white/20 focus:border-white focus:outline-none transition-colors resize-none font-mono" placeholder="/* din besked her */"></textarea>
                        </div>
                        <button type="submit" id="submitBtn" class="w-full border border-white px-6 py-3 font-medium hover:bg-white hover:text-black transition-all">
                            → send_besked()
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 px-6 border-t border-white/10">
        <div class="max-w-6xl mx-auto text-center text-gray-400 font-mono">
            <p>© <?php echo $current_year; ?> Alexander Bang | Udviklet med ❤️</p>
        </div>
    </footer>

    <!-- Custom Modal -->
    <div id="messageModal" class="modal-overlay">
        <div class="modal-content">
            <div class="terminal-header">alexander@portfolio:~$ message_sent</div>
            <div id="modalMessage" class="modal-message"></div>
            <div class="flex justify-center">
                <button onclick="closeModal()" class="border border-white/30 px-8 py-3 hover:border-white hover:bg-white hover:text-black transition-all font-mono">
                    → close
                </button>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
                mobileMenu.classList.add('hidden');
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in, .slide-in').forEach(el => {
            observer.observe(el);
        });

        // Typing animation
        const typingElement = document.querySelector('.typing-animation');
        if (typingElement) {
            const text = typingElement.textContent;
            typingElement.textContent = '';
            let i = 0;

            function typeWriter() {
                if (i < text.length) {
                    typingElement.textContent += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, 100);
                }
            }

            // Start typing animation when element is visible
            const typingObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(typeWriter, 500);
                        typingObserver.unobserve(entry.target);
                    }
                });
            });

            typingObserver.observe(typingElement);
        }

        // Form submission with AJAX
        document.getElementById('contactForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.textContent;

            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.textContent = '→ sender...';
            submitBtn.style.opacity = '0.6';

            try {
                const formData = new FormData(this);

                // Debug: Test modal first
                console.log('Sending form...');

                const response = await fetch('contact_handler.php', {
                    method: 'POST',
                    body: formData
                });

                // Check if response is ok
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const result = await response.json();
                console.log('Response:', result);

                if (result.success) {
                    // Success - show custom modal
                    showModal(result.message, 'success');
                    this.reset();

                    // Reset input styles
                    const inputs = this.querySelectorAll('input, textarea');
                    inputs.forEach(input => {
                        input.style.borderColor = 'rgba(255,255,255,0.2)';
                        input.style.boxShadow = 'none';
                    });
                } else {
                    // Error - show custom modal
                    showModal(result.message, 'error');
                }

            } catch (error) {
                console.error('Error:', error);

                // If contact_handler.php doesn't exist, show a test modal
                if (error.message.includes('404') || error.message.includes('Failed to fetch')) {
                    showModal('Besked sendt til database! 🎉<br><small>(Test modal - contact_handler.php ikke fundet endnu)</small>', 'success');
                    this.reset();
                } else {
                    showModal('Der opstod en teknisk fejl. Prøv venligst igen senere.', 'error');
                }
            } finally {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
                submitBtn.style.opacity = '1';
            }
        });

        // Add subtle parallax effect to hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroGradient = document.querySelector('.hero-gradient');
            if (heroGradient) {
                heroGradient.style.transform = `translateY(${scrolled * 0.3}px)`;
            }
        });

        // Terminal-like cursor blink for navigation
        document.addEventListener('DOMContentLoaded', function() {
            const navBrand = document.querySelector('nav .text-lg');
            let showCursor = true;

            setInterval(() => {
                if (showCursor) {
                    navBrand.textContent = 'alexander@portfolio:~$ █';
                } else {
                    navBrand.textContent = 'alexander@portfolio:~$';
                }
                showCursor = !showCursor;
            }, 1000);
        });

        // Custom Modal Functions
        function showModal(message, type = 'success') {
            const modal = document.getElementById('messageModal');
            const modalMessage = document.getElementById('modalMessage');
            const modalContent = modal.querySelector('.modal-content');
            const terminalHeader = modal.querySelector('.terminal-header');

            // Update styles based on type
            if (type === 'success') {
                modalContent.className = 'modal-content modal-success';
                terminalHeader.textContent = 'alexander@portfolio:~$ message_sent --status=success';
            } else {
                modalContent.className = 'modal-content modal-error';
                terminalHeader.textContent = 'alexander@portfolio:~$ message_sent --status=error';
            }

            // Set message
            modalMessage.innerHTML = message;

            // Show modal
            modal.classList.add('show');

            // Auto close after 6 seconds
            setTimeout(() => {
                closeModal();
            }, 6000);
        }

        function closeModal() {
            const modal = document.getElementById('messageModal');
            modal.classList.remove('show');
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Close modal on outside click
        document.getElementById('messageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Make functions globally available for testing
        window.showModal = showModal;
        window.closeModal = closeModal;
    </script>
</body>

</html>
<?php
$birth_year = 2001;
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
                <a href="#experience" class="nav-link hover:text-gray-300">experience</a>
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
            <a href="#experience" class="block hover:text-gray-300">experience</a>
            <a href="#contact" class="block hover:text-gray-300">contact</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center px-6 relative grid-pattern">
        <div class="hero-gradient absolute inset-0"></div>
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <div class="mb-8 fade-in flex justify-center space-x-8">
                <a href="https://www.linkedin.com/in/alexander-bang-044b8819b/" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-300 transition-colors">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                    </svg>
                </a>
                <a href="https://github.com/alexanderbang01" target="_blank" rel="noopener noreferrer" class="text-white hover:text-gray-300 transition-colors">
                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                    </svg>
                </a>
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
            <div class="flex justify-center fade-in">
                <a href="#contact" class="border border-white px-8 py-4 hover:bg-white hover:text-black transition-all font-medium">
                    → Kontakt mig
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 px-6 section-separator">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-4xl font-light mb-16 text-center fade-in">om_mig.md</h2>
            <div class="grid md:grid-cols-2 gap-16 items-start">
                <div class="slide-in">
                    <img src="assets/ab.jpeg" alt="Alexander Bang" class="w-full max-w-md mx-auto rounded-lg border border-white/10 object-contain">
                </div>
                <div class="slide-in">
                    <div class="space-y-6 text-gray-300 leading-relaxed">
                        <p>
                            // Hvem er jeg?<br>
                            <span class="text-white">const me</span> = {<br>
                            &nbsp;&nbsp;navn: <span class="text-gray-400">"Alexander Bang"</span>,<br>
                            &nbsp;&nbsp;alder: <span class="text-white"><?php echo $age; ?></span>,<br>
                            &nbsp;&nbsp;rolle: [<span class="text-gray-400">"Datatekniker"</span>, <span class="text-gray-400">"Programmør"</span>],<br>
                            &nbsp;&nbsp;uddannelse: <span class="text-gray-400">"Færdig 2025"</span><br>
                            };
                        </p>
                        <p class="text-gray-400">
                            Jeg er nyuddannet datatekniker med speciale i programmering.
                            Under min uddannelse har jeg arbejdet med forskellige teknologier
                            og udviklet færdigheder inden for både mobile apps, frontend og backend webudvikling.
                        </p>
                        <p class="text-gray-400">
                            Jeg er god til at tilpasse mig nye projekter og hurtigt sætte mig ind i ukendte teknologier.
                            Jeg arbejder struktureret og har fokus på at levere stabile og vedligeholdbare løsninger.
                        </p>
                        <p class="text-gray-400">
                            Jeg har erfaring med både Windows og macOS, hvilket gør mig fleksibel i forhold til forskellige udviklingsmiljøer
                            og samarbejde på tværs af platforme.
                        </p>
                        <p class="text-gray-400">
                            Jeg elsker at lære nye teknologier og skabe
                            funktionelle digitale løsninger, der gør en forskel for brugerne.
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

            <!-- Core Programming Languages -->
            <div class="mb-16 fade-in">
                <h3 class="text-xl font-medium mb-8 text-gray-300">// Core Programmeringssprog</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-javascript-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">JavaScript</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-typescript-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">TypeScript</div>
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
                        <i class="devicon-swift-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Swift</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-dart-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Dart</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-kotlin-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Kotlin</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-python-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Python</div>
                    </div>
                </div>
            </div>

            <!-- Frontend & Styling -->
            <div class="mb-16 fade-in">
                <h3 class="text-xl font-medium mb-8 text-gray-300">// Frontend & Styling</h3>
                <div class="grid grid-cols-3 md:grid-cols-5 gap-6">
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-html5-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">HTML5</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-css3-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">CSS3</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-tailwindcss-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Tailwind CSS</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-bootstrap-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Bootstrap</div>
                    </div>
                </div>
            </div>

            <!-- Frameworks & Libraries -->
            <div class="mb-16 fade-in">
                <h3 class="text-xl font-medium mb-8 text-gray-300">// Frameworks & Libraries</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-flutter-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Flutter</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-dotnetcore-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">.NET Core</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-react-original text-4xl mb-3 block"></i>
                        <div class="text-sm">React</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-vuejs-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Vue.js</div>
                    </div>
                </div>
            </div>

            <!-- Databases -->
            <div class="mb-16 fade-in">
                <h3 class="text-xl font-medium mb-8 text-gray-300">// Databaser</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-mysql-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">MySQL</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-postgresql-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">PostgreSQL</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-mongodb-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">MongoDB</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-mysql-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">MariaDB</div>
                    </div>
                </div>
            </div>

            <!-- Cloud & Services -->
            <div class="mb-16 fade-in">
                <h3 class="text-xl font-medium mb-8 text-gray-300">// Cloud & Services</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-firebase-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Firebase</div>
                    </div>
                    <div class="tech-card bg-black border border-white/10 p-6 text-center">
                        <i class="devicon-azure-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Azure</div>
                    </div>
                </div>
            </div>

            <!-- Design Tools -->
            <div class="mb-16 fade-in">
                <h3 class="text-xl font-medium mb-8 text-gray-300">// Design værktøjer</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
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
                <div class="grid grid-cols-3 md:grid-cols-5 gap-6">
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
                        <i class="devicon-visualstudio-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Visual Studio</div>
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
                        <i class="devicon-docker-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Docker</div>
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
                        <i class="devicon-postman-plain text-4xl mb-3 block"></i>
                        <div class="text-sm">Postman</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section (Erstatter Projects) -->
    <section id="experience" class="py-24 px-6 section-separator">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-light mb-16 text-center fade-in">erfaring/</h2>
            <div class="max-w-4xl mx-auto">

                <!-- Uddannelse -->
                <div class="mb-12 fade-in">
                    <div class="bg-black border border-white/10 p-8 rounded-lg">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                            <h3 class="text-xl font-medium">Datatekniker med speciale i Programmering</h3>
                            <span class="text-gray-400 text-sm mt-2 md:mt-0">2019 - 2025</span>
                        </div>
                        <p class="text-gray-400 mb-4">Uddannelsesinstitution</p>
                        <p class="text-gray-300 leading-relaxed">
                            Færdiguddannet som datatekniker med fokus på programmering. Har arbejdet med diverse teknologier
                            og udviklet kompetencer inden for både frontend og backend udvikling.
                        </p>
                    </div>
                </div>

                <!-- Kompetencer -->
                <div class="mb-12 fade-in">
                    <div class="bg-black border border-white/10 p-8 rounded-lg">
                        <h3 class="text-xl font-medium mb-6">Kernekompetencer</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-lg font-medium text-gray-300 mb-3">Frontend Udvikling</h4>
                                <ul class="text-gray-400 space-y-2">
                                    <li>• Responsive webdesign</li>
                                    <li>• JavaScript & TypeScript</li>
                                    <li>• App-udvikling (Dart)</li>
                                    <li>• CSS frameworks (Tailwind, Bootstrap)</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="text-lg font-medium text-gray-300 mb-3">Backend Udvikling</h4>
                                <ul class="text-gray-400 space-y-2">
                                    <li>• PHP & .NET Core</li>
                                    <li>• Database design (MySQL, PostgreSQL)</li>
                                    <li>• API udvikling</li>
                                    <li>• Cloud services (Firebase, Azure)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mål -->
                <div class="fade-in">
                    <div class="bg-black border border-white/10 p-8 rounded-lg">
                        <h3 class="text-xl font-medium mb-4">Fremtidige Mål</h3>
                        <p class="text-gray-300 leading-relaxed">
                            Som nyuddannet datatekniker søger jeg en udviklerposition, hvor jeg kan anvende
                            mine færdigheder og fortsætte med at lære nye teknologier. Jeg er særligt interesseret i
                            webudvikling og mobile applikationer.
                        </p>
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
                    navBrand.textContent = 'alexander@portfolio:~';
                }
                showCursor = !showCursor;
            }, 1000);
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
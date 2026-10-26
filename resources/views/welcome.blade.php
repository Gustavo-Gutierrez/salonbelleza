<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Salon Studio - Salón de belleza premium por Yolanda Gutierrez. Servicios profesionales de estética, belleza y bienestar.">

    <title>Salon Studio | Belleza y Estética Profesional</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dancing-script:400,700|playfair-display:400,700,900|poppins:300,400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #d4a574; /* Dorado cálido */
            --secondary-color: #8b7355; /* Café elegante */
            --accent-color: #c19a6b; /* Dorado medio */
            --light-bg: #f9f7f3; /* Beige claro */
            --dark-text: #3a3a3a;
            --light-text: #7a6e5d;
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-text);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        /* Navbar Superior */
        .top-bar {
            background: var(--secondary-color);
            color: var(--white);
            padding: 0.5rem 0;
            font-size: 0.9rem;
        }
        
        .top-bar a {
            color: var(--white);
            text-decoration: none;
            margin-right: 1.5rem;
        }
        
        .top-bar i {
            margin-right: 0.5rem;
        }
        
        /* Navbar Principal */
        .main-navbar {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(139, 115, 85, 0.1);
            padding: 1rem 0;
            transition: all 0.3s ease;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .studio-logo {
            font-family: 'Dancing Script', cursive;
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--secondary-color);
            text-decoration: none;
            line-height: 1;
        }
        
        .studio-logo span {
            color: var(--primary-color);
            font-size: 3rem;
        }
        
        .studio-tagline {
            font-family: 'Playfair Display', serif;
            font-size: 0.9rem;
            color: var(--light-text);
            margin-top: -5px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        
        .nav-link-custom {
            color: var(--dark-text) !important;
            font-weight: 500;
            font-size: 1rem;
            margin: 0 1rem;
            position: relative;
            padding: 0.5rem 0 !important;
            transition: color 0.3s ease;
        }
        
        .nav-link-custom:hover {
            color: var(--primary-color) !important;
        }
        
        .nav-link-custom.active {
            color: var(--primary-color) !important;
        }
        
        .nav-link-custom.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--primary-color);
        }
        
        .btn-yolanda {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: var(--white) !important;
            border: none;
            border-radius: 30px;
            padding: 0.8rem 2.2rem;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 165, 116, 0.3);
        }
        
        .btn-yolanda:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(212, 165, 116, 0.4);
        }
        
        .btn-outline-yolanda {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
            border-radius: 30px;
            padding: 0.8rem 2.2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-outline-yolanda:hover {
            background: var(--primary-color);
            color: var(--white);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(248, 245, 240, 0.95), rgba(248, 245, 240, 0.95)),
                        url('https://images.unsplash.com/photo-1560066984-138dadb4c035?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            min-height: 90vh;
            display: flex;
            align-items: center;
            padding: 6rem 0;
            position: relative;
        }
        
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--light-text);
            margin-bottom: 2rem;
            max-width: 600px;
        }
        
        .hero-highlight {
            color: var(--primary-color);
            font-family: 'Dancing Script', cursive;
            font-size: 5rem;
            display: block;
            margin-top: -1rem;
        }
        
        .owner-name {
            font-family: 'Playfair Display', serif;
            color: var(--secondary-color);
            font-size: 1.5rem;
            margin-top: 2rem;
            position: relative;
            display: inline-block;
        }
        
        .owner-name::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -40px;
            width: 30px;
            height: 1px;
            background: var(--primary-color);
        }
        
        /* Servicios Section */
        .services-section {
            padding: 6rem 0;
            background: var(--white);
        }
        
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--secondary-color);
        }
        
        .section-subtitle {
            text-align: center;
            color: var(--light-text);
            margin-bottom: 3rem;
            font-size: 1.1rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .service-card {
            background: var(--white);
            border-radius: 15px;
            padding: 2.5rem 2rem;
            transition: all 0.4s ease;
            height: 100%;
            border: 1px solid rgba(212, 165, 116, 0.1);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }
        
        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }
        
        .service-card:hover::before {
            transform: scaleX(1);
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(212, 165, 116, 0.15);
        }
        
        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--light-bg), var(--white));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--primary-color);
            font-size: 2rem;
            border: 2px solid rgba(212, 165, 116, 0.2);
            transition: all 0.3s ease;
        }
        
        .service-card:hover .service-icon {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: var(--white);
            transform: rotateY(180deg);
        }
        
        .service-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .service-price {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.4rem;
            text-align: center;
            margin-top: 1.5rem;
        }
        
        /* Galería Section */
        .gallery-section {
            padding: 6rem 0;
            background: var(--light-bg);
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }
        
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            height: 300px;
            cursor: pointer;
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        
        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(59, 46, 29, 0.9));
            color: var(--white);
            padding: 1.5rem;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover .gallery-overlay {
            transform: translateY(0);
        }
        
        /* Testimonios Section */
        .testimonials-section {
            padding: 6rem 0;
            background: var(--white);
        }
        
        .testimonial-card {
            background: var(--light-bg);
            border-radius: 15px;
            padding: 2.5rem;
            margin: 1rem;
            position: relative;
            border-left: 5px solid var(--primary-color);
        }
        
        .testimonial-text {
            font-style: italic;
            color: var(--dark-text);
            margin-bottom: 1.5rem;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .author-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
        }
        
        /* CTA Section */
        .cta-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, var(--secondary-color), var(--dark-text));
            color: var(--white);
            text-align: center;
        }
        
        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }
        
        .cta-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2.5rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Footer */
        .footer {
            background: var(--dark-text);
            color: var(--white);
            padding: 4rem 0 2rem;
        }
        
        .footer-logo {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--white);
            margin-bottom: 1rem;
        }
        
        .footer-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }
        
        .footer-links a {
            color: #ccc;
            text-decoration: none;
            display: block;
            margin-bottom: 0.8rem;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: var(--primary-color);
        }
        
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: var(--white);
            margin-right: 0.8rem;
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .copyright {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #999;
            font-size: 0.9rem;
        }
        
        /* WhatsApp Float */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #25D366;
            color: var(--white);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .whatsapp-float:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(37, 211, 102, 0.6);
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 3rem;
            }
            
            .hero-highlight {
                font-size: 4rem;
            }
            
            .section-title {
                font-size: 2.3rem;
            }
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-highlight {
                font-size: 3rem;
            }
            
            .studio-logo {
                font-size: 2.2rem;
            }
            
            .studio-logo span {
                font-size: 2.4rem;
            }
            
            .nav-link-custom {
                margin: 0.5rem 0;
                text-align: center;
            }
        }
        
        /* Animaciones */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeInUp 0.8s ease-out;
        }
    </style>
</head>
<body class="salon-body">
    <!-- WhatsApp Float -->
    <a href="https://wa.me/5211234567890?text=Hola%20Salon%20Studio,%20me%20interesa%20agendar%20una%20cita" 
       class="whatsapp-float" 
       target="_blank"
       title="Agendar cita por WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="tel:+5211234567890">
                        <i class="fas fa-phone-alt"></i> +52 123 456 7890
                    </a>
                    <a href="mailto:contacto@salonstudio.com">
                        <i class="fas fa-envelope"></i> contacto@salonstudio.com
                    </a>
                </div>
                <div>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg main-navbar">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <div class="studio-logo">Salon<span>Studio</span></div>
                <div class="studio-tagline">Yolanda Gutierrez</div>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom active" href="#home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#services">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#gallery">Galería</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#about">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#testimonials">Testimonios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#contact">Contacto</a>
                    </li>
                </ul>

                <!-- Auth Buttons -->
                <div class="d-flex align-items-center ms-lg-3 mt-3 mt-lg-0">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-yolanda me-2">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-yolanda">
                                <i class="fas fa-sign-out-alt me-2"></i>Salir
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-yolanda me-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-yolanda">
                                <i class="fas fa-user-plus me-2"></i>Registrarse
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 fade-in">
                    <h1 class="hero-title">
                        Descubre tu belleza interior y exterior en
                        <span class="hero-highlight">Salon Studio</span>
                    </h1>
                    <p class="hero-subtitle">
                        Un espacio dedicado a realzar tu belleza natural con técnicas profesionales 
                        y productos de la más alta calidad. Donde cada servicio es una experiencia única.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#contact" class="btn btn-yolanda btn-lg">
                            <i class="fas fa-calendar-check me-2"></i>Agendar Cita
                        </a>
                        <a href="#services" class="btn btn-outline-yolanda btn-lg">
                            <i class="fas fa-spa me-2"></i>Ver Servicios
                        </a>
                    </div>
                    <div class="owner-name">Yolanda Gutierrez - Especialista en Belleza</div>
                </div>
                <div class="col-lg-6">
                    <!-- Imagen decorativa -->
                    <div class="position-relative" data-aos="fade-left">
                        <img src="https://images.unsplash.com/photo-1562322140-8baeececf3df?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Salon Studio" 
                             class="img-fluid rounded-3 shadow-lg">
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-10 rounded-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios Section -->
    <section id="services" class="services-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Nuestros Servicios</h2>
                <p class="section-subtitle">
                    Ofrecemos una amplia gama de servicios profesionales para cuidar de tu belleza y bienestar
                </p>
            </div>

            <div class="row g-4">
                <!-- Servicio 1 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-cut"></i>
                        </div>
                        <h3 class="service-title">Cortes y Peinados</h3>
                        <p class="text-center">Transformamos tu look con cortes modernos y peinados para ocasiones especiales.</p>
                        <div class="service-price">Desde $350 MXN</div>
                    </div>
                </div>

                <!-- Servicio 2 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <h3 class="service-title">Coloración</h3>
                        <p class="text-center">Técnicas avanzadas de coloración, mechas, balayage y tratamientos capilares.</p>
                        <div class="service-price">Desde $800 MXN</div>
                    </div>
                </div>

                <!-- Servicio 3 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-hand-sparkles"></i>
                        </div>
                        <h3 class="service-title">Manicure & Pedicure</h3>
                        <p class="text-center">Cuidado profesional de uñas con esmaltado semipermanente y diseños personalizados.</p>
                        <div class="service-price">Desde $250 MXN</div>
                    </div>
                </div>

                <!-- Servicio 4 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-spa"></i>
                        </div>
                        <h3 class="service-title">Tratamientos Faciales</h3>
                        <p class="text-center">Limpieza facial profunda, hidratación y tratamientos anti-edad especializados.</p>
                        <div class="service-price">Desde $600 MXN</div>
                    </div>
                </div>

                <!-- Servicio 5 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="service-title">Maquillaje Profesional</h3>
                        <p class="text-center">Maquillaje para eventos especiales, novias y sesiones fotográficas.</p>
                        <div class="service-price">Desde $450 MXN</div>
                    </div>
                </div>

                <!-- Servicio 6 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="service-title">Depilación</h3>
                        <p class="text-center">Técnicas de depilación con cera y otros métodos para una piel suave.</p>
                        <div class="service-price">Desde $200 MXN</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galería Section -->
    <section id="gallery" class="gallery-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Nuestra Galería</h2>
                <p class="section-subtitle">Mira algunos de nuestros trabajos y transformaciones</p>
            </div>

            <div class="gallery-grid">
                <div class="gallery-item" data-aos="zoom-in">
                    <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Corte de cabello">
                    <div class="gallery-overlay">
                        <h5>Cortes Modernos</h5>
                        <p>Transformación completa</p>
                    </div>
                </div>
                <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Coloración">
                    <div class="gallery-overlay">
                        <h5>Coloración Profesional</h5>
                        <p>Técnica balayage</p>
                    </div>
                </div>
                <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1607779097040-4daa1a4010c6?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Maquillaje">
                    <div class="gallery-overlay">
                        <h5>Maquillaje de Novia</h5>
                        <p>Look natural y elegante</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios Section -->
    <section id="testimonials" class="testimonials-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Lo que dicen nuestras clientas</h2>
                <p class="section-subtitle">Testimonios de mujeres que han confiado en nosotros</p>
            </div>

            <div class="row">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="testimonial-card">
                        <p class="testimonial-text">
                            "Yolanda es increíble! Siempre sabe exactamente lo que necesito. Mi cabello nunca había lucido tan bien."
                        </p>
                        <div class="testimonial-author">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                                 alt="Ana Martínez" class="author-avatar">
                            <div>
                                <h6>Ana Martínez</h6>
                                <small>Clienta desde 2020</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card">
                        <p class="testimonial-text">
                            "El mejor salón de la ciudad. La atención es personalizada y los resultados siempre superan mis expectativas."
                        </p>
                        <div class="testimonial-author">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                                 alt="María Rodríguez" class="author-avatar">
                            <div>
                                <h6>María Rodríguez</h6>
                                <small>Clienta habitual</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card">
                        <p class="testimonial-text">
                            "Para mi boda, Yolanda me hizo el peinado y maquillaje perfectos. Todas mis invitadas preguntaron por ella."
                        </p>
                        <div class="testimonial-author">
                            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                                 alt="Laura Sánchez" class="author-avatar">
                            <div>
                                <h6>Laura Sánchez</h6>
                                <small>Novia 2023</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="contact" class="cta-section">
        <div class="container">
            <h2 class="cta-title">¿Lista para tu transformación?</h2>
            <p class="cta-subtitle">
                Agenda tu cita hoy mismo y descubre por qué Salon Studio es el preferido 
                por mujeres que buscan calidad, profesionalismo y resultados excepcionales.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="https://wa.me/5211234567890" class="btn btn-yolanda btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
                <a href="tel:+5211234567890" class="btn btn-outline-yolanda btn-lg">
                    <i class="fas fa-phone-alt me-2"></i>Llamar Ahora
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-logo">Salon<span>Studio</span></div>
                    <p class="mt-3">Especialistas en belleza y bienestar. Transformamos tu look mientras cuidamos de tu salud capilar y piel.</p>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Servicios</h5>
                    <div class="footer-links">
                        <a href="#services">Cortes y Peinados</a>
                        <a href="#services">Coloración</a>
                        <a href="#services">Tratamientos Faciales</a>
                        <a href="#services">Manicure & Pedicure</a>
                        <a href="#services">Maquillaje</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-title">Contacto</h5>
                    <div class="footer-links">
                        <a href="https://maps.google.com" target="_blank">
                            <i class="fas fa-map-marker-alt me-2"></i>Av. Principal #123, Ciudad
                        </a>
                        <a href="tel:+5211234567890">
                            <i class="fas fa-phone-alt me-2"></i>+52 123 456 7890
                        </a>
                        <a href="mailto:contacto@salonstudio.com">
                            <i class="fas fa-envelope me-2"></i>contacto@salonstudio.com
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5 class="footer-title">Horarios</h5>
                    <div class="footer-links">
                        <p>Lunes - Viernes: 9:00 AM - 7:00 PM</p>
                        <p>Sábado: 9:00 AM - 4:00 PM</p>
                        <p>Domingo: Cerrado</p>
                        <p class="mt-3">*Citas con previa reservación</p>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; {{ date('Y') }} Salon Studio - Yolanda Gutierrez. Todos los derechos reservados.</p>
                <p>Desarrollado con Laravel & Bootstrap</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animations -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Inicializar AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
        
        // Smooth Scroll para enlaces internos
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Actualizar nav activo
                    document.querySelectorAll('.nav-link-custom').forEach(link => {
                        link.classList.remove('active');
                    });
                    this.classList.add('active');
                }
            });
        });
        
        // Cambiar nav activo al hacer scroll
        window.addEventListener('scroll', function() {
            let current = '';
            const sections = document.querySelectorAll('section');
            const navHeight = 80;
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if(scrollY >= (sectionTop - navHeight)) {
                    current = section.getAttribute('id');
                }
            });
            
            document.querySelectorAll('.nav-link-custom').forEach(link => {
                link.classList.remove('active');
                if(link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.main-navbar');
            if(window.scrollY > 100) {
                navbar.style.padding = '0.5rem 0';
                navbar.style.boxShadow = '0 2px 20px rgba(139, 115, 85, 0.15)';
            } else {
                navbar.style.padding = '1rem 0';
                navbar.style.boxShadow = '0 2px 20px rgba(139, 115, 85, 0.1)';
            }
        });
    </script>
</body>
</html>
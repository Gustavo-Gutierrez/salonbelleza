<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión | Salon Studio</title>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #d4a574; /* Dorado cálido */
            --secondary-color: #8b7355; /* Café elegante */
            --accent-color: #c19a6b; /* Dorado medio */
            --light-bg: #f9f7f3; /* Beige claro */
            --dark-text: #3a3a3a;
            --light-text: #7a6e5d;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light-bg);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        
        .login-container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            min-height: 700px;
            box-shadow: 0 20px 50px rgba(139, 115, 85, 0.2);
            border-radius: 20px;
            overflow: hidden;
            background: white;
        }
        
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, var(--secondary-color), var(--dark-text));
            color: white;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1560066984-138dadb4c035?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
            opacity: 0.1;
        }
        
        .studio-logo {
            font-family: 'Dancing Script', cursive;
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }
        
        .studio-logo span {
            color: var(--primary-color);
        }
        
        .studio-tagline {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 3rem;
            letter-spacing: 2px;
            position: relative;
            z-index: 1;
        }
        
        .welcome-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }
        
        .welcome-text {
            font-size: 1.1rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }
        
        .features-list {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
            position: relative;
            z-index: 1;
        }
        
        .features-list li {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.9);
        }
        
        .features-list i {
            color: var(--primary-color);
            margin-right: 1rem;
            font-size: 1.2rem;
        }
        
        .login-right {
            flex: 1;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .login-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }
        
        .login-subtitle {
            color: var(--light-text);
            font-size: 1rem;
        }
        
        .form-group {
            margin-bottom: 1.8rem;
        }
        
        .form-label {
            color: var(--dark-text);
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.9rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(212, 165, 116, 0.25);
            outline: none;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--light-text);
            z-index: 3;
        }
        
        .input-with-icon {
            padding-left: 3rem !important;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            border: none;
            border-radius: 10px;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 500;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 165, 116, 0.4);
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.5rem 0;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 0.5rem;
        }
        
        .remember-me label {
            color: var(--light-text);
            cursor: pointer;
        }
        
        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }
        
        .forgot-password:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 2rem 0;
            color: var(--light-text);
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e9ecef;
        }
        
        .divider span {
            padding: 0 1rem;
            font-size: 0.9rem;
        }
        
        .social-login {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .social-btn {
            border: 2px solid #e9ecef;
            background: white;
            border-radius: 10px;
            padding: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--dark-text);
        }
        
        .social-btn:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .social-btn i {
            font-size: 1.2rem;
        }
        
        .register-link {
            text-align: center;
            margin-top: 2rem;
            color: var(--light-text);
        }
        
        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            margin-left: 0.5rem;
            transition: color 0.3s ease;
        }
        
        .register-link a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .input-error {
            border-color: #dc3545 !important;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
                margin: 2rem;
            }
            
            .login-left {
                padding: 3rem;
            }
            
            .login-right {
                padding: 3rem;
            }
        }
        
        @media (max-width: 576px) {
            .login-container {
                margin: 1rem;
            }
            
            .login-left,
            .login-right {
                padding: 2rem;
            }
            
            .social-login {
                grid-template-columns: 1fr;
            }
            
            .studio-logo {
                font-size: 2.8rem;
            }
            
            .welcome-title {
                font-size: 2rem;
            }
        }
        
        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>
<body>
    <div class="login-container animate-fade-in">
        <!-- Left Side - Branding & Info -->
        <div class="login-left">
            <div class="brand-section">
                <div class="studio-logo">Salon<span>Studio</span></div>
                <div class="studio-tagline">YOLANDA GUTIERREZ</div>
            </div>
            
            <h1 class="welcome-title">Bienvenida al Sistema</h1>
            <p class="welcome-text">
                Accede a tu cuenta para gestionar citas, clientes y servicios del salón.
                Tu belleza es nuestra prioridad.
            </p>
            
            <ul class="features-list">
                <li><i class="fas fa-check-circle"></i> Gestiona tus citas fácilmente</li>
                <li><i class="fas fa-check-circle"></i> Controla tu inventario de productos</li>
                <li><i class="fas fa-check-circle"></i> Administra tu agenda de clientes</li>
                <li><i class="fas fa-check-circle"></i> Genera reportes y estadísticas</li>
                <li><i class="fas fa-check-circle"></i> Acceso seguro y protegido</li>
            </ul>
            
            <div class="mt-4">
                <p style="color: rgba(255, 255, 255, 0.8); font-size: 0.9rem;">
                    <i class="fas fa-info-circle"></i> 
                    ¿Problemas para acceder? Contacta al soporte: soporte@yolandastudio.com
                </p>
            </div>
        </div>
        
        <!-- Right Side - Login Form -->
        <div class="login-right">
            <div class="login-header">
                <h1 class="login-title">Iniciar Sesión</h1>
                <p class="login-subtitle">Ingresa tus credenciales para acceder al sistema</p>
            </div>
            
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Error:</strong> Verifica tus credenciales
                    </div>
                @endif
                
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-control input-with-icon @error('email') input-error @enderror" 
                               placeholder="ejemplo@Salonstudio.com"
                               value="{{ old('email') }}"
                               required 
                               autofocus>
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-control input-with-icon @error('password') input-error @enderror" 
                               placeholder="Ingresa tu contraseña"
                               required>
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Recordar sesión</label>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Iniciar Sesión
                </button>
                
                @if(config('services.google.client_id') || config('services.facebook.client_id'))
                    <div class="divider">
                        <span>O continuar con</span>
                    </div>
                    
                    <div class="social-login">
                        @if(config('services.google.client_id'))
                            <button type="button" class="social-btn" onclick="window.location.href='{{ route('social.login', 'google') }}'">
                                <i class="fab fa-google" style="color: #DB4437;"></i>
                            </button>
                        @endif
                        
                        @if(config('services.facebook.client_id'))
                            <button type="button" class="social-btn" onclick="window.location.href='{{ route('social.login', 'facebook') }}'">
                                <i class="fab fa-facebook-f" style="color: #4267B2;"></i>
                            </button>
                        @endif
                        
                        @if(config('services.apple.client_id'))
                            <button type="button" class="social-btn">
                                <i class="fab fa-apple"></i>
                            </button>
                        @endif
                    </div>
                @endif
            </form>
            
            @if (Route::has('register'))
                <div class="register-link">
                    ¿No tienes una cuenta?
                    <a href="{{ route('register') }}">Regístrate aquí</a>
                </div>
            @endif
            
            <div class="mt-4 text-center">
                <a href="{{ url('/') }}" class="forgot-password" style="font-size: 0.9rem;">
                    <i class="fas fa-arrow-left me-2"></i> Volver al sitio principal
                </a>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script>
        // Mostrar/ocultar contraseña
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.createElement('button');
            toggleButton.type = 'button';
            toggleButton.innerHTML = '<i class="fas fa-eye"></i>';
            toggleButton.className = 'btn btn-sm position-absolute';
            toggleButton.style.right = '10px';
            toggleButton.style.top = '50%';
            toggleButton.style.transform = 'translateY(-50%)';
            toggleButton.style.background = 'transparent';
            toggleButton.style.border = 'none';
            toggleButton.style.color = 'var(--light-text)';
            
            const inputGroup = document.querySelector('#password').parentElement;
            inputGroup.style.position = 'relative';
            inputGroup.appendChild(toggleButton);
            
            toggleButton.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
            
            // Efecto de focus en inputs
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('.input-icon').style.color = 'var(--primary-color)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('.input-icon').style.color = 'var(--light-text)';
                });
            });
            
            // Validación en tiempo real
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('input', function() {
                if(this.value.includes('@') && this.value.includes('.')) {
                    this.classList.remove('input-error');
                }
            });
        });
    </script>
</body>
</html>
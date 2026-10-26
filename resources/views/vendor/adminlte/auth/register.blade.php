<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro | Salon Studio</title>

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
        
        .register-container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            min-height: 700px;
            box-shadow: 0 20px 50px rgba(139, 115, 85, 0.2);
            border-radius: 20px;
            overflow: hidden;
            background: white;
        }
        
        .register-left {
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
        
        .register-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');
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
        
        .benefits-list {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
            position: relative;
            z-index: 1;
        }
        
        .benefits-list li {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.9);
        }
        
        .benefits-list i {
            color: var(--primary-color);
            margin-right: 1rem;
            font-size: 1.2rem;
        }
        
        .register-right {
            flex: 1;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
            overflow-y: auto;
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .register-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }
        
        .register-subtitle {
            color: var(--light-text);
            font-size: 1rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
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
        
        .btn-register {
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
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 165, 116, 0.4);
        }
        
        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            margin: 1.5rem 0;
        }
        
        .terms-checkbox input {
            margin-right: 0.5rem;
            margin-top: 0.25rem;
        }
        
        .terms-checkbox label {
            color: var(--light-text);
            font-size: 0.9rem;
            line-height: 1.4;
        }
        
        .terms-checkbox a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .terms-checkbox a:hover {
            text-decoration: underline;
        }
        
        .login-link {
            text-align: center;
            margin-top: 2rem;
            color: var(--light-text);
        }
        
        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            margin-left: 0.5rem;
            transition: color 0.3s ease;
        }
        
        .login-link a:hover {
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
        
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -0.75rem;
        }
        
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 0.75rem;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .register-container {
                flex-direction: column;
                max-width: 500px;
                margin: 2rem;
            }
            
            .register-left {
                padding: 3rem;
            }
            
            .register-right {
                padding: 3rem;
            }
            
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        
        @media (max-width: 576px) {
            .register-container {
                margin: 1rem;
            }
            
            .register-left,
            .register-right {
                padding: 2rem;
            }
            
            .studio-logo {
                font-size: 2.8rem;
            }
            
            .welcome-title {
                font-size: 2rem;
            }
            
            .register-title {
                font-size: 1.8rem;
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
    <div class="register-container animate-fade-in">
        <!-- Left Side - Branding & Info -->
        <div class="register-left">
            <div class="brand-section">
                <div class="studio-logo">Salon<span>Studio</span></div>
                <div class="studio-tagline">YOLANDA GUTIERREZ</div>
            </div>
            
            <h1 class="welcome-title">Únete a Nuestra Comunidad</h1>
            <p class="welcome-text">
                Regístrate para acceder a beneficios exclusivos, gestionar tus citas y recibir 
                promociones especiales del salón.
            </p>
            
            <ul class="benefits-list">
                <li><i class="fas fa-calendar-check"></i> Agenda citas fácilmente</li>
                <li><i class="fas fa-percent"></i> Acceso a promociones exclusivas</li>
                <li><i class="fas fa-history"></i> Historial de servicios</li>
                <li><i class="fas fa-bell"></i> Notificaciones personalizadas</li>
                <li><i class="fas fa-star"></i> Programa de fidelidad</li>
            </ul>
            
            <div class="mt-4">
                <p style="color: rgba(255, 255, 255, 0.8); font-size: 0.9rem;">
                    <i class="fas fa-shield-alt"></i> 
                    Tus datos están protegidos y no serán compartidos con terceros
                </p>
            </div>
        </div>
        
        <!-- Right Side - Register Form -->
        <div class="register-right">
            <div class="register-header">
                <h1 class="register-title">Crear Cuenta</h1>
                <p class="register-subtitle">Completa tus datos para registrarte</p>
            </div>
            
            <form action="{{ route('register') }}" method="POST">
                @csrf
                
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Por favor corrige los siguientes errores:</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre Completo</label>
                            <div class="input-group">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       class="form-control input-with-icon @error('name') input-error @enderror" 
                                       placeholder="Yolanda Gutierrez"
                                       value="{{ old('name') }}"
                                       required 
                                       autofocus>
                            </div>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone" class="form-label">Teléfono</label>
                            <div class="input-group">
                                <i class="fas fa-phone input-icon"></i>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       class="form-control input-with-icon @error('phone') input-error @enderror" 
                                       placeholder="+52 123 456 7890"
                                       value="{{ old('phone') }}"
                                       required>
                            </div>
                            @error('phone')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-control input-with-icon @error('email') input-error @enderror" 
                               placeholder="ejemplo@salonstudio.com"
                               value="{{ old('email') }}"
                               required>
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" 
                                       id="password" 
                                       name="password" 
                                       class="form-control input-with-icon @error('password') input-error @enderror" 
                                       placeholder="Mínimo 8 caracteres"
                                       required>
                            </div>
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <div class="input-group">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       class="form-control input-with-icon" 
                                       placeholder="Repite tu contraseña"
                                       required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="birth_date" class="form-label">Fecha de Nacimiento (Opcional)</label>
                    <div class="input-group">
                        <i class="fas fa-birthday-cake input-icon"></i>
                        <input type="date" 
                               id="birth_date" 
                               name="birth_date" 
                               class="form-control input-with-icon" 
                               value="{{ old('birth_date') }}">
                    </div>
                </div>
                
               
                
                <div class="terms-checkbox">
                    <input type="checkbox" id="newsletter" name="newsletter" checked>
                    <label for="newsletter">
                        Deseo recibir promociones, novedades y consejos de belleza por correo electrónico.
                    </label>
                </div>
                
                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus me-2"></i> Crear Cuenta
                </button>
            </form>
            
            <div class="login-link">
                ¿Ya tienes una cuenta?
                <a href="{{ route('login') }}">Inicia sesión aquí</a>
            </div>
            
            <div class="mt-3 text-center">
                <a href="{{ url('/') }}" class="text-decoration-none" style="color: var(--light-text); font-size: 0.9rem;">
                    <i class="fas fa-arrow-left me-2"></i> Volver al sitio principal
                </a>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar/ocultar contraseñas
            const passwordInputs = document.querySelectorAll('input[type="password"]');
            passwordInputs.forEach(input => {
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
                
                const inputGroup = input.parentElement;
                inputGroup.style.position = 'relative';
                inputGroup.appendChild(toggleButton);
                
                toggleButton.addEventListener('click', function() {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
            });
            
            // Validación de contraseña
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');
            
            function validatePassword() {
                if(password.value !== confirmPassword.value) {
                    confirmPassword.classList.add('input-error');
                    return false;
                } else {
                    confirmPassword.classList.remove('input-error');
                    return true;
                }
            }
            
            password.addEventListener('input', validatePassword);
            confirmPassword.addEventListener('input', validatePassword);
            
            // Validación de email
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('input', function() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if(emailRegex.test(this.value)) {
                    this.classList.remove('input-error');
                }
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
        });
    </script>
</body>
</html>
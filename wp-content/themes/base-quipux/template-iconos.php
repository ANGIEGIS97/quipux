<?php
/**
 * Template Name: Ejemplos de Iconos Quipux
 * Description: Plantilla para mostrar ejemplos de uso de los iconos de Quipux
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <!-- Sección Hero -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <h1 class="main-title"><?php echo get_the_title(); ?></h1>
                        <p class="lead mb-0 text-muted subtitle">Guía de uso de iconos Quipux</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección de Iconos Quipux -->
        <section class="icons-demo-section py-5">
            <div class="container">
                <!-- Introducción -->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">¿Cómo usar los iconos?</h2>
                                <p>Para usar los iconos de Quipux, simplemente agrega las clases correspondientes:</p>
                                <div class="bg-light p-3 rounded">
                                    <code>&lt;i class="icon icon-nombre-del-icono"&gt;&lt;/i&gt;</code>
                                </div>
                                <p class="mt-3">Para iconos de Material Design, usa el prefijo <code>icon-m-</code>:</p>
                                <div class="bg-light p-3 rounded">
                                    <code>&lt;i class="icon icon-m-nombre-del-icono"&gt;&lt;/i&gt;</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Iconos QICONS -->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h3 class="mb-0">Iconos QICONS</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-4">
                                    <div class="icon-demo">
                                        <i class="icon icon-car text-primary"></i>
                                        <span>icon-car</span>
                                    </div>
                                    <div class="icon-demo">
                                        <i class="icon icon-bus text-success"></i>
                                        <span>icon-bus</span>
                                    </div>
                                    <div class="icon-demo">
                                        <i class="icon icon-bicycle text-info"></i>
                                        <span>icon-bicycle</span>
                                    </div>
                                    <div class="icon-demo">
                                        <i class="icon icon-alert text-warning"></i>
                                        <span>icon-alert</span>
                                    </div>
                                    <div class="icon-demo">
                                        <i class="icon icon-calendar text-danger"></i>
                                        <span>icon-calendar</span>
                                    </div>
                                    <div class="icon-demo">
                                        <i class="icon icon-search"></i>
                                        <span>icon-search</span>
                                    </div>
                                    <div class="icon-demo">
                                        <i class="icon icon-agent-transit"></i>
                                        <span>icon-agent-transit</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Iconos Material -->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h3 class="mb-0">Iconos Material</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-4">
                                    <div class="icon-demo">
                                        <i class="icon icon-m-edit text-primary"></i>
                                        <span>icon-m-edit</span>
                                    </div>
                                    <div class="icon-demo">
                                        <i class="icon icon-m-delete text-danger"></i>
                                        <span>icon-m-delete</span>
                                    </div>
                                    <div class="icon-demo">
                                        <i class="icon icon-m-lock text-warning"></i>
                                        <span>icon-m-lock</span>
                                    </div>
                                    <div class="icon-demo">
                                        <i class="icon icon-m-groups text-success"></i>
                                        <span>icon-m-groups</span>
                                    </div>
                                    <div class="icon-demo">
                                        <i class="icon icon-m-description text-info"></i>
                                        <span>icon-m-description</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ejemplos de uso -->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h3 class="mb-0">Ejemplos de Uso</h3>
                            </div>
                            <div class="card-body">
                                <h4 class="mb-4">En Botones</h4>
                                <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                                    <button class="btn btn-primary btn-example">
                                        <i class="icon icon-car me-2"></i>
                                        Reservar Vehículo
                                    </button>
                                    <button class="btn btn-success btn-example">
                                        <i class="icon icon-m-groups me-2"></i>
                                        Gestionar Grupo
                                    </button>
                                    <button class="btn btn-warning btn-example">
                                        <i class="icon icon-alert me-2"></i>
                                        Alertas
                                    </button>
                                    <button class="btn btn-danger btn-example">
                                        <i class="icon icon-m-delete me-2"></i>
                                        Eliminar
                                    </button>
                                </div>

                                <h4 class="mb-4">En Tarjetas</h4>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <i class="icon icon-car-mechanical display-4 text-primary mb-3"></i>
                                                <h5>Mantenimiento</h5>
                                                <p class="text-muted">Gestión de mantenimiento vehicular</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <i class="icon icon-route display-4 text-success mb-3"></i>
                                                <h5>Rutas</h5>
                                                <p class="text-muted">Planificación de rutas</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <i class="icon icon-speed display-4 text-danger mb-3"></i>
                                                <h5>Velocidad</h5>
                                                <p class="text-muted">Control de velocidad</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Estilos adicionales para la demostración de iconos -->
        <style>
            /* Variables CSS para consistencia */
            :root {
                --primary-color: #007bff;
                --primary-hover: #0056b3;
                --text-dark: #2d3436;
                --text-muted: #636e72;
                --bg-light: #f8f9fa;
                --shadow-light: rgba(0,0,0,0.05);
                --shadow-medium: rgba(0,0,0,0.15);
                --border-radius: 0.5rem;
                --transition: all 0.3s ease;
            }

            /* Diseño general */
            .content-area {
                width: 100%;
                max-width: 100%;
                padding: 0;
                margin: 0;
            }

            /* Sección Hero */
            .hero-section {
                background: none;
                margin-bottom: 2rem;
                border-bottom: 1px solid rgba(0,0,0,0.1);
            }

            /* Título principal */
            .main-title {
                font-size: 3rem;
                font-weight: 700;
                color: var(--text-dark);
                line-height: 1.2;
                margin-bottom: 1.5rem;
                position: relative;
                display: inline-block;
            }

            .main-title::after {
                content: '';
                position: absolute;
                bottom: -15px;
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 4px;
                background-color: var(--primary-color);
                border-radius: 2px;
            }

            /* Subtítulo */
            .subtitle {
                font-size: 1.35rem;
                color: var(--text-muted);
                margin-top: 2rem;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
            }
            .icons-demo-section {
                background-color: white;
            }
            .icon-demo {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 0.5rem;
                background-color: white;
                min-width: 120px;
                text-align: center;
                transition: all 0.3s ease;
            }
            .icon-demo:hover {
                transform: translateY(-5px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }
            .icon-demo i {
                font-size: 2rem;
                margin-bottom: 0.5rem;
            }
            .icon-demo span {
                font-size: 0.875rem;
                color: #6c757d;
            }
            .gap-4 {
                gap: 1.5rem !important;
            }
            .gap-3 {
                gap: 1rem !important;
            }
            .me-2 {
                margin-right: 0.5rem !important;
            }
            .btn-example {
                height: 48px;
                display: flex;
                align-items: center;
                justify-content: center;
                white-space: nowrap;
                min-width: 140px;
            }
            .card {
                border: none;
                box-shadow: 0 0 15px rgba(0,0,0,0.05);
                border-radius: 0.5rem;
                overflow: hidden;
            }
            .card-header {
                border-bottom: none;
                padding: 1rem 1.5rem;
            }
            .card-header h3 {
                font-size: 1.25rem;
            }
            .display-4 {
                font-size: 3.5rem;
            }
            /* Diseño Responsivo */
            @media (max-width: 991.98px) {
                .main-title {
                    font-size: 2rem;
                }
                
                .hero-section {
                    padding: 1.5rem 0;
                }
            }

            @media (max-width: 767.98px) {
                .main-title {
                    font-size: 2rem;
                }
                
                .subtitle {
                    font-size: 1.1rem;
                    padding: 0 1rem;
                }
                
                .hero-section {
                    padding: 1rem 0;
                    margin-bottom: 1.5rem;
                }
                
                .icon-demo {
                    min-width: 100px;
                }
            }

            @media (max-width: 575.98px) {
                .main-title {
                    font-size: 2rem;
                }
            }
        </style>
    </main>
</div>

<?php get_footer(); ?> 
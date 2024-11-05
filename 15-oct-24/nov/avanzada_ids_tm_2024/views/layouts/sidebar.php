<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="index.html" class="b-brand text-primary">
                <img src="<?= BASE_PATH ?>assets/images/logo-dark.svg" alt="logo image" class="logo-lg" />
                <span class="badge bg-brand-color-2 rounded-pill ms-2 theme-version">v1.2.0</span>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <!-- Dashboard Section -->
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                    <i class="ph-duotone ph-gauge"></i>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-gauge"></i>
                        </span>
                        <span class="pc-mtext">Dashboard</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="index.html">Analytics</a></li>
                        <li class="pc-item"><a class="pc-link" href="affiliate.html">Affiliate</a></li>
                        <li class="pc-item"><a class="pc-link" href="finance.html">Finance</a></li>
                        <li class="pc-item"><a class="pc-link" href="../admins/helpdesk-dashboard.html">Helpdesk</a></li>
                        <li class="pc-item"><a class="pc-link" href="invoice.html">Invoice</a></li>
                    </ul>
                </li>

                <!-- E-commerce Section (Customized) -->
                <li class="pc-item pc-caption">
                    <label>E-commerce</label>
                    <i class="ph-duotone ph-storefront"></i>
                </li>
                <li class="pc-item">
                    <a href="<?= BASE_PATH ?>productos" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-house"></i>
                        </span>
                        <span class="pc-mtext">Productos</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="<?= BASE_PATH ?>productos/nuevo" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-plus-circle"></i>
                        </span>
                        <span class="pc-mtext">Agregar Producto</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="<?= BASE_PATH ?>productos/editar/" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-pencil-simple"></i>
                        </span>
                        <span class="pc-mtext">Editar Producto</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="<?= BASE_PATH ?>productos/eliminar/" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-trash"></i>
                        </span>
                        <span class="pc-mtext">Eliminar Producto</span>
                    </a>
                </li>

                <!-- Other Sections -->
                <li class="pc-item pc-caption">
                    <label>Application</label>
                    <i class="ph-duotone ph-buildings"></i>
                </li>
                <li class="pc-item">
                    <a href="../application/calendar.html" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-calendar-blank"></i>
                        </span>
                        <span class="pc-mtext">Calendar</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="../application/chat.html" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-chats-circle"></i>
                        </span>
                        <span class="pc-mtext">Chat</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="../application/mail.html" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-envelope-open"></i>
                        </span>
                        <span class="pc-mtext">Mail</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="../pages/contact-us.html" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-target"></i>
                        </span>
                        <span class="pc-mtext">Contact Us</span>
                    </a>
                </li>

                <!-- Help Center -->
                <li class="pc-item pc-caption">
                    <label>Help Center</label>
                    <i class="ph-duotone ph-suitcase"></i>
                </li>
                <div class="card nav-action-card bg-brand-color-4">
                    <div class="card-body" style="background-image: url('<?= BASE_PATH ?>assets/images/layout/nav-card-bg.svg')">
                        <h5 class="text-dark">Help Center</h5>
                        <p class="text-dark text-opacity-75">Please contact us for more questions.</p>
                        <a href="https://phoenixcoded.support-hub.io/" class="btn btn-primary" target="_blank">Go to help Center</a>
                    </div>
                </div>

                <!-- User Account Section -->
                <div class="card pc-user-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="<?= BASE_PATH ?>assets/images/user/avatar-1.jpg" alt="user-image" class="user-avtar wid-45 rounded-circle" />
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="dropdown">
                                    <a href="#" class="arrow-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,20">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 me-2">
                                                <h6 class="mb-0">Jonh Smith</h6>
                                                <small>Administrator</small>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="btn btn-icon btn-link-secondary avtar">
                                                    <i class="ph-duotone ph-windows-logo"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li>
                                                <a class="pc-user-links">
                                                    <i class="ph-duotone ph-user"></i>
                                                    <span>My Account</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="pc-user-links">
                                                    <i class="ph-duotone ph-gear"></i>
                                                    <span>Settings</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="pc-user-links">
                                                    <i class="ph-duotone ph-lock-key"></i>
                                                    <span>Lock Screen</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="pc-user-links">
                                                    <i class="ph-duotone ph-power"></i>
                                                    <span>Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->

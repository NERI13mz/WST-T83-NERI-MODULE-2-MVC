<!--
=========================================================
* Soft UI Dashboard 3 - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    @yield('title')
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Icon action button -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* Typography */
    :root {
        --font-primary: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        --font-size-sm: 0.875rem;
        --font-size-base: 0.95rem;
        --font-size-lg: 1.125rem;
        --font-size-xl: 1.25rem;
    }

    /* Global Font Settings */
    body {
        font-family: var(--font-primary);
        font-size: var(--font-size-base);
        letter-spacing: -0.01em;
    }

    /* Navigation Text */
    .nav-link-text {
        font-size: var(--font-size-sm);
        font-weight: 500;
        letter-spacing: 0;
    }

    /* Sidebar Brand */
    .navbar-brand span {
        font-size: var(--font-size-lg) !important;
        font-weight: 600 !important;
        letter-spacing: -0.02em;
    }

    /* Page Header */
    .page-header {
        font-size: var(--font-size-xl);
        font-weight: 600;
        letter-spacing: -0.03em;
    }

    /* Breadcrumb */
    .breadcrumb-item {
        font-size: var(--font-size-sm);
        font-weight: 500;
    }

    /* Stats and Numbers */
    .stat-label {
        font-size: var(--font-size-sm);
        font-weight: 500;
        letter-spacing: 0.02em;
        text-transform: none;
    }

    .stat-value {
        font-size: var(--font-size-xl);
        font-weight: 600;
        letter-spacing: -0.02em;
    }

    /* User Profile */
    .nav-user-name {
        font-size: var(--font-size-base);
        font-weight: 500;
        letter-spacing: -0.01em;
    }

    /* Responsive Typography */
    @media (max-width: 768px) {
        .page-header {
            font-size: var(--font-size-lg);
        }

        .stat-value {
            font-size: var(--font-size-lg);
        }

        .navbar-brand span {
            font-size: var(--font-size-base) !important;
        }
    }

    :root {
        --navy-blue: #001f3f; /* Navy Blue */
        --gold: #FFD700; /* Gold */
        --gold-dark: #B8860B; /* Darker shade of gold for gradient */
        --light-gray: #f8f9fa; /* Light Gray for contrast */
        --white:rgb(255, 255, 255); /* White */
        --active-blue: #0056b3; /* New active blue color */
        
        /* Update font variables */
        --font-primary: 'Inter', sans-serif;
        --font-size-xs: 0.75rem;
        --font-size-sm: 0.875rem;
        --font-size-base: 1rem;
        --font-size-lg: 1.125rem;
        --font-size-xl: 1.25rem;
    }

    /* Update global font styles */
    body {
        font-family: var(--font-primary) !important;
        font-weight: 400;
        letter-spacing: -0.01em !important;
    }

    /* Update sidebar icon styles */
    .nav-link .icon-shape {
        width: 32px !important;
        height: 32px !important;
        border-radius: 8px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: rgba(255, 255, 255, 0.1) !important;
        margin-right: 12px !important;
    }

    .nav-link .icon-shape i {
        font-size: 14px !important;
        color: var(--white) !important;
    }

    /* Update icon set for a more minimal look */
    .nav-item:nth-child(1) .icon-shape i::before { content: '\f015' !important; } /* Home/Dashboard */
    .nav-item:nth-child(2) .icon-shape i::before { content: '\f044' !important; } /* Enrollment */
    .nav-item:nth-child(3) .icon-shape i::before { content: '\f007' !important; } /* Students */
    .nav-item:nth-child(4) .icon-shape i::before { content: '\f02d' !important; } /* Subjects */
    .nav-item:nth-child(5) .icon-shape i::before { content: '\f080' !important; } /* Grades */
    .nav-item:last-child .icon-shape i::before { content: '\f2f5' !important; } /* Sign Out */

    /* Update navigation text styles */
    .nav-link-text {
        font-size: var(--font-size-sm) !important;
        font-weight: 400 !important;
        letter-spacing: 0.02em !important;
    }

    /* Update header title */
    .sidenav-header .font-weight-bold {
        font-size: var(--font-size-base) !important;
        font-weight: 600 !important;
        letter-spacing: -0.02em !important;
        line-height: 1.4 !important;
    }

    /* Update breadcrumb */
    .breadcrumb-item {
        font-size: var(--font-size-xs) !important;
        font-weight: 500 !important;
        letter-spacing: -0.01em !important;
    }

    /* Update page title */
    .font-weight-bolder.mb-0 {
        font-size: var(--font-size-lg) !important;
        font-weight: 600 !important;
        letter-spacing: -0.02em !important;
    }

    /* Active state refinements */
    .nav-link.active {
        background: linear-gradient(310deg, var(--gold), var(--gold-dark)) !important;
    }

    .nav-link.active .icon-shape {
        background: var(--white) !important;
    }

    .nav-link.active .icon-shape i {
        color: var(--navy-blue) !important;
    }

    /* Hover state refinements */
    .nav-link:hover .icon-shape {
        background: var(--white) !important;
        transition: all 0.2s ease;
    }

    .nav-link:hover .icon-shape i {
        color: var(--navy-blue) !important;
    }

    /* Update navigation text styles */
    .nav-link-text {
        font-size: var(--font-size-sm) !important;
        font-weight: 400 !important;
        letter-spacing: 0.02em !important;
    }

    /* Update header styles */
    .sidenav-header .font-weight-bold {
        font-size: var(--font-size-lg) !important;
        font-weight: 500 !important;
        letter-spacing: 0.02em !important;
    }

    /* Breadcrumb styling */
    .breadcrumb-item {
        font-size: var(--font-size-sm) !important;
        font-weight: 400 !important;
        letter-spacing: 0.01em !important;
    }

    /* Page title styling */
    .font-weight-bolder.mb-0 {
        font-size: var(--font-size-xl) !important;
        font-weight: 500 !important;
        letter-spacing: 0.02em !important;
    }

    /* Card header text */
    .card-header h6 {
        font-size: var(--font-size-base) !important;
        font-weight: 500 !important;
        letter-spacing: 0.01em !important;
    }

    /* Username display */
    .nav-item.pe-2 {
        font-size: var(--font-size-sm) !important;
        font-weight: 400 !important;
        letter-spacing: 0.01em !important;
    }

    /* Make active navigation more distinct */
    .nav-link.active .nav-link-text {
        font-weight: 500 !important;
    }

    /* Hover state text */
    .nav-link:hover .nav-link-text {
        font-weight: 500 !important;
    }

    /* Sidebar background */
    .sidenav {
        background: var(--navy-blue) !important;
        box-shadow: 4px 0 8px rgba(0, 0, 0, 0.2) !important;
        z-index: 1000 !important;
        position: fixed !important;
    }

    .navbar-main {
        background: var(--navy-blue) !important;
        box-shadow: 4px 0 8px rgba(0, 0, 0, 0.2) !important;
    }

    .logout-btn {
        transition: all 0.3s ease;
        border-radius: 0.5rem;
        margin: 0 1rem;
    }

    .logout-btn:hover {
        background: linear-gradient(310deg, var(--gold), var(--navy-blue)) !important;
    }

    .logout-btn:hover .icon {
        background: transparent !important;
    }

    .logout-btn:hover .color-background {
        fill: white !important;
    }

    .logout-btn:hover .nav-link-text {
        color: white !important;
        font-weight: 600;
    }

    .logout-btn .icon {
        transition: all 0.3s ease;
    }

    .logout-btn .nav-link-text {
        transition: all 0.3s ease;
        color: var(--white);
    }

    .logout-btn .color-background {
        fill: var(--white);
        transition: all 0.3s ease;
    }

    .logout-btn .color-background.opacity-6 {
        fill-opacity: 0.6;
    }

    /* New styles for all sidebar items */
    .nav-item .nav-link {
        color: var(--white) !important;
        transition: all 0.3s ease;
    }

    .nav-item .nav-link:hover {
        background: linear-gradient(310deg, var(--gold), var(--navy-blue)) !important;
    }

    .nav-item .nav-link:hover .icon {
        background: transparent !important;
    }

    .nav-item .nav-link:hover .nav-link-text {
        color: var(--white) !important;
        font-weight: 600;
    }

    .nav-item .nav-link:hover .color-background,
    .nav-item .nav-link:hover .color-background.opacity-6 {
        fill: var(--white) !important;
    }

    .nav-item .nav-link .icon {
        transition: all 0.3s ease;
    }

    .nav-item .nav-link .nav-link-text {
        transition: all 0.3s ease;
        color: var(--white);
    }

    .nav-item .nav-link .color-background {
        fill: var(--white);
        transition: all 0.3s ease;
    }

    .nav-item .nav-link .color-background.opacity-6 {
        fill-opacity: 0.6;
        transition: all 0.3s ease;
    }
     .user-name-display {
        display: flex;
        align-items: center;
        color: var(--white);
        padding: 0;
        cursor: default;
        pointer-events: none;
    }
    .sidenav-header {
    padding: 1rem;
    }

    .sidenav-header .navbar-brand {
        width: 100%;
        padding: 0.5rem;
    }

    .sidenav-header .font-weight-bold {
        color: var(--white) !important;
        font-weight: 600;
    }
    /* Standardize icon sizes */
    .icon-shape {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .icon-shape i, 
    .icon-shape svg {
        width: 18px;
        height: 18px;
        font-size: 18px;
    }

    .nav-link .icon-shape {
        width: 48px;
        height: 48px;
    }

    .nav-link .icon-shape i,
    .nav-link .icon-shape svg {
        width: 18px;
        height: 18px;
        font-size: 18px;
    }

    /* Navigation Icon and Placeholder Styling */
    .nav-link {
        padding: 0.8rem 1.2rem !important;
        margin: 0.5rem 1rem;
        border-radius: 0.75rem;
        width: calc(100% - 2rem);
        transition: all 0.3s ease;
    }

    .nav-link .icon-shape {
        width: 35px;
        height: 35px;
        background: var(--white);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .nav-link .icon-shape i,
    .nav-link .icon-shape svg {
        width: 16px;
        height: 16px;
        font-size: 16px;
    }

    .nav-link-text {
        font-size: 0.875rem;
        font-weight: 500;
    }

    /* Active state styling */
    .nav-link.active .icon-shape {
        background: var(--white) !important;
    }

    .nav-link.active .icon-shape i,
    .nav-link.active .icon-shape svg {
        color: var(--navy-blue) !important;
    }

    /* Sidebar Header Styling */
    .sidenav-header {
        padding: 0.5rem 1rem;
    }

    .sidenav-header .navbar-brand {
        width: 100%;
        padding: 0.5rem;
    }

    .sidenav-header .navbar-brand:hover {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 0.5rem;
    }

    /* Add this to your existing styles */
    .page-header-text {
        font-weight: 500 !important;
    }

    /* Table content alignment */
    .table thead th {
        text-align: center !important;
        vertical-align: middle !important;
    }

    .table tbody td {
        text-align: center !important;
        vertical-align: middle !important;
    }

    /* Keep action buttons centered */
    .table td .btn-group,
    .table td .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Keep badges centered and properly spaced */
    .table td .badge {
        margin: 0.25rem;
        display: inline-block;
    }

    /* Exception for specific columns that should remain left-aligned (like descriptions) */
    .table td.text-start,
    .table th.text-start {
        text-align: left !important;
    }

    .avatar {
        border: 2px solid var(--white);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .avatar:hover {
        transform: scale(1.05);
        transition: all 0.3s ease;
    }

    .avatar-sm {
        border: 2px solid var(--white);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* Material Icons base styles */
    .material-icons-round {
        font-size: 20px !important;
        width: 20px !important;
        height: 20px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        vertical-align: middle !important;
    }

    /* Icon container styles */
    .icon-shape .material-icons-round {
        font-size: 16px !important;
        width: 16px !important;
        height: 16px !important;
    }

    /* Prevent icon scaling */
    .btn .material-icons-round,
    .nav-link .material-icons-round {
        transform: none !important;
        transition: none !important;
    }

    /* Nucleo Icons base styles */
    .btn-sm .ni {
        font-size: 0.875rem !important;
        position: relative;
        top: 2px;
    }

    /* Button icon spacing */
    .btn-sm .ni {
        margin-right: 0.5rem;
    }

    /* Prevent icon scaling */
    .btn .ni,
    .nav-link .ni {
        transform: none !important;
        transition: none !important;
    }

    /* Icon alignment in buttons */
    .btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 0.35rem !important;
    }

    /* Profile Icon Styling */
    .avatar-sm {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .avatar-sm:hover {
        transform: scale(1.1);
    }

    .fa-user-circle {
        font-size: 24px !important;
    }

    /* Logout button styling */
    .nav-item form {
        margin: 0;
        padding: 0;
    }

    .nav-item form button.nav-link {
        width: 100%;
        border: none;
        background: none;
        display: flex;
        align-items: center;
        padding: 0.675rem 1rem;
        margin: 0 1rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .nav-item form button.nav-link:hover {
        background: linear-gradient(310deg, var(--gold), var(--navy-blue));
    }

    .nav-item form button.nav-link:hover .icon {
        background: transparent !important;
    }

    .nav-item form button.nav-link:hover .nav-link-text {
        color: var(--white) !important;
        font-weight: 600;
    }

    /* Remove click/tap highlight effect */
    .sidenav .nav-link,
    .sidenav .nav-item {
        -webkit-tap-highlight-color: transparent;
        user-select: none;
        transition: none !important;
    }

    .sidenav .nav-link:active,
    .sidenav .nav-item:active,
    .sidenav .nav-link:focus,
    .sidenav .nav-item:focus {
        background: none !important;
        -webkit-tap-highlight-color: transparent !important;
        outline: none !important;
    }

    /* Preserve hover effect but remove click transition */
    .sidenav .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    /* Consistent icon styling */
    .sidenav .nav-link .icon {
        background: transparent !important;
        transition: all 0.3s ease;
    }

    /* Icon and SVG color transitions */
    .sidenav .nav-link .icon i,
    .sidenav .nav-link .icon svg,
    .sidenav .nav-link .color-background {
        color: var(--white) !important;
        fill: var(--white) !important;
        transition: all 0.3s ease;
    }

    /* Hover and active states */
    .sidenav .nav-link:hover .icon i,
    .sidenav .nav-link:hover .icon svg,
    .sidenav .nav-link.active .icon i,
    .sidenav .nav-link.active .icon svg,
    .sidenav .nav-link:hover .color-background,
    .sidenav .nav-link.active .color-background {
        color: var(--white) !important;
        fill: var(--white) !important;
    }

    /* Background transitions */
    .sidenav .nav-link:hover .icon,
    .sidenav .nav-link.active .icon {
        background: var(--gold) !important;
    }

    /* Remove unwanted transitions */
    .sidenav .nav-link:active,
    .sidenav .nav-item:active {
        background: none !important;
    }

    /* Hover effect */
    .sidenav .nav-link:hover {
        background: linear-gradient(310deg, var(--gold), var(--navy-blue));
    }

    .card {
        background: var(--white) !important;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
    }

    .card-header {
        background: linear-gradient(310deg, var(--navy-blue), var(--gold)) !important;
        color: var(--white) !important;
    }

    /* Toggle Buttons */
    .form-switch .form-check-input {
        background-color: var(--navy-blue) !important;
        border-color: var(--gold) !important;
    }

    .form-switch .form-check-input:checked {
        background-color: var(--gold) !important;
        border-color: var(--navy-blue) !important;
    }

    /* Navigation Active State */
    .nav-link.active {
        background: linear-gradient(310deg, var(--gold), var(--gold-dark)) !important;
        color: var(--navy-blue) !important;
    }

    .nav-link.active .nav-link-text,
    .nav-link.active i {
        color: var(--navy-blue) !important;
    }

    /* Update the icon background for active state */
    .nav-link.active .icon-shape {
        background: var(--white) !important;
    }

    .nav-link.active .icon-shape i,
    .nav-link.active .icon-shape svg {
        color: var(--navy-blue) !important;
    }

    /* Breadcrumb */
    .breadcrumb-item, 
    .breadcrumb-item a {
        color: var(--white) !important;
    }

    .breadcrumb-item.active {
        color: var(--white) !important;
        opacity: 1 !important;
    }

    .breadcrumb-item a.opacity-5 {
        opacity: 0.7 !important;
    }

    /* Profile Dropdown */
    .navbar-nav .nav-link {
        color: var(--navy-blue) !important;
    }

    /* Icons in Sidebar */
    .icon-shape {
        background: rgba(255, 255, 255, 0.1) !important;
        border: none;
    }

    .icon-shape i, .icon-shape svg {
        color: var(--white) !important;
        opacity: 1 !important;
    }

    .color-background {
        fill: var(--white) !important;
    }

    /* Remove any remaining violet references */
    .nav-item .nav-link:not(.active):hover {
        background: linear-gradient(310deg, var(--gold), var(--navy-blue)) !important;
    }

    /* Navigation Container */
    .navbar-main {
        background: var(--navy-blue) !important;
        border-radius: 16px !important;
        margin: 1rem 1.5rem !important;
        box-shadow: 0 4px 12px rgba(0, 31, 63, 0.15);
    }

    /* Breadcrumb Styling */
    .breadcrumb {
        margin: 0;
        padding: 0;
    }

    .breadcrumb-item {
        font-size: 0.85rem;
        font-weight: 500;
        font-family: 'Inter', sans-serif;
    }

    .breadcrumb-link {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-link:hover {
        color: var(--gold);
    }

    .breadcrumb-item.active {
        color: var(--white);
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.6);
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(90deg, var(--gold) 0%, var(--gold-dark) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        font-size: 1.5rem;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        letter-spacing: -0.5px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Ensure text remains visible during load */
    @media screen and (-webkit-min-device-pixel-ratio: 0) {
        .page-header {
            -webkit-text-fill-color: transparent;
        }
    }

    /* Fallback for browsers that don't support gradient text */
    @supports not (background-clip: text) {
        .page-header {
            color: var(--gold);
        }
    }

    /* User Profile Section */
    .avatar-wrapper {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid var(--gold);
    }

    .avatar-wrapper i {
        font-size: 1.25rem;
        color: var(--white);
    }

    .nav-user-name {
        color: var(--white);
        font-size: 0.9rem;
        font-weight: 500;
        font-family: 'Inter', sans-serif;
        margin-left: 0.5rem;
    }

    /* Container Spacing */
    .container-fluid {
        padding: 1rem 1.75rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .navbar-main {
            margin: 0.5rem !important;
        }

        .page-header {
            font-size: 1.25rem;
        }

        .container-fluid {
            padding: 0.75rem 1rem;
        }
    }

    /* Gap Utility */
    .gap-2 {
        gap: 0.75rem;
    }

    /* User Profile Section */
    .gradient-text {
        background: linear-gradient(90deg, var(--gold) 0%, var(--gold-dark) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        font-weight: 600;
    }

    /* Ensure text remains visible during load */
    @media screen and (-webkit-min-device-pixel-ratio: 0) {
        .gradient-text {
            -webkit-text-fill-color: transparent;
        }
    }

    /* Fallback for browsers that don't support gradient text */
    @supports not (background-clip: text) {
        .gradient-text {
            color: var(--gold);
        }
    }

    .nav-user-name {
        font-size: 0.95rem;
        font-family: 'Inter', sans-serif;
        margin-left: 0.5rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .avatar-wrapper {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid var(--gold);
    }

    /* Sidebar Icon Styling */
    .sidenav .nav-link .icon-shape {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--gold);
        margin-right: 1rem;
    }

    .sidenav .nav-link .icon-shape i {
        color: var(--gold) !important;
        font-size: 1.1rem;
    }

    /* Active State */
    .sidenav .nav-link.active .icon-shape {
        background: var(--gold);
    }

    .sidenav .nav-link.active .icon-shape i {
        color: var(--navy-blue) !important;
    }

    /* Hover State */
    .sidenav .nav-link:hover:not(.active) .icon-shape {
        background: rgba(255, 215, 0, 0.1);
    }

    .nav-link-profile {
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
    }

    .nav-link-profile:hover {
        color: var(--gold);
    }

    .nav-link-profile:hover .avatar-wrapper i {
        color: var(--gold);
    }

    .avatar-wrapper {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: var(--navy-blue);
        transition: all 0.3s ease;
    }

    .avatar-wrapper i {
        font-size: 1.5rem;
        color: var(--white);
    }

    .nav-user-name {
        font-weight: 500;
        color: var(--navy-blue);
    }

    .nav-link-profile:hover .nav-user-name {
        color: var(--gold);
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0 text-center" href="{{ route('dashboard') }}">
        <div class="d-flex flex-column align-items-center">
            <span class="font-weight-bold" style="font-size: 1.2rem; color: var(--white) !important;">
                Student Information
            </span>
            <span class="font-weight-bold" style="font-size: 1.2rem; color: var(--white) !important;">
                System
            </span>
        </div>
    </a>
</div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if(Auth::user()->user_type === 'student')
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('student.dashboard') ? 'active bg-gradient-white text-dark' : 'text-dark' }}" 
                       href="{{ route('student.dashboard') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-home text-dark opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('student.studentSubjects') ? 'active bg-gradient-white text-dark' : 'text-dark' }}" 
                       href="{{ route('student.studentSubjects') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-book text-dark opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">My Subjects</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('student.studentGrades') ? 'active bg-gradient-white text-dark' : 'text-dark' }}" 
                       href="{{ route('student.studentGrades') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-chart-bar text-dark opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">My Grades</span>
                    </a>
                </li>
            @endif
            
            @if(Auth::user()->user_type === 'instructor')
            <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard') ? 'active bg-gradient-white text-dark' : 'text-dark' }}" 
                       href="{{ route('dashboard') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-home text-dark opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('enrollment.index') ? 'active' : '' }}" href="{{ route('enrollment.index') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-plus text-dark opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Enrollment</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('students.index') ? 'active bg-gradient-white text-dark' : 'text-dark'}}" href="{{ route('students.index') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>Office</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g id="office" transform="translate(153.000000, 2.000000)">
                                                <path class="color-background opacity-6" d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z"></path>
                                                <path class="color-background" d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Students</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{Request::routeIs('subjects.index') ? 'active bg-gradient-white text-dark' : 'text-dark'}}" href="{{ route('subjects.index') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>credit-card</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(453.000000, 454.000000)">
                                                <path class="color-background opacity-6" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"></path>
                                                <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Subjects</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{Request::routeIs('grades.index') ? 'active bg-gradient-white text-dark' : 'text-dark'}}" href="{{route('grades.index')}}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>box-3d-50</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(603.000000, 0.000000)">
                                                <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z"></path>
                                                <path class="color-background opacity-6" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z"></path>
                                                <path class="color-background opacity-6" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Grades</span>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-sign-out-alt text-dark opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sign Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-2 px-4">
        <!-- Breadcrumb and Page Title -->
        <nav aria-label="breadcrumb" class="d-flex flex-column">
            <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0">
                <li class="breadcrumb-item">
                    <a class="breadcrumb-link" href="javascript:;">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    @yield('Pages')
                </li>
            </ol>
            <h4 class="page-header mb-0">@yield('Pages')</h4>
        </nav>

        <!-- User Profile Section -->
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
            <ul class="navbar-nav align-items-center">
                <li class="nav-item pe-3 d-flex align-items-center">
                    <a href="{{ route('exactProfile') }}" class="nav-link-profile">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-wrapper">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <span class="nav-user-name gradient-text">{{Auth::user()->name}}</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
   @yield('content')
  </main>
  
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#fff",
          data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 15,
              font: {
                size: 14,
                family: "Inter",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false
            },
            ticks: {
              display: false
            },
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

          },
          {
            label: "Websites",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            fill: true,
            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
            maxBarThickness: 6
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Inter",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 20,
              font: {
                size: 11,
                family: "Inter",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Stack scripts -->
  @stack('scripts')
</body>

</html>
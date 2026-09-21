<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\CustomLogin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(CustomLogin::class)
            ->darkMode(false)
            ->brandName('شركة واحة الطاقة')
            ->font('Cairo')
            ->databaseNotifications()
            ->colors([
                'primary' => Color::Amber,
                'secondary' => Color::Teal,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'danger' => Color::Rose,
                'gray' => Color::Slate,
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => '<style>
                    @import url("https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap");

                    * {
                        font-family: "Cairo", sans-serif !important;
                    }

                    /* ═══════════════════ LOGIN PAGE ═══════════════════ */
                    .fi-simple-layout {
                        background: linear-gradient(135deg, #020617 0%, #0f172a 40%, #1e1b4b 70%, #451a03 100%) !important;
                        min-height: 100vh !important;
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                        position: relative;
                        overflow: hidden;
                        margin: 0 !important;
                        padding: 1.5rem !important;
                    }

                    /* Animated gradient orbs */
                    .fi-simple-layout::before {
                        content: "";
                        position: absolute;
                        top: -200px;
                        right: -200px;
                        width: 600px;
                        height: 600px;
                        background: radial-gradient(circle, rgba(245, 158, 11, 0.2) 0%, rgba(245, 158, 11, 0.05) 40%, transparent 70%);
                        border-radius: 50%;
                        pointer-events: none;
                        animation: floatOrb1 12s ease-in-out infinite;
                    }

                    .fi-simple-layout::after {
                        content: "";
                        position: absolute;
                        bottom: -150px;
                        left: -150px;
                        width: 500px;
                        height: 500px;
                        background: radial-gradient(circle, rgba(6, 182, 212, 0.15) 0%, rgba(6, 182, 212, 0.03) 40%, transparent 70%);
                        border-radius: 50%;
                        pointer-events: none;
                        animation: floatOrb2 15s ease-in-out infinite;
                    }

                    @keyframes floatOrb1 {
                        0%, 100% { transform: translate(0, 0) scale(1); }
                        50% { transform: translate(-80px, 60px) scale(1.1); }
                    }

                    @keyframes floatOrb2 {
                        0%, 100% { transform: translate(0, 0) scale(1); }
                        50% { transform: translate(60px, -50px) scale(1.15); }
                    }

                    .fi-simple-main {
                        display: flex !important;
                        flex-direction: column !important;
                        align-items: center !important;
                        justify-content: center !important;
                        width: 100% !important;
                        max-width: 480px !important;
                        margin: auto !important;
                        z-index: 10;
                        position: relative;
                    }

                    .fi-simple-main-ctn {
                        width: 100% !important;
                        max-width: 480px !important;
                        backdrop-filter: blur(20px) saturate(1.3);
                        -webkit-backdrop-filter: blur(20px) saturate(1.3);
                        background: rgba(15, 23, 42, 0.75) !important;
                        border: 1px solid rgba(245, 158, 11, 0.25) !important;
                        box-shadow:
                            0 25px 60px -12px rgba(0, 0, 0, 0.7),
                            0 0 40px rgba(245, 158, 11, 0.12),
                            inset 0 1px 0 rgba(255, 255, 255, 0.06) !important;
                        border-radius: 1.5rem !important;
                        padding: 2.5rem !important;
                        margin: auto !important;
                    }

                    .fi-simple-header {
                        margin-bottom: 1rem;
                    }

                    .fi-simple-header-heading {
                        color: #f59e0b !important;
                        font-weight: 900 !important;
                        font-size: 1.7rem !important;
                        text-shadow: 0 0 30px rgba(245, 158, 11, 0.3);
                    }

                    .fi-simple-header-subheading {
                        color: #94a3b8 !important;
                        font-size: 0.95rem !important;
                        line-height: 1.6 !important;
                    }

                    /* Login form inputs */
                    .fi-simple-layout input[type="email"],
                    .fi-simple-layout input[type="password"],
                    .fi-simple-layout input[type="text"] {
                        background-color: rgba(15, 23, 42, 0.6) !important;
                        color: #f1f5f9 !important;
                        font-size: 1rem !important;
                        border: 1px solid rgba(255, 255, 255, 0.1) !important;
                        border-radius: 0.75rem !important;
                        padding: 0.85rem 1rem !important;
                        transition: all 0.3s ease !important;
                    }

                    .fi-simple-layout input:focus {
                        border-color: rgba(245, 158, 11, 0.5) !important;
                        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15), 0 0 20px rgba(245, 158, 11, 0.1) !important;
                    }

                    .fi-simple-layout label,
                    .fi-simple-layout .fi-fo-field-wrp-label span {
                        color: #e2e8f0 !important;
                        font-weight: 700 !important;
                        font-size: 0.95rem !important;
                    }

                    /* Submit button */
                    .fi-simple-layout .fi-btn-primary,
                    .fi-simple-layout button[type="submit"] {
                        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%) !important;
                        color: #0f172a !important;
                        border: none !important;
                        box-shadow: 0 10px 30px -5px rgba(245, 158, 11, 0.5) !important;
                        border-radius: 0.75rem !important;
                        font-weight: 800 !important;
                        font-size: 1.1rem !important;
                        padding-top: 0.85rem !important;
                        padding-bottom: 0.85rem !important;
                        width: 100% !important;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                        cursor: pointer !important;
                    }

                    .fi-simple-layout .fi-btn-primary *,
                    .fi-simple-layout button[type="submit"] * {
                        color: #0f172a !important;
                        font-weight: 800 !important;
                    }

                    .fi-simple-layout .fi-btn-primary:hover,
                    .fi-simple-layout button[type="submit"]:hover {
                        background: linear-gradient(135deg, #fef08a 0%, #fbbf24 50%, #f59e0b 100%) !important;
                        transform: translateY(-2px) scale(1.01) !important;
                        box-shadow: 0 15px 35px -5px rgba(245, 158, 11, 0.6) !important;
                    }

                    /* ═══════════════════ ADMIN DASHBOARD ═══════════════════ */
                    .fi-sidebar {
                        background-color: #0f172a !important;
                        border-left-color: rgba(245, 158, 11, 0.15) !important;
                    }

                    .fi-sidebar .fi-sidebar-item-label,
                    .fi-sidebar .fi-sidebar-group-label,
                    .fi-sidebar .fi-sidebar-item-icon,
                    .fi-sidebar .fi-logo {
                        color: #f1f5f9 !important;
                    }

                    .fi-sidebar .fi-sidebar-item-active .fi-sidebar-item-label,
                    .fi-sidebar .fi-sidebar-item-active .fi-sidebar-item-icon {
                        color: #f59e0b !important;
                    }

                    .fi-sidebar .fi-sidebar-item-active .fi-sidebar-item-btn {
                        background-color: rgba(245, 158, 11, 0.1) !important;
                    }

                    .fi-sidebar .fi-sidebar-item-btn:hover {
                        background-color: rgba(255, 255, 255, 0.05) !important;
                    }

                    .fi-sidebar .fi-sidebar-item-btn:hover .fi-sidebar-item-label,
                    .fi-sidebar .fi-sidebar-item-btn:hover .fi-sidebar-item-icon {
                        color: #fbbf24 !important;
                    }

                    .fi-sidebar-nav-groups {
                        padding: 0.5rem !important;
                    }

                    .fi-body {
                        background-color: #f8fafc !important;
                    }

                    /* Fix SVG icon sizing globally in admin */
                    .fi-body svg:not(.fi-icon-btn-icon) {
                        max-width: 100%;
                        height: auto;
                    }

                    /* Stat cards proper sizing */
                    .fi-wi-stats-overview-stat {
                        border-radius: 1rem !important;
                        overflow: hidden;
                    }

                    .fi-wi-stats-overview-stat-icon svg {
                        width: 1.5rem !important;
                        height: 1.5rem !important;
                    }

                    /* Chart widgets */
                    .fi-wi-chart {
                        border-radius: 1rem !important;
                    }
                </style>'
            )
            ->navigationGroups([
                'المبيعات والعملاء',
                'المستودعات والمنتجات',
                'المشتريات والموردين',
                'المالية والحسابات',
                'المشاريع والصيانة',
                'الأنظمة والتقارير',
                'إدارة النظام والأمان',
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}

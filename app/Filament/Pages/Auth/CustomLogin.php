<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class CustomLogin extends BaseLogin
{
    public function getHeading(): string | Htmlable
    {
        return 'تسجيل الدخول إلى مركز التحكم';
    }

    public function getSubheading(): string | Htmlable | null
    {
        return 'شركة واحة الطاقة - الأنظمة الشمسية والتجهيزات الهندسية';
    }
}

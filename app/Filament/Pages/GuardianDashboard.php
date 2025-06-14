<?php

namespace App\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class GuardianDashboard extends Page
{
    //shield
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.guardian-dashboard';

    public function getStudentsProperty()
    {
        return Auth::user()->guardian?->students ?? [];
    }
}

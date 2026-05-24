<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Modules\Catalog\app\Filament\Resources\NoResource\Widgets\StatsOverview;

use Modules\Catalog\app\Filament\Resources\ActiveEmployeesResource\Widgets\ActiveEmployees;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
//  use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
// use BezhanSalleh\FilamentLanguageSwitch\FilamentLanguageSwitchPlugin;
use CraftForge\FilamentLanguageSwitcher\FilamentLanguageSwitcherPlugin;

class AdminPanelProvider extends PanelProvider
{
    
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('My Shop')
            ->brandLogo(asset('images/logo.png'))
            ->login()
            ->registration()
           ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => Blade::render('
               
                    <style>
                        .fi-logo {
                            height: 4rem !important;
                            width: auto !important; 
                            transition: transform 0.3s ease; 
                            border-radius: 50px;
                        }
                        .fi-logo:hover {
                            transform: scale(1.05);
                        }
                        .fi-icon-btn-icon {
                            color: #1c60f4 !important; 
                        }
                        .fi-simple-main {
                            border: dashed 3px white; 
                        }
                       
                    </style>
                '),
            )
            
            ->login()
            ->registration()
            ->colors([
                'primary' => '#800000', 
                'gray' => \Filament\Support\Colors\Color::Slate,
            ])
          
            
               ->font('Poppins')
            
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverResources(in: base_path('Modules/Catalog/app/Filament/Resources'), for: 'Modules\\Catalog\\app\\Filament\\Resources')
            ->discoverResources(in: base_path('Modules/Sales/app/Filament/Resources'), for: 'Modules\\Sales\\app\\Filament\\Resources')
            
->plugins([
      SpatieLaravelTranslatablePlugin::make()
        ->defaultLocales(['en', 'ar']), 
            FilamentLanguageSwitcherPlugin::make()
            
                ->locales([
                    ['code' => 'en', 'name' => 'English', 'flag' => 'gb'],
                    ['code' => 'ar', 'name' => 'العربية', 'flag' => 'eg'],
                      ['code' => 'el', 'name' => 'Greek', 'flag' => 'gr'],
                ]),
        ])





            ->pages([
                Pages\Dashboard::class,
                \Modules\Front\app\Filament\Pages\Shop::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            
            ->widgets([
               ActiveEmployees::class,
                StatsOverview::class,
            ])
            ->discoverWidgets(
               in: base_path('Modules/Catalog/app/Filament/Resources/NoneResource/Widgets'), 
               for: 'Modules\\Catalog\\app\\Filament\\Resources\\NoneResource\\Widgets'
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
    

}

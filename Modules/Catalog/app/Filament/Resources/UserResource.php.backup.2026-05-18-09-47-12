<?php

namespace Modules\Catalog\app\Filament\Resources;

use Modules\Catalog\app\Filament\Resources\UserResource\Pages;
use Modules\Catalog\app\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = null;

    protected static ?string $modelLabel = null;

    protected static ?string $pluralModelLabel = null;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            \Filament\Forms\Components\TextInput::make('name')
                ->required(),
            \Filament\Forms\Components\TextInput::make('email')
                ->email()
                ->required(),
            \Filament\Forms\Components\TextInput::make('password')
                ->password() // بيخلي النوع باسورد
                ->revealable() // <--- ده السحر! بيعمل زرار العين عشان تشوفي الكلمة وانتي بتكتبيها
                ->required(fn (string $operation): bool => $operation === 'create') // مطلوب فقط عند الإنشاء
                ->dehydrated(fn ($state) => filled($state)) // ميغيرش الباسورد لو سيبتيه فاضي في التعديل
                ->label(__('filament/admin/user_resource.password')),
            \Filament\Forms\Components\Select::make('role')
                    ->label(__('filament/admin/user_resource.role'))
                ->options([
                    1 => 'Admin',
                    0 => 'Customer',
                ])
                ->required(),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('name')
                    ->label(__('filament/admin/user_resource.name'))->searchable(),
            Tables\Columns\TextColumn::make('email')
                    ->label(__('filament/admin/user_resource.email'))->searchable(),
            Tables\Columns\TextColumn::make('role')
                    ->label(__('filament/admin/user_resource.role'))
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    '1' => 'success', // الأدمن أخضر
                    '0' => 'gray',    // المستخدم عادي
                    default => 'danger',
                }),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make() // سلة المهملات (للمسح الفردي)
                    ->requiresConfirmation()
                    ->modalHeading('حذف المستخدم')
                    ->modalDescription('هل أنتِ متأكدة أنكِ تريدين حذف هذا المستخدم؟ لا يمكن التراجع عن هذا الإجراء.')
                    ->modalSubmitActionLabel('أيوة، امسحي'),
                    Tables\Actions\Action::make('shipped')
                      ->label(__('filament/admin/user_resource.shipped'))
                      ->icon('heroicon-o-truck')
                      ->color('success')
                      ->requiresConfirmation() // عشان يسألك "إنتي متأكدة؟"
                      ->action(function () {
        // هنا بنكتب الكود اللي هيتنفذ (مثلاً نبعت إيميل)
        \Filament\Notifications\Notification::make()
            ->title('تم إرسال الساعة للعميل بنجاح!')
            ->success()
            ->send();
    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            
        ];
    }
    public static function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
{
    return $infolist
        ->schema([
            // قسم المعلومات الأساسية
            \Filament\Infolists\Components\Section::make(__('filament/admin/user_resource.الملفالشخصي'))
                ->description('البيانات الأساسية للمستخدم المسجل في النظام')
                ->icon('heroicon-o-user') // أيقونة شخص
                ->schema([
                    \Filament\Infolists\Components\Grid::make(2) // تقسيم الصفحة لعمودين
                        ->schema([
                            \Filament\Infolists\Components\TextEntry::make('name')
                                ->label('الاسم الكامل')
                                ->weight('bold'), // خط عريض
                            
                            \Filament\Infolists\Components\TextEntry::make('email')
                                ->label('البريد الإلكتروني')
                                ->icon('heroicon-m-envelope')
                                ->copyable(), // زرار نسخ الإيميل بضغطة واحدة
                        ]),
                ]),

            // قسم الصلاحيات والأمان
            \Filament\Infolists\Components\Section::make(__('filament/admin/user_resource.الأمانوالصلاحيات'))
                ->icon('heroicon-o-shield-check')
                ->schema([
                    \Filament\Infolists\Components\Grid::make(3)
                        ->schema([
                            \Filament\Infolists\Components\TextEntry::make('role')
                                ->label('نوع الحساب')
                                ->badge()
                                ->color(fn ($state) => $state == 1 ? 'success' : 'gray')
                                ->formatStateUsing(fn ($state) => $state == 1 ? 'مدير (Admin)' : 'عميل (Customer)'),

                            \Filament\Infolists\Components\TextEntry::make('created_at')
                                ->label('تاريخ الإنضمام')
                                ->dateTime('Y-m-d H:i'),

                            \Filament\Infolists\Components\TextEntry::make('password')
                              ->label('الباسورد المُشفر (Hash)')
                              ->icon('heroicon-m-key')
                              ->copyable() // عشان لو حابة تنسخيه
                              ->color('danger')
                              ->fontFamily('mono'), //
                        ]),
                ])
                ->collapsible(), // إمكانية قفل وفتح القسم ده
        ]);
}
    public static function getNavigationLabel(): string
    {
        return __('filament/admin/user_resource.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament/admin/user_resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/admin/user_resource.plural_model_label');
    }

}

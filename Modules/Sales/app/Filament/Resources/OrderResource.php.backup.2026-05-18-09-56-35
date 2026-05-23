<?php

namespace Modules\Sales\app\Filament\Resources; 

use Modules\Sales\app\Filament\Resources\OrderResource\Pages; 
// امسحي سطر الـ RelationManagers اللي كان هنا
use Modules\Sales\app\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationLabel = null;

    protected static ?string $modelLabel = null;

    protected static ?string $pluralModelLabel = null;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            // القسم الأول: بيانات الأوردر الأساسية
            Forms\Components\Section::make(__('filament/admin/order_resource.order_information'))
                ->schema([
                    Forms\Components\Select::make('user_id')
                    ->label(__('filament/admin/order_resource.user_id'))
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->required(), 

                    Forms\Components\TextInput::make('total_price')
                    ->label(__('filament/admin/order_resource.total_price'))
                        ->numeric()
                        ->prefix('EGP')
                        ->required(),

                    Forms\Components\Select::make('status')
                    ->label(__('filament/admin/order_resource.status'))
                        ->options([
                            'pending' => 'Pending',
                            'processing' => 'Processing',
                            'completed' => 'Completed',
                            'cancelled' => 'Cancelled',
                        ])
                        ->default('pending')
                        ->required(),
                ])->columns(3), // يخلي التلاتة دول جنب بعض في سطر واحد

            // القسم الثاني: المنتجات اللي جوه الأوردر (الـ Repeater)
            Forms\Components\Section::make(__('filament/admin/order_resource.order_items'))
                ->schema([
                    Forms\Components\Repeater::make('items')
                    ->label(__('filament/admin/order_resource.items')) 
                        ->relationship('items') // اسم الميثود في موديل Order
                        ->schema([
                            Forms\Components\Select::make('product_id')
                    ->label(__('filament/admin/order_resource.product_id'))
                                ->relationship('product', 'name')
                                ->required(),
                            Forms\Components\TextInput::make('quantity')
                    ->label(__('filament/admin/order_resource.quantity'))
                                ->numeric()
                                ->default(1)
                                ->required(),
                            Forms\Components\TextInput::make('price')
                    ->label(__('filament/admin/order_resource.price'))
                                ->numeric()
                                ->prefix('EGP')
                                ->required(),
                        ])
                        ->columns(3) 
                        ->grid(1) // يخلي كل منتج تحت التاني بشكل منظم
                        ->label('Products in this order'),
                ])
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
    // رقم الأوردر - خليته قابل للترتيب
    Tables\Columns\TextColumn::make('id')
        ->label(__('filament/admin/order_resource.id'))
        ->sortable(),

    // اسم العميل من علاقة الـ User
    Tables\Columns\TextColumn::make('user.name')
        ->label(__('filament/admin/order_resource.user.name'))
        ->searchable() // تقدري تبحثي باسم أي يوزر من الـ 10 اللي كريتناهم
        ->sortable(),

    // السعر الإجمالي بتنسيق العملة المصرية
    Tables\Columns\TextColumn::make('total_price')
        ->label(__('filament/admin/order_resource.total_price'))
        ->money('EGP')
        ->sortable(),

    // حالة الأوردر بشكل ملون (Badge)
    Tables\Columns\TextColumn::make('status')
        ->label(__('filament/admin/order_resource.status'))
        ->badge()
        ->color(fn (string $state): string => match ($state) {
            'pending' => 'warning',   // أصفر
            'processing' => 'info',    // أزرق
            'completed' => 'success',  // أخضر
            'cancelled' => 'danger',   // أحمر
            default => 'gray',
        })
        ->searchable(),

    // تاريخ إنشاء الأوردر بتنسيق وقت وتاريخ
    Tables\Columns\TextColumn::make('created_at')
        ->label(__('filament/admin/order_resource.created_at'))
        ->dateTime('d M Y, h:i A') // هيظهر مثلاً: 15 Apr 2026, 12:40 PM
        ->sortable()
        ->toggleable(isToggledHiddenByDefault: true), // ميزة تخلي العمود ده يختفي ويظهر حسب الرغبة
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
    public static function getNavigationLabel(): string
    {
        return __('filament/admin/order_resource.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament/admin/order_resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/admin/order_resource.plural_model_label');
    }

}
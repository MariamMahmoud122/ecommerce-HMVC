<?php

namespace Modules\Catalog\app\Filament\Resources;

use Modules\Catalog\app\Filament\Resources\ProductResource\Pages;
use Modules\Catalog\app\Models\Product; 
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

  
    protected static ?string $navigationLabel = 'Products';
    protected static ?string $modelLabel = 'Product';
    protected static ?string $pluralModelLabel = 'Products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament/admin/product_resource.product_information'))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('filament/admin/product_resource.name'))
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                                $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(Product::class, 'slug', ignoreRecord: true),

                        Forms\Components\Select::make('category_id')
                            ->label(__('filament/admin/product_resource.category_id'))
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\RichEditor::make('description')
                            ->label(__('filament/admin/product_resource.description'))
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make(__('filament/admin/product_resource.price&_inventory'))
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->prefix('EGP')
                            ->required(),
                        
                        Forms\Components\TextInput::make('stock')
                            ->numeric()
                            ->label(__('filament/admin/product_resource.stock'))
                            ->default(0),

                        Forms\Components\Toggle::make('is_visible')
                            ->label(__('filament/admin/product_resource.is_visible'))
                            ->default(true),
                    ])->columns(3),

                Forms\Components\Section::make(__('filament/admin/product_resource.product_image'))
    ->schema([
     Forms\Components\FileUpload::make('image')
    ->label(__('filament/admin/product_resource.image'))
    ->disk('public')
    ->directory('products')
    ->visibility('public')
    ->preserveFilenames() // عشان يحفظ الاسم زي ما هو وميحتارش
    ->afterStateUpdated(fn ($state) => $state === null) // تنظيف الحالة لو اتمسحت
    ->dehydrated(fn ($state) => filled($state))
    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
    ->rules(['required','mimes:jpg,jpeg,jfif,png,webp','max:2048'])
    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('filament/admin/product_resource.image'))
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament/admin/product_resource.name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('filament/admin/product_resource.category.name'))
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('price')
                    ->label(__('filament/admin/product_resource.price'))
                    ->money('EGP')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label(__('filament/admin/product_resource.stock'))
                    ->numeric()
                    ->color(fn (int $state): string => $state <= 5 ? 'danger' : 'success')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label(__('filament/admin/product_resource.is_visible'))
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label(__('filament/admin/product_resource.category'))
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
    public static function getNavigationLabel(): string
    {
        return __('filament/admin/product_resource.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament/admin/product_resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/admin/product_resource.plural_model_label');
    }

}
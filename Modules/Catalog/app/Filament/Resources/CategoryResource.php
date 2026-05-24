<?php

namespace Modules\Catalog\app\Filament\Resources;

use Modules\Catalog\app\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class CategoryResource extends Resource
{
    // ❌ شيلنا الـ use Translatable من هنا لتفادي مشكلة الـ Absolute URI الغلسة

    protected static ?string $model = Category::class;
    protected static ?string $slug = 'catalog/categories';
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    // 🚀 البديل السحري والآمن للترجمة جوه موديولات الـ HMVC
    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en', 'el'];
    }


public static function getDefaultTranslatableLocale(): string
{
    return 'ar'; // أو 'en' حسب اللغة الأساسية للوحتك
}
    
    protected static ?string $category_information = null;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('filament/admin/category_resource.category_information'))
                    ->description('Manage your clothing categories (Women, Men, Kids)')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('filament/admin/category_resource.name'))
                            ->required()
                            ->placeholder('e.g. Women Wear')
                            ->maxLength(255),

                        FileUpload::make('image')
                            ->label(__('filament/admin/category_resource.image'))
                            ->image()
                            ->directory('categories'),

                        Textarea::make('description')
                            ->label(__('filament/admin/category_resource.description'))
                            ->placeholder('Describe this category...')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label(__('filament/admin/category_resource.image'))
                    ->circular(),
                
                TextColumn::make('name')
                    ->label(__('filament/admin/category_resource.name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('filament/admin/category_resource.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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

    // 🚀 كتابة الـ Namespaces كاملة ومباشرة لصفحات الـ Module عشان نمنع الـ الـ Uri Conflict تماماً
    public static function getPages(): array
    {
        return [
            'index' => \Modules\Catalog\app\Filament\Resources\CategoryResource\Pages\ListCategories::route('/'),
            'create' => \Modules\Catalog\app\Filament\Resources\CategoryResource\Pages\CreateCategory::route('/create'),
            'edit' => \Modules\Catalog\app\Filament\Resources\CategoryResource\Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('filament/admin/category_resource.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament/admin/category_resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament/admin/category_resource.plural_model_label');
    }
}
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HolidayPackagesResource\Pages;
use App\Filament\Resources\HolidayPackagesResource\RelationManagers;
use App\Models\HolidayPackages;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HolidayPackagesResource extends Resource
{
    protected static ?string $model = HolidayPackages::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('price')->numeric()->required(),
                Textarea::make('desc')->required(),
                FileUpload::make('image')->required(),
                TextInput::make('unit')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->limit(10),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('category.name')->label('Category')->sortable(),
                TextColumn::make('price')->sortable(),
                TextColumn::make('unit'),
                ImageColumn::make('image'),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name') 
                    ->label('Filter by Category'),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
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
            'index' => Pages\ListHolidayPackages::route('/'),
            'create' => Pages\CreateHolidayPackages::route('/create'),
            'edit' => Pages\EditHolidayPackages::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RulesResource\Pages;
use App\Filament\Resources\RulesResource\RelationManagers;
use App\Models\Rules;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Contracts\HasTable;
class RulesResource extends Resource
{
    protected static ?string $model = Rules::class;
    protected static ?string $modelLabel = 'Kebijakan Aduan';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Kebijakan Aduan';
    protected static ?string $navigationGroup = 'Form Aduan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                ->label('Deskripsi Kebijakan')
                ->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('')->state(
                    static function (HasTable $livewire, $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                )->label('No')
                ->width(1)
                ->alignStart(),
                Tables\Columns\TextColumn::make('description')
                ->label('Deskripsi Kebijakan')
                ->columnSpanFull()
                ->alignStart()
                ->limit(70)
            ])
            ->filters([
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
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
            'index' => Pages\ListRules::route('/'),
        ];
    }
}

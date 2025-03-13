<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Operation;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\OperationResource;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\OperationResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OperationResource\RelationManagers;

class OperationResource extends Resource
{
    protected static ?string $pluralModelLabel = 'Shipment';
    protected static ?string $model = Operation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('TB')->label('Tug Boat'),
                        TextInput::make('BG')->label('Barge'),
                        TextInput::make('VOY')->label('Voyage'),
                        TextInput::make('BARGES_OWNERS_OPERATOR')->label('Barges Owners Operator'),
                        TextInput::make('SHIPPER')->label('Shipper'),
                        TextInput::make('COMODITIES')->label('Commodities'),
                        TextInput::make('CONTACT_MASTER_CAPTAIN')->label('Contact Master Captain'),
                        TextInput::make('LAYCAN')->label('Laycan'),
                    ])->columns(2),

                Card::make()
                    ->schema([
                        TextInput::make('POL')->label('Port of Loading'),
                        TextInput::make('AGENT_POL')->label('Agent POL'),
                        TextInput::make('PIC_POL')->label('PIC POL'),
                        TextInput::make('CONTACT_AGENT_POL')->label('Contact Agent POL'),
                        DateTimePicker::make('ETA_POL')->label('ETA POL'),
                        DateTimePicker::make('TA_POL')->label('TA POL'),
                        DateTimePicker::make('TB_POL')->label('TB POL'),
                        DateTimePicker::make('SL')->label('Start Loading'),
                        DateTimePicker::make('CL')->label('Completed Loading'),
                        DateTimePicker::make('CO_POL')->label('Cast Off POL'),
                        DateTimePicker::make('TD_POL')->label('TD POL'),
                        TextInput::make('DS_POL')->label('Draft Survey POL')->numeric(),
                    ])->columns(2),

                Card::make()
                    ->schema([
                        TextInput::make('POD')->label('Port of Discharge'),
                        TextInput::make('AGENT_POD')->label('Agent POD'),
                        TextInput::make('PIC_POD')->label('PIC POD'),
                        TextInput::make('CONTACT_AGENT_POD')->label('Contact Agent POD'),
                        DateTimePicker::make('ETA_POD')->label('ETA POD'),
                        DateTimePicker::make('TA_POD')->label('TA POD'),
                        DateTimePicker::make('TB_POD')->label('TB POD'),
                        DateTimePicker::make('SD')->label('Start Discharging'),
                        DateTimePicker::make('CD')->label('Completed Discharging'),
                        DateTimePicker::make('CO_POD')->label('Cast Off POD'),
                        DateTimePicker::make('TD_POD')->label('TD POD'),
                        TextInput::make('DS_POD')->label('Draft Survey POD')->numeric(),
                    ])->columns(2),

                Card::make()
                    ->schema([
                        Textarea::make('POSITION')->label('Position'),
                        Textarea::make('REMARKS_STATUS')->label('Remarks Status')
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('ID')->label('ID')->numeric()->sortable()->searchable(),
        TextColumn::make('TB')->label('Tug Boat')->sortable()->searchable(),
        TextColumn::make('BG')->label('Barge')->sortable()->searchable(),
        TextColumn::make('POSITION')->label('Position')->sortable()->searchable()->extraAttributes([
            'style' => 'max-width:260px'
        ])
        ->wrap(),
        TextColumn::make('REMARKS_STATUS')->label('Remarks Status')->sortable()->searchable()->extraAttributes([
            'style' => 'max-width:260px'
        ])
        ->wrap(),
        TextColumn::make('updated_at')->label('Last Update')->sortable()->searchable(),
        ])->defaultSort('ID', 'desc')
        ->filters([
            // Define any filters if necessary
        ])
        ->actions([
            ActionGroup::make([
            Tables\Actions\EditAction::make(),
            Tables\Actions\ViewAction::make(),
            Tables\Actions\DeleteAction::make(),
            ])
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListOperations::route('/'),
            'create' => Pages\CreateOperation::route('/create'),
            'edit' => Pages\EditOperation::route('/{record}/edit'),
        ];
    }
}

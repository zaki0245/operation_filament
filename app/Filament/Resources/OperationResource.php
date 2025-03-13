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
use Filament\Infolists;
use Filament\Infolists\Infolist;

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
                        DateTimePicker::make('ETA_POL')->label('ETA POL')->withoutSeconds(),
                        DateTimePicker::make('TA_POL')->label('TA POL')->withoutSeconds(),
                        DateTimePicker::make('TB_POL')->label('TB POL')->withoutSeconds(),
                        DateTimePicker::make('SL')->label('Start Loading')->withoutSeconds(),
                        DateTimePicker::make('CL')->label('Completed Loading')->withoutSeconds(),
                        DateTimePicker::make('CO_POL')->label('Cast Off POL')->withoutSeconds(),
                        DateTimePicker::make('TD_POL')->label('TD POL')->withoutSeconds(),
                        TextInput::make('DS_POL')->label('Draft Survey POL')->numeric(),
                    ]),

                Card::make()
                    ->schema([
                        TextInput::make('POD')->label('Port of Discharge'),
                        TextInput::make('AGENT_POD')->label('Agent POD'),
                        TextInput::make('PIC_POD')->label('PIC POD'),
                        TextInput::make('CONTACT_AGENT_POD')->label('Contact Agent POD'),
                        DateTimePicker::make('ETA_POD')->label('ETA POD')->withoutSeconds(),
                        DateTimePicker::make('TA_POD')->label('TA POD')->withoutSeconds(),
                        DateTimePicker::make('TB_POD')->label('TB POD')->withoutSeconds(),
                        DateTimePicker::make('SD')->label('Start Discharging')->withoutSeconds(),
                        DateTimePicker::make('CD')->label('Completed Discharging')->withoutSeconds(),
                        DateTimePicker::make('CO_POD')->label('Cast Off POD')->withoutSeconds(),
                        DateTimePicker::make('TD_POD')->label('TD POD')->withoutSeconds(),
                        TextInput::make('DS_POD')->label('Draft Survey POD')->numeric(),
                    ]),

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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('NOMINATION')
                    ->schema([
                        TextEntry::make('TB')->label('Tug Boat')->prefix(': '),
                        TextEntry::make('BG')->label('Barge')->prefix(': '),
                        TextEntry::make('VOY')->label('Voyage')->prefix(': '),
                        TextEntry::make('BARGES_OWNERS_OPERATOR')->label('Barges Owners/Operator')->prefix(': '),
                        TextEntry::make('SHIPPER')->label('Shipper')->prefix(': '),
                        TextEntry::make('COMODITIES')->label('Commodities')->prefix(': '),
                        TextEntry::make('CONTACT_MASTER_CAPTAIN')->label('Contact Master Captain')->prefix(': '),
                        TextEntry::make('LAYCAN')->label('Laycan')->prefix(': '),
                    ])->columns(2),

                Section::make('POL')
                    ->schema([
                        TextEntry::make('POL')->label('Port of Loading')->prefix(': '),
                        TextEntry::make('AGENT_POL')->label('Agent POL')->prefix(': '),
                        TextEntry::make('PIC_POL')->label('PIC POL')->prefix(': '),
                        TextEntry::make('CONTACT_AGENT_POL')->label('Contact Agent POL')->prefix(': '),
                        TextEntry::make('ETA_POL')->label('ETA POL')->prefix(': '),
                        TextEntry::make('TA_POL')->label('TA POL')->prefix(': '),
                        TextEntry::make('TB_POL')->label('TB POL')->prefix(': '),
                        TextEntry::make('SL')->label('Start Loading')->prefix(': '),
                        TextEntry::make('CL')->label('Completed Loading')->prefix(': '),
                        TextEntry::make('CO_POL')->label('Cast Off POL')->prefix(': '),
                        TextEntry::make('TD_POL')->label('TD POL')->prefix(': '),
                        TextEntry::make('DS_POL')->label('Draft Survey POL')->prefix(': '),
                    ]),

                Section::make('POD')
                    ->schema([
                        TextEntry::make('POD')->label('Port of Discharge')->prefix(': '),
                        TextEntry::make('AGENT_POD')->label('Agent POD')->prefix(': '),
                        TextEntry::make('PIC_POD')->label('PIC POD')->prefix(': '),
                        TextEntry::make('CONTACT_AGENT_POD')->label('Contact Agent POD')->prefix(': '),
                        TextEntry::make('ETA_POD')->label('ETA POD')->prefix(': '),
                        TextEntry::make('TA_POD')->label('TA POD')->prefix(': '),
                        TextEntry::make('TB_POD')->label('TB POD')->prefix(': '),
                        TextEntry::make('SD')->label('Start Discharging')->prefix(': '),
                        TextEntry::make('CD')->label('Completed Discharging')->prefix(': '),
                        TextEntry::make('CO_POD')->label('Cast Off POD')->prefix(': '),
                        TextEntry::make('TD_POD')->label('TD POD')->prefix(': '),
                        TextEntry::make('DS_POD')->label('Draft Survey POD')->prefix(': '),
                    ]),

                Section::make('ESTIMATED')
                    ->schema([
                        TextEntry::make('LAYTIME_POL')->label('Laytime POL')->prefix(': '),
                        TextEntry::make('LAYTIME_POD')->label('Laytime POD')->prefix(': '),
                        TextEntry::make('TOTAL_LAYTIME')->label('Total Laytime')->prefix(': '),
                        TextEntry::make('LAYTIME_ALLOWED')->label('Laytime Allowed')->prefix(': '),
                        TextEntry::make('DEMURRAGE_DESPATCH')->label('Demurrage/Despatch')->prefix(': '),
                    ])->columns(2),

                Section::make('POSITION & STATUS')
                    ->schema([
                        TextEntry::make('POSITION')->label('Position')->prefix(': '),
                        TextEntry::make('REMARKS_STATUS')->label('Remarks Status')->prefix(': '),
                    ])->columns(2),
            ]);
    }

}

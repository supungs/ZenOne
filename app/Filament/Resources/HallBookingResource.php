<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HallBookingResource\Pages;
use App\Filament\Resources\HallBookingResource\RelationManagers;
use App\Models\HallBooking;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Grid;
use App\Rules\HallFree;
use Carbon\Carbon;

class HallBookingResource extends Resource
{
    protected static ?string $model = HallBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make(2)->schema([
                        Select::make('hall_id')->relationship('hall', 'name')->required(),
                        DatePicker::make('date')->minDate(now())->required(),
                    ]),
                    Grid::make(2)->schema([
                        TimePicker::make('from')->minutesStep(15)->withoutSeconds()->required()->rules([new HallFree()]),
                        TimePicker::make('to')->minutesStep(15)->withoutSeconds()->after('from')->required()->rules([new HallFree()]),
                    ]),
                    TextInput::make('description')->required(),
                    
                    Grid::make(2)->schema([
                        Select::make('type')
                            ->options([
                                'lecture' => 'Lecture',
                                'tutorial' => 'Tutorial',
                                'exam' => 'Exam',
                                'event' => 'Event',
                                'other' => 'Other',
                            ])->required(),
                        Select::make('module_id')
                            ->relationship('module', 'name')
                            ->searchable()
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->code} - {$record->name}"),
                            ]),
                    Grid::make(2)->schema([
                        Select::make('batch')->options(range(date("Y")-5, date("Y"))),
                    ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hall.name')->sortable()->searchable(),
                BadgeColumn::make('type')
                ->enum([
                    'lecture' => 'Lecture',
                    'tutorial' => 'Tutorial',
                    'exam' => 'Exam',
                    'event' => 'Event',
                    'other' => 'Other'
                ]),
                TextColumn::make('date')->sortable()->searchable(),
                TextColumn::make('from'),
                TextColumn::make('to'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListHallBookings::route('/'),
            'create' => Pages\CreateHallBooking::route('/create'),
            'edit' => Pages\EditHallBooking::route('/{record}/edit'),
        ];
    }    
}

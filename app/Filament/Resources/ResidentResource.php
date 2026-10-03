<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResidentResource\Pages;
use App\Filament\Resources\ResidentResource\RelationManagers;
use App\Models\Resident;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResidentResource extends Resource
{
    protected static ?string $model = Resident::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Data Warga';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('NIK')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('Nomor Kartu Keluarga')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('Nama Lengkap')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('Tempat Lahir')
                    ->maxLength(191),
                Forms\Components\DatePicker::make('tanggal Lahir'),
                Forms\Components\TextInput::make('Jenis Kelamin'),
                Forms\Components\TextInput::make('Golongan Darah'),
                Forms\Components\TextInput::make('Agama'),
                Forms\Components\TextInput::make('Status Pernikahan'),
                Forms\Components\TextInput::make('Pendidikan Terakhir'),
                Forms\Components\TextInput::make('pekerjaan')
                    ->maxLength(191),
                Forms\Components\TextInput::make('Kewarganegaraan')
                    ->required(),
                Forms\Components\Textarea::make('Alamat')
                    ->columnSpanFull(),
                Forms\Components\Select::make('padukuhan_id')
                    ->relationship('Dusun', 'name'),
                Forms\Components\Select::make('rt_id')
                    ->relationship('RT', 'id'),
                Forms\Components\Select::make('rw_id')
                    ->relationship('RW', 'id'),
                Forms\Components\Select::make('family_id')
                    ->relationship('Keluarga', 'id'),
                /*Forms\Components\TextInput::make('photo_path')
                    ->maxLength(191),
                */
                Forms\Components\FileUpload::make('photo_path')
                            ->image()
                            ->directory('officials'),
                Forms\Components\Textarea::make('NIK Ayah')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('NIK Ibu')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('Kepala Keluarga?')
                    ->required(),
                Forms\Components\TextInput::make('Jenis disabilitas')
                    ->maxLength(191),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\DatePicker::make('Tanggal Pindah'),
                Forms\Components\DatePicker::make('Tanggal Meninggal'),
                Forms\Components\Textarea::make('Keterangan')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('birth_place')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('blood_type'),
                Tables\Columns\TextColumn::make('religion'),
                Tables\Columns\TextColumn::make('marital_status'),
                Tables\Columns\TextColumn::make('education_level'),
                Tables\Columns\TextColumn::make('occupation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('citizenship'),
                Tables\Columns\TextColumn::make('padukuhan.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rt.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rw.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('family.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('photo_path')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_head_of_family')
                    ->boolean(),
                Tables\Columns\TextColumn::make('disability_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('moved_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('death_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListResidents::route('/'),
            'create' => Pages\CreateResident::route('/create'),
            'edit' => Pages\EditResident::route('/{record}/edit'),
        ];
    }
}

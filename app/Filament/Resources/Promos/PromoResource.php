<?php

namespace App\Filament\Resources\Promos;

use App\Filament\Resources\Promos\Pages\ManagePromos;
use App\Models\Promo;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class PromoResource extends Resource
{
    protected static ?string $model = Promo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    protected static ?string $navigationLabel = 'Promo';

    protected static ?string $modelLabel = 'Promo';

    protected static ?string $pluralModelLabel = 'Promo';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Judul promo')
                ->required()
                ->maxLength(120),

            TextInput::make('badge')
                ->label('Label singkat')
                ->maxLength(40)
                ->helperText('Contoh: Diskon 20%, Beli 2 gratis 1.'),

            Textarea::make('description')
                ->label('Keterangan')
                ->rows(3)
                ->maxLength(300),

            Select::make('product_id')
                ->label('Menu terkait (opsional)')
                ->relationship('product', 'name')
                ->searchable()
                ->preload()
                ->helperText('Kalau diisi, promo di beranda akan membuka halaman menu ini.'),

            DatePicker::make('starts_on')
                ->label('Mulai')
                ->helperText('Kosongkan kalau langsung berlaku.'),

            DatePicker::make('ends_on')
                ->label('Berakhir')
                ->afterOrEqual('starts_on')
                ->helperText('Kosongkan kalau tanpa batas waktu.'),

            Toggle::make('is_active')
                ->label('Tampilkan di beranda')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Judul')->searchable(),
                TextColumn::make('badge')->label('Label')->placeholder('-'),
                TextColumn::make('starts_on')->label('Mulai')->date('d M Y')->placeholder('-'),
                TextColumn::make('ends_on')->label('Berakhir')->date('d M Y')->placeholder('Tanpa batas'),
                ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePromos::route('/'),
        ];
    }
}

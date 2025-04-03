<?php

namespace App\Filament\Resources\AdsResource\Pages;

use App\Filament\Resources\AdsResource;
use Filament\Resources\Pages\EditRecord;
use App\Models\Ads;

class EditAds extends EditRecord
{
    protected static string $resource = AdsResource::class;

    public function mount($record = null): void
    {
        $record ??= Ads::query()->first()?->id;

        if (!$record) {
            abort(404, 'No Ads record found.');
        }

        parent::mount($record);
    }
}

<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class ListPages extends ListRecords
{
    use HasPreviewModal;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getPreviewModalView(): ?string
    {
        return 'page.show';
    }

    protected function getPreviewModalDataRecordKey(): ?string
    {
        return 'page';
    }
}

<?php

namespace App\Filament\Resources\Pages\Pages;

use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

trait HasPagePreview
{
    use HasPreviewModal;

    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make()->label(__('Preview page')),
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

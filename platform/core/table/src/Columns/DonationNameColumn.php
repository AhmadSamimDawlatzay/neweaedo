<?php
namespace Botble\Table\Columns;


class DonationNameColumn extends LinkableColumn
{
    public static function make(array|string $data = [], string $name = ''): static
    {
        return parent::make($data ?: 'donation.name', $name)
            ->title(__('name'))
            ->alignStart();
    }
}

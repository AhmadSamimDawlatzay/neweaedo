<?php
namespace Botble\Table\Columns;
use BackedEnum;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Supports\Enum;
use Botble\Table\Contracts\FormattedColumn as FormattedColumnContract;

class ActiveInactiveStatusColumn extends FormattedColumn implements FormattedColumnContract
{
    public static function make(array|string $data = [], string $name = ''): static
    {
        return parent::make($data ?: 'status', $name)
            ->title(trans('core/base::tables.status'))
            ->alignCenter()
            ->width(100)
            ->renderUsing(function (ActiveInactiveStatusColumn $column, $value) {
                return $column->formattedValue($value);
            });
    }

    public function formattedValue($value): string
    {
    // Assuming 'active', 'inactive', 'pending', 'approved', and 'rejected' statuses are represented as strings
    if (!is_string($value)) {
        return '';
    }

    // Return 'Active' status as a success badge, 'Inactive' status as a danger badge,
    // 'Pending' status as a warning badge, 'Approved' status as a success badge,
    // and 'Rejected' status as a danger badge
    switch ($value) {
        case 'active':
            return '<span class="badge bg-success text-white text-capitalize">' . __('active') . '</span>';
        case 'inactive':
            return '<span class="badge bg-danger text-white text-capitalize">' . __('inactive') . '</span>';
        case 'pending':
            return '<span class="badge bg-warning text-white text-capitalize">' . __('pending') . '</span>';
        case 'approved':
            return '<span class="badge bg-success text-white text-capitalize">' . __('approved') . '</span>';
        case 'rejected':
            return '<span class="badge bg-danger text-white text-capitalize">' . __('rejected') . '</span>';
        default:
            return '';
    }
}
}

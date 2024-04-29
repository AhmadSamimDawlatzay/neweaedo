<?php

namespace Botble\Donation\Http\Controllers;

use Botble\Donation\Http\Requests\DonationRequest;
use Botble\Donation\Models\Donation;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Donation\Tables\DonationTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Donation\Forms\DonationForm;
use Botble\Base\Forms\FormBuilder;

class DonationController extends BaseController
{
    public function index(DonationTable $table)
    {
        PageTitle::setTitle(trans('plugins/donation::donation.name'));

        return $table->renderTable();
    }

    public function create(FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('plugins/donation::donation.create'));

        return $formBuilder->create(DonationForm::class)->renderForm();
    }

    public function store(DonationRequest $request, BaseHttpResponse $response)
    {
        $donation = Donation::query()->create($request->input());

        event(new CreatedContentEvent(DONATION_MODULE_SCREEN_NAME, $request, $donation));

        return $response
            ->setPreviousUrl(route('donation.index'))
            ->setNextUrl(route('donation.edit', $donation->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Donation $donation, FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('core/base::forms.edit_item', ['name' => $donation->name]));

        return $formBuilder->create(DonationForm::class, ['model' => $donation])->renderForm();
    }

    public function update(Donation $donation, DonationRequest $request, BaseHttpResponse $response)
    {
        $donation->fill($request->input());

        $donation->save();

        event(new UpdatedContentEvent(DONATION_MODULE_SCREEN_NAME, $request, $donation));

        return $response
            ->setPreviousUrl(route('donation.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Donation $donation, Request $request, BaseHttpResponse $response)
    {
        try {
            $donation->delete();

            event(new DeletedContentEvent(DONATION_MODULE_SCREEN_NAME, $request, $donation));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }
}

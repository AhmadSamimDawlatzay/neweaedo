<?php

namespace Botble\Donate\Http\Controllers;

use Botble\Donate\Http\Requests\DonateRequest;
use Botble\Donate\Models\Donate;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Donate\Tables\DonateTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Donate\Forms\DonateForm;
use Botble\Base\Forms\FormBuilder;

class DonateController extends BaseController
{
    public function index(DonateTable $table)
    {
        PageTitle::setTitle(trans('plugins/donate::donate.name'));

        return $table->renderTable();
    }

    public function create(FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('plugins/donate::donate.create'));

        return $formBuilder->create(DonateForm::class)->renderForm();
    }

    public function store(DonateRequest $request, BaseHttpResponse $response)
    {
        $donate = Donate::query()->create($request->input());

        event(new CreatedContentEvent(DONATE_MODULE_SCREEN_NAME, $request, $donate));

        return $response
            ->setPreviousUrl(route('donate.index'))
            ->setNextUrl(route('donate.edit', $donate->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Donate $donate, FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('core/base::forms.edit_item', ['name' => $donate->name]));

        return $formBuilder->create(DonateForm::class, ['model' => $donate])->renderForm();
    }

    public function update(Donate $donate, DonateRequest $request, BaseHttpResponse $response)
    {
        $donate->fill($request->input());

        $donate->save();

        event(new UpdatedContentEvent(DONATE_MODULE_SCREEN_NAME, $request, $donate));

        return $response
            ->setPreviousUrl(route('donate.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Donate $donate, Request $request, BaseHttpResponse $response)
    {
        try {
            $donate->delete();

            event(new DeletedContentEvent(DONATE_MODULE_SCREEN_NAME, $request, $donate));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }
}

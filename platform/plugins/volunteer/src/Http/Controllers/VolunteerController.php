<?php

namespace Botble\Volunteer\Http\Controllers;

use Botble\Volunteer\Http\Requests\VolunteerRequest;
use Botble\Volunteer\Models\Volunteer;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Volunteer\Tables\VolunteerTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Volunteer\Forms\VolunteerForm;
use Botble\Base\Forms\FormBuilder;

class VolunteerController extends BaseController
{
    public function index(VolunteerTable $table)
    {
        PageTitle::setTitle(trans('plugins/volunteer::volunteer.name'));

        return $table->renderTable();
    }

    public function create(FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('plugins/volunteer::volunteer.create'));

        return $formBuilder->create(VolunteerForm::class)->renderForm();
    }

    public function store(VolunteerRequest $request, BaseHttpResponse $response)
    {
        $volunteer = Volunteer::query()->create($request->input());

        event(new CreatedContentEvent(VOLUNTEER_MODULE_SCREEN_NAME, $request, $volunteer));

        return $response
            ->setPreviousUrl(route('volunteer.index'))
            ->setNextUrl(route('volunteer.edit', $volunteer->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Volunteer $volunteer, FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('core/base::forms.edit_item', ['name' => $volunteer->name]));

        return $formBuilder->create(VolunteerForm::class, ['model' => $volunteer])->renderForm();
    }

    public function update(Volunteer $volunteer, VolunteerRequest $request, BaseHttpResponse $response)
    {
        $volunteer->fill($request->input());

        $volunteer->save();

        event(new UpdatedContentEvent(VOLUNTEER_MODULE_SCREEN_NAME, $request, $volunteer));

        return $response
            ->setPreviousUrl(route('volunteer.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Volunteer $volunteer, Request $request, BaseHttpResponse $response)
    {
        try {
            $volunteer->delete();

            event(new DeletedContentEvent(VOLUNTEER_MODULE_SCREEN_NAME, $request, $volunteer));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }
}

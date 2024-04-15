<?php

namespace Botble\Project\Http\Controllers;

use Botble\Project\Http\Requests\ProjectRequest;
use Botble\Project\Models\Project;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Project\Tables\ProjectTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Project\Forms\ProjectForm;
use Botble\Base\Forms\FormBuilder;

class ProjectController extends BaseController
{
    public function index(ProjectTable $table)
    {
        PageTitle::setTitle(trans('plugins/project::project.name'));

        return $table->renderTable();
    }

    public function create(FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('plugins/project::project.create'));

        return $formBuilder->create(ProjectForm::class)->renderForm();
    }

    public function store(ProjectRequest $request, BaseHttpResponse $response)
    {
        $project = Project::query()->create($request->input());

        event(new CreatedContentEvent(PROJECT_MODULE_SCREEN_NAME, $request, $project));

        return $response
            ->setPreviousUrl(route('project.index'))
            ->setNextUrl(route('project.edit', $project->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Project $project, FormBuilder $formBuilder)
    {
        PageTitle::setTitle(trans('core/base::forms.edit_item', ['name' => $project->name]));

        return $formBuilder->create(ProjectForm::class, ['model' => $project])->renderForm();
    }

    public function update(Project $project, ProjectRequest $request, BaseHttpResponse $response)
    {
        $project->fill($request->input());

        $project->save();

        event(new UpdatedContentEvent(PROJECT_MODULE_SCREEN_NAME, $request, $project));

        return $response
            ->setPreviousUrl(route('project.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Project $project, Request $request, BaseHttpResponse $response)
    {
        try {
            $project->delete();

            event(new DeletedContentEvent(PROJECT_MODULE_SCREEN_NAME, $request, $project));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }
}

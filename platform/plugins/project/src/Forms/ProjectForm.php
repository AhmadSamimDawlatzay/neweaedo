<?php

namespace Botble\Project\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Project\Http\Requests\ProjectRequest;
use Botble\Project\Models\Project;

class ProjectForm extends FormAbstract
{
    public function buildForm(): void
    {
        $this
            ->setupModel(new Project)
            ->setValidatorClass(ProjectRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('date', 'date', [
                'label' =>'Date of project',
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'class' => 'form-control datepicker',
                    'data-date-format' => 'yyyy/mm/dd',
                ],
                'default_value' => now(config('app.timezone'))->format('Y/m/d'),
            ])

            ->add('description', 'editor', [
                'label' => 'Description of project',
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'rows' => 4,
                    'placeholder' => trans('core/base::forms.description_placeholder'),
                    'with-short-code' => true,
                ],
            ])


            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'class' => 'form-control select-full',
                ],
                'choices' => BaseStatusEnum::labels(),
            ])

            ->add('image','mediaImage',[
            'label' => trans('core/base::tables.image'),
            'label_attr' => ['class' => 'control-label'],
            ])

            ->setBreakFieldPoint('status');
    }
}

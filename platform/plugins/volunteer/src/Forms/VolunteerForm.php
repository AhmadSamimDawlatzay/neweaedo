<?php

namespace Botble\Volunteer\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Volunteer\Http\Requests\VolunteerRequest;
use Botble\Volunteer\Models\Volunteer;

class VolunteerForm extends FormAbstract
{
    public function buildForm(): void
    {
        $this
            ->setupModel(new Volunteer)
            ->setValidatorClass(VolunteerRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('education_level', 'customSelect', [ // Change "select" to "customSelect" for better UI
                'label' => __('Education level'),
                'label_attr' => ['class' => 'control-label required'], // Add class "required" if that is mandatory field
                'choices'    => [
                    1 => __('Elementary School (Grades 1-5 or 1-6)'),
                    2 => __('Middle School (Grades 6-8)'),
                    3 => __('High School (Grades 9-12)'),
                    4 => __('Associate Degree (2 years)'),
                    5 => __('Bachelor\'s Degree (4 years)'),
                    6 => __('Master\'s Degree'),
                    7 => __('Doctorate (Ph.D.)'),
                ],
            ])

            ->add('position', 'text', [
                'label' => __('Position'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => __('Position'),
                    'data-counter' => 120,
                ],
            ])

            ->add('experience_level', 'text', [
                'label' => __('Experience level'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => __('Experience level'),
                    'data-counter' => 120,
                ],
            ])

            ->add('remark', 'editor', [
                'label'=> __('Remark'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'with-short-code' => false, // if true, it will add a button to select shortcode
                    'without-buttons' => true, // if true, all buttons will be hidden
                ],
            ])

            ->add('cv', 'mediaFile', [
                'label' => __('CV'),
                'label_attr' => ['class' => 'control-label'],
            ])


            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'class' => 'form-control select-full required',
                ],
                'choices'    => [
                    'inactive' => 'inactive',
                    'active' => __('active'),
                ],
            ])

            ->add('image', 'mediaImage', [
                'label' => __('image'),
                'label_attr' => ['class' => 'control-label'],
            ])

                        ->add('id_card_front', 'mediaImage', [
                            'label' => __('id card front'),
                            'label_attr' => ['class' => 'control-label'],
                        ])

                        ->add('id_card_back', 'mediaImage', [
                            'label' => __('id card back'),
                            'label_attr' => ['class' => 'control-label'],
                        ])

            ->setBreakFieldPoint('status');

    }
}

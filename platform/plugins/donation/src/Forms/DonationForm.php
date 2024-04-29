<?php

namespace Botble\Donation\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Donation\Http\Requests\DonationRequest;
use Botble\Donation\Models\Donation;
class DonationForm extends FormAbstract
{
    public function buildForm(): void
    {
        $this
        ->setupModel(new Donation)
        ->setValidatorClass(DonationRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])


->add('amount', 'number', [
    'label' => __('amount'),
    'label_attr' => ['class' => 'control-label'],
    'attr' => [
        'id' => 'amount',
        'class' => 'form-control input-mask-number',
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

            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'class' => 'form-control select-full',
                ],
                'choices' => BaseStatusEnum::labels(),
            ])

            ->add('image', 'mediaImage', [
                'label' => __('image'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->setBreakFieldPoint('status');

        }
}

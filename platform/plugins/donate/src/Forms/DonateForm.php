<?php

namespace Botble\Donate\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Donate\Http\Requests\DonateRequest;
use Botble\Donate\Models\Donate;

class DonateForm extends FormAbstract
{
    public function buildForm(): void
    {
        $this->setupModel(new Donate())
            ->setValidatorClass(DonateRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])

            ->add('email', 'email', [
                'label' => __('Email'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => __('Email please'),
                    'data-counter' => 120
                ],
            ])
            ->add('phone', 'tel', [
                'label' => __('Phone'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => __('Phone number please'),
                    'data-counter' => 12
                ],
            ])
            ->add('amount', 'number', [
                'label' => __('Amount'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => __('Amount please'),
                    'data-counter' => 120
                ],
            ])
            ->add('remark', 'textarea', [
                'label' => __('remark'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'placeholder' => __('Remark please'),
                    'data-counter' => 1000
                ],
            ])



            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'class' => 'form-control select-full',
                ],
                'choices' => [
                            'pending' => __('Pending'),
                            'approved' => __('Approve'),
                            'rejected' => __('Reject'),
                ],
            ])

            ->add('donation_id', 'customSelect', [
                'label' => __('Donation'), // Change the label if needed
                'label_attr' => ['class' => 'control-label required'],
                'choices' => \Botble\Donation\Models\Donation::pluck('name', 'id')->toArray(),
                // platform\plugins\donation\src\Models\Donation
            ])

            ->setBreakFieldPoint('status');
    }
}

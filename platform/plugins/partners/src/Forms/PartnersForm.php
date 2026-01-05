<?php

namespace Botble\Partners\Forms;

use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Partners\Http\Requests\PartnersRequest;
use Botble\Partners\Models\Partners;

class PartnersForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(Partners::class)
            ->setValidatorClass(PartnersRequest::class)

            ->add(
                'name',
                TextField::class,
                NameFieldOption::make()
                    ->required()
                    ->toArray()
            )

            ->add(
                'image',
                MediaImageField::class,
                [
                    'label' => 'Hình ảnh',
                ]

            )

            ->add(
                'link',
                TextField::class,
                [
                    'label' => 'Link website',
                    'attr' => [
                        'placeholder' => 'https://example.com',
                    ],
                ]
            )

            ->add(
                'status',
                SelectField::class,
                StatusFieldOption::make()->toArray()
            )

            ->setBreakFieldPoint('status');
    }
}

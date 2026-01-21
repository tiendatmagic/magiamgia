<?php

namespace Botble\Blog\Forms;

use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\IsDefaultFieldOption;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\OnOffField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Blog\Http\Requests\CategoryRequest;
use Botble\Blog\Models\Category;

class CategoryForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(Category::class)
            ->setValidatorClass(CategoryRequest::class)
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
            ->add('description', TextareaField::class, DescriptionFieldOption::make()->toArray())
            ->add('is_default', OnOffField::class, IsDefaultFieldOption::make()->toArray())
            ->add(
                'show_on_homepage',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(trans('plugins/blog::categories.show_on_homepage'))
                    ->defaultValue(false)
                    ->toArray()
            )
            ->add(
                'show_on_provider',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(trans('plugins/blog::categories.show_on_provider'))
                    ->defaultValue(false)
                    ->toArray()
            )
            ->add(
                'icon',
                $this->getFormHelper()->hasCustomField('themeIcon') ? 'themeIcon' : TextField::class,
                TextFieldOption::make()
                    ->label(trans('core/base::forms.icon'))
                    ->placeholder('Ex: fa fa-home')
                    ->maxLength(120)
                    ->toArray()
            )
            ->add('status', SelectField::class, StatusFieldOption::make()->toArray())
            ->setBreakFieldPoint('status');
    }
}

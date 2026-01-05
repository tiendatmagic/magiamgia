<?php

namespace Botble\Service\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Service\Forms\ServiceCategoryForm;
use Botble\Service\Http\Requests\ServiceCategoryRequest;
use Botble\Service\Models\ServiceCategory;
use Botble\Service\Tables\ServiceCategoryTable;

class ServiceCategoryController extends BaseController
{
    public function index(ServiceCategoryTable $table)
    {
        $this->pageTitle(trans('plugins/service::service.category'));

        return $table->renderTable();
    }

    public function create()
    {
        return ServiceCategoryForm::create()->renderForm();
    }

    public function store(ServiceCategoryRequest $request)
    {
        $form = ServiceCategoryForm::create()->setRequest($request);
        $form->save();

        return $this->httpResponse()
            ->setPreviousUrl(route('service-category.index'))
            ->setNextUrl(route('service-category.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $serviceCategory]));

        return ServiceCategoryForm::createFromModel($serviceCategory)->renderForm();
    }

    public function update(ServiceCategory $serviceCategory, ServiceCategoryRequest $request)
    {
        ServiceCategoryForm::createFromModel($serviceCategory)
            ->setRequest($request)
            ->save();

        return $this->httpResponse()
            ->setPreviousUrl(route('service-category.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        return DeleteResourceAction::make($serviceCategory);
    }
}

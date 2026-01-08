<?php

namespace Botble\Tour\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Tour\Forms\TourCategoryForm;
use Botble\Tour\Http\Requests\TourCategoryRequest;
use Botble\Tour\Models\TourCategory;
use Botble\Tour\Tables\TourCategoryTable;
use Carbon\Carbon;

class TourCategoryController extends BaseController
{
    public function index(TourCategoryTable $table)
    {
        $this->pageTitle(trans('plugins/tour::tour.category'));

        return $table->renderTable();
    }

    public function create()
    {
        return TourCategoryForm::create()->renderForm();
    }

    public function store(TourCategoryRequest $request)
    {
        $form = TourCategoryForm::create()->setRequest($request);
        $form->save();

        $category = $form->getModel();

        if ($request->filled('created_at')) {
            try {
                $category->forceFill([
                    'created_at' => Carbon::createFromFormat('d/m/Y', $request->input('created_at')),
                ]);

                $originalTimestamps = $category->timestamps;
                $category->timestamps = false;
                $category->save();
                $category->timestamps = $originalTimestamps;
            } catch (\Throwable) {
                // ignore
            }
        }

        return $this->httpResponse()
            ->setPreviousUrl(route('tour-category.index'))
            ->setNextUrl(route('tour-category.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(TourCategory $tourCategory)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $tourCategory]));

        return TourCategoryForm::createFromModel($tourCategory)->renderForm();
    }

    public function update(TourCategory $tourCategory, TourCategoryRequest $request)
    {
        TourCategoryForm::createFromModel($tourCategory)
            ->setRequest($request)
            ->save();

        if ($request->filled('created_at')) {
            try {
                $tourCategory->forceFill([
                    'created_at' => Carbon::createFromFormat('d/m/Y', $request->input('created_at')),
                ]);

                $originalTimestamps = $tourCategory->timestamps;
                $tourCategory->timestamps = false;
                $tourCategory->save();
                $tourCategory->timestamps = $originalTimestamps;
            } catch (\Throwable) {
                // ignore
            }
        }

        return $this->httpResponse()
            ->setPreviousUrl(route('tour-category.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(TourCategory $tourCategory)
    {
        return DeleteResourceAction::make($tourCategory);
    }
}

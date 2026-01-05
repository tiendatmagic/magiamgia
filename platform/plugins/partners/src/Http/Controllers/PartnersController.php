<?php

namespace Botble\Partners\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Partners\Http\Requests\PartnersRequest;
use Botble\Partners\Models\Partners;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Partners\Tables\PartnersTable;
use Botble\Partners\Forms\PartnersForm;

class PartnersController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans(trans('plugins/partners::partners.name')), route('partners.index'));
    }

    public function index(PartnersTable $table)
    {
        $this->pageTitle(trans('plugins/partners::partners.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/partners::partners.create'));

        return PartnersForm::create()->renderForm();
    }

    public function store(PartnersRequest $request)
    {
        $form = PartnersForm::create()->setRequest($request);

        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('partners.index'))
            ->setNextUrl(route('partners.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Partners $partners)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $partners->name]));

        return PartnersForm::createFromModel($partners)->renderForm();
    }

    public function update(Partners $partners, PartnersRequest $request)
    {
        PartnersForm::createFromModel($partners)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('partners.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Partners $partners)
    {
        return DeleteResourceAction::make($partners);
    }
}

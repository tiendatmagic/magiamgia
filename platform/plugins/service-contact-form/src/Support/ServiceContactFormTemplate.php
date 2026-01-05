<?php

namespace Botble\ServiceContactForm\Support;

class ServiceContactFormTemplate
{
    public static function defaultTemplate(): string
    {
        return <<<'HTML'
<div id="detailFormContact" class="detailFormContact py-2">
    <h2 class="text-center lg:tw-text-[2rem] tw-text-[calc(1.325rem+0.9vw)] tw-font-medium tw-mb-2">[[t_form_title]]</h2>
    <div class="d-flex justify-content-center">
        <div class="card-body">
            <form action="[[action]]" method="POST">
                [[csrf]]
                <div class="mb-3">
                    <label for="service_title" class="form-label"><strong>[[t_service_selected_label]]</strong></label>
                    <input type="text" class="form-control" id="service_title" name="service_title" value="[[service_title]]" readonly>
                    <input type="hidden" name="service_id" value="[[service_id]]">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label"><strong>[[t_name_label]]</strong></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="[[t_name_placeholder]]" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label"><strong>[[t_phone_label]]</strong></label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="[[t_phone_placeholder]]" required maxlength="13">
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label"><strong>[[t_date_label]]</strong></label>
                    <div class="input-group">
                                                                                <input type="text" class="form-control datepicker" id="date" name="date" placeholder="[[t_date_placeholder]]" autocomplete="off" required="">
                                        <span class="input-group-text">
                                          <i class="fa fa-calendar-alt"></i>
                                        </span>
                                    </div>
                </div>

                <div class="btn-FormContact py-2 text-center">
                    <button type="submit" class="btn btn-primary"><strong>[[t_submit]]</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>
HTML;
    }
}

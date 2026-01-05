<div class="">
  <div id="detailFormContact" class="detailFormContact tw-text-base py-2 mb-3">
    <h2 class="text-center lg:tw-text-[2rem] tw-text-[calc(1.325rem+0.9vw)] tw-font-medium tw-mb-2">{{ __('contact_form.title') }}</h2>
    <div class="d-flex justify-content-center">
      <div class="card-body">
        <form action="{{ route('public.submit.contact.form') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label"><strong>{{ __('contact_form.full_name_label') }}</strong></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{ __('contact_form.full_name_placeholder') }}" required="">
            @error('name')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label"><strong>{{ __('contact_form.phone_label') }}</strong></label>
            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="{{ __('contact_form.phone_placeholder') }}" required="" maxlength="20">
            @error('phone')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
          </div>
          <div class="mb-3">
            <label for="date" class="form-label"><strong>{{ __('contact_form.departure_date_label') }}</strong></label>
            <div class="input-group">
              <input type="text" class="form-control datepicker @error('date') is-invalid @enderror" id="date" name="date" autocomplete="off" placeholder="{{ __('contact_form.departure_date_placeholder') }}" required="">
                  <span class="input-group-text">
                                          <i class="fa fa-calendar-alt"></i>
                                        </span>
              @error('date')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="mb-3">
            <label for="note" class="form-label"><strong>{{ __('contact_form.note_label') }}</strong></label>
            <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3" placeholder="{{ __('contact_form.note_placeholder') }}"></textarea>
            @error('note')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
          </div>
          <div class="btn-FormContact py-2 text-center">
            <button type="submit" class="btn btn-primary"><strong>{{ __('contact_form.submit') }}</strong></button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>


<x-core::datagrid>
    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/contact::contact.tables.full_name') }}</x-slot:title>
        {{ $contact->name }}
    </x-core::datagrid.item>

    @if ($contact->phone)
        <x-core::datagrid.item>
            <x-slot:title>{{ trans('plugins/contact::contact.tables.phone') }}</x-slot:title>
            <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
        </x-core::datagrid.item>
    @endif

    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/contact::contact.tables.time') }}</x-slot:title>
        {{ $contact->created_at->translatedFormat('d M Y H:i:s') }}
    </x-core::datagrid.item>

    @php
        $departureDateDisplay = null;
        $addressIsDepartureDate = false;

        if (! empty($contact->departure_date)) {
            $departureDateDisplay = $contact->departure_date->format('d-m-Y');
            $addressIsDepartureDate = true;
        } elseif (! empty($contact->address)) {
            $address = trim((string) $contact->address);

            // Accept common date formats coming from the frontend datepicker.
            if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $address)) {
                $addressIsDepartureDate = true;
                $departureDateDisplay = \Carbon\Carbon::parse($address)->format('d-m-Y');
            } elseif (preg_match('/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/', $address)) {
                $addressIsDepartureDate = true;
                $departureDateDisplay = \Carbon\Carbon::createFromFormat('d/m/Y', $address)->format('d-m-Y');
            }
        }

        $showAddress = ! empty($contact->address) && ! $addressIsDepartureDate;
    @endphp

    @if ($departureDateDisplay)
        <x-core::datagrid.item>
            <x-slot:title>{{ 'Ngày đi' }}</x-slot:title>
            {{ $departureDateDisplay }}
        </x-core::datagrid.item>
    @endif

    @if ($showAddress)
        <x-core::datagrid.item>
            <x-slot:title>{{ trans('plugins/contact::contact.tables.address') }}</x-slot:title>
            {{ $contact->address ?: 'N/A' }}
        </x-core::datagrid.item>
    @endif

    @if ($contact->subject)
        <x-core::datagrid.item>
            <x-slot:title>{{ trans('plugins/contact::contact.tables.subject') }}</x-slot:title>
            {{ $contact->subject }}
        </x-core::datagrid.item>
    @endif
</x-core::datagrid>

<x-core::datagrid.item class="mt-3">
    <x-slot:title>{{ trans('plugins/contact::contact.tables.content') }}</x-slot:title>
    {{ $contact->content ?: '...' }}
</x-core::datagrid.item>

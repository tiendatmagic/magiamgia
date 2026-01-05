<?php

namespace Botble\Contact\Http\Controllers;

use Botble\Base\Facades\EmailHandler;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Contact\Models\Contact;
use Illuminate\Http\Request;

class CustomContactFormController extends BaseController
{
    public function submitContactForm(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'service_id' => 'nullable|integer',
            'service_title' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|string|max:50',
            'note' => 'nullable|string|max:1000',
        ]);

        try {
            // Map form fields to Contact model fields
            $contact = Contact::query()->create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                // Admin title: only the selected service name (no prefix)
                'subject' => $validated['service_title'] ?? null,
                // Save user note/message to DB. If note is empty, fall back to service title.
                'content' => $validated['note'] ?? ($validated['service_title'] ?? ''),
                'address' => $validated['date'],
                // The contacts.email column is NOT NULL.
                'email' => '',
                'status' => 'unread',
            ]);

            // Send email notification to admin
            EmailHandler::setModule('contact')
                ->setVariableValues([
                    'contact_name' => $contact->name ?? 'N/A',
                    'contact_subject' => $contact->subject ?? 'N/A',
                    'contact_email' => $contact->email ?? 'N/A',
                    'contact_phone' => $contact->phone ?? 'N/A',
                    'contact_address' => $contact->address ?? 'N/A',
                    'contact_content' => $contact->content ?? 'N/A',
                ])
                ->sendUsingTemplate('notice');

            return $this->httpResponse()
                ->setMessage(__('Your contact information has been sent successfully!'))
                ->setData(['contact_id' => $contact->id]);
        } catch (\Exception $e) {
            return $this->httpResponse()
                ->setError()
                ->setMessage(__('An error occurred while sending your message. Please try again.'));
        }
    }
}

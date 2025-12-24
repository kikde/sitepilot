

@component('mail::message')
# Thank you, {{ $donor->name }}!

We’ve received your donation. Please find your 80G receipt attached.

**Receipt No:** {{ $donation->receipt_no }}  
**Amount:** ₹ {{ number_format($amount, 2) }}  
**Date:** {{ optional($donation->updated_at ?? now())->format('d M Y') }}  
**Payment ID:** {{ $donation->razorpay_payment_id }}

If you need any help, reply to this email.

Thanks & regards,  
**{{ $setting->title ?? config('app.name') }}**
@endcomponent
@component('mail::message')
# Thank you for your donation

Hello {{ $donor->name }},

We have received your donation of INR {{ number_format($amount, 2) }}.

Receipt No.: {{ $donation->receipt_no }}

@if(!empty($donation->receipt_pdf_path))
Your receipt PDF is attached to this email.
@endif

Thanks,
{{ config('app.name') }}
@endcomponent

<!-- WhatsApp FAB (lifted up, bottom-left) -->
<a class="fab-whatsapp" href="https://wa.me/{{ $setting->phone }}?text={{ urlencode('Hello Team,👋\nThank you for your support!') }}" target="_blank" rel="noopener" aria-label="Chat on WhatsApp"></a>

<!-- Full-width sticky bar: Left | Center | Right -->
<div class="sticky-actions-full">
  <a class="sa-btn sa-register" href="{{ url('/member-registration') }}">Register</a>
  <a class="sa-btn sa-donate"   href="{{ url('/user-donate') }}">Donate</a>
  <a class="sa-btn sa-complaint" href="{{ url('/complain-form') }}">Complaint</a>
</div>
</div>
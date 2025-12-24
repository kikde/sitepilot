{{-- Member Registration – Thank You --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<section class="member-register" style="background:linear-gradient(180deg,#fff8f7,#f6fafc);padding:36px 16px;display:flex;justify-content:center;">
  <div class="mr-card" style="width:100%;max-width:720px;background:#fff;border:1px solid #e5e7eb;border-radius:22px;overflow:hidden;box-shadow:0 12px 34px rgba(0,0,0,.08);">
    <div class="mr-head" style="display:flex;align-items:center;gap:12px;padding:18px 22px;color:#fff;background:linear-gradient(135deg,#ff4d4d,#ff944d);">
      <i class="fa-solid fa-circle-check"></i>
      <h2 style="margin:0;font-size:1.4rem;font-weight:700;letter-spacing:.2px;">Registration Submitted</h2>
    </div>

    <div class="mr-body" style="padding:26px;">
      @if(session('success'))
        <div style="margin-bottom:14px;padding:12px 14px;border-radius:12px;background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0;">
          {{ session('success') }}
        </div>
      @endif

      <p style="margin:0 0 12px;color:#0f172a;">Hi <strong>{{ $user->name }}</strong>, thanks for registering with us.</p>
      <ul style="margin:0 0 16px 18px;color:#334155;">
        <li>Your application status: <strong>Pending verification</strong>.</li>
        <li>We’ll notify you once your ID Card is active.</li>
        <li>You can later download your ID Card from the website.</li>
      </ul>

      <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:6px;">
        <a href="{{ route('member.register.show') }}" class="btn btn-primary" style="text-decoration:none;display:inline-block;padding:10px 14px;border-radius:10px;background:linear-gradient(135deg,#ff4d4d,#ff944d);color:#fff;box-shadow:0 8px 20px rgba(255,77,77,.25);">Register Another Member</a>
        <a href="{{ url('/') }}" class="btn btn-ghost" style="text-decoration:none;display:inline-block;padding:10px 14px;border-radius:10px;background:#f6f7f9;color:#111827;border:1px solid #d1d5db;">Go to Homepage</a>
      </div>
    </div>
  </div>
</section>

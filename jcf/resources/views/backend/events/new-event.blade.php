@extends('layouts.app')

@section('site-title')
  {{ __('New Events Post') }}
@endsection

@section('style')
<style>
  /* ===== Header (title left, action right) ===== */
  .header-bar{
    display:flex; align-items:center; justify-content:space-between;
    gap:1rem; flex-wrap:wrap; padding:.25rem 0 .5rem;
  }
  .header-actions{ display:flex; gap:.5rem; flex-wrap:wrap; }
  @supports not (gap:.5rem){ .header-actions > * + *{ margin-left:.5rem; } }
  .btn-round{ border-radius:999px; }
  .btn-primary{ background:#6c5ce7; border-color:#6c5ce7; }
  .btn-primary:hover{ background:#584ce3; border-color:#584ce3; }

  /* ===== Form card polish ===== */
  .event-form-card{
    border:1px solid #eef1f6; border-radius:18px; overflow:hidden;
    box-shadow:0 10px 24px rgba(16,24,40,.06);
  }
  .event-form-accent{ height:8px; background:linear-gradient(90deg,#6c5ce7,#a78bfa,#22c55e); }
  .event-form-card .card-body{ padding:20px; }
  @media (max-width:768px){ .event-form-card .card-body{ padding:16px; } }

  /* section titles & dividers */
  .section-title-small{
    font-size:14px; font-weight:700; text-transform:uppercase; letter-spacing:.08em;
    color:#6b7280; margin-bottom:.35rem;
  }
  .divider-soft{ border-top:1px dashed #e5e7eb; margin:.8rem 0 1.1rem; }

  /* upload preview */
  #account-upload-img-wrapper{ position:relative; display:inline-block; cursor:pointer; }
  #account-upload-img{ display:block; object-fit:cover; border-radius:12px; }
  .account-upload-overlay{
    position:absolute; left:0; right:0; bottom:0;
    padding:6px 10px; background:linear-gradient(to top, rgba(0,0,0,.65), transparent);
    color:#fff; font-size:13px; text-align:center; pointer-events:none;
    border-bottom-left-radius:12px; border-bottom-right-radius:12px;
  }
  @media (max-width:575.98px){ #account-upload-img{ width:100%; height:auto; } }

  /* input icons (date/time) */
  .input-icon{ position:relative; }
  .input-icon i{
    position:absolute; left:10px; top:50%; transform:translateY(-50%);
    width:16px; height:16px; color:#6b7280;
  }
  .input-icon input{ padding-left:34px; }
  .form-text-sm{ font-size:12px; color:#6b7280; }
  i[data-feather]{ width:16px; height:16px; }

  /* editor host */
  .quill-wrapper{ border-radius:12px; box-shadow:0 6px 18px rgba(16,24,40,.06); background:#fff; }
  .quill-wrapper .ql-container{ min-height:340px; max-height:600px; overflow:auto; border-bottom-left-radius:12px; border-bottom-right-radius:12px; }
  .quill-wrapper .ql-toolbar{ border-top-left-radius:12px; border-top-right-radius:12px; }

  /* mobile header stack */
  @media (max-width:575.98px){
    .header-bar{ flex-direction:column; align-items:flex-start; }
  }
</style>
@endsection

@section('content')
<div class="col-lg-12 col-ml-12 padding-bottom-30">
  <div class="row">
    <div class="col-lg-12"><div class="margin-top-40"></div></div>

    {{-- ===== Header ===== --}}
    <div class="col-12">
      <div class="header-bar">
        <div>
          <h2 class="content-header-title mb-0">{{ __('New Events') }}</h2>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.events.all') }}">{{ __('All Events') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ol>
          </nav>
        </div>
        <div class="header-actions">
          <a href="{{ route('admin.events.all') }}"
             class="btn btn-outline-secondary btn-round btn-sm"
             data-smart-back
             data-back-fallback="{{ route('admin.events.all') }}">
            <i data-feather="arrow-left"></i><span class="ms-1">{{ __('Back') }}</span>
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-12 mt-2">
      <div class="card event-form-card">
        <div class="event-form-accent"></div>
        <div class="card-body">
          <form id="event-form" action="{{ route('admin.events.new') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
              {{-- LEFT COLUMN --}}
              <div class="col-lg-8">
                {{-- BASIC INFO --}}
                <div class="section-title-small">{{ __('Basic Information') }}</div>
                <div class="divider-soft"></div>

                <div class="form-group">
                  <label for="title">{{ __('Title') }}</label>
                  <input type="text" class="form-control" id="title" name="title"
                         value="{{ old('title') }}" placeholder="{{ __('Title') }}">
                </div>

                <div class="form-group permalink_label">
                  <label class="text-dark">
                    {{ __('Permalink / Slug * : ') }}
                    <span id="slug_show" class="d-inline-block"></span>
                    <span id="slug_edit" class="d-inline-block">
                      <button class="btn btn-warning btn-sm ml-1 px-2 py-1 slug_edit_button">
                        <i class="fas fa-edit"></i>
                      </button>
                      <input type="text" name="slug" class="form-control blog_slug mt-2" style="display:none">
                      <button class="btn btn-info btn-sm slug_update_button mt-2 px-2 py-1" style="display:none">
                        {{ __('Update') }}
                      </button>
                    </span>
                  </label>
                </div>

                <div class="form-group">
                  <label for="category">{{ __('Category') }}</label>
                  <select name="category_id" class="form-control" id="category">
                    <option value="">{{ __('Select Category') }}</option>
                    @foreach($all_categories as $category)
                      <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="short_description">{{ __('Short Description (for cards)') }}</label>
                  <textarea name="short_description" id="short_description" class="form-control" rows="2"
                            placeholder="{{ __('Short summary shown in event cards') }}">{{ old('short_description') }}</textarea>
                </div>

                {{-- DETAILED DESCRIPTION --}}
               <div class="form-group">
    <label>Detailed Description</label>
    <p class="my-50">
      <a href="javascript:void(0);" id="blog-image-text">Recommended inline image 700×442, max ~10 MB.</a>
    </p>

    <div id="blog-editor-wrapper" class="quill-wrapper">
      <!-- IMPORTANT: keep name="description" and give it an initial value for edit forms -->
      <input type="hidden" name="description" id="description"
             value="{{ old('description', $event->description ?? '') }}" />

      <div id="blog-editor-container">
        <!-- This DIV is Quill’s host. We seed it from old()/DB for first paint -->
        <div class="editor">{!! old('description', $event->description ?? '') !!}</div>
      </div>
    </div>
  </div>

                {{-- DATE & TIME --}}
                <div class="section-title-small mt-4">{{ __('Date & Time') }}</div>
                <div class="divider-soft"></div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="start_date">{{ __('Start Date') }}</label>
                    <div class="input-icon">
                      <i data-feather="calendar"></i>
                      <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="start_time">{{ __('Start Time') }}</label>
                    <div class="input-icon">
                      <i data-feather="clock"></i>
                      <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time') }}">
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="end_date">{{ __('End Date') }}</label>
                    <div class="input-icon">
                      <i data-feather="calendar"></i>
                      <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="end_time">{{ __('End Time') }}</label>
                    <div class="input-icon">
                      <i data-feather="clock"></i>
                      <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') }}">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="timezone">{{ __('Timezone') }}</label>
                  <input type="text" class="form-control" id="timezone" name="timezone"
                         value="{{ old('timezone','Asia/Kolkata') }}" placeholder="Asia/Kolkata">
                </div>

                {{-- COST & TICKETS --}}
                <div class="section-title-small mt-4">{{ __('Cost & Tickets') }}</div>
                <div class="divider-soft"></div>

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="is_free">{{ __('Is Event Free?') }}</label>
                    <select name="is_free" id="is_free" class="form-control">
                      <option value="1" {{ old('is_free', 1) ? 'selected' : '' }}>{{ __('Yes') }}</option>
                      <option value="0" {{ old('is_free', 1) ? '' : 'selected' }}>{{ __('No (Paid)') }}</option>
                    </select>
                    <small class="form-text-sm">{{ __('If free, price fields are optional; you can still set a label.') }}</small>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="price_amount">{{ __('Price Amount') }}</label>
                    <input type="number" step="0.01" class="form-control" id="price_amount" name="price_amount"
                           value="{{ old('price_amount') }}" placeholder="{{ __('e.g. 200.00') }}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="price_currency">{{ __('Currency') }}</label>
                    <input type="text" class="form-control" id="price_currency" name="price_currency"
                           value="{{ old('price_currency','INR') }}" placeholder="INR">
                  </div>
                </div>

                <div class="form-group">
                  <label for="cost_label">{{ __('Cost Label') }}</label>
                  <input type="text" class="form-control" id="cost_label" name="cost_label"
                         value="{{ old('cost_label') }}" placeholder="{{ __('e.g. Free Entry, Donation Based, ₹200 per person') }}">
                </div>

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="capacity">{{ __('Total Capacity (Seats)') }}</label>
                    <input type="number" class="form-control" id="capacity" name="capacity"
                           value="{{ old('capacity') }}" placeholder="{{ __('e.g. 200') }}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="available_tickets">{{ __('Available Tickets') }}</label>
                    <input type="number" class="form-control" id="available_tickets" name="available_tickets"
                           value="{{ old('available_tickets') }}" placeholder="{{ __('Available tickets') }}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="tickets">{{ __('Tickets Info') }}</label>
                    <input type="text" class="form-control" id="tickets" name="tickets"
                           value="{{ old('tickets') }}" placeholder="{{ __('e.g. Registration Required, Walk-in Allowed') }}">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="registration_required">{{ __('Registration Required?') }}</label>
                    <select name="registration_required" id="registration_required" class="form-control">
                      <option value="0" {{ old('registration_required') ? '' : 'selected' }}>{{ __('No') }}</option>
                      <option value="1" {{ old('registration_required') ? 'selected' : '' }}>{{ __('Yes') }}</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="registration_deadline">{{ __('Registration Deadline') }}</label>
                    <div class="input-icon">
                      <i data-feather="clock"></i>
                      <input type="datetime-local" class="form-control" id="registration_deadline"
                             name="registration_deadline" value="{{ old('registration_deadline') }}">
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="registration_url">{{ __('Registration / Ticket URL') }}</label>
                    <input type="text" class="form-control" id="registration_url" name="registration_url"
                           value="{{ old('registration_url') }}" placeholder="{{ __('Google Form or ticketing link') }}">
                  </div>
                </div>
              </div>

              {{-- RIGHT COLUMN --}}
              <div class="col-lg-4">
                {{-- ORGANIZER --}}
                <div class="section-title-small">{{ __('Organizer Details') }}</div>
                <div class="divider-soft"></div>

                <div class="form-group">
                  <label for="organizer">{{ __('Organizer') }}</label>
                  <input type="text" class="form-control" id="organizer" name="organizer"
                         value="{{ old('organizer') }}" placeholder="{{ __('Event Organizer') }}">
                </div>
                <div class="form-group">
                  <label for="organizer_email">{{ __('Organizer Email') }}</label>
                  <input type="email" class="form-control" id="organizer_email" name="organizer_email"
                         value="{{ old('organizer_email') }}" placeholder="{{ __('Organizer Email') }}">
                </div>
                <div class="form-group">
                  <label for="organizer_phone">{{ __('Organizer Phone') }}</label>
                  <input type="text" class="form-control" id="organizer_phone" name="organizer_phone"
                         value="{{ old('organizer_phone') }}" placeholder="{{ __('Organizer Phone') }}">
                </div>
                <div class="form-group">
                  <label for="organizer_whatsapp">{{ __('Organizer WhatsApp') }}</label>
                  <input type="text" class="form-control" id="organizer_whatsapp" name="organizer_whatsapp"
                         value="{{ old('organizer_whatsapp') }}" placeholder="{{ __('WhatsApp Number (optional)') }}">
                </div>
                <div class="form-group">
                  <label for="organizer_website">{{ __('Organizer Website') }}</label>
                  <input type="text" class="form-control" id="organizer_website" name="organizer_website"
                         value="{{ old('organizer_website') }}" placeholder="{{ __('Organizer Website') }}">
                </div>

                {{-- VENUE --}}
                <div class="section-title-small mt-4">{{ __('Venue Details') }}</div>
                <div class="divider-soft"></div>

                <div class="form-group">
                  <label for="venue">{{ __('Venue Name') }}</label>
                  <input type="text" class="form-control" id="venue" name="venue"
                         value="{{ old('venue') }}" placeholder="{{ __('Event Venue') }}">
                </div>
                <div class="form-group">
                  <label for="venue_location">{{ __('Venue Location (Short)') }}</label>
                  <input type="text" class="form-control" id="venue_location" name="venue_location"
                         value="{{ old('venue_location') }}" placeholder="{{ __('e.g. Near Bus Stand, Main Road') }}">
                </div>
                <div class="form-group">
                  <label for="venue_address">{{ __('Venue Address (Full)') }}</label>
                  <textarea name="venue_address" id="venue_address" rows="2" class="form-control"
                            placeholder="{{ __('Full address for maps / directions') }}">{{ old('venue_address') }}</textarea>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="venue_city">{{ __('City') }}</label>
                    <input type="text" class="form-control" id="venue_city" name="venue_city"
                           value="{{ old('venue_city') }}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="venue_state">{{ __('State') }}</label>
                    <input type="text" class="form-control" id="venue_state" name="venue_state"
                           value="{{ old('venue_state') }}">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="venue_country">{{ __('Country') }}</label>
                    <input type="text" class="form-control" id="venue_country" name="venue_country"
                           value="{{ old('venue_country','India') }}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="venue_phone">{{ __('Venue Phone') }}</label>
                    <input type="text" class="form-control" id="venue_phone" name="venue_phone"
                           value="{{ old('venue_phone') }}" placeholder="{{ __('Venue Phone') }}">
                  </div>
                </div>

                <div class="form-group">
                  <label for="venue_map_url">{{ __('Venue Map URL (Google Maps)') }}</label>
                  <input type="text" class="form-control" id="venue_map_url" name="venue_map_url"
                         value="{{ old('venue_map_url') }}" placeholder="{{ __('https://maps.google.com/...') }}">
                </div>

                {{-- MEDIA --}}
                <div class="section-title-small mt-4">{{ __('Media') }}</div>
                <div class="divider-soft"></div>

                <div class="form-group">
                  <label for="account-upload">{{ __('Image') }}</label>
                  <div id="account-upload-img-wrapper" class="mr-25">
                    <img src="{{ asset('frontend/custom/breadcrump.png') }}"
                         id="account-upload-img" class="rounded" alt="event image"
                         height="250" width="250"
                         onclick="document.getElementById('account-upload').click();" />
                    <div class="account-upload-overlay">{{ __('Tap to upload image') }}</div>
                  </div>
                  <input type="file" id="account-upload" class="d-none" name="image"
                         accept="image/*" onchange="(function(inp){ if(inp.files[0]){ let r=new FileReader(); r.onload=e=>document.getElementById('account-upload-img').src=e.target.result; r.readAsDataURL(inp.files[0]); } })(this)" />
                  <small class="form-text-sm">{{ __('Recommended image size 720x420 (landscape)') }}</small>
                </div>

                <div class="form-group">
                  <label for="video_url">{{ __('Video URL (optional)') }}</label>
                  <input type="text" class="form-control" id="video_url" name="video_url"
                         value="{{ old('video_url') }}" placeholder="{{ __('YouTube or other video link') }}">
                </div>

                <div class="form-group">
                  <label for="brochure_url">{{ __('Brochure / PDF URL (optional)') }}</label>
                  <input type="text" class="form-control" id="brochure_url" name="brochure_url"
                         value="{{ old('brochure_url') }}" placeholder="{{ __('PDF brochure link (if any)') }}">
                </div>

                {{-- STATUS & SEO --}}
                <div class="section-title-small mt-4">{{ __('Status & SEO') }}</div>
                <div class="divider-soft"></div>

                <div class="form-group">
                  <label for="status">{{ __('Status') }}</label>
                  <select name="status" id="status" class="form-control">
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>{{ __('Published') }}</option>
                    <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                  </select>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <div class="form-check mt-2">
                      <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1"
                             {{ old('is_featured') ? 'checked' : '' }}>
                      <label class="form-check-label" for="is_featured">{{ __('Featured Event') }}</label>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <div class="form-check mt-2">
                      <input class="form-check-input" type="checkbox" id="show_on_homepage" name="show_on_homepage" value="1"
                             {{ old('show_on_homepage') ? 'checked' : '' }}>
                      <label class="form-check-label" for="show_on_homepage">{{ __('Show on Homepage') }}</label>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="display_from">{{ __('Display From') }}</label>
                    <div class="input-icon">
                      <i data-feather="clock"></i>
                      <input type="datetime-local" class="form-control" id="display_from" name="display_from"
                             value="{{ old('display_from') }}">
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="display_to">{{ __('Display To') }}</label>
                    <div class="input-icon">
                      <i data-feather="clock"></i>
                      <input type="datetime-local" class="form-control" id="display_to" name="display_to"
                             value="{{ old('display_to') }}">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="meta_title">{{ __('Meta Title') }}</label>
                  <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ old('meta_title') }}">
                </div>

                <div class="form-group">
                  <label for="meta_tags">{{ __('Meta Tags (comma separated)') }}</label>
                  <input type="text" name="meta_tags" id="meta_tags" class="form-control" value="{{ old('meta_tags') }}">
                </div>

                <div class="form-group">
                  <label for="meta_description">{{ __('Meta Description') }}</label>
                  <textarea name="meta_description" id="meta_description" class="form-control" rows="3">{{ old('meta_description') }}</textarea>
                </div>

                {{-- SUBMIT --}}
                <div class="mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.events.all') }}" class="btn btn-outline-secondary">Back</a>
                </div>
              </div> {{-- /col-lg-8 --}}
            </div> {{-- /row --}}
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section('script')
<script>
  // Icons
  document.addEventListener('DOMContentLoaded', function(){ if (window.feather) feather.replace(); });

  // Smart Back
  (function(){
    function hardCloseMenu(){
      document.body.classList.remove('menu-open','menu-expanded');
      document.querySelectorAll('.sidenav-overlay, .drag-target').forEach(n=>{ try{ n.remove(); }catch(e){} });
      if (window.bootstrap){
        document.querySelectorAll('.offcanvas.show').forEach(el=>{
          const inst = bootstrap.Offcanvas.getInstance(el);
          if (inst) inst.hide();
        });
      }
    }
    document.addEventListener('click', function (e) {
      const btn = e.target.closest('[data-smart-back]'); if (!btn) return;
      e.preventDefault(); e.stopPropagation(); hardCloseMenu();
      const ref = document.referrer || '';
      const dest = ref.startsWith(location.origin) ? ref : (btn.dataset.backFallback || '{{ route("admin.events.all") }}');
      setTimeout(()=>{ location.href = dest; }, 0);
    });
  })();

  // Slug helpers
  (function($){
    if (!window.jQuery) return;
    $(function () {
      function convertToSlug(str){
        let slug = (str||'').trim().toLowerCase()
          .replace(/[^a-z0-9\s-]/g, '')
          .replace(/\s+/g, '-')
          .replace(/-+/g, '-');
        return slug;
      }

      $('.permalink_label').hide();

      $(document).on('keyup', '#title', function () {
        const raw = $(this).val();
        const slug = convertToSlug(raw);
        const url  = `{{ url('/events') }}/${slug}`;
        $('.permalink_label').toggle(!!raw);
        $('#slug_show').text(url).css('color', 'blue');
        $('.blog_slug').val(slug);
      });

      $(document).on('click', '.slug_edit_button', function (e) {
        e.preventDefault(); $('.blog_slug').show(); $(this).hide(); $('.slug_update_button').show();
      });

      $(document).on('click', '.slug_update_button', function (e) {
        e.preventDefault(); $(this).hide(); $('.slug_edit_button').show();
        const slug = convertToSlug($('.blog_slug').val());
        const url  = `{{ url('/events') }}/${slug}`;
        $('#slug_show').text(url); $('.blog_slug').val(slug).hide();
      });

      // is_free -> hint
      $('#is_free').on('change', function () {
        const isFree = $(this).val() === '1';
        $('#price_amount').attr('placeholder', isFree ? '{{ __("Optional when free") }}' : '{{ __("e.g. 200.00") }}');
      }).trigger('change');
    });
  })(jQuery);

  
</script>
@endsection

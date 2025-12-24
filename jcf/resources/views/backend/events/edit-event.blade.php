@extends('layouts.app')

@section('site-title', __('Edit Event'))

@section('style')
<style>
  .header-bar{display:flex;align-items:center;justify-content:space-between;gap:.75rem;flex-wrap:wrap}
  .header-actions{display:flex;gap:.5rem;flex-wrap:wrap}
  @supports not (gap:.5rem){.header-actions>*+*{margin-left:.5rem}}
  .event-form-card{border-radius:16px}
  .section-title-small{font-size:14px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:#6b7280;margin:.5rem 0 .35rem}
  .divider-soft{border-top:1px dashed #e5e7eb;margin:8px 0 14px}
  #account-upload-img-wrapper{position:relative;display:inline-block;cursor:pointer}
  #account-upload-img{display:block;object-fit:cover}
  .account-upload-overlay{position:absolute;left:0;right:0;bottom:0;padding:6px 10px;background:linear-gradient(to top,rgba(0,0,0,.65),transparent);color:#fff;font-size:13px;text-align:center;pointer-events:none}
  @media (max-width:575.98px){#account-upload-img{width:100%;height:auto}}
  @media (max-width:575.98px){.header-bar{flex-direction:column;align-items:flex-start}}
</style>
@endsection

@section('content')
<div class="content-wrapper">
  {{-- Header --}}
  <div class="content-header row">
    <div class="col-12">
      <div class="card p-2 px-3" style="border-radius:14px;border:1px solid #eef1f6;">
        <div class="header-bar">
          <div>
            <h2 class="mb-0">{{ __('Edit Event') }}</h2>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.events.all') }}">All Events</a></li>
                <li class="breadcrumb-item active">{{ $event->title }}</li>
              </ol>
            </nav>
          </div>
          <div class="header-actions">
            <a href="{{ route('admin.events.all') }}" class="btn btn-outline-secondary btn-round btn-sm" data-smart-back data-back-fallback="{{ route('admin.events.all') }}">
              <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Body --}}
  <div class="content-body">
    <div class="card event-form-card">
      <div class="card-body">
        <form class="mt-2" id="event-edit-form" action="{{ route('admin.events.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          {{-- Route is POST, so do NOT add @method('PUT') --}}
          <input type="hidden" name="event_id" value="{{ $event->id }}">

          <div class="row">
            {{-- LEFT --}}
            <div class="col-lg-8">
              <div class="section-title-small">{{ __('Basic Information') }}</div>
              <div class="divider-soft"></div>

              <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title',$event->title) }}">
              </div>

              <div class="form-group permalink_label">
                <label class="text-dark">
                  {{ __('Permalink / Slug:') }}
                  <span id="slug_show" class="d-inline-block">{{ url('/events/'.$event->slug) }}</span>
                  <span id="slug_edit" class="d-inline-block">
                    <button class="btn btn-warning btn-sm ml-1 px-2 py-1 slug_edit_button"><i class="fas fa-edit"></i></button>
                    <input type="text" name="slug" class="form-control blog_slug mt-2" value="{{ $event->slug }}" style="display:none">
                    <button class="btn btn-info btn-sm slug_update_button mt-2 px-2 py-1" style="display:none">{{ __('Update') }}</button>
                  </span>
                </label>
              </div>

              <div class="form-group">
                <label for="category">{{ __('Category') }}</label>
                <select name="category_id" class="form-control" id="category">
                  <option value="">{{ __('Select Category') }}</option>
                  @foreach($all_categories as $cat)
                    <option value="{{ $cat->id }}" {{ (int)old('category_id',$event->category_id)===(int)$cat->id ? 'selected':'' }}>
                      {{ $cat->title }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="short_description">{{ __('Short Description (for cards)') }}</label>
                <textarea name="short_description" id="short_description" class="form-control" rows="2">{{ old('short_description',$event->short_description) }}</textarea>
              </div>

              {{-- Detailed Description (Quill-compatible; also works without Quill) --}}
              <div class="form-group">
                <label>{{ __('Detailed Description') }}</label>
                <p class="my-50">
                  <a href="javascript:void(0);" id="blog-image-text">Recommended inline image 700×442, max ~10 MB.</a>
                </p>
                <div id="blog-editor-wrapper">
                  {{-- Hidden field that will receive HTML on submit --}}
                  <input type="hidden" class="form-control" name="description" id="description" />
                  {{-- Editable host (Quill will hydrate if present; otherwise contenteditable works) --}}
                  <div id="blog-editor-container">
                    <div class="editor" contenteditable="true">{!! old('description', $event->description) !!}</div>
                  </div>
                </div>
              </div>

              <div class="section-title-small mt-4">{{ __('Date & Time') }}</div>
              <div class="divider-soft"></div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="start_date">{{ __('Start Date') }}</label>
                  <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date',$event->start_date) }}">
                </div>
                <div class="form-group col-md-6">
                  <label for="start_time">{{ __('Start Time') }}</label>
                  <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time',$event->start_time) }}">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="end_date">{{ __('End Date') }}</label>
                  <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date',$event->end_date) }}">
                </div>
                <div class="form-group col-md-6">
                  <label for="end_time">{{ __('End Time') }}</label>
                  <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time',$event->end_time) }}">
                </div>
              </div>

              <div class="form-group">
                <label for="timezone">{{ __('Timezone') }}</label>
                <input type="text" class="form-control" id="timezone" name="timezone" value="{{ old('timezone',$event->timezone ?? 'Asia/Kolkata') }}">
              </div>

              <div class="section-title-small mt-4">{{ __('Cost & Tickets') }}</div>
              <div class="divider-soft"></div>

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="is_free">{{ __('Is Event Free?') }}</label>
                  <select name="is_free" id="is_free" class="form-control">
                    <option value="1" {{ old('is_free',$event->is_free)?'selected':'' }}>{{ __('Yes') }}</option>
                    <option value="0" {{ old('is_free',$event->is_free)?'':'selected' }}>{{ __('No (Paid)') }}</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="price_amount">{{ __('Price Amount') }}</label>
                  <input type="number" step="0.01" class="form-control" id="price_amount" name="price_amount" value="{{ old('price_amount',$event->price_amount) }}">
                </div>
                <div class="form-group col-md-4">
                  <label for="price_currency">{{ __('Currency') }}</label>
                  <input type="text" class="form-control" id="price_currency" name="price_currency" value="{{ old('price_currency',$event->price_currency ?? 'INR') }}">
                </div>
              </div>

              <div class="form-group">
                <label for="cost_label">{{ __('Cost Label') }}</label>
                <input type="text" class="form-control" id="cost_label" name="cost_label" value="{{ old('cost_label',$event->cost_label ?? $event->cost) }}">
              </div>

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="capacity">{{ __('Total Capacity (Seats)') }}</label>
                  <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity',$event->capacity) }}">
                </div>
                <div class="form-group col-md-4">
                  <label for="available_tickets">{{ __('Available Tickets') }}</label>
                  <input type="number" class="form-control" id="available_tickets" name="available_tickets" value="{{ old('available_tickets',$event->available_tickets) }}">
                </div>
                <div class="form-group col-md-4">
                  <label for="tickets">{{ __('Tickets Info') }}</label>
                  <input type="text" class="form-control" id="tickets" name="tickets" value="{{ old('tickets',$event->tickets) }}">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="registration_required">{{ __('Registration Required?') }}</label>
                  <select name="registration_required" id="registration_required" class="form-control">
                    <option value="0" {{ old('registration_required',$event->registration_required)?'':'selected' }}>{{ __('No') }}</option>
                    <option value="1" {{ old('registration_required',$event->registration_required)?'selected':'' }}>{{ __('Yes') }}</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="registration_deadline">{{ __('Registration Deadline') }}</label>
                  <input type="datetime-local" class="form-control" id="registration_deadline" name="registration_deadline" value="{{ old('registration_deadline',$event->registration_deadline) }}">
                </div>
                <div class="form-group col-md-4">
                  <label for="registration_url">{{ __('Registration / Ticket URL') }}</label>
                  <input type="text" class="form-control" id="registration_url" name="registration_url" value="{{ old('registration_url',$event->registration_url) }}">
                </div>
              </div>
            </div>

            {{-- RIGHT --}}
            <div class="col-lg-4">
              <div class="section-title-small">{{ __('Organizer Details') }}</div>
              <div class="divider-soft"></div>

              <div class="form-group"><label for="organizer">{{ __('Organizer') }}</label>
                <input type="text" class="form-control" id="organizer" name="organizer" value="{{ old('organizer',$event->organizer) }}">
              </div>
              <div class="form-group"><label for="organizer_email">{{ __('Organizer Email') }}</label>
                <input type="email" class="form-control" id="organizer_email" name="organizer_email" value="{{ old('organizer_email',$event->organizer_email) }}">
              </div>
              <div class="form-group"><label for="organizer_phone">{{ __('Organizer Phone') }}</label>
                <input type="text" class="form-control" id="organizer_phone" name="organizer_phone" value="{{ old('organizer_phone',$event->organizer_phone) }}">
              </div>
              <div class="form-group"><label for="organizer_whatsapp">{{ __('Organizer WhatsApp') }}</label>
                <input type="text" class="form-control" id="organizer_whatsapp" name="organizer_whatsapp" value="{{ old('organizer_whatsapp',$event->organizer_whatsapp) }}">
              </div>
              <div class="form-group"><label for="organizer_website">{{ __('Organizer Website') }}</label>
                <input type="text" class="form-control" id="organizer_website" name="organizer_website" value="{{ old('organizer_website',$event->organizer_website) }}">
              </div>

              <div class="section-title-small mt-4">{{ __('Venue Details') }}</div>
              <div class="divider-soft"></div>

              <div class="form-group"><label for="venue">{{ __('Venue Name') }}</label>
                <input type="text" class="form-control" id="venue" name="venue" value="{{ old('venue',$event->venue) }}">
              </div>
              <div class="form-group"><label for="venue_location">{{ __('Venue Location (Short)') }}</label>
                <input type="text" class="form-control" id="venue_location" name="venue_location" value="{{ old('venue_location',$event->venue_location) }}">
              </div>
              <div class="form-group"><label for="venue_address">{{ __('Venue Address (Full)') }}</label>
                <textarea name="venue_address" id="venue_address" rows="2" class="form-control">{{ old('venue_address',$event->venue_address) }}</textarea>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6"><label for="venue_city">{{ __('City') }}</label>
                  <input type="text" class="form-control" id="venue_city" name="venue_city" value="{{ old('venue_city',$event->venue_city) }}">
                </div>
                <div class="form-group col-md-6"><label for="venue_state">{{ __('State') }}</label>
                  <input type="text" class="form-control" id="venue_state" name="venue_state" value="{{ old('venue_state',$event->venue_state) }}">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6"><label for="venue_country">{{ __('Country') }}</label>
                  <input type="text" class="form-control" id="venue_country" name="venue_country" value="{{ old('venue_country',$event->venue_country ?? 'India') }}">
                </div>
                <div class="form-group col-md-6"><label for="venue_phone">{{ __('Venue Phone') }}</label>
                  <input type="text" class="form-control" id="venue_phone" name="venue_phone" value="{{ old('venue_phone',$event->venue_phone) }}">
                </div>
              </div>

              <div class="form-group"><label for="venue_map_url">{{ __('Venue Map URL (Google Maps)') }}</label>
                <input type="text" class="form-control" id="venue_map_url" name="venue_map_url" value="{{ old('venue_map_url',$event->venue_map_url) }}">
              </div>

              <div class="section-title-small mt-4">{{ __('Media') }}</div>
              <div class="divider-soft"></div>

              <div class="form-group">
                <label for="account-upload">{{ __('Image') }}</label>
                <div id="account-upload-img-wrapper">
                  <img src="{{ $event->image ? asset('backend/events/'.$event->image) : asset('frontend/custom/breadcrump.png') }}"
                       id="account-upload-img" class="rounded" alt="event image" height="250" width="250"
                       onclick="document.getElementById('account-upload').click();" />
                  <div class="account-upload-overlay">{{ __('Tap to upload image') }}</div>
                </div>
                <input type="file" id="account-upload" class="d-none" name="image" accept="image/*"
                       onchange="(function(inp){ if(inp.files[0]){ let r=new FileReader(); r.onload=e=>document.getElementById('account-upload-img').src=e.target.result; r.readAsDataURL(inp.files[0]); } })(this)">
                <small>{{ __('Recommended: 720×420') }}</small>
              </div>

              <div class="form-group">
                <label for="video_url">{{ __('Video URL (optional)') }}</label>
                <input type="text" class="form-control" id="video_url" name="video_url" value="{{ old('video_url',$event->video_url) }}">
              </div>

              <div class="form-group">
                <label for="brochure_url">{{ __('Brochure / PDF URL (optional)') }}</label>
                <input type="text" class="form-control" id="brochure_url" name="brochure_url" value="{{ old('brochure_url',$event->brochure_url) }}">
              </div>

              <div class="section-title-small mt-4">{{ __('Status & SEO') }}</div>
              <div class="divider-soft"></div>

              <div class="form-group">
                <label for="status">{{ __('Status') }}</label>
                <select name="status" id="status" class="form-control">
                  @php $st = old('status',$event->status); @endphp
                  <option value="draft"     {{ $st==='draft'?'selected':'' }}>Draft</option>
                  <option value="published" {{ $st==='published'?'selected':'' }}>Published</option>
                  <option value="cancelled" {{ $st==='cancelled'?'selected':'' }}>Cancelled</option>
                  <option value="completed" {{ $st==='completed'?'selected':'' }}>Completed</option>
                </select>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured',$event->is_featured)?'checked':'' }}>
                    <label class="form-check-label" for="is_featured">{{ __('Featured Event') }}</label>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" id="show_on_homepage" name="show_on_homepage" value="1" {{ old('show_on_homepage',$event->show_on_homepage)?'checked':'' }}>
                    <label class="form-check-label" for="show_on_homepage">{{ __('Show on Homepage') }}</label>
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="display_from">{{ __('Display From') }}</label>
                  <input type="datetime-local" class="form-control" id="display_from" name="display_from" value="{{ old('display_from',$event->display_from) }}">
                </div>
                <div class="form-group col-md-6">
                  <label for="display_to">{{ __('Display To') }}</label>
                  <input type="datetime-local" class="form-control" id="display_to" name="display_to" value="{{ old('display_to',$event->display_to) }}">
                </div>
              </div>

              <div class="form-group"><label for="meta_title">{{ __('Meta Title') }}</label>
                <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ old('meta_title',$event->meta_title) }}">
              </div>
              <div class="form-group"><label for="meta_tags">{{ __('Meta Tags (comma separated)') }}</label>
                <input type="text" name="meta_tags" id="meta_tags" class="form-control" value="{{ old('meta_tags',$event->meta_tags) }}">
              </div>
              <div class="form-group"><label for="meta_description">{{ __('Meta Description') }}</label>
                <textarea name="meta_description" id="meta_description" class="form-control" rows="3">{{ old('meta_description',$event->meta_description) }}</textarea>
              </div>
            </div> {{-- /col-lg-4 --}}
          </div> {{-- /row --}}

          <div class="d-flex flex-column flex-sm-row gap-2 mt-3">
            <button type="submit" class="btn btn-primary">
              <i data-feather="save"></i><span class="ms-1">Save Changes</span>
            </button>
            <a href="{{ route('admin.events.all') }}" class="btn btn-outline-secondary" data-smart-back data-back-fallback="{{ route('admin.events.all') }}">
              <i data-feather="arrow-left"></i><span class="ms-1">Back</span>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  // Icons
  document.addEventListener('DOMContentLoaded',()=>{ if(window.feather) feather.replace(); });

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
      const dest = ref.startsWith(location.origin) ? ref : (btn.dataset.backFallback || '{{ route('admin.events.all') }}');
      setTimeout(()=>{ location.href = dest; }, 0);
    });
  })();

  // Slug helpers
  (function($){
    if(!window.jQuery) return;
    $(function(){
      function convertToSlug(str){
        let slug = (str||'').trim().toLowerCase()
          .replace(/[^a-z0-9\s-]/g,'')
          .replace(/\s+/g,'-')
          .replace(/-+/g,'-');
        return slug;
      }
      $(document).on('keyup','#title',function(){
        const raw=$(this).val();
        const slug=convertToSlug(raw);
        const url=`{{ url('/events') }}/${slug}`;
        $('.permalink_label').show();
        $('#slug_show').text(url).css('color','blue');
        $('.blog_slug').val(slug);
      });
      $(document).on('click','.slug_edit_button',function(e){
        e.preventDefault(); $('.blog_slug').show(); $(this).hide(); $('.slug_update_button').show();
      });
      $(document).on('click','.slug_update_button',function(e){
        e.preventDefault(); $(this).hide(); $('.slug_edit_button').show();
        const slug=$('.blog_slug').val(); const url=`{{ url('/events') }}/${slug}`;
        $('#slug_show').text(url); $('.blog_slug').hide();
      });
    });
  })(jQuery);

  // Ensure description HTML is copied on submit (Quill or plain contenteditable)
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('event-edit-form');
    if (!form) return;

    form.addEventListener('submit', function () {
      const quillBody = document.querySelector('#blog-editor-container .ql-editor');
      const fallback  = document.querySelector('#blog-editor-container .editor');
      const html = quillBody ? quillBody.innerHTML : (fallback ? fallback.innerHTML : '');
      const hidden = document.getElementById('description');
      if (hidden) hidden.value = html;
    });

    // Optional: auto-init Quill if available and not already initialized
    if (window.Quill && !document.querySelector('#blog-editor-container .ql-editor')) {
      new Quill('#blog-editor-container .editor', { theme: 'snow' });
    }
  });
</script>
@endsection

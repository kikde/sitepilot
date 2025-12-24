@extends('layouts.app')

@section('content')

@php
    // Keep older variable names working without errors
    $users = $davit ?? ($users ?? auth()->user());
@endphp
<div class="content-wrapper">
    <div class="content-header row"></div>
    <div class="content-body">


        @if(empty($mobile))
            <h1 class="text-danger">
                सफल पंजीकरण के लिए कृपया अपनी प्रोफ़ाइल फ़ोटो और अन्य सभी फ़ील्ड अपडेट करें, प्रोफ़ाइल अपडेट के लिए नीचे दिए गए लिंक पर क्लिक करें
                <a class="text-info" href="{{ '/user-edit/' . Auth::user()->id }}">Click Here</a>
            </h1>

        @elseif(empty($rec))
            <div class="row match-height">
                <div class="col-md-6 col-lg-4"></div>

                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <img class="rounded mx-auto d-block" src="{{ asset('frontend/custom/payment-Qrcode.png') }}" width="350" height="200" alt="Card image cap">
                            <p class="card-text">Upload Payment Receipt.</p>

                            <form action="{{ route('payments.store') }}" method="POST" id="FormId" onsubmit="btnsubmit.disabled = true; return true;" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="file" class="form-control" id="payment" name="screenshot" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <input type="submit" class="btn btn-danger" id="btnsubmit" value="Submit" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4"></div>
            </div>

        @elseif(optional($davit)->after_verifiy_affidavit == null)
            <div class="row match-height">
                <div class="col-md-6 col-lg-4"></div>

                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="text-danger">कृपया हलफनामे पर हस्ताक्षर करें और सदस्यता सक्रियण के लिए नीचे अपलोड करें |</h1>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 mb-5 mb-lg-0">
                                    <a href="{{ asset('storage/' . optional($davit)->before_affidavit) }}" class="btn btn-primary btn-block waves-effect waves-float waves-light" download>
                                        हलफनामा डाउनलोड करें |
                                    </a>
                                </div>
                            </div>
                            <br/>

                            <p class="card-text">हलफनामा अपलोड</p>
                            <form action="{{ url('/upload-affi/' . optional($davit)->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ optional($davit)->id }}">

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="after_verifiy_affidavit" accept="image/*,.pdf" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <button class="btn btn-danger">हलफनामा अपलोड करें |</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4"></div>
            </div>
   
        @else
            <section id="dashboard-analytics">
                <div class="row match-height">
                    <!-- Greetings Card starts -->
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="card card-congratulations">
                            <div class="card-body text-center">
                                <img src="{{ asset('backend/app-assets/images/elements/decore-left.png') }}" class="congratulations-img-left" alt="card-img-left" />
                                <img src="{{ asset('backend/app-assets/images/elements/decore-right.png') }}" class="congratulations-img-right" alt="card-img-right" />
                                <div class="avatar avatar-xl bg-primary shadow">
                                    <div class="avatar-content">
                                        <i data-feather="award" class="font-large-1"></i>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h1 class="mb-1 text-white">Welcome to {{ $setting->title }}</h1>
                                    <p class="card-text m-auto w-75">{{$setting->meta_keywords}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Greetings Card ends -->

                    <!-- Subscribers Chart Card starts -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="users" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">10k</h2>
                                <p class="card-text">New Users</p>
                            </div>
                            <div id="gained-chart"></div>
                        </div>
                    </div>
                    <!-- Subscribers Chart Card ends -->

                    <!-- Orders Chart Card starts -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">6</h2>
                                <p class="card-text">Refferal Member</p>
                            </div>
                            <div id="order-chart"></div>
                        </div>
                    </div>
                    <!-- Orders Chart Card ends -->

                    <!-- Transaction Card -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card card-transaction">
                            <div class="card-body">

                                @if(!empty($rec) && !empty($rec->payment_rec))
                                    <div class="transaction-item">
                                        <div class="media">
                                            <div class="avatar bg-light-success rounded">
                                                <div class="avatar-content">
                                                    <i data-feather="credit-card" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="transaction-title">ID Card</h6>
                                            </div>
                                        </div>
                                        <div class="font-weight-bolder">
                                            @if(optional($davit)->idcard)
                                                <a href="{{ asset('storage/' . $davit->idcard) }}" class="text-success" download>
                                                    <i data-feather="arrow-down" class="avatar-icon font-medium-3"></i>
                                                </a>
                                            @else
                                                <p>Active First</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="transaction-item">
                                        <div class="media">
                                            <div class="avatar bg-light-danger rounded">
                                                <div class="avatar-content">
                                                    <i data-feather="archive" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="transaction-title">Honarary Letter</h6>
                                            </div>
                                        </div>
                                        <div class="font-weight-bolder text-danger">
                                            @if(optional($davit)->honar_letter)
                                                <a href="{{ asset('storage/' . $davit->honar_letter) }}" class="text-danger" download>
                                                    <i data-feather="arrow-down" class="avatar-icon font-medium-3"></i>
                                                </a>
                                            @else
                                                <p>Active First</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="transaction-item">
                                        <div class="media">
                                            <div class="avatar bg-light-info rounded">
                                                <div class="avatar-content">
                                                    <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="transaction-title">Payment Receipt💰</h6>
                                            </div>
                                        </div>
                                        <div class="font-weight-bolder text-danger">
                                            @if(!empty($rec->payment_rec))
                                                <a href="{{ asset('storage/' . $rec->payment_rec) }}" class="text-danger" download>
                                                    <i data-feather="arrow-down" class="avatar-icon font-medium-3"></i>
                                                </a>
                                            @else
                                                <p>👎Not Done</p>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <h1 class="text-danger">आपके विवरण को सत्यापित करने में 24 घंटे लगते हैं। सत्यापन के बाद आप अपना नियुक्ति पत्र आईडी कार्ड के साथ डाउनलोड कर सकते हैं</h1>
                                @endif

                            </div>
                        </div>
                    </div>
                    <!--/ Transaction Card -->
                </div>

                <div class="row match-height">
                    <!-- Employee Task Card -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card card-employee-task">
                            <div class="card-header">
                                <h4 class="card-title text-primary">Top 10 Performer</h4>
                                <i data-feather="more-vertical" class="font-medium-3 cursor-pointer"></i>
                            </div>
                            <div class="card-body">
                                @if(!empty($top))
                                    @foreach($top as $ten)
                                        <div class="employee-task d-flex justify-content-between align-items-center">
                                            <div class="media">
                                                <div class="avatar mr-75">
                                                    @if(!empty($ten->profile_image))
                                                        <img src="{{ asset('backend/uploads/members/' . $ten->profile_image) }}" class="rounded" width="42" height="42" alt="Avatar" />
                                                    @else
                                                        <img src="{{ asset('backend/uploads/user.jpg') }}" class="rounded" width="42" height="42" alt="Avatar" />
                                                    @endif
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h6 class="mb-0">{{ $ten->name }}</h6>
                                                    <small>{{ $ten->occupation }}</small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <small class="text-muted mr-75">{{ $ten->created_at->diffForHumans() }}</small>
                                                <div class="employee-task-chart-primary-1"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h6>No Data Found</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--/ Employee Task Card -->

                    <!-- Profile Card -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card card-profile">
                            <img src="{{ asset('backend/app-assets/images/pages/banner.png') }}" class="img-fluid card-img-top" alt="Profile Cover Photo" />
                            <div class="card-body">
                                <div class="profile-image-wrapper">
                                    <div class="profile-image">
                                        <div class="avatar">
                                            @php
                                                $performerImg = (!empty($perfor) && !empty($perfor->profile_image))
                                                    ? asset('backend/uploads/' . $perfor->profile_image)
                                                    : asset('backend/uploads/user.jpg');
                                            @endphp
                                            <img src="{{ $performerImg }}" alt="Profile Picture" />
                                        </div>
                                    </div>
                                </div>
                                <h3>{{ $perfor->name ?? '' }}</h3>
                                <h6 class="text-muted">{{ $perfor->occupation ?? '' }}</h6>
                                <div class="badge badge-light-primary profile-badge">Performer Of The Month</div>
                                <hr class="mb-2" />
                                <div class="d-flex justify-content-between align-items-center">
                                    {{-- Optional stats --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Profile Card -->

                    <!-- Timeline Card -->
                    <div class="col-lg-4 col-12">
                        <div class="card card-user-timeline">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <i data-feather="list" class="user-timeline-title-icon"></i>
                                    <h4 class="card-title">Notice Board</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="timeline ml-50">
                                    @foreach(($notice ?? []) as $board)
                                        <li class="timeline-item">
                                            <span class="timeline-point timeline-point-indicator"></span>
                                            <div class="timeline-event">
                                                <h6>{{ $board->notes }}</h6>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/ Timeline Card -->
                </div>
            </section>
        @endif
        <!-- Dashboard Analytics end -->

    </div>
</div>
@endsection

<?php

namespace Jcf\NgoSite\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Gallery\Entities\Gallery;

class PublicGalleryController extends Controller
{
    public function photos(Request $request)
    {
        $share_site = $request->get('share_site', 'gallery');

        $photos = Gallery::query()
            ->where('type', 'photo')
            ->when($share_site === 'gallery', fn ($q) => $q->where('share_site', 'gallery'))
            ->when($share_site !== 'gallery', fn ($q) => $q->where('share_site', $share_site))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('frontend.pages.photo', compact('photos', 'share_site'));
    }

    public function videos()
    {
        $videos = Gallery::query()
            ->where('type', 'video')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('frontend.pages.media', compact('videos'));
    }
}


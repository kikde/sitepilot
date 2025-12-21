<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\User\Entities\User;

class DocumentController extends Controller
{
    /**
     * HTML page used by APIshot (and browser) to render the affidavit for a user.
     */
    public function showAffidavit(User $user): View
    {
        // Make sure this Blade exists (see step 4)
        return view('frontend.templates.affidavit.style-1', [
            'user' => $user,
        ]);
    }
}

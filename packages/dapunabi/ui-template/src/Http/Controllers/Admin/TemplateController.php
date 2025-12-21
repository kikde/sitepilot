<?php

namespace Dapunabi\UiTemplate\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;

class TemplateController extends BaseController
{
    public function index()
    {
        return view('uitpl::admin.templates.index');
    }
}


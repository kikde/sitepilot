<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Page\Entities\EventCategory;

class EventCategoryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $v = Validator::make($data, [
            'title' => 'required|string|max:255',
            'status' => 'nullable|in:draft,publish,published,cancelled,completed',
        ]);
        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        }

        EventCategory::create([
            'title' => $data['title'],
            'status' => $data['status'] ?? 'publish',
        ]);

        return back()->with('message', 'Category added successfully.');
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $v = Validator::make($data, [
            'id' => 'required|integer|exists:events_categories,id',
            'title' => 'required|string|max:255',
            'status' => 'nullable|in:draft,publish,published,cancelled,completed',
        ]);
        if ($v->fails()) {
            return back()->withErrors($v)->withInput();
        }

        $cat = EventCategory::findOrFail((int)$data['id']);
        $cat->update([
            'title' => $data['title'],
            'status' => $data['status'] ?? $cat->status,
        ]);

        return back()->with('message', 'Category updated successfully.');
    }

    public function delete($id)
    {
        $cat = EventCategory::findOrFail((int)$id);
        $cat->delete();
        return back()->with('message', 'Category deleted successfully.');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->input('bulk_option');
        $ids = (array) $request->input('bulk_delete', []);
        if ($action === 'delete' && !empty($ids)) {
            EventCategory::whereIn('id', $ids)->delete();
            return back()->with('message', 'Selected categories deleted.');
        }
        return back()->with('status', 'No changes applied.');
    }
}


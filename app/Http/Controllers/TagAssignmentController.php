<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagAssignmentController extends Controller
{
    public function show(Tag $tag)
    {
        return view('assignment.show', [
            'tag' => $tag,
            'links' => Link::query()
                ->orderBy('title')
                ->paginate(50),
        ]);
    }

    public function store(Request $request, Tag $tag)
    {
        $assigned_tags = $tag->links->pluck('id')->toArray();

        foreach ($request->links as $link_id => $selected) {

            if ($selected == "1" && !in_array($link_id, $assigned_tags)) {
                $assigned_tags[] = $link_id;
            }

            if ($selected == "0" && in_array($link_id, $assigned_tags)) {
                $assigned_tags = array_diff($assigned_tags, [$link_id]);
            }

        }

        $tag->links()->sync($assigned_tags);

        if ($request->has('toPage')) {
            return redirect()->to($request->get('toPage'));
        }

        return redirect()
            ->route('tags.index')
            ->with('alert-success', __('tags.assign.success'));
    }
}

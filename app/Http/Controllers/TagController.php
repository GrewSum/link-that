<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('tags.index', [
            'tags' => Tag::query()
                ->orderBy('name')
                ->withCount('links')
                ->paginate(25),
        ]);
    }

    public function create()
    {
        return view('tags.create', [
            'colors' => [
                'gray',
                'red',
                'orange',
                'yellow',
                'green',
                'teal',
                'cyan',
                'sky',
                'indigo',
                'rose',
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'color' => 'required',
            'description' => 'required',
        ]);

        Tag::create([
            'name' => $validated['name'],
            'color' => $validated['color'],
            'description' => $validated['description'],
        ]);

        return redirect()
            ->route('tags.index')
            ->with('alert-success', 'Tag successfully created!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', [
            'tag' => $tag,
            'colors' => [
                'gray',
                'red',
                'orange',
                'yellow',
                'green',
                'teal',
                'cyan',
                'sky',
                'indigo',
                'rose',
            ]
        ]);
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required',
            'color' => 'required',
            'description' => 'required',
        ]);

        $tag->update([
            'name' => $validated['name'],
            'color' => $validated['color'],
            'description' => $validated['description'],
        ]);

        return redirect()
            ->route('tags.index')
            ->with('alert-success', 'Tag successfully updated!');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()
            ->route('tags.index')
            ->with('alert-success', 'Tag has been deleted!');
    }
}

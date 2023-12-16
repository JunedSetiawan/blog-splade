<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollectionRequest;
use App\Models\Collection;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = auth()->user()->collections()->with('post')->paginate(6);
        return view('pages.post.collection.index', [
            'collections' => $collections
        ]);
    }

    public function store(CollectionRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        Collection::create($validated);

        Toast::message('Post added to collection')->autoDismiss(5);

        return redirect()->back();
    }

    public function destroy(Collection $collection)
    {
        $this->authorize('delete', $collection);

        $collection->delete();

        Toast::message('Collection removed from collection')->autoDismiss(5);

        return redirect()->back();
    }
}

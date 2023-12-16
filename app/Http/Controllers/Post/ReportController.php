<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('post')->paginate(6);
        return view('pages.dashboard.report.index', [
            'reports' => $reports
        ]);
    }

    public function store(Post $post, StoreReportRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->user()->id;

        $post->reports()->create($validated);

        Toast::message('report Post Successfully!')->autoDismiss(5);

        $post->save();

        return redirect()->back();
    }
}

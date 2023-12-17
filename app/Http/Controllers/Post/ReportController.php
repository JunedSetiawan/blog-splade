<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use App\Notifications\ReportNotif;
use App\Tables\Reports;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Reports::class;
        return view('pages.dashboard.report.index', [
            'reports' => $reports
        ]);
    }

    public function store(Post $post, StoreReportRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->user()->id;

        $user = User::find(auth()->user()->id);
        $user->notify(new ReportNotif($post->id, $validated['description']));

        $post->reports()->create($validated);
        $post->save();

        Toast::message('report Post Successfully!')->autoDismiss(5);

        return redirect()->back();
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}

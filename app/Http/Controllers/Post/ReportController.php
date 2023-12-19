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
use Illuminate\Notifications\DatabaseNotification;
use ProtoneMedia\Splade\Facades\Toast;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Reports::class;

        $unreadNotifications = \Illuminate\Support\Facades\DB::table('notifications')
            ->where('notifiable_id', auth()->id())
            ->where('notifiable_type', get_class(auth()->user()))
            ->whereNull('read_at')
            ->get();

        $readNotifications = \Illuminate\Support\Facades\DB::table('notifications')
            ->where('notifiable_id', auth()->id())
            ->where('notifiable_type', get_class(auth()->user()))
            ->whereNotNull('read_at')
            ->get();
        return view('pages.dashboard.report.index', [
            'unreadNotifications' => $unreadNotifications,
            'readNotifications' => $readNotifications,
            'reports' => $reports
        ]);
    }

    public function store(Post $post, StoreReportRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->user()->id;

        $user = User::find(auth()->user()->id);

        $post->reports()->create($validated);
        $user->notify(new ReportNotif($post->id, $validated['description']));
        $post->save();

        Toast::message('report Post Successfully!')->autoDismiss(5);

        return redirect()->back();
    }

    public function markAsRead()
    {
        DatabaseNotification::whereNull('read_at')
            ->whereNotNull('notifiable_id')
            ->update([
                'read_at' => now()
            ]);
        return redirect()->back();
    }

    public function accept(Report $report)
    {
        if (auth()->user()->can('accept-reports') && auth()->user()->hasRole('admin')) {
            if (!$report->status == 1) {
                $report->update([
                    'status' => 1
                ]);

                $post = Post::find($report->post_id);
                $post->update([
                    'status' => 'inactive'
                ]);

                Toast::message('Report Accepted Successfully!')->autoDismiss(5);

                return redirect()->back();
            }
            Toast::message('Report Already Accepted!')->autoDismiss(5);
            return redirect()->back();
        }
    }
}

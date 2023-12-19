<?php

namespace App\Tables;

use App\Models\Report;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Reports extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        if ($request->user()->can('delete-reports') || $request->user()->can('view-dashboard') || $request->user()->hasRole('admin') || $request->user()->can('accept-reports')) {
            return true;
        }
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Report::query()->with(['user', 'post'])->latest();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->column('post.title', label: 'Post Title', searchable: true)
            ->column('user.name', label: 'Reporter', searchable: true)
            ->column('description', label: 'Reason Description', searchable: true)
            ->column('created_at', sortable: true, as: fn ($created_at, $report) => $created_at->format('d/m/Y'))
            ->column('post.status', label: 'Status Post', as: fn ($status, $report) => $status == 'active' ? 'Active' : 'Inactive')
            ->column('status', label: 'Report', as: fn ($status, $report) => $status == 0 ? 'Pending' : 'Accepted')
            ->bulkAction('Delete', each: fn (Report $report) => $report->delete(), confirm: true, confirmText: 'Are you sure you want to delete this report? (This action cannot be undone)')
            ->column(label: 'Actions')
            ->paginate(5);

        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        // ->export()
    }
}

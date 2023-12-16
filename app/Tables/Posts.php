<?php

namespace App\Tables;

use App\Models\Post;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Posts extends AbstractTable
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
        if ($request->user()->can('delete-posts') || $request->user()->can('view-dashboard') || $request->user()->hasRole('admin')) {
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
        return Post::query()->with(['user', 'category'])->latest();
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
            ->searchInput('title', label: 'Search by title')
            ->searchInput('category.name', label: 'Search by Category')
            ->column('title', sortable: true)
            ->column('category.name', label: 'Category')
            ->column('user.name', label: 'Author')
            ->column('created_at', sortable: true, as: fn ($created_at, $post) => $created_at->format('d/m/Y'))
            ->bulkAction('Delete', each: fn (Post $post) => $post->delete(), confirm: true, confirmText: 'Are you sure you want to delete this post? (This action cannot be undone)')
            ->paginate(5);

        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        // ->export()
    }
}

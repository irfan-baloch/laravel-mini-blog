<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostApprovalController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query()->latest();
        
        // Filter by status
        if($request->filled('status') && in_array($request->status, ['pending', 'published', 'rejected']))
        {
            $query->where('status', $request->status);
        }

        // Search by title or author
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm){
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhereHas('user', function ($q) use ($searchTerm){
                        $q->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        $posts = $query->paginate(10)->withQueryString();

        return view('admin.posts.index',compact('posts'));

    }

    public function approve(Post $post)
    {
        $post->update(['status'=> 'published']);
        return redirect()->back()->with('success', 'Post approved successfully.');
    }

    public function reject(Post $post)
    {
        $post->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Post rejected.');
    }
}

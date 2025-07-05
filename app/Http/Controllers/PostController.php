<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $slug = Str::slug($request->title);

        // ensure slug is unique
        if (Post::where('slug', $slug)->exists()) {
            $slug .= '-' . uniqid();
        }

        $data['title']   = $request->title;
        $data['slug']    = $slug;
        $data['body']    = $request->body;
        $data['status']  = auth()->user()->role == 'admin' ? 'published' : 'pending';
        $data['user_id'] = auth()->user()->id;
        $data['category_id'] = $request->category_id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }


        $post = Post::create($data);

        if($request->has('tags'))
        {
            $post->tags()->sync($request->tags);
        }

        if (auth()->user()->role == 'admin') {
            $message = 'Post submitted successfully.';
        } else {
            $message = 'Post submitted successfully and is pending approval.';
        }
        

        return redirect()->route('posts.create')->with('success', $message);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // Authorize
    private function authorizePost(Post $post)
    {
        if($post->user_id !== auth()->id())
        {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $this->authorizePost($post);
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorizePost($post);

        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['title'] = $request->title;
        $data['body'] = $request->body;
        $data['category_id'] = $request->category_id;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            // Save new image
            $data['image']  = $request->file('image')->store('uploads', 'public');
        }

        $post->update($data);

        if ($request->has('tags')) 
        {
            $post->tags()->sync($request->tags);
        }
        else
        {
            $post->tags()->detach();  // Remove all if none selected
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorizePost($post);

        // Delete image if exists
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}

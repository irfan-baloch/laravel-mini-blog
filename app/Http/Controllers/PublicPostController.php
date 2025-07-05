<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PublicPostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')->latest()->paginate(6);
        return view('public.index',[
            'posts'            => $posts,
            'metaTitle'       => 'Welcome to Mini Blog' . ' | ' . config('app.name'),
            'metaDescription' => 'Browse the latest posts on Laravel mini blog',
        ]);
    }

    public function show($slug)
    {
        $post = Post::with(['user', 'comments.user'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        
        return view('public.view', [
            'post'            => $post,
            'metaTitle'       => $post->title . ' | ' . config('app.name'),
            'metaDescription' => Str::limit(strip_tags($post->body), 150),
            'metaKeywords'    => $post->tags->pluck('name')->implode(', '),
            'metaImage'       => $post->image ? asset('storage/posts/'. $post->image) : asset('default-og-image.jpg'),
        ]);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::where('status', 'published')->where('category_id', $category->id)->latest()->paginate(5);
        return view('posts.category', compact('category', 'posts'));        
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->where('status', 'published')->latest()->paginate(5);
        return view('posts.tag', compact('tag', 'posts'));
    }
}

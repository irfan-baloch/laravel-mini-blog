<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PublicPostController;
use App\Http\Controllers\PublicUserController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PostApprovalController;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;
use App\Models\User;

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/')) // Homepage
        ->add(Url::create('/blog')) // Your blog listing page
        ->add(Url::create('/contact')) // Static pages
        ->add(Url::create('/about'));

    // ✅ Add all published posts
    $posts = Post::where('status', 'published')->get();
    foreach ($posts as $post) {
        $sitemap->add(Url::create("/post/{$post->slug}"));
    }

    // ✅ Add all public user profiles
    $users = User::all(); // You can also filter only active users
    foreach ($users as $user) {
        $sitemap->add(Url::create("/user/{$user->username}"));
    }

    return $sitemap;
});


Route::get('/', [PublicPostController::class, 'index'])->name('home');

Route::get('/post/{slug}', [PublicPostController::class, 'show'])->name('public.post');
Route::get('/category/{slug}', [PublicPostController::class, 'category'])->name('category.posts');

Route::get('/tag/{slug}', [PublicPostController::class, 'tag'])->name('tag.posts');

Route::get('/user/{username}', [PublicUserController::class, 'show'])->name('user.profile');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/dashboard', [ProfileController::class, 'dashboard'])->name('profile.dashboard');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Post 
    Route::resource('posts', PostController::class)->except(['show']);

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/posts', [PostApprovalController::class, 'index'])->name('posts.index');
    Route::put('/posts/{post}/approve', [PostApprovalController::class, 'approve'])->name('posts.approve');
    Route::put('/posts/{post}/reject', [PostApprovalController::class, 'reject'])->name('posts.reject');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/toggle-role', [UserController::class, 'toggleRole'])->name('users.toggleRole');
    
    Route::get('/messages', [ContactController::class, 'index'])->name('messages');

    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::resource('tags', TagController::class)->except(['show']);
});

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'storeContact'])->name('contact.store');




require __DIR__.'/auth.php';

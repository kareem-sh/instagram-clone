<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Import the trait

class PostController extends Controller
{
    use AuthorizesRequests; // Use the trait

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ids = Auth::user()->following()->wherePivot('confirmed', true)->get()->pluck('id');
        $posts = Post::whereIn('user_id', $ids)->latest()->get();
        $suggested_users = Auth::user()->suggested_user();  
        return view('posts.index', compact(['posts', 'suggested_users']));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',
            'image' => ['mimes:png,jpg,gif,jpeg', 'required']
        ]);

        $image = $request['image']->store('posts', 'public');

        $data['image'] = $image;
        $data['slug'] = Str::random(10);
        $data['user_id'] = Auth::user()->id;
        Post::create($data);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post); // Use authorize method directly
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post); // Use authorize method directly

        $data = $request->validate([
            'description' => 'required',
            'image' => ['nullable', 'mimes:png,jpg,jpeg,gif']
        ]);
        
        if ($request->has('image')) {
            $image = $request['image']->store('posts', 'public');
            $data['image'] = $image;
        }

        $post->update($data);
        
        return redirect('/p/' . $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); // Use authorize method directly
        if (Storage::exists('public/' . $post->image)) {
            Storage::delete('public/' . $post->image);
        }
        
        $post->deleteOrFail();
        return redirect(url('/'));
    }

    public function explore()
    {
        $posts = Post::whereRelation('owner', 'private_account', '=', 0)
            ->whereNot('user_id', Auth::user()->id)
            ->simplePaginate(12);
        
        return view('posts.explore', compact('posts'));
    }
}

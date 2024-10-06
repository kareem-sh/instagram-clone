<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class LikeController extends Controller
{
    public function __invoke(Post $post){
        Auth::user()->likes()->toggle($post);
        return back();
    }
}

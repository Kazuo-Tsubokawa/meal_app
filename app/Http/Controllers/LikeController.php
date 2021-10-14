<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post, Request $request, Like $like)
    {
        //二重登録問題
        $request->session()->regenerateToken();
        $like = new Like();
        $like->post_id = $post->id;
        $like->user_id = Auth::user()->id;

        $like->save();

        return redirect()
            ->route('posts.show', compact('post', 'like'))
            ->with('notice', 'お気に入り登録しました');
    }

    public function destroy(Post $post, Request $request, Like $like)
    {
        $user = Auth::user()->id;
        $like = Like::where('post_id', $post->id)->where('user_id', $user)->first();
        
        $like->delete();
        
        return redirect()
            ->route('posts.show', compact('post', 'like'))
            ->with('notice', 'お気に入り削除しました');
    }

}

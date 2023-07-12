<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($key): JsonResponse
    {
        return response()
            ->json(
                Post::with('tags')
                    ->where('posts.user_id', intval($key))
                    ->get()
            );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): JsonResponse
    {
        $new_post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id
        ]);

        if (count($request->tags))
        {
            for ($i = 0; $i < count($request->tags); $i++)
            {
                $tag = Tag::where('name', $request->tags[$i])->get()->all();
                if (!$tag)
                {
                    $tag = [Tag::create(['name' => $request->tags[$i]])];
                }

                $new_post_tag = DB::table('post_tag')->insert([
                    'post_id' => $new_post->id,
                    'tag_id' => $tag[0]->id
                ]);
            }
        }

        return response()->json('Post saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}

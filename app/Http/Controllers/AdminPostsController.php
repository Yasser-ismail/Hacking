<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\AdminPostsRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
            // Ignores notices and reports all other kinds... and warnings
            error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
            // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
        }

        $posts = Post::paginate(2);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
            // Ignores notices and reports all other kinds... and warnings
            error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
            // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
        }

        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminPostsRequest $request)
    {
        $user = Auth::user();
        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = '/images/'. time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['path'=>$name]);
            $input['photo_id'] = $photo->id;
        }


        Session::flash('created_post', 'Post has been created');

        $user->posts()->create($input);

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminPostsRequest $request, $id)
    {
        $input = $request->all();
        if($file = $request->file('photo_id')){
            $name = '/images/' . time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['path'=>$name]);

            $input['photo_id'] = $photo->id;
        }


        if (is_null(Auth::user()->posts()->whereId($id)->first())) {

            Session::flash('not_owner', 'You can update your posts only!');

            return redirect('/posts');
            // it's null, redirect or do something
        } else {
            // It's not null, update the post
            Auth::user()->posts()->whereId($id)->first()->update($input);

            Session::flash('updated_post', 'Post has been updated!');

            return redirect('/posts');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->IsAdmin() || !is_null(Auth::user()->posts->where('id', $id)->first())){

            $post = Post::findOrFail($id);

                if($post->photo){
                    $post->photo->delete();
                    unlink(public_path(). $post->photo->path);
                }


            $post->delete();


            Session::flash('deleted_post', 'Post has been deleted');

            return redirect('/posts');
        }else{
            Session::flash('not_admin', 'Admin Or Auther Can only delete the post!');

            return redirect('/posts');
        }

    }

    public function post($slug){

        $post = Post::findBySlugOrFail($slug);

        return view('post', compact('post'));
    }
}

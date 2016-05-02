<?php

namespace App\Http\Controllers;

use File;
use Auth;
use App\Tag;
use App\Post;
use App\Picture;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return view('admin.post.index', compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        $categories = Category::lists('title', 'id');
        $tags = Tag::lists('name', 'id');
        $post = new Post;
        $userId = Auth::user()->id;
        $picture = Picture::lists('name', 'id');

        return view('admin.post.create', compact('categories', 'tags', 'userId', 'post', 'picture'));

    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());

        if (!empty($request->input('tag_id')))
            $post->tags()->attach($request->input('tag_id'));

        $this->upload($request, $post);


        return redirect('post')->with('message', 'success');
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = Category::lists('title', 'id');
        $tags = Tag::lists('name', 'id');
        $post = Post::find($id);
        $userId = Auth::user()->id;

        return view('admin.post.edit', compact('post', 'categories', 'tags', 'userId', 'picture'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        $tags = $request->input('tag_id');

        $tags = !empty($tags) ? $tags : [];

        $post->tags()->sync($tags);

        $message[] = 'success update post';

        $img = $request->file('picture');
        if (!is_null($img)) {
            $this->deletePicture($post);
            $this->upload($request->input('name'), $img, $post->id);
            $message[] = 'success change image';
        }

        if (!is_null($request->input('deletePicture'))) {
            $this->deletePicture($post);
        }

        return redirect('post')->with(['message' => $message]);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $title = $post->title;
        $post->delete();

        return redirect('post')->with(['message' => sprintf('L\'article à bien été supprimé', $title)]);
    }

    /**
     * @param Post $post
     * @return bool
     */
    private function deletePicture(Post $post)
    {
        if (!is_null($post->picture)) {
            $picture = Picture::findOrFail($post->picture->id);
            $fileName = env('UPLOAD_PICTURES', 'uploads') . DIRECTORY_SEPARATOR . $post->picture->uri;
            if (File::exists($fileName))
                File::delete($fileName);
            $picture->delete();

        }
    }

    /**
     * @param $name
     * @param $img
     * @param $postId
     * @return bool
     */
    private function upload($name, $img, $postId)
    {

        $ext = $img->getClientOriginalExtension();
        $uri = str_random(50) . '.' . $ext;
        Picture::create([
            'name' => $name,
            'uri' => $uri,
            'size' => $img->getSize(),
            'mime' => $img->getClientMimeType(),
            'post_id' => $postId,

        ]);
        $img->move(env('UPLOAD_PICTURES', 'uploads'), $uri);

        return true;

    }
}
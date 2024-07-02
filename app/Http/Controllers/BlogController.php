<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Http\Requests\SearchBlogRequest;
use App\Http\Services\BlogService;
use App\Http\Services\ElasticService;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{

    public function __construct(protected BlogService $blogService, protected ElasticService $elasticService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $blogs = Blog::paginate(10);
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $createdBlog = $this->blogService->insertBlog($request->all());
            $url = url('/blogs/'. $createdBlog->id);
            $this->elasticService->upsertElasticBlog($request->all(), $createdBlog->id,$url);

            //
//            $this->elasticService->writeLogElastic();
            DB::commit();
        } catch (\Exception $e){
             Log::error($e->getMessage());
             DB::rollBack();
        }

        return redirect()->route('blog.create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blogContent = Blog::find($id);
        if(!$blogContent){
            return abort(Response::HTTP_NOT_FOUND,'THIS BLOG NOT FOUND');
        }
        return view('blogs.show', compact('blogContent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //        Blog::truncate();
        DB::beginTransaction();
        try {
            Blog::find($id)->delete();
            $this->elasticService->deleteDocument('blog_index',$id);
            DB::commit();
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            DB::rollBack();
        }

        return redirect()->route('blog.index');
    }

    public function searchBlog(Request $request){
        if($request['search'] && $request['search'] !== ''){
            $data = $this->elasticService->searchBlog($request->all());
            $blogs = $this->blogService->convertElasticBlog($data);
            return view('blogs.index', compact('blogs'));
        }
        $blogs = $this->blogService->getAll();
        return view('blogs.index', compact('blogs'));

    }
}

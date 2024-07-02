<?php


namespace App\Http\Services;


use App\Models\Blog;
use Elastic\Elasticsearch\ClientBuilder;

class BlogService
{
    public function __construct(protected ElasticService $elasticService)
    {

    }

    public function getAll()
    {
        return Blog::all();
    }

    public function insertBlog($data)
    {
        $insertData = [
            'title' => $data['title'],
            'content' => $data['content']
        ];
        return Blog::create($insertData);
    }


    public function updateBlog($data, $id)
    {
        Blog::find($id)->update($data);
        $url = url('/blogs/' . $id);
        //immediately update elastic blog
        $this->elasticService->upsertElasticBlog($data, $id, $url);
    }

    public function convertElasticBlog($data)
    {
        $dataArr = $data['hits']['hits'];
        $converted = [];
        foreach ($dataArr as $value) {
            $converted[] = [
                'id' => $value['_id'],
                'content' => $value['_source']['content'],
                'title' => $value['_source']['title']
            ];
        }
        return $converted;
    }

}

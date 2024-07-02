<?php


namespace App\Http\Services;
use Elastic\Elasticsearch\ClientBuilder;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ElasticService
{
    protected $client;
    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts(['https://f010002969e64d638214be28d0711d76.us-central1.gcp.cloud.es.io:443'])
            ->setApiKey('Sl9mVVY1QUJHQ1RGM2ZiVjFKamg6dTJsUXVqUDBSNGlkZEh1ZjhlNF8zdw==')
            ->build();
    }

    public function upsertElasticBlog($data, $id, $url = null)
    {
        $params = [
            'index' => 'blog_index',
            'id' => $id,
            'body' => [
                'content' => $data['content'],
                'title' => $data['title'],
                'blog_url' => $url
            ]
        ];


        //index a document
        $response = $this->client->index($params);

        return $response->getStatusCode();
//        dd($client->get($params)->asArray());

//        dd($response->asArray());



//        echo $response->getStatusCode();
//        echo $response->getBody();
    }


    public function deleteDocument($index,$id){
        if($index && $id){
            $params = [
                'index' => $index,
                'id'    => $id
            ];

            $this->client->delete($params);
            return true;
        }

        return false;
    }


    public function searchBlog($data){
//        $params_search = [
//            'index' => 'blog_index', //your index
//            'body'  => [
//                'query' => [
//                    'match' => [
//                        'content' => $data['search']
//                    ]
//                ]
//            ]
//        ];

        $params_search = [
            'index' => 'blog_index', //your index
            'body'  => [
                'query' => [
                    'multi_match' => [
                        'query' => $data['search'],
                        'fields' => ['title','content']
                    ]
                ],
                //enable highlight
                'highlight' => [
                    'number_of_fragments' => 5,
                    'fragment_size' => 100,
                    'require_field_match' => 'true',
                    'fields' => [
                        'content' => [
                            'number_of_fragments' => 4
                        ]
                    ]
                ]
            ]
        ];

        $search = $this->client->search($params_search);

        return $search->asArray();
    }

    public function writeLogElastic(){
        $logger = new Logger('blog_log');
        $logger->pushHandler(new StreamHandler('storage/blog/blogs.log', Logger::WARNING));

        $client = ClientBuilder::create()
            ->setLogger($logger)
            ->build();
    }
}

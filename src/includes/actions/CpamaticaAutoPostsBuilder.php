<?php

namespace CAP\actions;

use CAP\CpamaticaAutoPosts;
use CAP\Exception\ExceptionHttpResponse;
use CAP\helpers\CreateCategory;
use CAP\helpers\CreateFeatureImage;
use CAP\helpers\CreateMetafield;
use CAP\helpers\CreatePost;
use CAP\http\HttpCurl;

class CpamaticaAutoPostsBuilder
{
    /**
     * Posts service | uploaded
     *
     * @var array
     */
    public $dataService, $dataUploaded;

    public function __construct()
    {
        try {
            $this->dataService = $this->getServicePost();
            $this->dataUploaded = $this->createPosts();
        } catch (ExceptionHttpResponse $e) {
            throw new ExceptionHttpResponse($e->getMessage());
        }
    }

    private function getServicePost()
    {
        $postService = new HttpCurl();
        $postService->setJsonParse(true);
        $postService->setContentType('application/json');
        $postService->setUrl("https://my.api.mockaroo.com/posts.json");
        try {
            return $postService->query(array('key' => 'X-API-Key', 'val' => '413dfbf0'));
        } catch (ExceptionHttpResponse $e) {
            throw new ExceptionHttpResponse($e->getMessage());
        }
    }

    private function createPosts(): array
    {
        $uploadedData = [];
        foreach ($this->dataService as $servicePost) {
            // Filter Append by title
            $titlePost = wp_strip_all_tags($servicePost->title);
            $findPostByTitle = get_posts(array('title' => wp_strip_all_tags($titlePost), 'numberposts' => 1, 'post_type' => CpamaticaAutoPosts::getInstance()->settings['post_type']));
            if (!empty($findPostByTitle)) {
                break;
            }

            // Find category
            $filterByCategory  = get_term_by('name', $servicePost->category, 'category');
            $categoryId = !empty($filterByCategory)
                ? $filterByCategory->term_id
                : (new CreateCategory($servicePost->category))->insert();

            $buildPost = array("category_id" => $categoryId);

            // Create Post
            $createPost = new CreatePost();
            $createPost->setTitle($titlePost);
            $createPost->setContent($servicePost->content);
            $createPost->setCategory($categoryId);
            $createdPost = $createPost->insert();
            $buildPost = array_merge($buildPost, array('post_id' => $createdPost));

            // Append Feature Image
            $createImage = new CreateFeatureImage($createdPost, $titlePost);
            $createImage->setImageUrl($servicePost->image);
            $createdImage = $createImage->insert();
            $createImage->updateThumbPost($createdImage);
            $buildPost = array_merge($buildPost, array('post_thumbnail' => $createdImage));

            if (!empty($servicePost->rating)) {
                $ratingField = new CreateMetafield($createdPost);
                $round = round($servicePost->rating, 2);
                $ratingFieldRes = $ratingField->update('rating', $round);
                if ($ratingFieldRes) {
                    $round = round($servicePost->rating, 2);
                    $buildPost = array_merge($buildPost, array('meta_rating' => $round));
                }
            }


            // Append Rating
            $uploadedData[] = $buildPost;
        }
        return $uploadedData;
    }
}

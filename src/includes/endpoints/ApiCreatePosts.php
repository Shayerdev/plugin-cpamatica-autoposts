<?php

namespace CAP\endpoint;

use CAP\actions\CpamaticaAutoPostsBuilder;
use CAP\CpamaticaAutoPosts;
use CAP\Exception\ExceptionHttpResponse;
use CAP\helpers\CreateEndpoint;

class ApiCreatePosts extends CreateEndpoint
{
    public function __construct($slug, $version, $endpoint, $method = 'GET')
    {
        parent::__construct($slug, $version, $endpoint, array($this, 'callback'), [], $method);
    }

    public function callback(\WP_REST_Request $request)
    {
        // Verify user
        $userKey = $request->get_param('key');
        $secretKey = CpamaticaAutoPosts::getInstance()->settings['secret_api_phrase'];
        if (empty($userKey) || $secretKey !== $userKey) {
            return new \WP_Error('key_anvalid', 'Key access is invalid', array( 'status' => 401 ));
        }
        try {
            // Init Posts builder
            $wpResponse = new CpamaticaAutoPostsBuilder();
        } catch (ExceptionHttpResponse | \Exception $e) {
            return new \WP_Error('posts_fetch_invalid', $e->getMessage(), array( 'status' => 200 ));
        }
        return new \WP_REST_Response($wpResponse->dataUploaded, 200);
    }
}

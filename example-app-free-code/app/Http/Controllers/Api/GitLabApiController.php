<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GitLabApiController extends Controller
{
    /** @var Request */
    protected $request;
    private $apiService;

    /**
     * CommentsController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request, GitLabApiService $apiService)
    {
        parent::__construct($request);
        $this->request = $request;
        $this->apiService = $apiService;
    }

    /**
     * Show the application dashboard.
     * Request body should be like:
     * {
     *     "authHttpToken": "your_http_token_here"
     * }
     *
     * @return array
     */
    public function getProjects(Request $request) {
        Log::info("[GET] Executed /projects: ");

        $authHttpToken = $request->input('authHttpToken');
        $response = $this->apiService->getProjects($authHttpToken, []);

        return [
            'status' => 'OK',
            'response' => $response,
        ];
    }
}

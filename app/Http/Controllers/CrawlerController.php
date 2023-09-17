<?php

namespace App\Http\Controllers;

use App\Services\CrawlingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CrawlerController extends Controller
{
    protected $crawlingService;

    public function __construct(CrawlingService $crawlingService)
    {
        $this->crawlingService = $crawlingService;
    }

    public function crawl(Request $request)
    {
        // Define your validation rules
        $rules = [
            'url' => 'required|string',
            'depth' => 'required|integer',
            'crawl_again' => 'boolean',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $url = $request->url;
            $depth = $request->depth;
            $crawl_again = $request->crawl_again;
            // Call the CrawlingService to crawl the URL
            $response = $this->crawlingService->crawl($url, $depth, $crawl_again);

            return response()->json($response, 200);
        } catch (\Exception $e) {
            // Handle the exception and log the error
            Log::error('Crawling error: ' . $e->getMessage());
            return response()->json(['message' => 'Crawling failed. Please check the logs for details']);
        }
    }
}

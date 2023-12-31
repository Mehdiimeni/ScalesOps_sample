<?php

namespace App\Http\Controllers;

use App\Models\SearchImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{
    protected $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function downloadAndSaveImages(Request $request)
    {
        $searchQuery = $request->input('searchQuery');
        $maxImages = 5;

        $response = $this->httpClient->get("https://www.googleapis.com/customsearch/v1?q={$searchQuery}&key=YOUR_API_KEY&cx=YOUR_CUSTOM_SEARCH_ENGINE_ID&searchType=image");
        $imageResults = $response->json('items');

        collect($imageResults)->take($maxImages)->each(function ($imageResult) {
            $imageUrl = $imageResult['link'];
            $imageData = $this->httpClient->get($imageUrl)->getBody()->getContents();
            $imageResized = imagescale(imagecreatefromstring($imageData), 1024);

            ob_start();
            imagejpeg($imageResized, NULL, 85);
            $resizedImageString = ob_get_clean();

            SearchImage::create(['image_data' => $resizedImageString]);
        });

        return "Images downloaded and saved successfully.";
    }
}


<?php

namespace App\Http\Controllers\Api;

use App\Artwork;
use App\Http\Controllers\ApiController;
use App\Http\Requests\ArtworkRequest;
use App\Http\Resources\Artwork as ArtworkResource;
use App\Image;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends ApiController
{
    public function index()
    {
        $artworks = Artwork::all();

        return $this->successResponse(ArtworkResource::collection($artworks));
    }

    public function show($id)
    {
        $artwork = Artwork::findOrFail($id);

        return $this->successResponse(new ArtworkResource($artwork));
    }

    public function store(ArtworkRequest $request)
    {
        try {
            $artworkData = $request->data['artwork'];

            $artworkArray = [
                'name' => $artworkData['name'],
                'origin' => $artworkData['origin'],
                'text1' => $artworkData['text1'],
                'highlighted_text' => $artworkData['highlightedText'],
                'text2' => $artworkData['text2'],
                'text3' => $artworkData['text3'],
                'text4' => $artworkData['text4'],
                'width' => $artworkData['width'],
                'height' => $artworkData['height'],
                'depth' => $artworkData['depth'],
                'sku' => $artworkData['sku'],
                'price_in_cents' => $artworkData['price'] * 100,
                'for_sale' => $artworkData['forSale'],
            ];

            $filesArray = [];

            foreach ($request->files->get('carouselImages') as $key => $value) {
                $path = Storage::putFileAs(
                    'artworks/' . $artworkArray['sku'] . '/carousel',
                    $value,
                    $artworkArray['sku'] . '-' . 'carousel-' . $key . '.jpg',
                    'public'
                );

                array_push($filesArray, [
                    'display' => 'carousel',
                    'url' => $path
                ]);
            }

            $path = Storage::putFileAs(
                'artworks/' . $artworkArray['sku'] . '/cover',
                $request->files->get('coverImage'),
                $artworkArray['sku'] . '-' . 'cover.jpg',
                'public'
            );

            array_push($filesArray, [
                'display' => 'cover',
                'url' => $path
            ]);

            foreach ($request->files->get('flyerImages') as $key => $value) {
                $path = Storage::putFileAs(
                    'artworks/' . $artworkArray['sku'] . '/flyer',
                    $value,
                    $artworkArray['sku'] . '-' . 'flyer-' . $key . '.jpg',
                    'public'
                );

                array_push($filesArray, [
                    'display' => 'flyer',
                    'url' => $path
                ]);
            }

            $artwork = Artwork::create($artworkArray);

            foreach ($filesArray as $key => $value) {
                $uploadedImage = new Image;
                $uploadedImage->display = $value['display'];
                $uploadedImage->url = $value['url'];
                $uploadedImage->imageable()->associate($artwork);
                $uploadedImage->save();
            }
        } catch (Throwable $e) {
            return 'hi';
        }

        return $this->successResponse(new ArtworkResource($artwork));
    }

    public function update(ArtworkRequest $request, Artwork $artwork)
    {
        $artworkData = $request->data['artwork'];

        $artworkArray = [
            'name' => $artworkData['name'],
            'origin' => $artworkData['origin'],
            'text1' => $artworkData['text1'],
            'highlighted_text' => $artworkData['highlightedText'],
            'text2' => $artworkData['text2'],
            'text3' => $artworkData['text3'],
            'text4' => $artworkData['text4'],
            'width' => $artworkData['width'],
            'height' => $artworkData['height'],
            'depth' => $artworkData['depth'],
            'price_in_cents' => $artworkData['price'] * 100,
            'for_sale' => $artworkData['forSale'],
        ];

        $artwork->update($artworkArray);

        return $this->successResponse(new ArtworkResource($artwork));
    }

    public function delete($id)
    {
        $artwork = Artwork::find($id);

        if (is_null($artwork)) {
            return response()->json([
                'errors' => [
                    'id' => [
                        'The artwork being deleted does not exist in the database.'
                    ]
                ],
            ], 422);
        } else {
            $artwork->delete();
            $success = "Artwork successfully deleted.";
        }

        return response()->json([
            'messages' => [
                'success' => $success,
            ]
        ], 200);
    }
}

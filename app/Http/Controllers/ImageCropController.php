<?php

namespace App\Http\Controllers;

use App\Contracts\FileExternalServiceInterface;
use App\Http\Requests\ImageCropStoreFormRequest;
use App\Services\TinyImageCropService;

/**
 * Class ImageCropController
 * @package App\Http\Controllers
 */
class ImageCropController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * @param TinyImageCropService $tinyImageCropService
     * @param ImageCropStoreFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(
        FileExternalServiceInterface $imageCropService,
        ImageCropStoreFormRequest $request
    )
    {
        try {
            return redirect()->back()
                ->with(
                    'messageSuccess',
                    $imageCropService->cropImage($request->getDto()->image)
                );
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('messageError', $e->getMessage());
        }
    }
}

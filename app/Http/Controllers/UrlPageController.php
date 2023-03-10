<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlPageRequest;
use App\Http\Requests\UpdateUrlPageRequest;
use App\Models\UrlPage;
use App\Services\UrlPage\UrlPageService;
use App\Services\Configuration\ConfigurationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UrlPageController extends Controller
{
    public $adminUrl = 'QCMGUKAXRT';

    /**
     * Админская URL
     */
    public function admin()
    {
        $service = UrlPageService::getInstance();
        $serviceConfigurations = ConfigurationService::getInstance();

        $service->setProperties($this->adminUrl);

        return view('admin.index', [
            'service' => $service,
            'serviceConfigurations' => $serviceConfigurations,
        ]);
    }

    /**
     * Админская URL
     */
    public function show(string $url)
    {
        $service = UrlPageService::getInstance();
        $serviceConfigurations = ConfigurationService::getInstance();

        $service->setProperties($url);
        $model = UrlPage::where('url', $url)->first();

        return view('user.index', [
            'service' => $service,
            'serviceConfigurations' => $serviceConfigurations,
        ]);
    }

    public function change(Request $request): JsonResponse
    {
        $model = UrlPage::where('url', $request->url)->first();

        if (request()->has('phone')) {
            $model->phone = $request->phone;
        }

        $model->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function generateUrl(Request $request): JsonResponse
    {
        $service = UrlPageService::getInstance();
        $service->generateUniqueUrl(1, $request->url);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
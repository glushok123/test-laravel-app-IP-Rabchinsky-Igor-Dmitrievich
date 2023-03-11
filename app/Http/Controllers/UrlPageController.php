<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlPageRequest;
use App\Http\Requests\UpdateUrlPageRequest;
use App\Models\UrlPage;
use App\Services\UrlPage\UrlPageService;
use App\Services\Configuration\ConfigurationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Configuration;

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
        $model = UrlPage::where('url', $this->adminUrl)->first();

        return view('admin.index', [
            'service' => $service,
            'serviceConfigurations' => $serviceConfigurations,
            'model' => $model,
        ]);
    }

    /**
     * Админская URL
     */
    public function show(string $url)
    {
        if (UrlPage::where('url', $url)->exists() == false) {
            abort(404);
        }

        $service = UrlPageService::getInstance();
        $serviceConfigurations = ConfigurationService::getInstance();
        $service->setProperties($url);

        $model = UrlPage::where('url', $url)->first();

        if ($model->time_first_open_url == null) {
            $model->time_first_open_url = new \DateTime();
            $model->save();
        }

        return view('user.index', [
            'service' => $service,
            'serviceConfigurations' => $serviceConfigurations,
            'model' => $model,
        ]);
    }

    /**
     * Изменение атрибутов
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function change(Request $request): JsonResponse
    {
        $model = UrlPage::where('url', $request->url)->first();

        if (request()->has('phone')) {
            if (UrlPage::where('phone', $request->phone)->where('url', '<>', $request->url)->exists() == true) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Номер телефона уже используется, попробуйте ввести другой номер телефона',
                ]);
            }
            $model->phone = $request->phone;
        }

        if (request()->has('city')) {
            $model->city = $request->city;
        }

        if (request()->has('age')) {
            $model->age = $request->age;
        }

        if (request()->has('work')) {
            $model->work = $request->work;
        }

        if (request()->has('floor')) {
            $model->floor = $request->floor;
        }

        if (request()->has('payment_method')) {
            $model->payment_method = $request->payment_method;
        }

        $model->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Генерация url для админа
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function generateUrl(Request $request): JsonResponse
    {
        $service = UrlPageService::getInstance();
        $service->generateUniqueUrl(1, $request->url);
        $array = $service->getUniqueUrl();

        return response()->json([
            'status' => 'success',
            'array' => $array,
        ]);
    }

    /**
     * Генерация url для пользователей
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function generateUrlForUser(Request $request): JsonResponse
    {
        $service = UrlPageService::getInstance();
        $count = (int) Configuration::where('name', 'KOLSYL')->value('value');
        $service->generateUniqueUrl($count, $request->url);
        $array = $service->getUniqueUrl();
        $model = UrlPage::where('url', $request->url)->first();

        if ($model->time_payment == null) {
            $model->time_payment = new \DateTime();
            $model->save();
        }

        return response()->json([
            'status' => 'success',
            'array' => $array,
        ]);
    }

    /**
     * Сохранение комментария дочернего url
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function saveCommentUrl(Request $request): JsonResponse
    {
        $model = UrlPage::where('url', $request->url)->first();

        $model->comment = $request->comment;
        $model->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Активация url
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function activeUrl(Request $request): JsonResponse
    {
        $service = UrlPageService::getInstance();
        $model = UrlPage::where('url', $request->url)->first();
        $model->time_active = new \DateTime();
        $model->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Кнопка СТАРТ, очистка таблицы
     * 
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function startInit(Request $request): JsonResponse
    {
        $model = UrlPage::where('url', $this->adminUrl)->first();
        $phone = $model->phone;
        $payment_method = $model->payment_method;

        UrlPage::truncate();

        $model = new UrlPage();
        $model->url = $this->adminUrl;
        $model->phone = $phone;
        $model->payment_method = $payment_method;
        $model->save();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
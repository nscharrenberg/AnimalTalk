<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TranslationService;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    private TranslationService $service;
    public function __construct(TranslationService $service)
    {
        $this->service = $service;
    }

    public function getLanguages(Request $request) {
        $from = $request->query('from');

        if (isset($from)) {
            $languages = $this->service->getTranslateableLanguages($from);
        } else {
            $languages = $this->service->getOriginLanguages();
        }

        return response($languages, 200);
    }
}

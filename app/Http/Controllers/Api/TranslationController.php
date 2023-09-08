<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TranslationRequest;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TranslationController extends Controller
{
    private TranslationService $service;
    public function __construct(TranslationService $service)
    {
        $this->service = $service;
    }

    public function getLanguages(Request $request): Response {
        $from = $request->query('from');

        if (isset($from)) {
            if ($from === "auto") {
                $languages = $this->service->getLanguages();
            } else {
                $languages = $this->service->getTranslateableLanguages($from);
            }
        } else {
            $languages = ["auto"];
            $languages = array_merge($languages, $this->service->getOriginLanguages());
        }

        return response([
            "languages" => $languages
        ], 200);
    }

    public function translate(TranslationRequest $request): Response {
        $validated = $request->validated();
        $validated = $request->safe()->only(['text', 'drunk', 'from', 'to']);

        $isDrunk = isset($validated['drunk']) && $validated['drunk'];

        try {
            return \response($this->service->translate($validated['text'], $validated['to'], $validated['from'], $isDrunk), 200);
        } catch (\Exception $exception) {
            return response([
                "error" => $exception->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Middleware;

use App\Services\LocalisationService\LocalisationToggleService;
use \Illuminate\Http\Request;
use Closure;

class Localisation
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next)
    {
        $toggleService = new LocalisationToggleService();

        $toggleService->setRequest($request);
        $toggleService->setNext($next);

        return $toggleService->resolve();
    }
}

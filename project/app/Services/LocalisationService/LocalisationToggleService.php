<?php

namespace App\Services\LocalisationService;

use App\Languages;
use Closure;
use \Illuminate\Http\Request;

class LocalisationToggleService
{
    const RU_LANG = 'ru';
    const EN_LANG = 'en';

    const DEFAULT_LANG = self::RU_LANG;

    /** @var Request */
    protected $request;

    /** @var Closure */
    protected $next;

    static private $sessionKey = 'current_language';

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Closure
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param Closure $next
     */
    public function setNext(Closure $next)
    {
        $this->next = $next;
    }

    /**
     * @return mixed
     */
    public function returnNext()
    {
        $next = $this->getNext();

        return $next($this->request);
    }

    /**
     * @return Languages[]
     */
    public static function getLanguages()
    {
        if (!\Schema::hasTable('languages')) {
            return [];
        }

        return Languages::all();
    }

    /**
     * @param $segment
     * @return bool
     */
    public function isLanguage($segment)
    {
        foreach (self::getLanguages() as $language) {
            if ($segment === $language->code) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $language
     * @return bool
     */
    public function isDefaultLanguage($language): bool
    {
        return $language === self::DEFAULT_LANG;
    }

    public function initLanguage($language = null)
    {
        $language = $this->isLanguage($language) ? $language : self::DEFAULT_LANG;

        session()->put(self::$sessionKey, $language);
        app()->setLocale($language);
    }

    /**
     * @return string|null
     */
    public function getSessionLanguage()
    {
        $language = session(self::$sessionKey);

        return $this->isLanguage($language) ? $language : null;
    }

    /**
     * @return string
     */
    public static function getAppLanguage()
    {
        return app()->getLocale();
    }

    /**
     * @return bool
     */
    public function isLocalisationRedirect()
    {
        $isRedirect = session()->get('is_localisation_redirect');

        if (!isset($isRedirect) || !$isRedirect) {
            return false;
        }

        return true;
    }

    /**
     * @return string|null
     */
    public function getLanguageSegment()
    {
        return \Request::segment(1);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function changeWithToggle()
    {
        $urlLanguage = $this->getLanguageSegment();
        $sessionLanguage = $this->getSessionLanguage();

        /** no change */
        if ($this->isLanguage($urlLanguage) && $this->isLanguage($sessionLanguage) && $sessionLanguage === $urlLanguage) {
            return $this->returnNext();
        }

        if (!$this->isLanguage($urlLanguage) && $this->isDefaultLanguage($sessionLanguage)) {
            return $this->returnNext();
        }
        /** end no change */


        /** first init language */
        if (!$this->isLanguage($sessionLanguage)) {
            $this->initLanguage($this->isLanguage($urlLanguage) ? $urlLanguage : self::DEFAULT_LANG);

            return $this->returnNext();
        }

        $this->initLanguage($sessionLanguage);

        if ($this->isDefaultLanguage($sessionLanguage) && !$this->isLanguage($urlLanguage)) {
            return $this->returnNext();
        }

        $redirectUri = $this->generateUriWithSessionLanguage();

        return redirect()->to($redirectUri);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function changeWithUrl()
    {
        $urlLanguage = $this->getLanguageSegment();

        $this->initLanguage($this->isLanguage($urlLanguage) ? $urlLanguage : self::DEFAULT_LANG);

        if ($this->isDefaultLanguage($urlLanguage)) {
            $redirectUri = $this->generateUriWithSessionLanguage();

            return redirect()->to($redirectUri);
        }

        return $this->returnNext();
    }

    /**
     * @return string
     */
    public function generateUriWithSessionLanguage()
    {
        $uriLanguage = $this->getLanguageSegment();
        $sessionLanguage = $this->getSessionLanguage();

        $currentUri = request()->getRequestUri();

        if ($this->isLanguage($uriLanguage)) {
            $currentUri = trim($currentUri, '/');
            $currentUri = trim($currentUri, $uriLanguage . '/');
            $currentUri = trim($currentUri, '/');
        }

        if ($this->isLanguage($sessionLanguage) && !$this->isDefaultLanguage($sessionLanguage)) {
            $currentUri = '/' . $sessionLanguage . '/' . $currentUri;
        }

        $currentUri = str_replace('//', '/', $currentUri);

        return $currentUri;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|mixed
     * @throws \Exception
     */
    public function resolve()
    {
        if (!$this->request instanceof Request || !$this->next instanceof Closure) {
            throw new \Exception('Invalid request with localisation');
        }

        if ($this->isLocalisationRedirect()) {
            $result = $this->changeWithToggle();
        } else {
            $result = $this->changeWithUrl();
        }

        self::resetLocalisationRedirectFlag();

        return $result;
    }

    public static function setLocalisationRedirectFlag()
    {
        session()->put('is_localisation_redirect', true);
    }

    public static function resetLocalisationRedirectFlag()
    {
        session()->forget('is_localisation_redirect');
    }
}

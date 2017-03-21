<?php

namespace pxgamer\Minimin\Routes;

use pxgamer\Minimin\Plugins;
use pxgamer\Minimin\Smarter;

/**
 * Class Store
 * @package pxgamer\Minimin\Routes
 */
class Store
{
    const STORE_PACKAGE_URL = 'https://packagist.org/search.json?tags=minimin-package';

    /**
     * @var \Smarty
     */
    public $S;

    /**
     * Store constructor.
     */
    public function __construct()
    {
        $this->S = Smarter::get();
    }

    public function index()
    {
        $this->S->display(
            'store/index.tpl',
            [
                'available' => $this->getPackages()->results,
                'installed' => Plugins::get()
            ]
        );
    }

    public function search()
    {

    }

    /**
     * @param null|string $search_query
     * @return mixed
     */
    private function getPackages($search_query = null)
    {
        $url = self::STORE_PACKAGE_URL . ($search_query ? '&q=' . urlencode($search_query) : '');
        $cu = curl_init();
        curl_setopt_array(
            $cu,
            [
                CURLOPT_URL => $url,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_RETURNTRANSFER => true
            ]
        );
        return json_decode(curl_exec($cu));
    }
}
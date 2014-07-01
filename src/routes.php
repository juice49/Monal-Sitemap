<?php namespace Ash\MonalSitemap;

use Route, Request, Config;

$filename = Config::get('monal-sitemap::filename');

Route::get($filename . '.xml', __NAMESPACE__ . '\Controllers\SitemapController@getXMLIndex');
Route::get($filename, __NAMESPACE__ . '\Controllers\SitemapController@getIndex');
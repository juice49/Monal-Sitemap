<?php namespace Ash\MonalSitemap\Controllers;




use App, BaseController, Response;




class SitemapController extends BaseController {
	
	
	
	
	public function getXMLIndex() {
		$sitemap = App::make('sitemap');
		return Response::make($sitemap->xml(), 200, [ 'Content-Type' => 'application/xml' ]);
	}
	
	
	
	
	public function getIndex() {
		$sitemap = App::make('sitemap');
		return $sitemap->html();
	}
	
	
	
	
	
}
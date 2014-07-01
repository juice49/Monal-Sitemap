<?php namespace Ash\MonalSitemap;




use Illuminate\Support\ServiceProvider, App, Config;




class MonalSitemapServiceProvider extends ServiceProvider {




	protected $defer = false;




	public function boot() {
		$this->package('ash/monal-sitemap');
		require(__DIR__ . '/../../routes.php');
	}




	public function register() {

		App::singleton('sitemap', function() {
			return new Models\Sitemap;
		});

		App::bind('SitemapEntity', function() {
			return new Models\Entity;
		});

		App::bind('SitemapCollection', function() {
			return new Models\Collection;
		});

	}




	public function provides() {
		return array();
	}




}
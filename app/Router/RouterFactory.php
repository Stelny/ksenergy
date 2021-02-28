<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Routing\Route;

final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;

       /* */

       


        /* ADMIN */
        $admin = new RouteList('Admin');

		$admin[] = new Route('admin/<presenter>/<action>[/<id>]', array(
            'presenter' => 'Dashboard',
            'action' => 'default',
        ));


        /* FRONT */
		$front = new RouteList('Front');

        $front[] = new Route('akumulace-do-baterii/<name>', array(
            'presenter' => 'MainPages',
            'action' => 'default',
            'category' => 'akumulace-do-baterii',
        ));

        $front[] = new Route('kontakt', array(
            'presenter' => 'Contact',
            'action' => 'default',
        ));

        $front[] = new Route('tepelna-cerpadla', array(
            'presenter' => 'MainPages',
            'action' => 'cerpadlo',
            'category' => 'akumulace-do-baterii',
        ));

        $front[] = new Route('blog/<name>', array(
            'presenter' => 'Blog',
            'action' => 'detail',
        ));

        $front[] = new Route('blog', array(
            'presenter' => 'Blog',
            'action' => 'default',
        ));


        $front[] = new Route('ohrev-teple-vody/<name>', array(
            'presenter' => 'MainPages',
            'action' => 'default',
            'category' => 'ohrev-teple-vody',
        ));

        $front[] = new Route('<presenter>/<action>', array(
            'presenter' => 'Homepage',
            'action' => 'default',
        ));



		$router[] = $admin;
		$router[] = $front;


        return $router;
	}
}

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

        $router[] = new Route('ohrev-teple-vody/<name>', array(
            'presenter' => 'MainPages',
            'action' => 'default',
            'category' => 'ohrev-teple-vody',
        ));

        $router[] = new Route('akumulace-do-baterii/<name>', array(
            'presenter' => 'MainPages',
            'action' => 'default',
            'category' => 'akumulace-do-baterii',
        ));

        $router[] = new Route('<presenter>/<action>', array(
            'presenter' => 'Homepage',
            'action' => 'default',
        ));

		


        return $router;
	}
}

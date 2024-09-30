<?php

declare(strict_types=1);

namespace Light\Page;

use Fig\Http\Message\RequestMethodInterface;
use Light\Page\Controller\PageController;
use Mezzio\Application;
use Psr\Container\ContainerInterface;

class RoutesDelegator
{
    public function __invoke(ContainerInterface $container, string $serviceName, callable $callback): Application
    {
        /** @var Application $app */
        $app = $callback();

        $app->get('/', [PageController::class], 'home');

        $app->route(
            '/page[/{action}]',
            [PageController::class],
            [RequestMethodInterface::METHOD_GET, RequestMethodInterface::METHOD_POST],
            'page'
        );

        return $app;
    }
}

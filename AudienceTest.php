<?php

declare(strict_types=1);

namespace Drupal\mymodule\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\RouteCollection;
use Drupal\Core\Routing\RoutingEvents;
use Drupal\Core\Routing\RouteBuildEvent;

/**
 * Alters routes for block content.
 */
final class RouteAlterSubscriber implements EventSubscriberInterface {

  /**
   * Alters existing routes.
   */
  public function onAlterRoutes(RouteBuildEvent $event): void {
    $collection = $event->getRouteCollection();
    if (!$collection instanceof RouteCollection) {
      return;
    }

    // Target the block content collection route.
    if ($route = $collection->get('entity.block_content.collection')) {
      // Restrict access to only 'administer block content'.
      $route->setRequirement('_permission', 'administer block content');
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents(): array {
    // The priority determines when this runs; a high number ensures it runs late.
    $events[RoutingEvents::ALTER][] = ['onAlterRoutes', -100];
    return $events;
  }

}



services:
  mymodule.route_alter_subscriber:
    class: Drupal\mymodule\EventSubscriber\RouteAlterSubscriber
    tags:
      - { name: event_subscriber }
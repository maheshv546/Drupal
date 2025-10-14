<?php

declare(strict_types=1);

namespace Drupal\mymodule\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Routing\RoutingEvents;
use Drupal\Core\Routing\RouteBuildEvent;

/**
 * Forces /admin/content/block to use only 'administer block content' permission.
 */
final class BlockRouteOverrideSubscriber implements EventSubscriberInterface {

  /**
   * Replace the route requirement.
   */
  public function onAlterRoutes(RouteBuildEvent $event): void {
    $collection = $event->getRouteCollection();
    if (!$collection->get('entity.block_content.collection')) {
      return;
    }

    $route = $collection->get('entity.block_content.collection');

    // Remove any existing permission requirement completely.
    $route->setRequirement('_permission', 'administer block content');
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents(): array {
    // Very late priority so it runs AFTER all core/contrib subscribers.
    $events[RoutingEvents::ALTER][] = ['onAlterRoutes', -1000];
    return $events;
  }

}

services:
  mymodule.block_route_override_subscriber:
    class: Drupal\mymodule\EventSubscriber\BlockRouteOverrideSubscriber
    tags:
      - { name: event_subscriber }
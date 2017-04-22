<?php

namespace Drupal\virtual_entities\Routing;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Drupal\Core\Entity\EntityManagerInterface;

/**
 * Virtual entity routes.
 */
class RoutesVirtualEntity {

  /**
   * The entity storage handler.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $entityStorage;

  /**
   * Creates an ExternalEntityRoutes object.
   *
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity manager.
   */
  public function __construct(EntityManagerInterface $entity_manager) {
    $this->entityStorage = $entity_manager->getStorage('virtual_entity_type');
  }

  /**
   * {@inheritdoc}
   */
  public function routes() {
    $route_collection = new RouteCollection();
    $first = TRUE;
    foreach ($this->entityStorage->loadMultiple() as $type) {
      if ($first) {
        $first = FALSE;
        $route = new Route(
          '/admin/content/virtual-entities',
          [
            '_controller' => '\Drupal\external_entities\Entity\Controller\ExternalEntityListController::listing',
            'entity_type' => 'external_entity',
            'bundle' => $type->id(),
            '_title' => $type->label() . ' external entities',
          ],
          [
            '_permission' => 'access virtual entities overview',
          ]
        );
        $route_collection->add('entity.virtual_entity.collection', $route);
      }
      $route = new Route(
        '/admin/content/virtual-entities/' . $type->id(),
        [
          '_controller' => '\Drupal\external_entities\Entity\Controller\ExternalEntityListController::listing',
          'entity_type' => 'external_entity',
          'bundle' => $type->id(),
          '_title' => $type->label() . ' external entities',
        ],
        [
          '_permission' => 'access virtual entities overview',
        ]
      );
      $route_collection->add('entity.virtual_entity.' . $type->id(), $route);
    }

    return $route_collection;
  }

}

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

    $route = new Route(
      '/admin/content/virtual-entities',
      [
        '_entity_list' => 'virtual_entity',
        '_title' => 'Virtual entities',
      ],
      [
        '_permission' => 'access virtual entities overview',
      ]
    );
    $route_collection->add('entity.virtual_entity.collection', $route);

    return $route_collection;
  }

}

<?php

namespace Drupal\virtual_entities\Entity;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Routing\EntityRouteProviderInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Provides routes for virtual entities.
 */
class VirtualEntityRouteProvider implements EntityRouteProviderInterface {

  /**
   * {@inheritdoc}
   */
  public function getRoutes(EntityTypeInterface $entity_type) {
    $route_collection = new RouteCollection();

    $route = (new Route('/virtual-entity/{virtual_entity}'))
      ->addDefaults([
        '_controller' => '\Drupal\node\Controller\NodeViewController::view',
        '_title_callback' => '\Drupal\node\Controller\NodeViewController::title',
      ])
      ->setRequirement('virtual_entity', '\d+')
      ->setRequirement('_entity_access', 'virtual_entity.view');
    $route_collection->add('entity.virtual_entity.canonical', $route);

    $route = (new Route('/virtual-entity/{virtual_entity}/delete'))
      ->addDefaults([
        '_entity_form' => 'virtual_entity.delete',
        '_title' => 'Delete',
      ])
      ->setRequirement('virtual_entity', '\d+')
      ->setRequirement('_entity_access', 'virtual_entity.delete')
      ->setOption('_virtual_entity_operation_route', TRUE);
    $route_collection->add('entity.virtual_entity.delete_form', $route);

    $route = (new Route('/virtual-entity/{virtual_entity}/edit'))
      ->setDefault('_entity_form', 'virtual_entity.edit')
      ->setRequirement('_entity_access', 'virtual_entity.update')
      ->setRequirement('virtual_entity', '\d+')
      ->setOption('_virtual_entity_operation_route', TRUE);
    $route_collection->add('entity.virtual_entity.edit_form', $route);

    return $route_collection;
  }

}

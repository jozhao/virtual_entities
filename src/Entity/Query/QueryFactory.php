<?php

namespace Drupal\virtual_entities\Entity\Query;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Query\QueryBase;
use Drupal\Core\Entity\Query\QueryFactoryInterface;
use GuzzleHttp\ClientInterface;

/**
 * Class QueryFactory.
 *
 * @package Drupal\virtual_entities\Entity\Query
 */
class QueryFactory implements QueryFactoryInterface {

  /**
   * The namespace of this class, the parent class etc.
   *
   * @var array
   */
  protected $namespaces;

  /**
   * The HTTP client to fetch the data with.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * QueryFactory constructor.
   *
   * @param \GuzzleHttp\ClientInterface $http_client
   *   GuzzleHttp client.
   */
  public function __construct(ClientInterface $http_client) {
    $this->namespaces = QueryBase::getNamespaces($this);
    $this->httpClient = $http_client;
  }

  /**
   * {@inheritdoc}
   */
  public function get(EntityTypeInterface $entity_type, $conjunction) {
    $class = QueryBase::getClass($this->namespaces, 'Query');

    return new $class($entity_type, $conjunction, $this->httpClient, $this->namespaces);
  }

  /**
   * {@inheritdoc}
   */
  public function getAggregate(EntityTypeInterface $entity_type, $conjunction) {
    // TODO: Implement getAggregate() method.
  }

}

<?php

namespace Drupal\virtual_entities\Entity\Query;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Query\QueryBase;
use Drupal\Core\Entity\Query\QueryInterface;
use GuzzleHttp\ClientInterface;

/**
 * Class Query.
 *
 * @package Drupal\virtual_entities\Entity\Query
 */
class Query extends QueryBase implements QueryInterface {

  /**
   * The HTTP client to fetch the data with.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * Query constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   * @param string                                  $conjunction
   * @param array                                   $namespaces
   */
  public function __construct(\Drupal\Core\Entity\EntityTypeInterface $entity_type, $conjunction, ClientInterface $http_client, array $namespaces) {
    parent::__construct($entity_type, $conjunction, $namespaces);

    $this->httpClient = $http_client;
  }

  /**
   * {@inheritdoc}
   */
  public function execute() {
    return $this
      ->prepare()
      ->compile()
      ->addSort()
      ->finish()
      ->result();
  }

  /**
   * Prepares the basic query with proper metadata/tags and base fields.
   */
  public function prepare() {
    return $this;
  }

  /**
   * Compiles the conditions.
   *
   * @return \Drupal\virtual_entities\Entity\Query\Query
   *   Returns the called object.
   */
  protected function compile() {
    $this->condition->compile($this);

    return $this;
  }

  /**
   * Adds the sort to the build query.
   *
   * @return \Drupal\virtual_entities\Entity\Query\Query
   *   Returns the called object.
   */
  protected function addSort() {
    return $this;
  }

  /**
   * Finish the query by adding fields, GROUP BY and range.
   *
   * @return \Drupal\virtual_entities\Entity\Query\Query
   *   Returns the called object.
   */
  protected function finish() {
    return $this;
  }

  /**
   * Executes the query and returns the result.
   *
   * @return int|array
   *   Returns the query result as entity IDs.
   */
  protected function result() {

  }

}
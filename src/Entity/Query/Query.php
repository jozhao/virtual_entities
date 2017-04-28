<?php

namespace Drupal\virtual_entities\Entity\Query;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Query\QueryBase;
use Drupal\Core\Entity\Query\QueryInterface;
use Drupal\Component\Plugin\PluginManagerInterface;
use GuzzleHttp\ClientInterface;

/**
 * Class Query.
 *
 * @package Drupal\virtual_entities\Entity\Query
 */
class Query extends QueryBase implements QueryInterface {

  /**
   * The parameters to send to entity storage client.
   *
   * @var array
   */
  protected $parameters = [];

  /**
   * The HTTP client to fetch the data with.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * The HTTP client parameters.
   *
   * @var array
   */
  protected $httpClientParameters = [];

  /**
   * The storage client manager.
   *
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $storageClientManager;

  /**
   * The storage client.
   *
   * @var \Drupal\virtual_entities\Plugin\VirtualEntity\StorageClientInterface
   */
  protected $storageClient;

  /**
   * Query constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   Virtual entity type.
   * @param string $conjunction
   *   Query condition.
   * @param \Drupal\Component\Plugin\PluginManagerInterface $storage_client_manager
   *   Storage client plugin manager.
   * @param \GuzzleHttp\ClientInterface $http_client
   *   GuzzleHttp client.
   * @param array $namespaces
   *   Current entity namespace.
   */
  public function __construct(EntityTypeInterface $entity_type, $conjunction, PluginManagerInterface $storage_client_manager, ClientInterface $http_client, array $namespaces) {
    parent::__construct($entity_type, $conjunction, $namespaces);

    $this->storageClientManager = $storage_client_manager;
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
   *
   * @see \Drupal\virtual_entities\Plugin\VirtualEntity\StorageClient\Restful
   */
  protected function result() {
    if ($this->count) {
      return count($this->getStorageClient()->query($this->httpClientParameters));
    }

    // Fetch entities ids.
    $query_results = $this->getStorageClient()->query($this->httpClientParameters);
    $result = [];
    $bundle_id = 'resource';
    $bundle_entity_type = $this->entityType->getBundleEntityType();
    $bundle = \Drupal::entityTypeManager()->getStorage($bundle_entity_type)->load($bundle_id);

    foreach ($query_results as $query_result) {
      if (FALSE === $bundle->getFieldMapping('id')) {
        continue;
      }
      $hashed_id = md5($query_result->{$bundle->getFieldMapping('id')});
      $id = $bundle_id . '-' . $hashed_id;
      $result[$id] = $id;
    }

    return $result;
  }

  /**
   * Get the storage client for a bundle.
   *
   * @see \Drupal\virtual_entities\Entity\VirtualEntityType
   */
  protected function getStorageClient() {
    if (empty($this->storageClient)) {
      // Load entity types act as bundles.
      $bundle_entity_type = $this->entityType->getBundleEntityType();
      // Load bundle instance object.
      $bundle = \Drupal::entityTypeManager()->getStorage($bundle_entity_type)->load('resource');
      // Set storage client plugin configuration.
      $plugin_id = 'virtual_entity_client_restful';
      $plugin_configuration = [
        'endpoint' => $bundle->getEndPoint(),
        'format' => $bundle->getFormat(),
      ];
      // Load storage client class.
      $this->storageClient = $this->storageClientManager->createInstance(
        $plugin_id,
        $plugin_configuration
      );
    }

    return $this->storageClient;
  }

  /**
   * Set a parameter.
   */
  public function setParameter($key, $value) {
    if ($key == $this->entityType->getKey('bundle')) {
      return FALSE;
    }
    $this->parameters[$key] = is_array($value) ? implode($value, ',') : $value;
  }

}

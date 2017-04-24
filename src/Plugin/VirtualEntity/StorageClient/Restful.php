<?php

namespace Drupal\virtual_entities\Plugin\VirtualEntity\StorageClient;

use Drupal\virtual_entities\Plugin\VirtualEntity\StorageClientBase;
use Drupal\virtual_entities\VirtualEntityInterface;

/**
 * Restful client.
 *
 * @StorageClient(
 *   id = "virtual_entity_client_restful",
 *   name = "RESTful"
 * )
 */
class Restful extends StorageClientBase {

  /**
   * {@inheritdoc}
   */
  public function load($id) {
    // TODO: Implement load() method.
  }

  /**
   * {@inheritdoc}
   */
  public function save(VirtualEntityInterface $entity) {
    // TODO: Implement save() method.
  }

  /**
   * {@inheritdoc}
   */
  public function query(array $parameters = []) {
    $parameters = [
      'apiKey' => 'd73db1da583c4270b749e094c0d5cd2a',
      'source' => 'abc-news-au',
      'sortBy' => 'top',
    ];

    $response = $this->httpClient->get(
      $this->configuration['endpoint'],
      [
        'query' => $parameters,
        'headers' => [],
      ]
    );

    // Fetch results from response.
    $results = json_decode($response->getBody());

    return $results->articles;
  }

}

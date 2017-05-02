<?php

namespace Drupal\virtual_entities\Plugin\VirtualEntityStorageClientPlugin;

use Drupal\virtual_entities\Plugin\VirtualEntityStorageClientPluginBase;
use GuzzleHttp\Exception\RequestException;

/**
 * Restful client.
 *
 * @VirtualEntityStorageClientPlugin(
 *   id = "virtual_entity_storage_client_plugin_restful",
 *   label = "RESTful"
 * )
 */
class Restful extends VirtualEntityStorageClientPluginBase {

  /**
   * Results.
   *
   * @var mixed
   */
  private static $results;

  /**
   * {@inheritdoc}
   */
  public function query(array $parameters = []) {
    try {
      $response = $this->httpClient->get($this->configuration['endpoint'], $this->configuration['httpClientParameters']);

      // Fetch data contents from remote.
      $data = $response->getBody()->getContents();
      // Use decoder to parse the data.
      $results = $this->decoder->getDecoder($this->configuration['format'])->decode($data);

      // If entities identity is set, return.
      if (!empty($this->configuration['entitiesIdentity'])) {
        $entitiesIdentity = (string) $this->configuration['entitiesIdentity'];
        // Check if this identity is available.
        if (isset($results[$entitiesIdentity])) {
          $results = $results[$entitiesIdentity];
        }
      }

      // Save results.
      self::$results = (object) $results;

      return self::$results;
    }
    catch (RequestException $e) {
      watchdog_exception('virtual_entities', $e);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function load($id) {
    if (empty(self::$results)) {
      self::$results = $this->query();
    }

    $items = self::$results;

    if (!empty($items)) {
      // Get entity unique ID.
      $entityUniqueId = (string) $this->configuration['entityUniqueId'];

      foreach ($items as $item) {
        $item = (object) $item;
        if (isset($item->$entityUniqueId) && md5($item->$entityUniqueId) == $id) {
          return (object) $item;
        }
      }
    }

    // Return FALSE if this entity is not available.
    return FALSE;
  }

}

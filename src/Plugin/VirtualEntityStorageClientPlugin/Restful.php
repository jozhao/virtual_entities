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
      // Load from cache.
      $cid = md5($this->configuration['endpoint']);
      if ($cache = \Drupal::cache('virtual_entities')->get($cid)) {
        self::$results = $cache->data;
      }
      else {
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
        // Save into cache table.
        $cid = md5($this->configuration['endpoint']);
        \Drupal::cache('virtual_entities')->set($cid, self::$results);
      }

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
    // Load from cache.
    $cid = $id;
    if ($cache = \Drupal::cache('virtual_entity')->get($cid)) {
      $item = $cache->data;

      return $item;
    }
    else {
      if (empty(self::$results)) {
        // Load from cache.
        $cid = md5($this->configuration['endpoint']);
        if ($cache = \Drupal::cache('virtual_entities')->get($cid)) {
          self::$results = $cache->data;
        }
        else {
          self::$results = $this->query();
        }
      }

      $items = self::$results;

      if (!empty($items)) {
        // Get entity unique ID.
        $entityUniqueId = (string) $this->configuration['entityUniqueId'];

        foreach ($items as $item) {
          // Make sure item is object.
          $item = (object) $item;
          if (isset($item->$entityUniqueId) && md5($item->$entityUniqueId) == $id) {
            \Drupal::cache('virtual_entity')->set($cid, $item);

            return (object) $item;
          }
        }
      }
    }

    // Return FALSE if this entity is not available.
    return FALSE;
  }

}

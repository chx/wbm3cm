<?php


namespace Drupal\wbm3cm\Plugin\migrate\destination;

use Drupal\migrate\MigrateException;
use Drupal\migrate\Plugin\migrate\destination\EntityRevision as BrokenEntityRevision;

/**
 * Provides entity revision destination plugin w/ working translations.
 *
 * No annotation, this is used instead of the broken core class.
 *
 * Two bugs:
 *
 * 1. getEntity loses the entity updateEntity returns.
 * 2. getIds does not take the translations configuration into consideration.
 */
class EntityRevision extends BrokenEntityRevision {

  protected function getEntity(Row $row, array $old_destination_id_values) {
    $revision_id = $old_destination_id_values ?
      reset($old_destination_id_values) :
      $row->getDestinationProperty($this->getKey('revision'));
    if (!empty($revision_id) && ($entity = $this->storage->loadRevision($revision_id))) {
      $entity->setNewRevision(FALSE);
    }
    else {
      $entity_id = $row->getDestinationProperty($this->getKey('id'));
      $entity = $this->storage->load($entity_id);

      // If we fail to load the original entity something is wrong and we need
      // to return immediately.
      if (!$entity) {
        return FALSE;
      }

      $entity->enforceIsNew(FALSE);
      $entity->setNewRevision(TRUE);
    }
    $entity = $this->updateEntity($entity, $row);
    $entity->isDefaultRevision(FALSE);
    return $entity;
  }

  public function getIds() {
    $ids = [];
    $ids = $this->addKeyToIds($ids, 'revision', 'revisions');
    if ($this->isTranslationDestination()) {
      $ids = $this->addKeyToIds($ids, 'langcode', 'translation');
    }
    return $ids;
  }

  protected function addKeyToIds($ids, $key_name, $what) {
    if ($key = $this->getKey($key_name)) {
      $ids[$key] = $this->getDefinitionFromEntity($key);
    }
    else {
      throw new MigrateException("This entity type does not support $what.");
    }
    return $ids;
  }


}

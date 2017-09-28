<?php


namespace Drupal\wbm3cm\Plugin\migrate\destination;

use Drupal\migrate\MigrateException;
use Drupal\migrate\Plugin\migrate\destination\EntityRevision as BrokenEntityRevision;

/**
 * Provides entity revision destination plugin w/ working translations.
 *
 * No annotation, this is used instead of the broken core class.
 */
class EntityRevision extends BrokenEntityRevision {

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

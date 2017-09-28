<?php

namespace Drupal\wbm3cm\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * @MigrateProcessPlugin(
 *   id = "wbm3cm_set_null"
 * )
 */
class SetNull extends ProcessPluginBase {

  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    // EntityContentBase::updateEntity() calls $field->setValue($values) which
    // says "or NULL to unset the data value." but
    // MigrateExecutable::processRow() explicitly does not set NULLs. Bother!
    $row->setDestinationProperty($destination_property, NULL);
  }

}

<?php

namespace Drupal\wbm3cm\Deriver;

class Step2 extends Step1 {

  protected function addMore(array $definition, $entity_type_id) {
    $langcode_field = $definition['source']['langcode_field'];
    $revision_id_field = $definition['source']['revision_id_field'];
    $definition['process'][$revision_id_field] = $revision_id_field;
    $definition['process'][$langcode_field] = $langcode_field;
    $definition['destination']['plugin'] = "entity_revision:$entity_type_id";
    return parent::addMore($definition, $entity_type_id);
  }


}

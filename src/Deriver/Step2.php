<?php

namespace Drupal\wbm3cm\Deriver;

class Step2 extends Step1 {

  protected function addMore(array $definition, $entity_type_id, $revision_id_field) {
    $definition['process'][$revision_id_field] = 'revision_id';
    $definition['destination']['plugin'] = "entity_revision:$entity_type_id";
    return parent::addMore($definition, $entity_type_id, $revision_id_field);
  }


}

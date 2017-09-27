<?php

namespace Drupal\wbm3cm;


class Wbm3CmDeriverStep2 extends Wbm3CmDeriverStep1 {

  protected function addMore(array $definition, $entity_type_id, $revision_id_field) {
    $definition['process'][$revision_id_field] = 'revision_id';
    $definition['destination']['plugin'] = "nentity_revision:$entity_type_id";
    return parent::addMore($definition, $entity_type_id, $revision_id_field);
  }


}

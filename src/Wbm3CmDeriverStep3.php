<?php

namespace Drupal\wbm3cm;

class Wbm3CmDeriverStep3 extends Wbm3CmDeriverStep2 {

  protected function addMore(array $definition, $entity_type_id, $revision_id_field) {
    $definition['moderation_state']['migration'] = "wbm3cm_step1:$entity_type_id";
    return parent::addMore($definition, $entity_type_id, $revision_id_field);
  }

}


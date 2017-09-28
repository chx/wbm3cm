<?php

namespace Drupal\wbm3cm\Deriver;

class Step3 extends Step2 {

  protected function addMore(array $definition, $entity_type_id) {
    $definition['moderation_state']['migration'] = "wbm3cm_step1:$entity_type_id";
    return parent::addMore($definition, $entity_type_id);
  }

}


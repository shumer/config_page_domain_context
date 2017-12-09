<?php

namespace Drupal\config_page_domain_context\Plugin\ConfigPagesContext;

use Drupal\config_pages\ConfigPagesContextBase;

/**
 * Provides a Domain config pages context.
 *
 * @ConfigPagesContext(
 *   id = "domain",
 *   label = @Translation("Domain"),
 * )
 */
class Domain extends ConfigPagesContextBase{

  /**
   * Return the value of the context.
   *
   * @return mixed
   */
  public static function getValue() {
    $loader = \Drupal::service('domain.negotiator');
    $current_domain = $loader->getActiveDomain();

    return $current_domain->id();
  }

}

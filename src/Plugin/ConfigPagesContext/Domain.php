<?php
namespace Drupal\config_pages\Plugin\ConfigPagesContext;
use Drupal\config_pages\ConfigPagesContextBase;
use Drupal\Core\Url;

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
  public function getValue() {
    $loader = \Drupal::service('domain.negotiator');
    $current_domain = $loader->getActiveDomain();
    return $current_domain->id();
  }

  /**
   * Return the label of the context.
   *
   * @return string
   */
  public function getLabel() {
    $loader = \Drupal::service('domain.negotiator');
    $current_domain = $loader->getActiveDomain();
    return $current_domain->label();
  }

  /**
   * Return array of available links to switch on given context.
   *
   * @return array
   */
  public function getLinks() {
    $links = [];
    $value = $this->getValue();
    \Drupal::service('entity_type.manager')->getStorage('domain')->resetCache();
    $domains =  \Drupal::service('entity_type.manager')->getStorage('domain')->loadMultiple();
    foreach ($domains as $domain) {
      $links[] = [
        'title' => $domain->label(),
        'href' => Url::fromUri($domain->getUrl()),
        'selected' => ($value == $domain->id()) ? TRUE : FALSE,
        'value' => $domain->id(),
      ];
    }
    return $links;
  }

}

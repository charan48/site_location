<?php

namespace Drupal\site_location\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\site_location\Current_time;
use Drupal\Core\Cache\Cache;

/**
 * Provides a block with a Site Location.
 *
 * @Block(
 *   id = "sitelocation_block",
 *   admin_label = @Translation("Site Location Block"),
 * )
 */
class SiteLocationBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected $current_datetime;

   /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param Drupal\site_location\Current_time $current_datetime;
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, Current_time $current_datetime) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->current_datetime = $current_datetime;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('sitelocation.time'),
    );
  }

  /**
   * {@inheritdoc}
   */
    public function build() {
        $data['country'] = \Drupal::config('site_location_configuration_form.settings')->get('country');
        $data['city'] = \Drupal::config('site_location_configuration_form.settings')->get('city');
        $complete_time = $this->current_datetime->getTime();
        $time_div = explode("-",$complete_time);
        $data['time'] = $time_div[0];
        $data['date'] = $time_div[1];
        return [
            '#items' => $data,
            '#theme' => 'site_location',
            '#cache' => ['max-age' => 0]
        ];
    }

}
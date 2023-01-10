<?php

namespace Drupal\site_location;

use Drupal\Core\Datetime\DateFormatter;

/**
 * Class Current_time.
 */
class Current_time {
 
  /**
   * Constructs a new Current_time object.
   */
  protected $dateFormatter;

  public function __construct(DateFormatter $dateFormatter) {
    $this->dateFormatter = $dateFormatter;
  }

  public function  getTime(){
    $timezone = \Drupal::config('site_location_configuration_form.settings')->get('timezone');
    $timezones = [
      'chicago' => 'America/Chicago',
      'new_york' => 'America/New_York',
      'tokyo' => 'Asia/Tokyo',
      'dubai' => 'Asia/Dubai',
      'kolkata' => 'Asia/Kolkata',
      'amsterdamv' => 'Europe/Amsterdam',
      'oslo' => 'Europe/Oslo',
      'london' => 'Europe/London',
    ];
    $zone = $timezones[$timezone];
    if($zone){
      // here we are using dateFormatter service to get time by timezone.
      $current_time = $this->dateFormatter->format(time(), 'custom', 'h:i a-l, d F Y', $zone);
    }
    return $current_time;
    //return \Drupal::service('date.formatter')->format(time(), 'custom', 'dS M Y - h:i A', $zone);
  }

}
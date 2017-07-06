<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 6/27/17
 * Time: 1:01 PM
 */
namespace UCI\Wordpress\Customize;

class Settings {

  /**
   * @var \WP_Customize_Manager
   */
    private $wpCustomize;

  /**
   * @return \WP_Customize_Manager
   */
  public function getWpCustomize() {
    return $this->wpCustomize;
  }

  /**
   * @param \WP_Customize_Manager $wpCustomize
   */
  public function setWpCustomize(\WP_Customize_Manager $wpCustomize) {
    $this->wpCustomize = $wpCustomize;
  }

  /**
   * Settings constructor.
   *
   * @param \WP_Customize_Manager $wpCustomize
   */
  public function __construct(\WP_Customize_Manager $wpCustomize) {
    $this->setWpCustomize($wpCustomize);
  }
}
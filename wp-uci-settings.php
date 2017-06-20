<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 6/20/17
 * Time: 11:13 AM
 */
namespace UCI\Wordpress\Customize;

class Settings {
    /**
     * @var \WP_Customize_Manager
     */
    private $wpCustomize;

    const SECTION_NAME = 'uciseventeen_settings';
    const WORDMARK_SETTING = 'wordmark_image';
    const SEARCH_FORM_SETTING = 'search_form';
    const SEARCH_FORM_UCI = 'uci';
    const SEARCH_FORM_WP = 'wp';
    const SITE_OWNER_SETTING = 'site_owner';
    const SITE_OWNER_DEFAULT = 'UC Irvine';
    const ADDRESS_ONE_SETTING = 'site_owner_address_one';
    const ADDRESS_TWO_SETTING = 'site_owner_address_two';
    const ADDRESS_THREE_SETTING = 'site_owner_address_three';
    const PHONE_SETTING = 'site_owner_phone';
    const EMAIL_SETTING = 'site_owner_email';

    /**
     * @return \WP_Customize_Manager
     */
    public function getWpCustomize()
    {
        return $this->wpCustomize;
    }

    /**
     * @param \WP_Customize_Manager $wpCustomize
     */
    public function setWpCustomize(\WP_Customize_Manager $wpCustomize)
    {
        $this->wpCustomize = $wpCustomize;
    }

    public function __construct($wpCustomize)
    {
        $this->setWpCustomize($wpCustomize);

        $this->getWpCustomize()->add_section(self::SECTION_NAME, array(
            'title' => __('UCI Settings', 'uciseventeen'),
            'priority' => 100,
            'capability' => 'edit_theme_options',
            'description' => __('Change options here', 'uciseventeen')
        ));

        $this->addWordmark();
        $this->addSearchType();
        $this->addSiteOwner();
        $this->addAddress();
        $this->addPhone();
        $this->addEmail();
    }

    private function addPhone() {
        $this->getWpCustomize()->add_setting(self::PHONE_SETTING, array(
            'default' => ''
        ));

        $this->getWpCustomize()->add_control(new \WP_Customize_Control($this->getWpCustomize(), self::PHONE_SETTING, array(
            'label' => __('Phone', 'uciseventeen'),
            'section' => self::SECTION_NAME,
            'settings' => self::PHONE_SETTING,
            'type' => 'text'
        )));
    }

    private function addEmail() {
        $this->getWpCustomize()->add_setting(self::EMAIL_SETTING, array(
            'default' => ''
        ));

        $this->getWpCustomize()->add_control(new \WP_Customize_Control($this->getWpCustomize(), self::EMAIL_SETTING, array(
            'label' => __('Email address', 'uciseventeen'),
            'section' => self::SECTION_NAME,
            'settings' => self::EMAIL_SETTING,
            'type' => 'text'
        )));
    }

    private function addAddress() {
        $this->getWpCustomize()->add_setting(self::ADDRESS_ONE_SETTING, array(
            'default' => ''
        ));

        $this->getWpCustomize()->add_control(new \WP_Customize_Control($this->getWpCustomize(), self::ADDRESS_ONE_SETTING, array(
            'label' => __('Address Line 1', 'uciseventeen'),
            'section' => self::SECTION_NAME,
            'settings' => self::ADDRESS_ONE_SETTING,
            'type' => 'text'
        )));

        $this->getWpCustomize()->add_setting(self::ADDRESS_TWO_SETTING, array(
            'default' => ''
        ));

        $this->getWpCustomize()->add_control(new \WP_Customize_Control($this->getWpCustomize(), self::ADDRESS_TWO_SETTING, array(
            'label' => __('Address Line 2', 'uciseventeen'),
            'section' => self::SECTION_NAME,
            'settings' => self::ADDRESS_TWO_SETTING,
            'type' => 'text'
        )));

        $this->getWpCustomize()->add_setting(self::ADDRESS_THREE_SETTING, array(
            'default' => ''
        ));

        $this->getWpCustomize()->add_control(new \WP_Customize_Control($this->getWpCustomize(), self::ADDRESS_THREE_SETTING, array(
            'label' => __('City, State, Zip code', 'uciseventeen'),
            'section' => self::SECTION_NAME,
            'settings' => self::ADDRESS_THREE_SETTING,
            'type' => 'text'
        )));
    }

    private function addSiteOwner() {
        $this->getWpCustomize()->add_setting(self::SITE_OWNER_SETTING, array(
            'default' => self::SITE_OWNER_DEFAULT
        ));

        $this->getWpCustomize()->add_control(new \WP_Customize_Control($this->getWpCustomize(), self::SITE_OWNER_SETTING, array(
            'label' => __('Site Owner', 'uciseventeen'),
            'section' => self::SECTION_NAME,
            'settings' => self::SITE_OWNER_SETTING,
            'type' => 'text'
        )));
    }

    private function addWordmark() {
        $this->getWpCustomize()->add_setting(self::WORDMARK_SETTING, array(
            'default' => ''
        ));

        $this->getWpCustomize()->add_control(new \WP_Customize_Media_Control($this->getWpCustomize(), self::WORDMARK_SETTING, array(
            'label' => __('Wordmark image', 'uciseventeen'),
            'section' => self::SECTION_NAME,
            'mime_type' => 'image'
        )));
    }

    private function addSearchType() {
        $this->getWpCustomize()->add_setting(self::SEARCH_FORM_SETTING, array(
            'default' => self::SEARCH_FORM_UCI
        ));

        $this->getWpCustomize()->add_control(new \WP_Customize_Control($this->getWpCustomize(), self::SEARCH_FORM_SETTING, array(
            'label' => __('Search Type', 'uciseventeen'),
            'section' => self::SECTION_NAME,
            'settings' => self::SEARCH_FORM_SETTING,
            'type' => 'select',
            'choices' => array(
                self::SEARCH_FORM_UCI => __('UCI', 'uciseventeen'),
                self::SEARCH_FORM_WP => __('Wordpress', 'uciseventeen')
            )
        )));
    }
}
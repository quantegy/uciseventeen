<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 6/20/17
 * Time: 11:13 AM
 */
namespace UCI\Wordpress\Customize\Header;

class Settings extends \UCI\Wordpress\Customize\Settings {
    const SECTION_NAME = 'uciseventeen_header_settings';
    const WORDMARK_SETTING = 'wordmark_image';
    const SEARCH_FORM_SETTING = 'search_form';
    const SEARCH_FORM_UCI = 'uci';
    const SEARCH_FORM_WP = 'wp';
    const SEARCH_FORM_COLLECTION_SETTING = 'search_collection';
    const SEARCH_FORM_DEFAULT_COLLECTION = 'uci_full';

    public function __construct($wpCustomize)
    {
        parent::__construct($wpCustomize);

        $this->getWpCustomize()->add_section(self::SECTION_NAME, array(
            'title' => __('UCI: Header', 'uciseventeen'),
            'priority' => 100,
            'capability' => 'edit_theme_options',
            'description' => __('Change options here', 'uciseventeen')
        ));

        $this->addWordmark();
        $this->addSearchType();
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

        $this->getWpCustomize()->add_setting(self::SEARCH_FORM_COLLECTION_SETTING, array('default' => self::SEARCH_FORM_DEFAULT_COLLECTION));

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

        $this->getWpCustomize()->add_control(new \WP_Customize_Control($this->getWpCustomize(), self::SEARCH_FORM_COLLECTION_SETTING, array(
			'label' => __('Assign a search collection', 'uciseventeen'),
	        'description' => __('Only relevant to using the UCI search form.', 'uciseventeen'),
	        'section' => self::SECTION_NAME,
	        'settings' => self::SEARCH_FORM_COLLECTION_SETTING,
	        'type' => 'text'
        )));
    }
}
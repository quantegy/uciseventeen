<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 6/20/17
 * Time: 11:13 AM
 */
namespace UCI\Wordpress\Customize\Footer;

class Settings extends \UCI\Wordpress\Customize\Settings {
    const SECTION_NAME = 'uciseventeen_footer_settings';
    const SITE_OWNER_SETTING = 'site_owner';
    const SITE_OWNER_DEFAULT = 'UC Irvine';
    const ADDRESS_ONE_SETTING = 'site_owner_address_one';
    const ADDRESS_TWO_SETTING = 'site_owner_address_two';
    const ADDRESS_THREE_SETTING = 'site_owner_address_three';
    const PHONE_SETTING = 'site_owner_phone';
    const EMAIL_SETTING = 'site_owner_email';
    const LOGOS_SETTING = array(
        array('slug' => 'footer_1_logo', 'label' => 'Logo: Column 1'),
        array('slug' => 'footer_2_logo', 'label' => 'Logo: Column 2'),
        array('slug' => 'footer_3_logo', 'label' => 'Logo: Column 3'),
        array('slug' => 'footer_4_logo', 'label' => 'Logo: Column 4'),
    );

    public function __construct($wpCustomize)
    {
        parent::__construct($wpCustomize);

        $this->getWpCustomize()->add_section(self::SECTION_NAME, array(
            'title' => __('UCI: Footer', 'uciseventeen'),
            'priority' => 100,
            'capability' => 'edit_theme_options',
            'description' => __('Change options here', 'uciseventeen')
        ));

        $this->addSiteOwner();
        $this->addAddress();
        $this->addPhone();
        $this->addEmail();

        $this->addLogos();
    }

    public static function getLogoSpot($slug) {
        $logoIndex = array_search($slug, array_column(self::LOGOS_SETTING, 'slug'));

        //var_dump($logoIndex);
        if($logoIndex >= 0) {
            $logo = self::LOGOS_SETTING[$logoIndex];

            $html = '';

            $logoLink = get_theme_mod($slug.'_link');
            $logoImgId = get_theme_mod($slug);

            if(!empty($logoImgId)) {
                $html .= '<div>';

                if(!empty($logoLink)) {
                    $html .= '<a href="' . $logoLink . '">' . wp_get_attachment_image($logoImgId) . '</a>';
                } else {
                    $html .= wp_get_attachment_image($logoImgId);
                }

                $html .= '</div>';
            }
        }

        echo $html;
    }

    private function addLogos() {
        foreach (self::LOGOS_SETTING as $logo) {
            $this->makeLogo($logo['slug'], $logo['label']);
        }
    }

    private function makeLogo($slug, $label = 'Logo') {
        $this->getWpCustomize()->add_setting($slug, array(
            'default' => ''
        ));

        $this->getWpCustomize()->add_control(new \WP_Customize_Media_Control($this->getWpCustomize(), $slug, array(
            'label' => __($label, 'uciseventeen'),
            'section' => self::SECTION_NAME,
            'mime_type' => 'image'
        )));

        $linkSlug = $slug . '_link';
        $linkLabel = $label . ' Link';
        $this->getWpCustomize()->add_setting($linkSlug, array(
            'default' => ''
        ));

        $this->getWpCustomize()->add_control(new \WP_Customize_Control($this->getWpCustomize(), $linkSlug, array(
            'label' => __($linkLabel, 'uciseventeen'),
            'section' => self::SECTION_NAME,
            'settings' => $linkSlug,
            'type' => 'text'
        )));
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
}
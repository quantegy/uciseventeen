<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 8/28/17
 * Time: 10:51 AM
 */
class UCI_Calendar_Widget extends WP_Widget_Calendar {
	public function widget( $args, $instance ) {

		$html = get_calendar(true, false);

		$doc = new DOMDocument();
		$doc->loadHTML($html);

		$xpath = new DOMXPath($doc);

		$calTableNode = $xpath->query("//table[@id='wp-calendar']")->item(0);
		$calTableNode->setAttribute('class', 'table');

		$doc->importNode($calTableNode);

		$thColNodes = $xpath->query("//table[@id='wp-calendar']//th[@scope='col']");
		foreach($thColNodes as $num => $thcn) {
			$NDay = $num;
			$dayName = date('l', mktime(0, 0, 0, (int)date('n'), $NDay, (int)date('Y')));

			$thcn->removeAttribute('title');
			$dayLetter = $thcn->textContent;
			$thcn->textContent = '';

			$abbrNode = $doc->createElement('abbr', $dayLetter);
			$abbrNode->setAttribute('title', $dayName);

			$thcn->appendChild($abbrNode);

			$doc->importNode($thcn);
		}

		$tfootNode = $xpath->query("//table[@id='wp-calendar']/tfoot")->item(0);
		$tfootNode->setAttribute('role', 'presentation');

		$doc->importNode($tfootNode);

		$html = $doc->saveHTML();

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Calendar') : $instance['title'], $instance, $this->id_base);

		echo $args['before_widget'];

		echo $args['before_title'] . $title . $args['after_title'];

		echo $html;

		echo $args['after_widget'];
	}
}
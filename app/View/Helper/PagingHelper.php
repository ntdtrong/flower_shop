<?php
App::uses('AppHelper', 'View/Helper');

class PagingHelper extends AppHelper {
    
    /**
	 * 
	 * @param array $paginatorObj
	 * @param string $url
	 */
	public function render($paginatorObj, $url, $queryString = '') {
		if ($paginatorObj['total_pages'] == 0) return '';
		$frame = $this->frame($paginatorObj['current_page'], 1, $paginatorObj['total_pages']);
		$html = '<div style="text-align: center;" class="thire-pag-wrap"><ul class="pagination pagination-sm">';
		if ($paginatorObj['prev_page'] == 0) {
			$html .= '<li class="prev disabled"><a href="#">&laquo;</a></li>';
		} else {
			$html .= '<li class="prev"> <a href="' . $url  . '/' . $paginatorObj['prev_page'] . $queryString . '"> &laquo;</a> </li>';
		}
		foreach($frame as $page) {
			if ($page == $paginatorObj['current_page']) {
				$html .= '<li class="active"> <a href="#">' . $page . '</a></li>';
			} else {
				$html .= '<li> <a href="' . $url  . '/' . $page . $queryString . '">' . $page . '</a></li>';
			}
		}
		if ($paginatorObj['next_page'] == 0) {
			$html .= '<li class="disabled"><a href="#">&raquo;</a></li>';
		} else {
			$html .= '<li class="next"><a href="' . $url  . '/' . $paginatorObj['next_page'] . $queryString . '">&raquo;</a></li>';
		}
		return $html;
	}
	
	private function frame($current, $min, $max) {
		$frame = array();
		
		$currentMin = $current - 2;
		$currentMax = $current + 2;
		
		if ($currentMin < $min) {
			$currentMax = $currentMax + $min - $currentMin;
			$currentMin = $min;
		}
		
		if ($currentMax > $max) {
			$currentMin = $currentMin - $currentMax + $max;
			$currentMax = $max;
			if ($currentMin < $min) {
				$currentMin = $min;
			}
		}
		
		for ($i = $currentMin; $i < $currentMax + 1; $i++) {
			$frame[] = $i;
		}
		
		return $frame;
	}
}
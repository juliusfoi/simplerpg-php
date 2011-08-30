<?php 

class Irontouch_Util_Html
{
	static public function link($content, $class = null, $id = null)
	{
		if($class != null)
			$class = 'class="'. $class .'"';
		else
			$class = "";
		if($id != null)
			$id = 'id="'. $id .'"';
		else
			$id = "";
			
		return '<a '. $class .' '. $id .' href="' . $content["href"] . '" >'. $content["label"] .'</a>';
	}
}
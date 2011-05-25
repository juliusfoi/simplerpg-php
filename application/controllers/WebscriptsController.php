<?php
/*
 * 	Copyright 2011 by Julius Foitzik
 *
 This file is part of SimpleRPG.

 SimpleRPG is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 SimpleRPG is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with SimpleRPG.  If not, see <http://www.gnu.org/licenses/>.
 */

class WebscriptsController extends Zend_Controller_Action
{

	public function init()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
	}

	public function indexAction()
	{
		$this->_response->setBody(file_get_contents(APPLICATION_PATH.'/webscripts/battle.js'));
	}

	public function getscriptAction()
	{
		$this->_response->setBody(file_get_contents(APPLICATION_PATH.'/webscripts/'.$this->_getParam('script', 'no script found')));
	}


}


<?php


class Irontouch_Auth_LoginAuth implements Zend_Auth_Adapter_Interface
{
	protected $_username;
	protected $_password;
	protected $_user;
	protected $_salt;
	protected $_hashMethod = 'sha256';
    /**
     * Sets username and password for authentication
     *
     * @return void
     */
    public function __construct($username, $password, $user)
    {
        $this->_username = $username;
        $this->_password = $password;
        
        if($user != null && ($user instanceof Application_Model_User) )
        {
        	$this->_user = $user;
        	$this->_user->getSalt();
    	}
        else {
	        $_user = new Application_Model_User();
	        $_user->findByName($username);
	        $this->_user->getSalt();
        }
    }
 
    /**
     * Performs an authentication attempt
     *
     * @throws Zend_Auth_Adapter_Exception If authentication cannot
     *                                     be performed
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
    	//$bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
    	//$options = $bootstrap->getOptions();
    	//$app_secret = $options['security']['cryptography']['app_secret'];
		if(hash_hmac($this->_hashMethod , $this->_password.$this->_username, $this->_user->getSalt()) == $this->_user->hash())
		{
			return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $this->_username, array("no errors"));
		}
		else
			throw new Zend_Auth_Adapter_Exception("Failed to authenticate in Module: 'LoginAuth' ".hash_hmac($this->_hashMethod , $this->_password.$this->_username, $this->_user->getSalt()).'+'.$this->_user->getPassword());
    }
}
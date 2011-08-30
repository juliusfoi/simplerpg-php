<?php

class Irontouch_Util_Serialize
{
    public static function getRaw($data)
    {
    	if($data != null)
    	{
    		if(is_array($data ))
    			return serialize($data);
    		else
    			return $data;	
    	}
    	else
    		return null;
    }
    
    public static function getSerialized($data)
    {
    	if($data != null)
    	{
    		if(is_string($data))
    			return unserialize($data);
    		else
    			return $data;	
    	}
    	else
    		return null;
    }
}
<?php
/**
 *@author    Myron Turner <turnermm02@shaw.ca> 
 */
 
use dokuwiki\Extension\ActionPlugin;
use dokuwiki\Extension\EventHandler;
use dokuwiki\Extension\Event;

class action_plugin_goto extends ActionPlugin {
    public function register(EventHandler $controller) {   
	  $controller->register_hook('ACTION_ACT_PREPROCESS', 'BEFORE', $this, 'handle_act',array('before')); 
      $controller->register_hook('DOKUWIKI_STARTED', 'AFTER', $this, 'started',array('after'));
    }
	public function started(Event $event, $param) {
        global $JSINFO,$updateVersion;
        $JSINFO['update_version'] = $updateVersion;        
    }

	public function handle_act(Event $event, $param) {   	   
	   global $conf,$USERINFO,$INPUT;
		$act = act_clean($event->data);
		 if($act != 'login') {
				return;
		}
	    $user = $INPUT->server->str('REMOTE_USER');
		if(!$user) return;
		$auto_login = $this->getConf('auto_login');	
        if($auto_login) {  
          setcookie("GOTO_LOGIN",":$user" , time()+10, DOKU_BASE);
         	
        }
        else return;

		$which_only = $this->getConf('only_option');
		$users_only = false;
		$groups_only = false;
		if($which_only == 'group') {
		    $groups_only = true;
		}
		else if($which_only != 'default') {
		    $users_only = true;
		}
		$redirect_target = "";
		if(! $users_only) {			   
			$user_grps = $USERINFO['grps'];		
			$groups = $this->getConf('group');
			$groups = preg_replace("/\s+/","",$groups);
			$groups = explode(',',$groups);
		    $grp_opt = $this->getConf('group_options');
			foreach($groups as $grp) {
				if(in_array ($grp , $user_grps)) {
					$redirect_target = "$grp:";
					$redirect_target .= ($grp_opt == 'user_page' ? $user : $conf['start']);							
                    break;					
				}
			}	
			if($redirect_target) {
				setcookie("GOTO_LOGIN", $redirect_target, time()+120, DOKU_BASE);		
                return;				
			}			
		}			
			
        if($groups_only)  return;
	       
		   $option  = $this->getConf('auto_options');
		   $common = $this->getConf('common_ns');
		   if($common) {
			   $common = rtrim($common,':');    
		   }               
		   $srch = array('common_ns','user_page','user_ns','start_page');               
		   $repl = array($common,$user,$user,$conf['start']);
		   $value = str_replace($srch,$repl,$option); 
		   setcookie("GOTO_LOGIN", $value, time()+120, DOKU_BASE);
		}
		
}

<?php
/**
* GOTO Plugin: Easily redirect to other pages in your wiki.
* 
* @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
* @author     Allen Ormond <aormond atgmaildotcom>  
 *@author    Myron Turner <turnermm02@shaw.ca> 
*/

if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

class  syntax_plugin_goto extends DokuWiki_Syntax_Plugin {

	function getType(){
		return('substition');
		}

		function connectTo($mode) {
			$this->Lexer->addSpecialPattern('(?i)~~GOTO>.+?~~',$mode,'plugin_goto');
			}

			function getSort() {
				return 249;
			}

			function handle($match, $state, $pos, Doku_Handler $handler){
                 global $INPUT;
				 $userid = $INPUT->server->str('REMOTE_USER');
                 $is_usr = false;
                 $is_extern = false;
				$seconds = $this->getConf('seconds');        //Default number of seconds to wait before redirect.
				$minSeconds = $this->getConf('minSeconds');      //Minimum number of seconds allowed before redirect.

				/* $message is the redirection message that is displayed. %d will be replaced with a link
				*  to the destination. %s will be replaced with the number of seconds before redirect. */
				$message = "<strong>".$this->getLang('redirect')."</strong>";				
				$matches = explode("?", substr($match,7,-2));
                if($matches[0] == 'user') {
                   $matches[0] = "user";  // wildcard replaced in javascript   goto_redirect()
                    $is_usr = 'user';
					$seconds = 3;
                }  
                else if (preg_match("#^\s*https?:\/\/#",$matches[0])) {
                    $is_extern ='extern';                   
                }
              
				if (is_numeric($matches[1])){
                    $seconds = $matches[1]; 
                }
               else if(!is_numeric($matches[1]) && $is_extern) {
                     if (is_numeric($matches[2])){
                       $seconds = $matches[2]; 
                   }                   
                    $matches[0] .= '?' . $matches[1];
                }
				if ($seconds < $minSeconds){ $seconds = $minSeconds; }//Check that seconds is greater than $minSeconds.
				$message = str_replace("%D","%d",$message);//Make %d case insensitive.
				$message = str_replace("%S","%s",$message);//Make %s case insensitive.
				return array($matches[0], $seconds, $message,$is_usr,$is_extern);
			}

             function render($mode, Doku_Renderer $renderer, $data) {
                if($mode != 'xhtml') return false;
                global $updateVersion;              
                global $ACT;
                $internal_link = false;
                if(!$data[3]) {
                    if(!$data[4]) {
                        $message = str_replace("%d",$renderer->internallink($data[0], $data[0],'', true),$data[2]);
                        $internal_link = true;
                    }
                    else {
                       $message = str_replace("%d",$data[0],$data[2]);
                       $url = $data[0];
                    }
                    $message = str_replace("%s",$data[1],$message);
                    $renderer->doc .= $message;
                }
                if(!$data[4]) {
                    $urlArr = explode('#', $data[0], 2);
                    $url = wl($urlArr[0]);
                    if (count($urlArr) > 1) {
					$url .= '#'.cleanID($urlArr[1]);			
                    }  
                }                
				if ($ACT != 'preview') {
                    if(!$data[3] && !$data[4]) {
                        $tm= $data[1]*1000;
                        if($updateVersion > 50) {
                            $renderer->doc .= '<span id = "goto_go">'.$url .';'.$tm.'</span>';
                        }
                        else {
                            $renderer->doc .= "<script>var goto_tm= setTimeout(function(){goto_redirect('$url', '$data[4]');},$tm);</script>";
                        }
                    }
					else{
				        $tm =($data[1]*1000);	                                            
                        if($data[3] == 'user') $data[4] = 'user';
			            $renderer->doc .= "<script>var goto_tm= setTimeout(function(){goto_redirect('$url', '$data[4]');},$tm);</script>";
					}
				}
                 return true; 
			}
		}

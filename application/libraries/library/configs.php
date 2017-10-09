<?php
class Configs
{
	function set_config($data_config = array(), $url)
	{	
		if(file_exists($url))
		{
			include($url);
			$this->config = $config;
			$file = $url;
			
			foreach($data_config as $key=>$value)
			{
				if($value === '1')
				{
					$this->config[$key] = true;
				}else if($value === '0')
				{
					$this->config[$key] = false;
				}else
				{
					if($value !== '')
						$this->config[$key] = $value;
				}
			}
			
			$config = var_export($this->config, true);
			if(file_put_contents($file, "<?php ".PHP_EOL.'$config'." = $config; ".PHP_EOL."?>"))
			{
				return true;
			}else
			{
				return false;
			}
		}else
		{
			return false;
		}
	}

}
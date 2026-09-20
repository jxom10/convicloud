<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;


class ToolsController extends Controller
{
    public function actualizar(){
		
		$script = "mkdir .convicloud_temp
					cd .convicloud_temp
					wget https://github.com/jxom10/convicloud/archive/refs/heads/main.zip
					unzip -q main.zip
					chmod 777 -R convicloud-main/public
					chmod 777 -R convicloud-main/storage
					cp -Pruv convicloud-main/. ../../
					rm -R .convicloud_temp;
					";
					//sshpass -p 'carrefour' rsync -av convicloud-main/. kkwet@casa.levantia.net:/var/www/convicloud/ ";
					//cd ..
					//";
		$result = Process::run($script);
		
		dd($result);
	}
}

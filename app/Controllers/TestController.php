<?php

namespace App\Controllers;

class TestController
{
	public function test()
	{
		return 'Hello Doge!';
	}

	public function hello($userName = 'Doge')
	{
		return 'Hello ' . $userName;
	}
}
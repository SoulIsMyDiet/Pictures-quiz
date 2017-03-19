<?php
//class that will be bigger in the future but for now is only randoming the possible answers so they will always be in different order
class variety
{
	public $number;
	/* public $number2;
	public $number3;
	public $number4; */
	public function randomize1()
	{
		$number[0] = rand(0, 3);
		$number[1] = rand(0, 3);
while ($number[1] ==$number[0])
{
	$number[1] = rand(0, 3);
}
$number[2] = rand(0, 3);
while ($number[2] ==$number[0] || $number[2] == $number[1])
{
	$number[2] = rand(0, 3);
}
$number[3] = rand(0, 3);
while ($number[3] ==$number[0] || $number[3] == $number[1] || $number[3] == $number[2])
{
	$number[3] = rand(0, 3);
}
		return $number;
	}
	public function see()
	{
		print_r ($this->number);
		
	}
	
}
//header('location:index.php');

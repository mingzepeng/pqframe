<?php
class passportModel extends Model
{
	public $table = 'passport';
	
	public $pk = 'pid';
	
	public $fields = array();
	
	public $modelname = 'passportModel';
	
	public $autocheck = 1;
	
	public $validate = array();
}

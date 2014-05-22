<?php

class Item extends Eloquent {

	protected $fillable = array('checklist_id', 'done', 'name', 'list');

	protected $table = 'items';

	public function checklist() {
		return $this->belongsTo('Checklist', 'checklist_id');
	}

	public function mark() {

	 	$this->done = $this->done ? false : true;

		return $this->save();
	}
}
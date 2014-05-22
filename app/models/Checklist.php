<?php

class Checklist extends Eloquent {

	protected $fillable = array('owner_id', 'name');

	protected $table = 'checklists';

	public function owner() {
		return $this->belongsTo('User', 'owner_id');
	}

	public function items() {
		return $this->hasMany('Item', 'checklist_id');
	}

}
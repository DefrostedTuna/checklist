<?php

class ChecklistController extends BaseController {

	public function getIndex() {

		$user = Auth::user();
		$lists = $user->checklists;
		
		return 	View::make('checklist.checklists')
				->with('lists', $lists)
				->with('user', $user);
	}


	public function getItems($id) {

		$user 	= Auth::user();
		$checklist 	= Checklist::findOrFail($id);

		return 	View::make('checklist.items')
				->with('checklist', $checklist)
				->with('user', $user);

	}

	public function getCreate() {
		//create a checklist markup
		return 	View::make('checklist.create');
	}

	public function postItems($id) {
		//process the checking of items

		$checklist_id 	= $id;
		$item_id 		= Input::get('item_id');
		$item 			= Item::findOrFail($item_id);

		if($item->mark()) {
			return 	Redirect::route('list-items', $checklist_id);
		} else {
			return 	Redirect::route('list-items', $checklist_id)
					->with('global', 'Error marking task.');
		}

		return 	Redirect::route('list-items', $checklist_id)
					->with('global', 'There was an error processing the request.');

	}

	public function getAddBatch($id) {
		//add item to chosen checklist markup

		$checklist = Checklist::findOrFail($id);

		return 	View::make('checklist.add')
				->with('checklist', $checklist);
	}

	public function postCreate() {
		//process a new checklist
		$validator = Validator::make(Input::all(), array(
			'name' => 'required|min:3|max:255'
		));

		if($validator->fails()) {
			return 	Redirect::route('list')
					->withErrors($validator)
					->withInput();
		} else {

			$name = Input::get('name');

			$checklist = Checklist::create(array(
					'name' => $name,
				'owner_id' => Auth::user()->id
			));

			if($checklist) {
				return 	Redirect::route('list')
						->with('global', 'List has been created');
			} else {
				return 	Redirect::route('list')
						->with('global', 'Checklist could not be created');
			}
		}
	}

	public function postAddItem() {
		//process adding new item to chosen checklist
		$validator = Validator::make(Input::all(), array(
			'name' => 'required|min:3|max:255'
		));

		$checklist_id = Input::get('checklist_id');

		if($validator->fails()) {
			return 	Redirect::route('list-items', $checklist_id)
					->withErrors($validator)
					->withInput();
		} else {

			
			$name = Input::get('name');

			$item = Item::create(array(
				'name' => $name,
				'checklist_id' => $checklist_id
			));

		if($item) {
			return 	Redirect::route('list-items', $checklist_id)
					->with('global', 'Item has been added!');
		} else {
			return 	Redirect::route('list-items', $checklist_id)
					->with('global', 'Item could not be added');
			}


		}
	}

	public function postAddBatch() {
		//bulk add processing
		$validator = Validator::make(Input::all(), array(
			'first_item' 	=> 'required|min:3|max:255',
			'second_item' 	=> 'min:3|max:255',
			'third_item' 	=> 'min:3|max:255',
			'fourth_item' 	=> 'min:3|max:255',
			'fifth_item' 	=> 'min:3|max:255',
		));

		$items = array();
		$checklist_id = Input::get('checklist_id');

		if($validator->fails()) {
			return 	Redirect::route('list-items-add-batch', $checklist_id)
					->withErrors($validator)
					->withInput();
		}

		//gather all name fields and loop through them
		foreach(Input::except('_token', 'checklist_id') as $item) {
			//if the item has input, append it to an array
			if($item) {
				$items[] = 	array(
								'name' => $item, 
								'checklist_id' => $checklist_id
							);
			}
		}

		//loop through and create each item serparately 
		//to assure creation of timestamp fields
		foreach($items as $item) {
			$create = Item::create($item);
		}

		if($create) {
			return 	Redirect::route('list-items', $checklist_id)
					->with('global', 'Items have been added!');
		} else {
			return 	Redirect::route('list-items', $checklist_id)
					->with('global', 'There was a problem adding items to the list.');
		}
	}

	public function postRemoveItem($id) {

		$checklist_id 	= $id;
		$item_id 		= Input::get('item_id');

		$item = Item::findOrFail($item_id);

		if($item->delete()) {
			return 	Redirect::route('list-items', $checklist_id);
		
		}	else {
			return 	Redirect::route('list-items', $checklist_id)
			->with('global', 'There was a problem deleting the item.');
		}

		return 	Redirect::route('list-items', $checklist_id)
				->with('global', 'There was a problem processing the request.');
	}

	public function postRemoveList($id) {

		$checklist_id = $id;

		$checklist = Checklist::findOrFail($checklist_id);

		foreach($checklist->items as $item) {
			$item->delete();
		}

		if($checklist->delete()) {
			return 	Redirect::route('list')
					->with('global', 'List removed successfully.');
		} else {
			return 	Redirect::route('list')
					->with('global', 'There was a problem trying to remove the list.');
		}

	}


}
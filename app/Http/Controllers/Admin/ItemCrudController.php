<?php namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ItemRequest as StoreRequest;
use App\Http\Requests\ItemRequest as UpdateRequest;

class ItemCrudController extends CrudController {

	public function __construct() {
        parent::__construct();

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\Models\Item");
        $this->crud->setRoute("admin/item");
        $this->crud->setEntityNameStrings('item', 'items');

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        
        //do not allow the user to delete or reorder
        $this->crud->denyAccess(['reorder', 'delete']);
        

        //add the fields
        $this->crud->addField([    // SELECT
                'label' => 'Order ID',
                'type' => 'disabled_text',
                'name' => 'order_id', 
                'hint' => '<b>NOTE:</b> This value is set automatically.',

            ]);

        $this->crud->addField([    // SELECT
                'label' => 'Product ID',
                'type' => 'select2',
                'name' => 'product_id',
                'entity' => 'product',
                'attribute' => 'id',
                'model' => "App\Models\Product",
                'hint' => 'Required',
            ]);

        $this->crud->addField([
                'type' => 'disabled_text',
                'name' => 'status',
                'label' => 'Status',
                'hint' => '<b>NOTE:</b> This value is set automatically.',
            ]);

        $this->crud->addField([
                'type' => 'enum',
                'name' => 'physical_status',
                'label' => 'Physical Status',
                'hint' => '<b>NOTE:</b> Physical Status cannot be set to "Delivered", if this item\'s Status is "Available".<br/>',
            ]);


        //add the columns
        $this->crud->addColumn([
                'label' => 'Item ID',
                'type' => 'number',
                'name' => 'id',
            ]);

        $this->crud->addColumn([
                'label' => 'Order ID',
                'type' => 'select',
                'name' => 'order_id',
                'entity' => 'order',
                'attribute' => 'id',
                'model' => "App\Models\Order",
            ]);

        $this->crud->addColumn([
                'label' => 'Product ID',
                'type' => 'select2',
                'name' => 'product_id',
                'entity' => 'product',
                'attribute' => 'id',
                'model' => "App\Models\Product",
            ]);


        $this->crud->addColumn([
                'name' => 'status',
                'label' => 'Status'
            ]);

        $this->crud->addColumn([
                'name' => 'physical_status',
                'label' => 'Physical Status'
            ]);

		// ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']);
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though: 
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable(); 

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

	public function store(StoreRequest $request)
	{
		return parent::storeCrud();
	}

	public function update(UpdateRequest $request)
	{
		return parent::updateCrud();
	}
}

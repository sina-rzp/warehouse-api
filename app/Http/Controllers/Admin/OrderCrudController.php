<?php namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\OrderRequest as StoreRequest;
use App\Http\Requests\OrderRequest as UpdateRequest;

class OrderCrudController extends CrudController {

	public function __construct() {
        parent::__construct();

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\Models\Order");
        $this->crud->setRoute("admin/order");
        $this->crud->setEntityNameStrings('order', 'orders');

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/

		// $this->crud->setFromDb();

        $this->crud->addField([
                'type' => 'text',
                'name' => 'customer_name',
                'label' => 'Customer'
            ]);

        $this->crud->addField([
                'type' => 'address',
                'name' => 'address',
                'label' => 'Address'
            ]);


     $this->crud->addField([    // ENUM
                    'name' => 'status',
                    'label' => 'Status',
                    'type' => 'enum',
                ]);

     $this->crud->addField([    // ENUM
                    'name' => 'order_date',
                    'label' => 'Order Date',
                    'type' => 'date',
                ]);


    $this->crud->addField([       
                            'label' => 'Items',
                            'type' => 'custom_1_to_n',
                            'name' => 'items', // the method that defines the relationship in your Model
                            'entity' => 'items', // the method that defines the relationship in your Model
                            'attribute' => 'id', // foreign key attribute that is shown to user
                            'model' => 'App\Models\Item', // foreign key model
                            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                        ]);


    $this->crud->addColumn([
                    'type' => 'number',
                    'name' => 'id',
                    'label' => 'Order Number'
                ]);

    $this->crud->addColumn([
                    'type' => 'text',
                    'name' => 'customer_name',
                    'label' => 'Customer'
                ]);

    $this->crud->addColumn([
                    'type' => 'address',
                    'name' => 'address',
                    'label' => 'Address'
                ]);

    $this->crud->addColumn([
                    'name' => 'status',
                    'label' => 'Status',
                ]);

    $this->crud->addColumn([    // ENUM
                    'name' => 'order_date',
                    'label' => 'Order Date',
                    'type' => 'date',
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

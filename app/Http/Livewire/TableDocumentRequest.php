<?php

namespace App\Http\Livewire;

use App\Models\DocumentRequest;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class TableDocumentRequest extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\DocumentRequest>
    */
    public function datasource(): Builder
    {
        return DocumentRequest::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('Doc_Code')
            ->addColumn('Doc_Name')
            ->addColumn('Doc_FullName')
            ->addColumn('Doc_Type')
            ->addColumn('Doc_Obj')
            ->addColumn('Doc_Description')
            ->addColumn('Doc_Status')
            ->addColumn('created_at_formatted', fn (DocumentRequest $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (DocumentRequest $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('DAR', 'Doc_Code')
                ->searchable()
                ->sortable(),
            Column::make('Code', 'Doc_Name')
                ->searchable()
                ->sortable(),
            Column::make('Name', 'Doc_FullName')
                ->searchable()
                ->sortable(),
            Column::make('Type', 'Doc_Type')
                ->searchable()
                ->sortable(),
            Column::make('Obj', 'Doc_Obj')
                ->searchable()
                ->sortable(),
            Column::make('Status', 'Doc_Status')
                ->searchable()
                ->sortable()
                ->makeInputSelect(collect(
                    [
                        ['Doc_Status' => 0,  'label' => 'Best before'],
                        ['Doc_Status' => 1,  'label' => 'Expiring'],
                        ['Doc_Status' => 2,  'label' => 'Expired'],
                    ]
                    ), 'Doc_Status', 'Doc_Status'),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid DocumentRequest Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
       return [
            Button::make('view', 'View')
            ->class('bg-brand_blue cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
            ->route('regDoc.view',['Doc_Code'])->target('_self'),
           /*
            Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('document-request.edit', ['document-request' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('document-request.destroy', ['document-request' => 'id'])
               ->method('delete')
               */
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid DocumentRequest Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($document-request) => $document-request->id === 1)
                ->hide(),
        ];
    }
    */
}

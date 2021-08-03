<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Domains\Qualification\Http\Controllers\QualificationController;
use App\Domains\Unit\Http\Controllers\UnitController;
use App\Domains\DocumentType\Http\Controllers\DocumentTypeController;
use App\Domains\Document\Http\Controllers\DocumentController;
use App\Domains\Department\Http\Controllers\DepartmentController;
use App\Domains\JobPosition\Http\Controllers\JobPositionController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });
/*****
* Qualification
*/
// Route::resource('/qualification', QualificationController::class);
// Route::resource('/qualification', QualificationController::class)->middleware('permission:admin.qualification.create-qualification|admin.qualification.view-qualification|admin.qualification.update-qualification|admin.qualification.delete-qualification');
Route::group([
    'prefix' => 'qualification',
    'as' => 'qualification.',
], function()
    {
    Route::group([
        
    ], function () {
        Route::get('/', [QualificationController::class, 'index'] )
            ->name('index')
            ->middleware('permission:admin.qualification.create-qualification|admin.qualification.view-qualification|admin.qualification.edit-qualification|admin.qualification.delete-qualification');;
        Route::get('create', [QualificationController::class, 'create'] )
            ->name('create')
            ->middleware('permission:admin.qualification.create-qualification');
        Route::get('show/{qualification}', [QualificationController::class, 'show'] )
            ->name('show')
            ->middleware('permission:admin.qualification.view-qualification');
        Route::get('edit/{qualification}', [QualificationController::class, 'edit'] )
            ->name('edit')
            ->middleware('permission:admin.qualification.edit-qualification');
        Route::post('update/{qualification}', [QualificationController::class, 'update'] )
            ->name('update');
        Route::delete('destroy/{qualification}', [QualificationController::class, 'destroy'] )
            ->name('destroy')
            ->middleware('permission:admin.qualification.delete-qualification');
        Route::post('store', [QualificationController::class, 'store'] )->name('store');    
           
    });
});


/*********
 * *Units
 *********/

// Route::resource('/unit', UnitController::class);
Route::group([
    'prefix' => 'unit',
    'as' => 'unit.',
], function()
    {
Route::group([
        
], function () {
    Route::get('/', [UnitController::class, 'index'] )
            ->name('index');
            
    Route::get('create', [UnitController::class, 'create'] )
            ->name('create');
          
    Route::get('show/{unit}', [UnitController::class, 'show'] )
            ->name('show');
           
    Route::get('edit/{unit}', [UnitController::class, 'edit'] )
            ->name('edit');
            
    Route::post('update/{unit}', [UnitController::class, 'update'] )
            ->name('update');
    Route::delete('destroy/{unit}', [UnitController::class, 'destroy'] )
            ->name('destroy');
            
    Route::post('store', [UnitController::class, 'store'] )->name('store');       
    Route::delete('delete/{qual}', [UnitController::class, 'delete'] )
            ->name('delete');              
    });            
});
/********************
 * *documents_types
 ********************/

Route::resource('/document_type', DocumentTypeController::class);

/********************
 * *documents
 ********************/

// Route::resource('/document', DocumentController::class); 
// Route::get('admin.document.download/{link}', [DocumentController::class, 'download'] )
//             ->name('download');     
Route::group([
    'prefix' => 'document',
    'as' => 'document.',
], function()
{
Route::group([
                    
], function () {
    Route::get('/', [DocumentController::class, 'index'] )
        ->name('index');
                        
    Route::get('create', [DocumentController::class, 'create'] )
        ->name('create');
                      
    Route::get('show/{document}', [DocumentController::class, 'show'] )
        ->name('show');
                       
    Route::get('edit/{document}', [DocumentController::class, 'edit'] )
        ->name('edit');
                        
    Route::post('update/{document}', [DocumentController::class, 'update'] )
        ->name('update');
    Route::delete('destroy/{document}', [DocumentController::class, 'destroy'] )
        ->name('destroy');
                        
    Route::post('store', [DocumentController::class, 'store'] )->name('store');       
    Route::get('download/{document}', [DocumentController::class, 'download'] )
        ->name('download');                                           
        });            
});
/********************
 * *departments
 ********************/

Route::resource('/department', DepartmentController::class);

/********************
 * *job positions
 ********************/

Route::resource('/job', JobPositionController::class);
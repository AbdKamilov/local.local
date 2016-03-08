<?php


use App\Task;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/



Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/{id}/new_project',['middleware'=>'auth','ProjectController@add_new']);

                // Form
    Route::get('/form', ['uses'=>'FormController@index','as'=>'home']);
    Route::get('message/{id}/edit',['uses'=>'FormController@edit','as'=>'message.edit'])->where(['id'=>'[0-9]+']);
    Route::post('message/{id}/up','FormController@update')->where(['id'=>'[0-9]+']);
    Route::post('message/add','FormController@add');
    Route::post('message/{id}/delete','FormController@delete')->where(['id'=>'[0-9]+']);
            // Task
    Route::get('/task', ['middleware'=>'auth',function () {
        //
        $tasks = Task::orderBy('created_at', 'asc')->get();

        return view('tasks', [
            'tasks' => $tasks
        ]);
    }]);

    /**
     * Add New Task
     */
    Route::post('/task/t', function (Request $request) {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25',
            'message' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/task')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->message = $request->message;
        $task->save();

        return redirect('/task');

    });

    /**
     * Delete Task
     */
    Route::delete('/task/t/{id}', function ($id) {
        Task::findOrFail($id)->delete();
        return redirect('/task');
    });

});

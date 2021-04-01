<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\NadConsole\Services\FormBuilder;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GeneralApiController extends Controller
{

    /**
     * getModel
     * 
     * return new instance of the model
     *
     * @param  string $modelName
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function getModel($modelName)
    {
        $modelArr = explode('.', $modelName);

        $model = 'App';

        if ($modelArr[0] != 'NadConsole') {
            $model .= '\\Models';
        }
        if (count($modelArr) > 1) {
            foreach ($modelArr as $name) {
                $model .= '\\' . $name;
            }
        } else {
            $model .= '\\' . $modelName;
        }

        return new $model;
    }

    /**
     * getDatatable
     * 
     * Returns a paginated datatable of a model.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDatatable(Request $request)
    {
        $searchCol = $request->searchCol;

        $model = $this->getModel($request->modelName);

        $tableName = $model->getTable();

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value


        $columns = array_column($columnName_arr, 'data');

        $records = $model->orderBy($columnName, $columnSortOrder);

        if (method_exists($model, 'filterData')) {
            $records = call_user_func_array([$model, 'filterData'], []);
        }

        // Total records
        $totalRecords = $records->select('count(*) as allcount')->count();
        $totalRecordswithFilter = $records->select('count(*) as allcount')->count();

        if ($searchValue) {
            $records = $records->where($tableName . '.' . $searchCol, 'like', '%' . $searchValue . '%');
            $totalRecordswithFilter = $records->select('count(*) as allcount')->where($searchCol, 'like', '%' . $searchValue . '%')->count();
        }

        // Fetch records
        $records = $records->orderBy($columnName, $columnSortOrder)
            ->select($tableName . '.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        $relationships = $request->get('relationships');
        foreach ($records as $record) {
            foreach ($columns as $col) {
                if ($request->relationships && array_key_exists($col, $relationships)) {
                    $value = $record->getRelationship($relationships[$col]);
                } else {
                    $value = $record->$col;
                }
                if (\method_exists($record, 'hook_column_' . $col . '_pre_render')) {
                    $value = $record->{'hook_column_' . $col . '_pre_render'}($value);
                }
                $row[$col] = $value;
            }
            $data_arr[] = $row;
        }

        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        ];

        return response()->json($response);
    }

    /**
     * getSelect2Data
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $tableName
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSelect2Data(Request $request, $tableName, $where = null)
    {
        $data = DB::table($tableName)->select($request->saveField, $request->displayField . ' as text');
        if ($where) {
            $data = $data->where($where);
        }
        return response()->json([
            'result' => $data->get()
        ]);
    }

    /**
     * getForm
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\NadConsole\Services\FormBuilder $fb
     * @param  integer $id 
     * @return string
     */
    public function getForm(Request $request, FormBuilder $fb, $id)
    {
        $model = $this->getModel($request->modelName);

        if (!\method_exists($model, $id)) {
            throw new NotFoundHttpException(sprintf('method %s is not exists in this model', $id));
        }
        $form = call_user_func_array([$model, $id], [$fb, $request->all()]);

        if ($request->has('id')) {
            $action = route($request->action, $request->id);
            return $form->render($action, $model->findOrFail($request->id));
        } else {
            $action = route($request->action);
            return $form->render($action);
        }
    }

    /**
     * getForm
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\NadConsole\Services\FormBuilder $fb
     * @param  integer $id 
     * @return string
     */
    public function getNewForm(Request $request, FormBuilder $fb, $id)
    {
        $model = $this->getModel($request->modelName);

        if (!\method_exists($model, $id)) {
            throw new NotFoundHttpException(sprintf('method %s is not exists in this model', $id));
        }
        $form = call_user_func_array([$model, $id], [$fb, $request->all()]);

        return $form->render($request->action);
    }

    /**
     * showItem
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    public function showItem(Request $request)
    {
        $model = $this->getModel($request->modelName);
        $data = $model->findOrFail($request->id);
        $row = [];
        foreach ($request->columns as $col) {
            if ($request->has('relationships') && is_array($request->relationships) && array_key_exists($col, $request->relationships)) {
                $value = $data->getRelationship($request->relationships[$col]);
                if (\method_exists($data, 'hook_column_' . $col . '_pre_render')) {
                    $row[$col] = $data->{'hook_column_' . $col . '_pre_render'}($value);
                }
            } else {
                $row[$col] = $data->$col;
            }
        }

        $nameSlug = $model->getSlug();

        $view = $request->has('viewSlug') && view()->exists('admin.popups.show.' . $request->viewSlug) ? view('admin.popups.show.' . $request->viewSlug) : view('admin.popups.show.general');
        return $view->with([
            'data' => $row,
            'nameSlug' => $nameSlug
        ]);
    }

    /**
     * destroy
     *
     * @param  \Illuminate\Http\Request $request
     * @param  integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $model = $this->getModel($request->modelName);

        $model->find($id)->delete();

        return response()->json([
            'success' => 'deleted successfully'
        ]);
    }
}

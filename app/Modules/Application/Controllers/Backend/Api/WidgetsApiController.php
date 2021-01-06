<?php

namespace App\Modules\Application\Controllers\Backend\Api;

use App\Http\Controllers\Controller;
use App\Modules\Domain\Services\Commands\WidgetsServiceCommand;
use Illuminate\Http\Request;

class WidgetsApiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->input();
        $service = new WidgetsServiceCommand();

        if (($id = $service->insert($input)) === false) {
            return response()->json(['result' => 0]);
        }

        return response()->json([
            'result' => 1,
            'id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->input('data');

        switch ($request->input('type')) {
            case 'update_ordering_batch':
                return $this->_updateOrderingBatch($input);
                break;
            default:
                return null;
                break;
        }
    }

    private function _updateOrderingBatch($input) {
        $service = new WidgetsServiceCommand();

        $result = $service->updateOrdering(explode(',', $input));

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = new WidgetsServiceCommand();
        return response()->json($service->delete($id));
    }
}

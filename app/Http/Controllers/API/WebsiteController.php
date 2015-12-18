<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Website as Model;

class WebsiteController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getList()
	{
		// FILTERS
		$filters = Input::only('skip', 'take', 'name');

		// VALIDATE
		$rules['skip']		= ['integer', 'min:0'];
		$rules['take']		= ['integer'];
		$rules['name']		= [''];

		$validator = Validate::make($filters, $rules);
		if ($validator->fails())
		{
			return JSend::fail($validator->messages()->toArray());          
		}
		else
		{
			$data = Model::name($filters['name'])
							->skip($filters['skip'])
							->take($filters['take'])
							->get();

			return JSend::success($data->toArray());
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postStore(Request $request)
	{
		// GET INPUT
		$input = Input::all();

		// GET VALIDATE
		$data = new Model;
		$data->fill($input);

		if (!Model::validate($data))
		{
			return JSend::fail($data->getErrors()->toArray());
		}  
		else
		{
			if ($data->save())
			{
				return JSend::success($data->toArray());
			}
			else
			{
				return JSend::success($data->getErrors());
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function getDetail($id)
	{
		//
		$data = Model::find($id);

		if ($data->id)
		{
			return JSend::success($data->toArray());
		}
		else
		{
			return JSend::fail(['Data not found']);
		}

	}
	
 	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function postDelete()
	{
		// 
		if (!Input::has('id'))
		{
			return JSend::fail(['InvalidRequest' => "Please specify id"])
		}
		//
		$data = Model::find(Input::get('id'));

		if (!$data->id)
		{
			return JSend::fail(['InvalidRequest' => "Data not found"])
		}

		if ($data->delete())
		{
			return JSend::success($data->toArray());
		}
		else
		{
			return JSend::fail($data->getErrors());
		}

	}
}

<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\User as Model;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return JSend
	 */
	public function getList()
	{
		// FILTERS
		$filters = Input::only('skip', 'take', 'name', 'email', 'mode');

		// VALIDATE
		$rules['skip']		= ['integer', 'min:0'];
		$rules['take']		= ['integer'];
		$rules['name']		= [];
		$rules['email']		= [];
		$rules['mode']		= ['in:a-z,z-a,recent_created,recent_updated,oldest_created,oldest_updated'];

		$validator = Validate::make($filters, $rules);
		if ($validator->fails())
		{
			return JSend::fail($validator->messages()->toArray());          
		}
		else
		{
			$data = Model::name($filters['name'])
							->email($filters['email'])
							->skip($filters['skip'])
							->take($filters['take']);

			switch ($filters['mode']) {
				case 'a-z':
					$data = $data->orderBy('name');
					break;

				case 'z-a':
					$data = $data->orderBy('name', 'desc');
					break;

				case 'recent_created':
					$data = $data->latest('created_at');
					break;

				case 'recent_updated':
					$data = $data->latest('updated_at');
					break;

				case 'oldest_created':
					$data = $data->oldest('created_at');
					break;

				case 'oldest_updated':
					$data = $data->oldest('updated_at');
					break;
			}

			$data = $data->get();

			return JSend::success($data->toArray());
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return JSend
	 */
	public function postRegister(Request $request)
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
	 * @return JSend
	 */
	public function getShow($id)
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
	 * @return JSend
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

	/**
	 * Authenticate
	 *
	 * @param  string  $email
	 * @param  string  $password
	 * @return JSend
	 */
	public function postAuthenticate()
	{
		$credential = Input::only('email', 'pasword');
		$data = Model::authenticate($credential);
		if ($data->id)
		{
			return JSend::success($data->toArray())
		}
		else
		{
			return JSend::fail(['Invalid Credential'])
		}
	}

	/**
	 * Authenticate Admin
	 *
	 * @param  string  $email
	 * @param  string  $password
	 * @return JSend
	 */
	public function postAuthenticateAdmin()
	{
		$credential = Input::only('email', 'pasword');
		$credential['role'] = 'admin';

		$data = Model::authenticate($credential);
		if ($data->id)
		{
			return JSend::success($data->toArray())
		}
		else
		{
			return JSend::fail(['Invalid Credential'])
		}
	}

	/**
	 * get Authorization
	 *
	 * @param  string  $email
	 * @param  string  $password
	 * @return JSend
	 */
	public function getAuthorized($user_id, $policy)
	{
		
	}
}

<?php 

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser
{
	private function successResponse($data, $code)
	{
		return response()->json($data,$code);
	}

	protected function errorResponse($message, $code)
	{
		return response()->json(['error' => $message, 'code' => $code],$code);	
	}

	protected function showAll(Collection $collection, $code = 200,$paginate = true)
	{
		if($collection->isEmpty()){
			return $this->successResponse(['data' => "No Existen resultados para la consulta realizada"], 404);
		}

		$collection = $this->filterData($collection);
		$collection = $this->sortData($collection);
		if($paginate){
			$collection = $this->paginate($collection);
		}
		//$collection  = $this->transformData($collection,$transformer);
		//$collection = $this->cacheResponse($collection);

		return $this->successResponse($collection, $code);
	}


	protected function showOne(Model $instance, $code = 200)
	{
		return $this->successResponse(['data' => $instance], $code);
	}

	protected function filterData(Collection $collection)
	{
		foreach(request()->query() as $query => $value)
		{
			//$attribute = $transformer :: originalAttribute($query); Obtenemos el atributo original en caso de usar transformaciones
			$array = array("sort_by","page",'per_page');
			
			if(isset($query, $value) && !in_array($query, $array))
			{
				$collection = $collection->where($query, $value);
			}
		}

		return $collection;
	}

	protected function sortData(Collection $collection)
	{
		if (request()->has('sort_by')) {
			
			$attribute = request()->sort_by;
			
			$collection = $collection->sortBy->{$attribute};			
			
		}

		return $collection;

	}

	protected function paginate(Collection $collection)
	{
		$rules = [
			'per_page' => 'integer|min:2|max:50'
		];

		Validator::validate(request()->all(),$rules);

		$page = LengthAwarePaginator::resolveCurrentPage();

		$perPage = 15;

		if(request()->has('per_page'))
		{
			$perPage = (int) request()->per_page;
		}

		$results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

		$paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
			'path' => LengthAwarePaginator::resolveCurrentPath(),
		]);
		
		$paginated->appends(request()->all());

		return $paginated;
	}

	protected function cacheResponse($data)
	{
		$url = request()->url();
		$queryParams = request()->query();
		ksort($queryParams);
		$queryString = http_build_query($queryParams);

		$fullUrl = "{$url}?{$queryString}";

		return Cache::remember($url, 15/60, function() use($data){
			return $data;
		});
	}
}




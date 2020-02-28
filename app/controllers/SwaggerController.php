<?php 
/**
 * @SWG\Swagger(
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Resource Planning",
 *         @SWG\Contact(name="Codal", url="http://local.resourceplanning.com/")
 *     )
 * )
 */
/**
 *
 * @SWG\Definition(definition="ErrorResponse", type="object", required={"messages"},
 *         @SWG\Property(property="status", type="string"),
 *         @SWG\Property(property="messages", type="array", @SWG\Items(type="string")),
 *         @SWG\Property(property="file", type="string"),
 *         @SWG\Property(property="line", type="integer",format="int32"),
 *         @SWG\Property(property="trace", type="array", @SWG\Items(type="string"))
 * )
 */

 /**
  * @SWG\Definition(definition="PagingData", type="object",
  *     @SWG\Property(property="currentPage", type="integer", format="int64"),
  *     @SWG\Property(property="nextPage", type="integer", format="int64"),
  *     @SWG\Property(property="prevPage", type="integer", format="int64"),
  *     @SWG\Property(property="totalItems", type="integer", format="int64"),
  *     @SWG\Property(property="totalPages", type="integer", format="int64"),
  *     @SWG\Property(property="firstPage", type="integer", format="int64"),
  *     @SWG\Property(property="lastPage", type="integer", format="int64"),
  *
  * )
 */

use Phlacon\Mvc\Model;

class SwaggerController extends ControllerBase
{
	private $appPath;
    private $jsonPath;

    public function initialize()
    {
        $this->appPath = $this->getDI()->get('config')->application->appDir;
    	// die($this->appPath);
        // return $this->appPath;
        $this->jsonPath = BASE_PATH.'/public/swagger-ui/temp.json';
    }
    public function indexAction() {
		$swagger = \Swagger\scan( $this->appPath);

    header('Content-Type:application/json');
       // return response()->json($swagger);
		return json_encode($swagger);

		
    }
    public function createAction(array $data, $parentId=null)
    {
        $swagger = \Swagger\scan( $this->appPath);

    header('Content-Type:application/json');
       // return response()->json($swagger);
    return json_encode($swagger);
    }

}

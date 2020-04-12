<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BootController;
use App\Services\ResponseManager\ResponseTrait;

class BaseApiController extends BootController
{
    use ResponseTrait;

    const GET_REQUEST = 'GET';
    const POST_REQUEST = 'POST';
    const PATCH_REQUEST = 'PATCH';
    const DELETE_REQUEST = 'DELETE';

    const INTEGER_PARAM = 'INTEGER';
    const STRING_PARAM = 'STRING';
    const ARRAY_PARAM = 'ARRAY';
    const BOOLEAN_PARAM = 'BOOLEAN';
    const FILE_PARAM = 'FILE';

    protected $errorsRequest = [];
    protected $request;
    protected $limit;
    protected $cursor;
    protected $offset;
    protected $expands = [];

    public function __construct()
    {
        $this->request = \request();

        $limit = (int)$this->request->get('limit');
        $offset = (int)$this->request->get('offset');
        $cursor = $this->request->get('cursor');

        $this->limit = $limit ? $limit : 100;
        $this->offset = $this->limit * $offset;
        $this->cursor = isset($cursor) ? (int)$cursor : null;

        $this->expands = $this->getExpands();
    }

    /**
     * @return array
     */
    public function getExpands()
    {
        $expands = $this->request->get('expands');

        return is_array($expands) ? $expands : [];
    }

    /**
     * @param string $expand
     * @return bool
     */
    public function hasExpand(string $expand)
    {
        return in_array($expand, $this->expands);
    }
}

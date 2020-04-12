<?php

namespace App\Services\ResponseManager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

trait ResponseTrait
{
    public function response(int $status, $message = null, $data = [])
    {
        $result = [];

        if (is_string($message)) {
            $result['message'] = $message;
        }

        if (is_array($message)) {
            $result = $message;
        }

        $result = array_merge($result, $data);

        return response()->json($result, $status);
    }

    public function responseError($status, $error = 'default', $invalidParameters = [])
    {
        $response = [
            'status' => $status,
        ];
        count($invalidParameters) && $response['invalid_parameters'] = $invalidParameters;
        !count($invalidParameters) && $response['error'] = $error;

        return response()->json($response, $status);
    }

    /**
     * @param string $parameterName
     * @param string $type
     * @param bool $isRequired
     * @param bool $isPost
     * @param array $allowed
     * @return mixed
     */
    public function requestParameter(string $parameterName, string $type, bool $isRequired, bool $isPost, $allowed = [])
    {
        $parameter = $isPost ? $this->request->post($parameterName) : $this->request->get($parameterName);

        if ($type === self::FILE_PARAM) {
            $parameter = $this->request->file($parameterName);
        }

        $error = false;
        $isRequired && !isset($parameter) && $error = true;

        if ($isRequired || isset($parameter)) {
            switch ($type) {
                case self::STRING_PARAM:
                case self::BOOLEAN_PARAM:
                    is_array($parameter) && $error = true;
                    break;

                case self::ARRAY_PARAM:
                    !is_array($parameter) && $error = true;
                    break;

                case self::FILE_PARAM:
                    !$parameter instanceof UploadedFile && $error = true;
                    break;

                case self::INTEGER_PARAM:
                default:
                    (is_array($parameter) || strlen((int)$parameter) !== strlen($parameter)) && $error = true;
                    break;
            }

            if (count($allowed) && !in_array($parameter, $allowed)) {
                $error = true;
            }
        }

        if ($error) {
            $data = [
                'required' => true,
                'must_be_type' => $type,
                'given_type' => strtoupper(gettype($parameter)),
            ];

            count($allowed) && $data['allowed'] = $allowed;

            $this->errorsRequest[$parameterName] = $data;
        } else {
            switch ($type) {
                case self::BOOLEAN_PARAM:
                    if ($parameterName === 'to_moderation' && $parameter === 'undefined') {
                        $parameter = true;
                        break;
                    }

                    if (isset($parameter)) {
                        $parameter = filter_var($parameter, FILTER_VALIDATE_BOOLEAN);
                    } else {
                        $parameter = null;
                    }

                    break;

                case self::INTEGER_PARAM:
                    if (isset($parameter)) {
                        $parameter = filter_var($parameter, FILTER_VALIDATE_INT);
                    } else {
                        $parameter = null;
                    }

                    break;
                default:
                    break;
            }
        }

        return $parameter;
    }
}

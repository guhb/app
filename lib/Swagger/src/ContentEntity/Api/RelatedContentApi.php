<?php
/**
 * RelatedContentApi
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */
/**
 *  Copyright 2015 SmartBear Software
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program. 
 * https://github.com/swagger-api/swagger-codegen 
 * Do not edit the class manually.
 */

namespace Swagger\Client\ContentEntity\Api;

use \Swagger\Client\Configuration;
use \Swagger\Client\ApiClient;
use \Swagger\Client\ApiException;
use \Swagger\Client\ObjectSerializer;

/**
 * RelatedContentApi Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class RelatedContentApi
{

    /**
     * API Client
     * @var \Swagger\Client\ApiClient instance of the ApiClient
     */
    protected $apiClient;
  
    /**
     * Constructor
     * @param \Swagger\Client\ApiClient|null $apiClient The api client to use
     */
    function __construct($apiClient = null)
    {
        if ($apiClient == null) {
            $apiClient = new ApiClient();
            $apiClient->getConfig()->setHost('https://localhost/');
        }
  
        $this->apiClient = $apiClient;
    }
  
    /**
     * Get API client
     * @return \Swagger\Client\ApiClient get the API client
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }
  
    /**
     * Set the API client
     * @param \Swagger\Client\ApiClient $apiClient set the API client
     * @return RelatedContentApi
     */
    public function setApiClient(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }
  
    
    /**
     * getRelatedContentFromContentUrl
     *
     * get the content related to content by url
     *
     * @param string $content_url  (optional)
     * @param int $limit  (optional)
     * @return \Swagger\Client\ContentEntity\Models\FilteredRelatedContent
     * @throws \Swagger\Client\ApiException on non-2xx response
     */
    public function getRelatedContentFromContentUrl($content_url=null, $limit=null)
    {
        
  
        // parse inputs
        $resourcePath = "/related-content/from-content-url";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = ApiClient::selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = ApiClient::selectHeaderContentType(array());
  
        // query params
        if ($content_url !== null) {
            $queryParams['contentUrl'] = $this->apiClient->getSerializer()->toQueryValue($content_url);
        }// query params
        if ($limit !== null) {
            $queryParams['limit'] = $this->apiClient->getSerializer()->toQueryValue($limit);
        }
        
        
        
        
  
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } else if (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        
        // make the API Call
        try
        {
            list($response, $httpHeader) = $this->apiClient->callApi(
                $resourcePath, $method,
                $queryParams, $httpBody,
                $headerParams, '\Swagger\Client\ContentEntity\Models\FilteredRelatedContent'
            );
            
            if (!$response) {
                return null;
            }

            return $this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\ContentEntity\Models\FilteredRelatedContent', $httpHeader);
            
        } catch (ApiException $e) {
            switch ($e->getCode()) { 
            case 200:
                $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\ContentEntity\Models\FilteredRelatedContent', $e->getResponseHeaders());
                $e->setResponseObject($data);
                break;
            }
  
            throw $e;
        }
        
        return null;
        
    }
    
    /**
     * getRelatedContentFromEntityId
     *
     * get the content related to an entity
     *
     * @param string $entity_id  (required)
     * @param int $limit  (optional)
     * @param bool $include_root_relations  (optional)
     * @return \Swagger\Client\ContentEntity\Models\FilteredRelatedContent
     * @throws \Swagger\Client\ApiException on non-2xx response
     */
    public function getRelatedContentFromEntityId($entity_id, $limit=null, $include_root_relations=null)
    {
        
        // verify the required parameter 'entity_id' is set
        if ($entity_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $entity_id when calling getRelatedContentFromEntityId');
        }
  
        // parse inputs
        $resourcePath = "/related-content/from-entity-id/{entityId}";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = ApiClient::selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = ApiClient::selectHeaderContentType(array());
  
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = $this->apiClient->getSerializer()->toQueryValue($limit);
        }// query params
        if ($include_root_relations !== null) {
            $queryParams['includeRootRelations'] = $this->apiClient->getSerializer()->toQueryValue($include_root_relations);
        }
        
        // path params
        if ($entity_id !== null) {
            $resourcePath = str_replace(
                "{" . "entityId" . "}",
                $this->apiClient->getSerializer()->toPathValue($entity_id),
                $resourcePath
            );
        }
        
        
  
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } else if (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        
        // make the API Call
        try
        {
            list($response, $httpHeader) = $this->apiClient->callApi(
                $resourcePath, $method,
                $queryParams, $httpBody,
                $headerParams, '\Swagger\Client\ContentEntity\Models\FilteredRelatedContent'
            );
            
            if (!$response) {
                return null;
            }

            return $this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\ContentEntity\Models\FilteredRelatedContent', $httpHeader);
            
        } catch (ApiException $e) {
            switch ($e->getCode()) { 
            case 200:
                $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\ContentEntity\Models\FilteredRelatedContent', $e->getResponseHeaders());
                $e->setResponseObject($data);
                break;
            case 400:
                $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\ContentEntity\Models\ResponseObj', $e->getResponseHeaders());
                $e->setResponseObject($data);
                break;
            }
  
            throw $e;
        }
        
        return null;
        
    }
    
    /**
     * getRelatedContentFromEntityName
     *
     * get content related to an entity (by name)
     *
     * @param string $name  (required)
     * @param int $limit  (optional)
     * @param bool $include_root_relations  (optional)
     * @return \Swagger\Client\ContentEntity\Models\FilteredRelatedContent
     * @throws \Swagger\Client\ApiException on non-2xx response
     */
    public function getRelatedContentFromEntityName($name, $limit=null, $include_root_relations=null)
    {
        
        // verify the required parameter 'name' is set
        if ($name === null) {
            throw new \InvalidArgumentException('Missing the required parameter $name when calling getRelatedContentFromEntityName');
        }
  
        // parse inputs
        $resourcePath = "/related-content/from-entity-name/{name}";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = ApiClient::selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = ApiClient::selectHeaderContentType(array());
  
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = $this->apiClient->getSerializer()->toQueryValue($limit);
        }// query params
        if ($include_root_relations !== null) {
            $queryParams['includeRootRelations'] = $this->apiClient->getSerializer()->toQueryValue($include_root_relations);
        }
        
        // path params
        if ($name !== null) {
            $resourcePath = str_replace(
                "{" . "name" . "}",
                $this->apiClient->getSerializer()->toPathValue($name),
                $resourcePath
            );
        }
        
        
  
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } else if (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        
        // make the API Call
        try
        {
            list($response, $httpHeader) = $this->apiClient->callApi(
                $resourcePath, $method,
                $queryParams, $httpBody,
                $headerParams, '\Swagger\Client\ContentEntity\Models\FilteredRelatedContent'
            );
            
            if (!$response) {
                return null;
            }

            return $this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\ContentEntity\Models\FilteredRelatedContent', $httpHeader);
            
        } catch (ApiException $e) {
            switch ($e->getCode()) { 
            case 200:
                $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\ContentEntity\Models\FilteredRelatedContent', $e->getResponseHeaders());
                $e->setResponseObject($data);
                break;
            }
  
            throw $e;
        }
        
        return null;
        
    }
    
}

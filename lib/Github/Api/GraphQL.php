<?php

namespace Github\Api;

/**
 * GraphQL API.
 *
 * Part of the Github v4 API
 *
 * @link   https://developer.github.com/v4/
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class GraphQL extends AbstractApi
{
    use AcceptHeaderTrait;

    /**
     * @param string $query
     * @param array  $variables
     * @param string $acceptHeaderValue
     * @param ?string $operationName
     *
     * @return array
     */
    public function execute($query, array $variables = [], string $acceptHeaderValue = 'application/vnd.github.v4+json', ?string $operationName = null)
    {
        $this->acceptHeaderValue = $acceptHeaderValue;
        $params = [
            'query' => $query,
        ];
        if (!empty($variables)) {
            $params['variables'] = json_encode($variables);
        }
        if (null !== $operationName) {
            $params['operationName'] = $operationName;
        }

        return $this->post('/graphql', $params);
    }

    /**
     * @param string $file
     * @param array  $variables
     *
     * @return array
     */
    public function fromFile($file, array $variables = [])
    {
        return $this->execute(file_get_contents($file), $variables);
    }
}

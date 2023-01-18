<?php

declare(strict_types=1);

namespace App\Api\OpenApi;

use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\OpenApi\Model;
use ApiPlatform\OpenApi\OpenApi;

/**
 * Class JwtDecorator for decorated token api documentation.
 */
final class JwtDecorator implements OpenApiFactoryInterface
{
    /**
     * @param OpenApiFactoryInterface $decorated
     */
    public function __construct(
        private readonly OpenApiFactoryInterface $decorated
    ) {
    }

    /**
     * Decorate onpen API for token.
     *
     * @param array<int, mixed> $context
     *
     * @return OpenApi
     */
    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);
        $schemas = $openApi->getComponents()->getSchemas();

        $schemas['Token'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'token' => [
                    'type' => 'string',
                    'readOnly' => true,
                ],
            ],
        ]);
        $schemas['Credentials'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'email' => [
                    'type' => 'string',
                    'example' => 'johndoe@example.com',
                ],
                'password' => [
                    'type' => 'string',
                    'example' => 'apassword',
                ],
            ],
        ]);

        $schemas = $openApi->getComponents()->getSecuritySchemes() ?? [];
        $schemas['JWT'] = new \ArrayObject([
            'type' => 'http',
            'scheme' => 'bearer',
            'bearerFormat' => 'JWT',
        ]);

        $pathItem = new Model\PathItem(
            ref: 'JWT Token',
            post: new Model\Operation(
                operationId: 'postCredentialsItem',
                tags: ['Token'],
                responses: [
                    '204' => [
                        'description' => 'Get JWT token in your cookies',
                        'content' => [
                            'application/json' => [
                                'schema' => [],
                            ],
                        ],
                    ],
                ],
                summary: 'Get JWT token to login.',
                description: 'Your Token will be store in cookies session.',
                requestBody: new Model\RequestBody(
                    description: 'Generate new JWT Token',
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/Credentials',
                            ],
                        ],
                    ]),
                ),
                security: [],
            ),
        );
        $openApi->getPaths()->addPath('/api/login', $pathItem);

        return $openApi;
    }
}

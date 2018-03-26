<?php

namespace ContactDuty\OAuth2;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class Client extends AbstractProvider {

    /**
     * @var string This will be prepended to the base uri.
     */
    protected $apiEndpoint = 'https://contactduty.com/api/v1/';

    /**
     * @var string This will be prepended to the base uri.
     */
    protected $oauthEndpoint = 'https://contactduty.com/oauth/';

    /**
     * @var string
     */
    protected $redirectUri;

    /**
     * @var string
     */
    public $scopeSeparator = ' ';

    /**
     * @var array
     */
    public $scopes = array(
        'create-messages',
        'read-messages',
        'edit-messages',
        'delete-messages'
    );

    /**
     * Get authorization url to begin OAuth flow
     *
     * @return string
     */
    public function getBaseAuthorizationUrl() {
        return $this->oauthEndpoint . 'authorize';
    }

    /**
     * Get access token url to retrieve token
     *
     * @param array $params
     *
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params) {
        return $this->oauthEndpoint . 'token';
    }

    /**
     * Get provider url to fetch user details
     *
     * @param AccessToken $token
     *
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token) {
        return $this->apiEndpoint . 'user';
    }

    /**
     * Get the default scopes used by this provider.
     *
     * @return array
     */
    protected function getDefaultScopes() {

        return $this->scopes;
    }

    /**
     * Check a provider response for errors.
     *
     * @param ResponseInterface $response
     * @param array|string $data
     *
     * @throws IdentityProviderException
     */
    public function checkResponse(ResponseInterface $response, $data) {
        if ($response->getStatusCode() >= 400) {
            throw new IdentityProviderException(
                !empty($data['error']) ? $data['error'] : $response->getReasonPhrase(),
                $response->getStatusCode(),
                $response
            );
        }
    }

    /**
     * Generate a user object from a successful user details request.
     *
     * @param array $response
     * @param AccessToken $token
     *
     * @return StripeResourceOwner
     */
    protected function createResourceOwner(array $response, AccessToken $token) {
        return new Owner($response);
    }

    /**
     * Returns the authorization headers used by this provider.
     *
     * Typically this is "Bearer" or "MAC". For more information see:
     * http://tools.ietf.org/html/rfc6749#section-7.1
     *
     * No default is provided, providers must overload this method to activate
     * authorization headers.
     *
     * @param  mixed|null $token Either a string or an access token instance
     * @return array
     */
    protected function getAuthorizationHeaders($token = null) {
        return array('Authorization' => 'Bearer ' . $token->getToken());
    }

    /**
     * Returns the default headers used by this provider.
     *
     * Typically this is used to set 'Accept' or 'Content-Type' headers.
     *
     * @return array
     */
    protected function getDefaultHeaders() {

        return array('Accept' => 'application/json');
    }

}
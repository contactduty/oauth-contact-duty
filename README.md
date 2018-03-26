# ContactDuty Provider for OAuth 2.0 Client
[ContactDuty](https://contactduty.com/) OAuth 2.0 support for the PHP League’s [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Installation

```
$ composer require contactduty/oauth-contact-duty
```
## Usage

You can get your OAuth client credentials [here](https://contactduty.com/home/api-clients).

```php
try {
    $provider = new ContactDuty\OAuth2\Client([
        'clientId'          => $clientId,
        'clientSecret'      => $clientSecret,
        'redirectUri'       => $redirectUri
    ]);

    $accessToken = $provider->getAccessToken('client_credentials');
    
    echo 'Access Token: ' . $accessToken->getToken() . "<br>";
    echo 'Expired in: ' . $accessToken->getExpires() . "<br>";
    echo 'Already expired? -> ' . ($accessToken->hasExpired() ? 'expired' : 'not expired') . "<br>";
    
 } catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    // Failed to get the access token
    die($e->getMessage());
}
```

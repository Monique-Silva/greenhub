1. Preflight request


2. CORS layer

It needs the front website to send a preflight request. After the preflight request, it will send back an access-control-allow-* to authorise the website to send a GET request /sanctum/csrf-cookie and pass to the next layer.

3. VerifyCsrfToken

This layer only blocks post/put and delete requests, with the aim of protecting the server from attacks (people trying to post/delete things on the server without authorisation). With a get request, it will pass to the next layer. Otherwise, ...


4. EnsureFrontendRequestsAreStateful

This layer only tries to authenticate the request. It wont stop or block it. It will check if there is an associated user with the request.

5. Laravel-API

After passed by all the layers, a session will be created with an ID and a CSRF token. The response sent back is a csrf and session id cookies, which will be expired within 2 hours. 

The browser will save these cookies, but the user is not authenticated. For that, it will need to send a POST request, with an email, password and also the x-xsrf-token (cookies). It will need to pass by all the layers.

Since it's a POST request, it will stop on the VerifyCsrfToken layer and check if the token is the same as the server's created section. If there's no match, it will send a 409 error. Otherwise, the request will be allowed to move forward.

In the EnsureFrontEnd.. layer, it will check if the request has a user id. Since there's not, it won't be authenticated but it will authorize to gets into the laravel-API. Getting there, laravel will find the user with the email and password and shows an user_id and update the created section with this new info. Ath this point, the user is authenticated and has 2 hours.

6. Sanctum-auth

In this layer, all the actions are only allowed by an authenticated user. If the browser send a GET request api/user, for instance, it will include the session id and xsrf-token. It will send back all ids for 2 hours. After that, the session will be expired, meaning that the EnsureFront... won't be able to authenticate the session and the sanctum layer will send a 401 error.





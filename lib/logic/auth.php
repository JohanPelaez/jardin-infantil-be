<?php
use \Firebase\JWT\JWT; 
class auth{

    function login(){
        $tokenId    = base64_encode(32); //base64_encode(mcrypt_create_iv(32))
        $issuedAt   = time();
        $notBefore  = $issuedAt + 10;  //Adding 10 seconds
        $expire     = $notBefore + 2592000; // Adding 1 month
        $serverName = 'http://localhost/~talosdigital/jardin-infantil-webapp/api/'; /// set your domain name 


        /*
            * Create the token as an array
            */
        $data = [
            'iat'  => $issuedAt,         // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss'  => $serverName,       // Issuer
            'nbf'  => $notBefore,        // Not before
            'exp'  => $expire,           // Expire
            'data' => [                  // Data related to the logged user you can set your required data
            'id'   => $row[0]['id'], // id from the users table
            'name' => $row[0]['name'], //  name
                        ]
        ];
        $secretKey = base64_decode(SECRET_KEY);
        /// Here we will transform this array into JWT:
        $jwt = JWT::encode(
                $data, //Data to be encoded in the JWT
                $secretKey, // The signing key
                    ALGORITHM 
                ); 
        return array(   'status'    => 'success',
                        'token'     => $jwt);
    }
}
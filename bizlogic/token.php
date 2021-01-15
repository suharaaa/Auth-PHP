<?php

    function generateToken($username) {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode(['username' => $username, 'expire' => time() + (15 * 60)]);

        $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        $signature = hash_hmac('sha256', $base64Header . "." . $base64Payload, "1qaz2wsx@", true);
        $base64Signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        $token = $base64Header . "." . $base64Payload . "." . $base64Signature;

        return $token;
    }

    function verifyToken($token) {
        $tokens = explode('.', $token);

        $payload = base64_decode($tokens[1]);
        $payload = json_decode($payload, true);

        if ($payload == null) { return false; }

        if ($payload['expire'] < time()) {
            return false;
        }
        
        return true;

    }
?>
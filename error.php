<?php
$server_url = "https://frompedrosilva.nl";
$server_name = "PEDRO SILVA";
$redirect_url = "https://frompedrosilva.nl";
$page_redirected_from = isset($_SERVER['REDIRECT_URL']) ? htmlspecialchars($_SERVER['REDIRECT_URL']) : '';

$error_messages = [
    400 => [
        'code' => '400 - Bad Request',
        'explanation' => 'The syntax of the URL submitted by your browser could not be understood. <br><br> Please verify the address and try again.'
    ],
    401 => [
        'code' => '401 - Unauthorized',
        'explanation' => 'This section requires a password or is otherwise protected. If you feel you have reached this page in error, please return to the login page and try again, or contact the webmaster if you continue to have problems.'
    ],
    403 => [
        'code' => '403 - Forbidden',
        'explanation' => 'This section requires a password or is otherwise protected. If you feel you have reached this page in error, please return to the login page and try again, or contact the webmaster if you continue to have problems.'
    ],
    404 => [
        'code' => '404 - Not Found',
        'explanation' => "The requested resource <strong>'{$page_redirected_from}'</strong> could not be found on this server. <br><br> Please verify the address and try again."
    ],
    500 => [
        'code' => '500 - Internal Server Error',
        'explanation' => 'The server encountered an internal error or misconfiguration and was unable to complete your request.'
    ],
    502 => [
        'code' => '502 - Bad Gateway',
        'explanation' => 'The server received an invalid response from the upstream server it accessed in attempting to fulfill the request.'
    ],
    503 => [
        'code' => '503 - Service Unavailable',
        'explanation' => 'The server is currently unable to handle the request due to temporary overloading or maintenance of the server.'
    ],
    504 => [
        'code' => '504 - Gateway Timeout',
        'explanation' => 'The server did not receive a timely response from the upstream server while trying to complete the request.'
    ],
    405 => [
        'code' => '405 - Method Not Allowed',
        'explanation' => 'The method specified in the request is not allowed for the resource identified by the request URL.'
    ],
    408 => [
        'code' => '408 - Request Timeout',
        'explanation' => 'The server timed out waiting for the request. Please try again.'
    ],
    429 => [
        'code' => '429 - Too Many Requests',
        'explanation' => 'You have sent too many requests in a given amount of time. Please try again later.'
    ],
    501 => [
        'code' => '501 - Not Implemented',
        'explanation' => 'The server does not support the functionality required to fulfill the request.'
    ],
    505 => [
        'code' => '505 - HTTP Version Not Supported',
        'explanation' => 'The server does not support the HTTP protocol version that was used in the request.'
    ],
];

$http_status = isset($_SERVER['REDIRECT_STATUS']) ? intval($_SERVER['REDIRECT_STATUS']) : 0;

$error_code = isset($error_messages[$http_status]) ? $error_messages[$http_status]['code'] : 'Unknown Error';
$explanation = isset($error_messages[$http_status]) ? $error_messages[$http_status]['explanation'] : 'An unknown error occurred.';
$redirect_to = $redirect_url;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error: <?php echo $error_code; ?></title>
    <link rel="icon" href="../assets/img/favicon.png" />
    <style>
        body {
            background: url('https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExaHVpNWozaHJhcDFkbjRtMDVkOWwxcmJ5OTVxZWNrZmR3ejNuYzd3byZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/26tn33aiTi1jkl6H6/giphy.webp') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100vh;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }
        h1 {
            color: #e74c3c;
            font-size: 48px;
            margin-bottom: 10px;
        }
        p {
            font-size: 18px;
            margin: 15px 0;
        }
        a {
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #fff;
        }
    </style>
    <?php if ($http_status !== 0): ?>
    <meta http-equiv="Refresh" content="5; url='<?php echo htmlspecialchars($redirect_to); ?>'">
    <?php endif; ?>
</head>
<body>
    <div class="container">
        <h1>Error Code: <br> <?php echo $error_code; ?></h1>
        <br>
        <p><?php echo $explanation; ?></p>
        <hr>
        <p>A project of <strong><a href="<?php echo $server_url; ?>"><?php echo $server_name; ?></a></strong></p>
    </div>
    <div class="footer">
        <p>You will be redirected in few seconds...</p>
    </div>
</body>
</html>

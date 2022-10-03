<?php

use App\Models\PushNotification;
use Aws\Credentials\Credentials;
use Aws\Sns\SnsClient;
/**
 * @param  $deviceToken
 *
 * @return  bool
 */
function generateSNSEndpoint($deviceToken): bool
{
    $userDeviceToken = PushNotification::where('device_id', $deviceToken)->first();

    if (empty($userDeviceToken)) {  
        return true;
    }

    $platformApplicationArn = ''; // you can manage same for other platforms e.g ios / web
    if ($userDeviceToken->platform == 'android') {
        $platformApplicationArn = config('services.sns.android_arn');
    }

    $client = new SnsClient([
        'version'     => '2010-03-31',
        'region'      => config('services.sns.region'),
        'credentials' => new Credentials(
            config('services.sns.key'),
            config('services.sns.secret')
        ),
    ]);

    $result = $client->createPlatformEndpoint(array(
        'PlatformApplicationArn' => $platformApplicationArn,
        'Token'                  => $deviceToken,
    ));

    $endPointArn = isset($result['EndpointArn']) ? $result['EndpointArn'] : '';
    $userDeviceToken->update(['endpoint_arn' => $endPointArn]);
    
    return true;
}

/**
 * @param  $userId
 * 
 * @return    bool
 */
function sendPushNotification($userId): bool
{
    $userDeviceTokens = PushNotification::where('user_id', $userId)->get();

    $client = new SnsClient([
        'version'     => '2010-03-31',
        'region'      => config('services.sns.region'),
        'credentials' => new Credentials(
            config('services.sns.key'),
            config('services.sns.secret')
        ),
    ]);

    foreach ($userDeviceTokens as $userDeviceToken) {
        $fcmPayload = json_encode(
            [
                'notification' => 
                    [
                        'title' => 'Test Notification',
                        'body'  => 'Hi from RB',
                        'sound' => 'default',
                    ],
            ]
        );

        $message = json_encode(['GCM' => $fcmPayload]);

        $client->publish([
            'TargetArn'        => $userDeviceToken->endpoint_arn,
            'Message'          => $message,
            'MessageStructure' => 'json',
        ]);
    }

    return true;
}


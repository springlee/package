<?php

return [
    'alipay' => [
        'app_id'         => '2016072900118402',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA5NgE2D2CODFNUxXPviZsDwlfOeixBIGhGWfuvz3dAeTccbhTI5S8zUcm7NNnL5NJUfnJU0ETnOwabFaxNNZdkt3FwPjqmr/yB6Y8XE5XwkG6UvT03XaL9kX7iFiD7xahzywRtiawO3hJtKP1iW/aWVPQ0Co4YfpfwyKoZ8QmQH9b/mxUdGExXvcI6ClYuaH8+8WrJto02EHbF1GS+BRF6G7QGNzQLtOxRKJltpEi90g3KGe2/biV88L19FDujapZ7Emrhvxf9DhpnsImQ+0RfNED7YuoAYUN1iI60YFG3+YxF6EplCzNLw9QNvMt2GFztn2Sddkft3CHXfGIobzYoQIDAQAB',
        'private_key'    => 'MIIEpQIBAAKCAQEA1oG1dlDMwrxX2xXvfC/ug7Y5pCNd8Ju1bA48F93gBMbplxYW3qDLxSW8KL7Bund6ws1enKDDLBBTEcJpHUZpFpL/Zdp5N/9k7aLSBxXNG48d639AFB2ooU+WqIW9nUthbFYktY4vbSZwWSpv6Hne4Riyh+cn7tlKvPmC6P4oIoCkVsVRYRrYXZDY0WUjPEubvMMONOqPEwQE53zo03fRztogDLx+fS8pAbywQ0Vbq8fFwqC6y2KpSUid1TKYX/0oAvt28H3GB8DtWFuL1AQiYiyOyaS0Ayn/rs1rYYYrsQp4y3tu7+26jJkhYjk+xMMRokhSeP6vvwTly75LI+j6/wIDAQABAoIBAQCY+6EDZNTj/Zda9OX71+NvpEKvwVl6BFL7YZuSGfdu8L4ftu1QkbVCQYtUM9fOuO+ghv93DWCkyG+2NsTo0BKauvPTHGFfgpHkuT65Nt81THi2P+bfcdeWVEDKp7d3uw8cSMOdiG5ilguCTDXLwz8loouRSVa9jdMzu2+V482T7IQo7vNmhwquu43Bx+W2VNUCY8czEGbV4HZb2s6cpzbT833fImEyxwP/Qt8QC+YFIMSXMghoYswF4b+m4848M/O+L+DRKse+GGtSRdr2tC+8LX8ZfcA/prB7iyNoDMe2z1/4K2DXHWVVQZ+T628r3JxfJUHGatVP+zbPvrBTIKghAoGBAPvTAps8HXOv9DAcbf0PWZemuHBvHeADZREiws1d2i/ycWtaGQMccADe19A+CZDce3hy/9y7GMXNooBSawtUk6ZQrHnkO77gPN8k0EDdpdXCmC5fcbvht9dZW/faCH6ymZJ/bk3DIKo8j2KvCRdgjcJC86pkO3zAdzFQSzG/OmMjAoGBANoQST/UtDZl2X78ZlZRbk5cJOXQXJFoDBOqV8TK6svuArvpx96570vbQnohWQdWTe+LDTTwcCkPei4zmvupAmfmCVM62/7TCTqjiJdgPAsHC96A3qJZ+bnnLhxLWewofP/us/qJaulYTaJzl+UwIhK7Lw6BOlEaX9XavjkKgGR1AoGBAJC9/0CEtBT7rKo+nQWYXhGplVeitpQ8v0mzJi7uY+utOX3PwpKkNMh7TaZ3Ef5+jEV2LBSOQbXn9SA2vyo7CcbNleVVxvV2Y+aKfVzbSWdtOxVkbLXmDkosJY13d+yC8Xxf3GG75zmSJ4Q8QUh7id9/phhpFjwlUB07Ho1QcdnrAoGBANUXsyzwQ8cg0mC4b50MaFmky93UNpFVdu/Et440qSvtg7h0JP/u/PxI4HaOnfyAhxp97ML97u0BFemOPnaM2zAC6LvvucoUGmG2KyWaQjKYiS2/C1Dl0har5jB6Jf6UNkq3ziMXJGWxB/SnNxkdZz6csshe2kklF9/Yqaj+LSd9AoGAP2VL4v+cf/kIcIof9CPzPPNUSYxWokxvku72f4djICz7ag0KckDsGFT1uxI1q9pmgYfhnlgBb/niHv3IBk7m/RJN4MRAkR57b2LiMUneKJuOLo0TD6TEN2Gcxt1ONRiCIMMCsHPlHP69iRiztunZqSim+JGVk9yClQNLowQthso=',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => 'wx4bca32308537afe4',   // 公众号 app id
        'mch_id'      => '1243675002',  // 第一步获取到的商户号
        'key'         => 'B6MNwKwrsFK9sbXCbAv4jFVnjCvSSe7L', // 刚刚设置的 API 密钥
        'cert_client' => resource_path('wechat_pay/apiclient_cert.pem'),
        'cert_key'    => resource_path('wechat_pay/apiclient_key.pem'),
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ]
];
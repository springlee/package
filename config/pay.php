<?php

return [
    'alipay' => [
        'app_id'         => '2018110862086332',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvwkJPAopQGaVa0UBv8BzFwYcxBcJ8gWsMjhfYJJf1Ow5/yGluMlJ5K0peFa+FDlqdT6sJ9R93GzYjbVH0rkSQAE2LHsfM5ULdYSsK/8dHmj7V286KPF90pXcOPN3corMpLiTpEqvGzgacUuQg1FuHI01Xf71rGgX6ZU2eYTRUy9Np9o3DAn6tuKr6GCnhfy8bEpd2fqmcFNJK041kAZ98rNmqCgCK11OavrfX9foQkupPy/LULOHc1r1IVUO4chhPG0WNETVnHlW6QhrP44BViS8eYRgOruSwkjFWwpkmmDFk2uBXu1Yj0+9SbRqnOKUyZPWIvZrpT0YBmJKYLy1OQIDAQAB',
        'private_key'    => 'MIIEowIBAAKCAQEA3N49ypuT7YTnGyblZUMBvyyWZOshNtTNQYgcYtzF7zxqbsPD
sTjpIt5kkZXg3/zg53iMoq0XxMuM8Q28dv1wM/MADbrVttrzuGhVDXTJktjaxPpo
P2ZXnuQTKlbnMWY2pg1ciPahwEhu5HvRq+0OMALcZfweW8NA8g6kjKGYURWpiXjR
4NyLAfWdXQeLZnDu12hsiu3Z28oqUIW9WBJkYsYrSQ/o+6ljhJCo3ZjSMILInfp1
5ysM0d7zKGUoxAvNZe1y+Rw5Lc26jSpG8ePDI/KAz1FmriFUKjLZ7S0AxNFKICMP
+8pLqpXxk6AURsKI3Y0xE9fguNjH1ju+6c6GNQIDAQABAoIBAQDV91LDMb637fV5
P1Ahri1GB6rWr1Zo6PTDVFmziI8T+WJeVbYBvNFV3z5sL1c/hppWg1kyyx7ongy3
BYibeWA2Y2Wc52/cifZrol8q/wW8BerBwpg1Oy8NFYRfkvq7x3qPmQgZA1yli0Yq
gK0Zsjf5WPwsrHa4jMog9QCB4JZPjTCx3gTUNanQ4TvYh48+f9iX8nYchRZ+qg72
u1Y/a9kqR/4h0zNyfmSRzU0h6/ddKCMjDDGXd8cmdewVM4MOK36TR+eEras02HXW
FIfpvmgz1afwlQnnAJ1/gTkEx7nlMIiG4yaV266QtXAtC1CZaXYC12pVs2ppbtV5
BLESqhmBAoGBAPddnhbnYRkaIFDgUpF/x0N97XxO2buHYqPbATz6ycQYrjVLJTXq
Db7nROCEjoyhgt9DqnB4fN70DKkRYb3yp4y2VPos6AB0GUzll3q0BmW0wH6/zl1b
+R3PzG92TxIJZmzZe020v6Eal0567sWRKhQpkzK7r1FMI1+IsiGj8fDhAoGBAOST
2ZMI5Co7LKdBvx45CT57KjrSgcIAYyn1EykZwZLPLPBRvaFrzP4oFrYMfx+hmzCu
erIFCyB3b4fc1JYYxXY7/6srZjmsyG/3hbWXepvS0sje+v8L9mmmdNlZg3nBIyxP
MVj6CaspZT2j9WaLdXeBEohi1jG0d/YRP116ZXvVAoGAP1mqcxMuus8GF7BbdQfU
cGR/vaYz/OLfUDd2SbewlJf9hYiJLxWSD6IK8bUBDOMQMT2TGNrCoBbAZ0wcTBko
79CCUs/NWtBg6mCiOrqAKOvxoIRexWoYkpn1MVaLSYM+yAGqomv357p3pZG2NMLI
lAFRwVxvudJV/NF1TUg/XgECgYAgd7PXA9NNAFzGYTthcp6ShnIoKtCNmvp68jnH
g8YQMWdjt2ilLifPDiizsTC5cH4XuyDoenjrIqvv83kq3NfnhHw7dw2tMZLC/Li8
Y4jh619PcwTaB3v349IDMYjQWZPCbnlG9zU6X8XmrIxmBXcpA2d7gfaE1uqXRDno
8ELMBQKBgC3qcT5gCcqvIAWT0yYonthijDy1/LPw2rlQzoVkMFeSOJGx2sbcg48O
pUcordyYcC3UggC6x1lzyuO/xQmAGdNJf2b7KTHS7uM8YtxIXrLuVzLiWq1F6eqT
wGHCyRdj+Jrui4qSlgaztmbpwLA17XCvH6Bi2hKsZcAmPm4eoHio',
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
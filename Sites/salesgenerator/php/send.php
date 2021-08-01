<?php
    
    /** получение, подготовка и отправка e-mail с данными о контакте, полученных с сайта */
    $phone = $_GET['tel'];
    $email = $_GET['email'];

    $phone = preg_replace("/\s?\(?\)?\s?-?/", "", $phone);
    $phone = substr($phone, 0, 2)." (".substr($phone, 2, 3).") ".substr($phone, 5, 3)."-".substr($phone, 8, 2)."-".substr($phone, 10, 2);

    echo "Данные формы, полученные с сайта:<br>" . "Email контакта: " . $email . "<br>Телефон контакта: " . $phone . "<br>";

    $to = 'iliu@yandex.ru';
    $title = 'Заявка Сотников Сергей';
    $msg = 'Email: ' . $email . " \r\n" . 'Phone: ' . $phone . " \r\n";
    $from = 'iliu1979@mail.ru';
    $headers =  'From: Сотников Сергей <' . $from . '>';
    
    $res = mail($to, $title, $msg, $headers);
    
    if ($res) echo "Почтовое отправление принято к доставке<br>";
    else {
        echo "Почтовое отправление отклонено<br>";
        $error = error_get_last()['message'];
        print_r($error);
    };

    $authorizationCode = 'XXXXX';
    $subdomain = '777belka777'; //Поддомен нужного аккаунта
    $arrContactParams = [
        // поля для контакта 
        "CONTACT" => [
            "name"          => $title,
            "phonePerson"	=> $phone,
            "emailPerson"	=> $email,
        ]
    ];

    /** используем для первоначальной авторизации и получения access и refresh token, требуется изменить одну строку данных для запроса*/
    //returnToken($subdomain, $authorizationCode, 'authorization_code'); 

    /** Внесение полученных с сайта данных о контакте в amoCRM*/
    //echo "<br>В AmoCRM добавлен контакт с ID:" . amoCRM($subdomain, $arrContactParams);

    function returnToken($subdomain, $token, $type) {
        
        /** Формируем URL для запроса */
        $link = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token';
        echo $link . "<br>";

        /** Формируем заголовки */
        $headers = ['Content-Type:application/json'];
    
        /** Собираем данные для запроса */
        $data = [
            'client_id' => '107914d8-b230-4132-9d14-3e3552fa61bb', // ID интеграции
            'client_secret' => '8UylBJTxtGweDgJykrafysA5XwBMO5oFfFZfqOZ7EacvmL3JIGOVAqVqENeQ0Esl', // Секретный ключ
            'grant_type' => $type,
            'refresh_token' => $token, //для перевоначальной авторизации используем поле 'code' => $token, иначе будет Bad request
            'redirect_uri' => 'https://777belka777.amocrm.ru',
        ];        
               
        $response = getAnswer($link, $headers, $data);
    
        if($response) {
    
            /* записываем конечное время жизни токена */
            $response["endTokenTime"] = time() + $response["expires_in"];
    
            $responseJSON = json_encode($response);
    
            /* передаём значения наших токенов в файл */
            $filename = "tkn.json";
            $f = fopen($filename,'w');
            fwrite($f, $responseJSON);
            fclose($f);
    
            $response = json_decode($responseJSON, true);
    
            return $response;
        }
        else {
            return false;
        }
    
    }

    function amoAddContact($subdomain, $accessToken, $arrContactParams) {
        
        /** Формируем URL для запроса */
        $link='https://' . $subdomain . '.amocrm.ru/api/v4/contacts';
        
        /** Формируем заголовки */
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $accessToken
        ];

        /** Собираем данные для запроса */
        $contacts = [
            [
                "name" => $arrContactParams["CONTACT"]["name"],
                "custom_fields_values" => [
                    [
                        "field_id" => 913746,
                        "values" => [
                            [
                                "value" => $arrContactParams["CONTACT"]["phonePerson"]
                            ]
                        ]
                    ],
                    [
                        "field_id" => 933499,
                        "values" => [
                            [
                                "value" => $arrContactParams["CONTACT"]["phonePerson"]
                            ]
                        ]
                    ],
                    [
                        "field_id" => 913750,
                        "values" => [
                            [
                                "value" => $arrContactParams["CONTACT"]["emailPerson"]
                            ]
                        ]
                    ],
                    [
                        "field_id" => 933501,
                        "values" => [
                            [
                                "value" => $arrContactParams["CONTACT"]["emailPerson"]
                            ]
                        ]
                    ],
                ]
            ],            
        ];
        $response= getAnswer($link, $headers, $contacts);
        //echo '<b>Данные о пользователе:</b>'; echo '<pre>'; print_r($response); echo '</pre>';
        return $response['_embedded']['contacts'][0]['id'];
    }

    function amoCRM($subdomain, $arrContactParams) {

        /* получаем значения токенов из файла */
        $dataToken = file_get_contents("tkn.json");
        $dataToken = json_decode($dataToken, true);
    
        /* проверяем, истёкло ли время действия токена Access */
        if($dataToken["endTokenTime"] < time()) {
            /* запрашиваем новый токен */
            $dataToken = returnToken($subdomain, $dataToken["refresh_token"], 'refresh_token');
            $accessToken = $dataToken["access_token"];
        }
        else {
            $accessToken = $dataToken["access_token"];
        }
    
        if($arrContactParams["CONTACT"]) {
            return amoAddContact($subdomain, $accessToken, $arrContactParams);
        } 
    }

    function getAnswer ($link, $headers, $data) {

        /**
         * Нам необходимо инициировать запрос к серверу.
         * Воспользуемся библиотекой cURL (поставляется в составе PHP).
         * Вы также можете использовать и кроссплатформенную программу cURL, если вы не программируете на PHP.
         */
        $curl = curl_init(); //Сохраняем дескриптор сеанса cURL
        /** Устанавливаем необходимые опции для сеанса cURL  */
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
        curl_setopt($curl,CURLOPT_URL, $link);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl,CURLOPT_HEADER, false);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
        $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
        //echo '<b>Данные:</b>'; echo '<pre>'; print_r(json_decode($out,true)); echo '</pre>';
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        /** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
        $code = (int)$code;        
        $errors = [
            400 => 'Bad request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not found',
            500 => 'Internal server error',
            502 => 'Bad gateway',
            503 => 'Service unavailable',
        ];
    
        try
        {
            /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
            if ($code < 200 || $code > 204) {
                throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
            }
        }
        catch(\Exception $e)
        {
            die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
        }
    
        /**
         * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
         * нам придётся перевести ответ в формат, понятный PHP
         */
        return json_decode($out,true);
    } 
    
?>
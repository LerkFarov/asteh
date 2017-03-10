<?php
    define('SHORTINIT', true);
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    if(isset($_POST['form_data'])){
        $sort_array = [];
        foreach($_POST['form_data'] as $value){
            $sort_array[$value['name']] = $value['value'];
        }

        $from  = "From: <master@mail.ru> \r\n";
        $from .= "Content-type: text/html; charset=utf-8\r\n";
        $admin_email = get_option('admin_email');

        switch($sort_array['type']){
            case 'call_back':
                $message_to_myemail = '
                    <table>
                     <tbody>
                      <tr>
                       <td>Имя:</td><td>'.$sort_array['name'].'</td>
                      </tr>
                      <tr>
                       <td>Телефон:</td><td>'.$sort_array['telefon'].'</td>
                      </tr>
                     </tbody>
                    </table>';

                $status = mail($admin_email, 'Обратний звонок', $message_to_myemail, $from);

                break;
            case 'contact':
                   $message_to_myemail = '
                    <table>
                     <tbody>
                      <tr>
                       <td>Имя:</td><td>'.$sort_array['name'].'</td>
                      </tr>
                      <tr>
                       <td>Телефон:</td><td>'.$sort_array['telefon'].'</td>
                      </tr>
                      <tr>
                       <td>Email:</td><td>'.$sort_array['email'].'</td>
                      </tr>
                      <tr>
                       <td>Сообщение:</td><td>'.$sort_array['your_message'].'</td>
                      </tr>
                     </tbody>
                    </table>';

                $status = mail($admin_email, 'ОБРАТНАЯ СВЯЗЬ', $message_to_myemail, $from);

                break;
            case 'orenda':
                $message_to_myemail = '
                    <table>
                     <tbody>
                      <tr>
                       <td>Имя:</td><td>'.$sort_array['name'].'</td>
                      </tr>
                      <tr>
                       <td>Телефон:</td><td>'.$sort_array['telefon'].'</td>
                      </tr>
                      <tr>
                       <td>Товар:</td><td>'.$sort_array['tovar'].'</td>
                      </tr>
                      <tr>
                       <td>Примечание:</td><td>'.$sort_array['description'].'</td>
                      </tr>
                     </tbody>
                    </table>';

                $status = mail($admin_email, 'Аренда', $message_to_myemail, $from);
                break;
        }
        echo $status;

    }
?>
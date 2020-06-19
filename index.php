<!DOCTYPE html>
<html>
<head> <title>Weather</title> </head>
<body style="background-color: #87CEEB">
<?php
if(!$_POST['city'])
    echo '
        <p style="text-align:center"><span style="background-color:#87CEEB"><img src="https://sun1-95.userapi.com/R_sCYyMiCoVI1ieJABQeaTmFNGjY1x6zzHNBAQ/UIfdg2c7kjc.jpg" /></span></p>

        <form name="Weather" action="index.php" method="post">
            <p style="text-align:center"><span style="background-color:#87CEEB">City:</span></p>
            <p style="text-align:center"><span style="background-color:#87CEEB"><input maxlength="32" name="city" required="required" size="16" type="text" /></span></p>
            <p style="text-align:center"><span style="background-color:#87CEEB"><input type="submit" name="done" value="Go!" /></span></p>
        </form>
        ';
else
{
    $city = $_POST['city'];
    $API = 'cbae8fdd183a40b994771418201806';
    $url = 'http://api.worldweatheronline.com/premium/v1/weather.ashx?key=' . $API . '&q=' . $city . '&format=json';
    if($curl = curl_init())
    {
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $result = curl_exec($curl);
        curl_close($curl);
        if($result)
        {
            $data = json_decode($result)->data;
            echo '
                <table align="center" border="1" cellpadding="1" cellspacing="1" style="height:500px; width:500px">
                    <caption><span style="background-color:#87CEEB">Weather</span></caption>
                    <tbody>
                        <tr>
                            <td>Date:</td>
                            <td>' . $data->weather[0]->date . '</td>
                        </tr>
                        <tr>
                            <td>Max temp:</td>
                            <td>' . $data->weather[0]->maxtempC . ' C' . '</td>
                        </tr>
                        <tr>
                            <td>Min temp:</td>
                            <td>' . $data->weather[0]->mintempC . ' C' . '</td>
                        </tr>
                        <tr>
                            <td>Average temp:</td>
                            <td>' . $data->weather[0]->avgtempC . ' C' . '</td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td>' . $data->current_condition[0]->weatherDesc[0]->value . '</td>
                        </tr>
                        <tr>
                            <td>Date:</td>
                            <td>' . $data->weather[1]->date . '</td>
                        </tr>
                        <tr>
                            <td>Max temp:</td>
                            <td>' . $data->weather[1]->maxtempC . ' C' . '</td>
                        </tr>
                        <tr>
                            <td>Min temp:</td>
                            <td>' . $data->weather[1]->mintempC . ' C' . '</td>
                        </tr>
                        <tr>
                            <td>Average temp:</td>
                            <td>' . $data->weather[1]->avgtempC . ' C' . '</td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td>' . $data->weather[1]->hourly[4]->weatherDesc[0]->value . '</td>
                        </tr>
                    </tbody>
                </table>';
        }
    }
}
?>
</body>
</html>

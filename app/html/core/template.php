<?php
include 'header.php';
include "functions.php";

    $domains=array(
        'nrm' => 'mlmsoft.com',
        'nrm-api2' => 'mlmsoft.com/api2/',
        'drupal' => 'sitefrontend.com',
        'grav' => 'onlineoffice.pro',
        'metabase' => 'report.mlmsoft.com'
    );

    $groups=array(
        'Delivery',
        'Dev',
        'Ethalons',
        'Prod',
        'Trial'
    );

    $protocol='https://';

    $nn=0;
    $service_type=array_keys($domains);
    $service_url=array_values($domains);

    foreach ($projects as $key => $value) {
        $nn++;
        $i=0;

        echo '<tr><th class="tg-ate8" colspan="5">' . $key . '</th></tr>';

        while ($i < strlen($value)) {
            $service_name = $key . '.' . $service_url[$i];

            if ($value[$i] == 1) {
                $service_status = get_status($protocol . $service_name);
                echo '<tr><td class="tg-baqh">' . ($i+1) . '</td><td class="tg-baqh">' . set_lamp($service_status).'</td><td class="tg-0lax">' . $service_type[$i] . '</td><td class="tg-0lax">' . '<a href="' . $protocol . $service_name . '">' . $service_name . '</a>' . '</td><td class="tg-0lax">' .$service_status . '</td></tr>';
            }
            else
                echo '<tr><td class="tg-baqh">' . ($i+1) . '</td><td class="tg-baqh">' . set_lamp('0').'</td><td class="tg-0lax">' . $service_type[$i] . '</td><td class="tg-0lax">' . 'service is disable'. '</td><td class="tg-0lax">' .'[000] OK' . '</td></tr>';
            $i++;
        }
    }

    ?>
</table>
</p>

<?php
include 'footer.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>WPL host checker</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width" />
    </head>
    <style type="text/css">
        *{margin: 0; padding:  0;}
        body{font: normal 13px Tahoma;}
        #page_container{margin: 100px auto; width: 960px; background: #dedede; border: 1px solid #cccccc; padding: 40px 0;}
        h1{text-align:  center; margin-bottom: 20px;}
        table.requirements{width: 100%;}
        table.requirements th.vertical{text-align: left;}
        table.requirements th.horizontal{text-align: right; padding-right: 10px;}
        span.red{font-weight: bold; color: red;}
        span.green{font-weight: bold; color: green;}
    </style>
    <body>
        <div id="page_container">
            <h1>Server requirements</h1>
            <table class="requirements">
                <tr>
                    <th class="horizontal">--</th>
                    <th class="vertical">Required</th>
                    <th class="vertical">Current</th>
                    <th class="vertical">Status</th>
                </tr>
                <?php
                    $webserver_name = isset($_SERVER['SERVER_SOFTWARE']) ? strtolower($_SERVER['SERVER_SOFTWARE']) : 'UNKNOWN';
                    $webserver = (strpos($webserver_name, 'apache') !== false or strpos($webserver_name, 'nginx') !== false) ? true : false;
                ?>
                <tr>
                    <th class="horizontal">Web Server</th>
                    <td>Standard</td>
                    <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
                    <td><?php echo $webserver ? '<span class="green">YES</span>' : '<span class="red">NO</span>'; ?></td>
                </tr>
                <tr>
                    <th class="horizontal">PHP version</th>
                    <td>5.3.1</td>
                    <td><?php echo phpversion(); ?></td>
                    <td><?php echo (!version_compare(phpversion(), '5.3.1', '>=') ? '<span class="red">NO</span>' : '<span class="green">YES</span>'); ?></td>
                </tr>
                <?php $gd = (extension_loaded('gd') && function_exists('gd_info')) ? true : false; ?>
                <tr>
                    <th class="horizontal">GD library</th>
                    <td>Installed</td>
                    <td><?php echo ($gd ? 'Installed' : 'Not installed'); ?></td>
                    <td><?php echo ($gd ? '<span class="green">YES</span>' : '<span class="red">NO</span>'); ?></td>
                </tr>
                <?php $safe = ini_get('safe_mode'); $safe_mode = (!$safe or strtolower($safe) == 'off') ? true : false; ?>
                <tr>
                    <th class="horizontal">Safe Mode</th>
                    <td>Off</td>
                    <td><?php echo $safe_mode ? 'Off' : 'On'; ?></td>
                    <td><?php echo $safe_mode ? '<span class="green">YES</span>' : '<span class="red">NO</span>'; ?></td>
                </tr>
                <?php $curl = function_exists('curl_version') ? true : false; ?>
                <tr>
                    <th class="horizontal"><?php echo CURL; ?></th>
                    <td>Installed</td>
                    <td><?php echo $curl ? 'Installed' : 'Not Installed'; ?></td>
                    <td><?php echo $safe_mode ? '<span class="green">YES</span>' : '<span class="red">NO</span>'; ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>

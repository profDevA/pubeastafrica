<?php

if (isset($_GET['provider'])) {
    $providerID = $_GET['provider'];

    if (isset(NextendSocialLogin::$allowedProviders[$providerID])) {
        $provider = NextendSocialLogin::$allowedProviders[$providerID];
        ?>
        <div class="nsl-admin-content">
        <h1>Debug: <?php echo $provider->getLabel(); ?></h1>

            <?php

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $provider->getTestUrl());
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "");
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);

            $cacert = ABSPATH . WPINC . '/certificates/ca-bundle.crt';
            if (file_exists($cacert)) {
                curl_setopt($ch, CURLOPT_CAINFO, $cacert);
            }

            $file            = tempnam(sys_get_temp_dir(), 'nsl-test');
            $temporaryHandle = fopen($file, 'w+');
            curl_setopt($ch, CURLOPT_STDERR, $temporaryHandle);

            $output = curl_exec($ch);
            curl_close($ch);

            rewind($temporaryHandle);

            $verboseLog = stream_get_contents($temporaryHandle);
            if (preg_match('/connected/i', $verboseLog)) {
                ?>
                <div class="updated"><p><b><?php printf(__('Network connection successful: %1$s', 'nextend-facebook-connect'), $provider->getTestUrl()); ?></b></p></div>
                <?php
            } else {
                ?>
                <div class="error">
                    <p>
                        <b><?php printf(__('Network connection failed: %1$s', 'nextend-facebook-connect'), $provider->getTestUrl()); ?></b>
                    </p>
                    <p>
                        <?php _e('Please contact with your hosting provider to resolve the network issue between your server and the provider.', 'nextend-facebook-connect'); ?>
                    </p>
                </div>
                <?php
            }

            echo "<pre>", htmlspecialchars($verboseLog), "</pre>\n";
            fclose($temporaryHandle);

            echo "<pre>", htmlspecialchars($output), "</pre>\n";
            @unlink($file);
            ?>
        </div>
        <?php
    }
}
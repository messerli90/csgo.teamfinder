<?php
try {
    $phar = new PharData('your-project-name.tar');
    $phar->extractTo('/teamfinder'); // extract all files
} catch (Exception $e) {
    // handle errors
}
?>
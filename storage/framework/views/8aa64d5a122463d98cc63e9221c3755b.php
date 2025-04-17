<?php if(function_exists('csp_nonce')): ?>
<script nonce="<?php echo e(csp_nonce()); ?>">
<?php else: ?>
<script>
<?php endif; ?>
    var lastCheck = new Date();
    var caffeineSendDrip = function () {
        var ajax = window.XMLHttpRequest
            ? new XMLHttpRequest
            : new ActiveXObject('Microsoft.XMLHTTP');

        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4 && ajax.status === 204) {
                lastCheck = new Date();
            }
        };

        ajax.open('GET', '<?php echo e($url); ?>');
        ajax.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        ajax.send();
    };

    setInterval(function () {
        caffeineSendDrip();
    }, <?php echo e($interval); ?>);

    if (<?php echo e($ageCheckInterval); ?> > 0) {
        setInterval(
            function () {
                if (new Date() - lastCheck >= <?php echo e($ageCheckInterval + $ageThreshold); ?>) {
                    location.reload(true);
                    setTimeout(
                        function () {
                            location.reload(true);
                        },
                        Math.max(0, <?php echo e($ageCheckInterval); ?> - 500),
                    );
                }
            },
            <?php echo e($ageCheckInterval); ?>,
        );
    }
</script>
<?php /**PATH C:\xampp\htdocs\vitemart-ec\vendor\genealabs\laravel-caffeine\src\Providers/../../resources/views/script.blade.php ENDPATH**/ ?>
<div>
	<?php
    session_start();

    unset($_SESSION['UserId']);
    // echo "<script>location.href = '/'</script>";
    echo "<script>window.location.href = '/'</script>";
    // onclick="window.location.href = '../dashboard'"

    session_destroy();

  ?>
</div>
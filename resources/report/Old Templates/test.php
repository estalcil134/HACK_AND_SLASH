<?php
echo "<script>document.domain=\"hack.and.slash\"</script>";
print_r($_POST);
?>
<script>
  window.addEventListener("message" receiveMessage, false);
  function receiveMessage(event)
  {
  	console.log(event.data);
  }
</script>
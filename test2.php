<?php
$file = fopen("test.txt","w+");

// exclusive lock
if (flock($file,LOCK_EX)) {
  fwrite($file,"Add some text to the file.");
  fflush($file);
  // release lock
  flock($file,LOCK_UN);
} else {
  echo "Error locking file!";
}
fclose($file);
?>
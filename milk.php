<!DOCTYPE html>
<html>
<body>

<?php
// Print the array from getdate()

// Return date/time info of a timestamp; then format the output
$mydate=getdate(date("U"));
echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
?>

</body>
</html>

<html>
<head><title>Show ufsp database</title></head>
		<link type="text/css" href="css/excite-bike/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
<body>
                <div>
                <meta charset="utf-8">

            <script>
            $(function() {
                $( "#from" ).datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3,
                    onSelect: function( selectedDate ) {
                        $( "#to" ).datepicker( "option", "minDate", selectedDate );
                    }
                });
                $( "#to" ).datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3,
                    onSelect: function( selectedDate ) {
                        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
                    }
                });
            });
            </script>
        
        
        
        <div class="demo">
        
        <label for="from">From</label>
        <input type="text" id="from" name="from"/>
        <label for="to">to</label>
        <input type="text" id="to" name="to"/>
        
        </div><!-- End demo -->
        
        
        
        <div class="demo-description">
        <p>Select the date range to search for.</p>
        </div><!-- End demo-description -->


<?php
$db="ufsp";
$mysql_user="root";
$mysql_password="root";
$mytable="usfp_table";
#$link = mysql_connect('localhost', 'mysql_user', 'mysql_password');
$link = mysql_connect(
  ':/Applications/MAMP/tmp/mysql/mysql.sock',
  'root',
  'root'
);
if (! $link)
die("Couldn't connect to MySQL");
mysql_select_db($db , $link)
or die("Couldn't open $db: ".mysql_error());

$result = mysql_query( "SELECT * FROM uspf_table" )
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "There are $num_rows records.<P>";
print "<table width=200 border=1>\n";
while ($get_info = mysql_fetch_row($result)){
print "<tr>\n";
foreach ($get_info as $field)
print "\t<td><font face=arial size=1/>$field</font></td>\n";
print "</tr>\n";
}
print "</table>\n";
mysql_close($link);
?>
</body>
</html> 
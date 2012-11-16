<?php
$db="thn";
$mysql_user="root";
$mysql_password="root";
$mytable1="`TABLE 1`";
$mytable2="`TABLE 2`";
//$link = mysql_connect('localhost', 'mysql_user', 'mysql_password'); -->
$link = mysql_connect(
  ':/Applications/MAMP/tmp/mysql/mysql.sock',
  'root',
  'root'
);
if (! $link)
die("Couldn't connect to MySQL");
mysql_select_db($db , $link)
or die("Couldn't open $db: ".mysql_error());

$result1 = mysql_query( "SELECT * FROM $mytable1" )
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

$result2 = mysql_query( "SELECT * FROM $mytable2" )
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "There are $num_rows records.<P>";
print "<table width=200 border=1>\n";
while ($get_info = mysql_fetch_row($result1)){
	print "<tr>\n";
	foreach ($get_info as $field)
	print "\t<td><font face=arial size=1/>$field</font></td>\n"; 
	while ($get_info = mysql_fetch_row($result2))
	{ foreach ($get_info as $field) 
	print "\t<td><font face=arial size=1/>$field</font></td>\n";}
		
	print "</tr>\n";
	}
print "</table>\n";

print "There are $num_rows records.<P>";
print "<table width=200 border=1>\n";
while ($get_info = mysql_fetch_row($result2)){
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
<?php
// your connection
mysql_connect("localhost","root","root");
mysql_select_db("banco_sisco");
 
// convert code
$res = mysql_query("SHOW TABLES");
while ($row = mysql_fetch_array($res))
{
    foreach ($row as $key => $table)
    {
        mysql_query("ALTER TABLE " . $table . " CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci");
        //echo $key . " => " . $table . " CONVERTED";
    }
}
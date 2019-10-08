<?php
  /** A PHP class to access MySQL database with convenient methods
    * in an object oriented way, and with a powerful debug system.\n
    * Licence:  LGPL \n
    * Web site: http://slaout.linux62.org/
    * @version  1.0
    * @author   S&eacute;bastien Lao&ucirc;t (slaout@linux62.org)
    */
  class DB
  {
    /** Put this variable to true if you want ALL queries to be debugged by default:
      */
    var $defaultDebug = false;

    /** INTERNAL: The start time, in miliseconds.
      */
    var $mtStart;
    /** INTERNAL: The number of executed queries.
      */
    var $nbQueries;
    /** INTERNAL: The last result ressource of a query().
      */
    var $lastResult;

    /** Connect to a MySQL database to be able to use the methods below.
      */
	
    function DB($base, $server, $user, $pass)
    {
      $this->mtStart    = $this->getMicroTime();
      $this->nbQueries  = 0;
      $this->lastResult = NULL;
      mysql_connect($server, $user, $pass) or die('Server connexion not possible.');
      mysql_select_db($base)               or die('Database connexion not possible.');
    }

    /** Query the database.
      * @param $query The query.
      * @param $debug If true, it output the query and the resulting table.
      * @return The result of the query, to use with fetchNextObject().
      */
    function query($query, $debug = -1)
    {
      $this->nbQueries++;
      $this->lastResult = mysql_query($query) or $this->debugAndDie($query);

      $this->debug($debug, $query, $this->lastResult);

      return $this->lastResult;
    }
    /** Do the same as query() but do not return nor store result.\n
      * Should be used for INSERT, UPDATE, DELETE...
      * @param $query The query.
      * @param $debug If true, it output the query and the resulting table.
      */
    function execute($query, $debug = -1)
    {
      $this->nbQueries++;
      mysql_query($query) or $this->debugAndDie($query);

      $this->debug($debug, $query);
    }
    /** Convenient method for mysql_fetch_object().
      * @param $result The ressource returned by query(). If NULL, the last result returned by query() will be used.
      * @return An object representing a data row.
      */
    function fetchNextObject($result = NULL)
    {
      if ($result == NULL)
        $result = $this->lastResult;

      if ($result == NULL || mysql_num_rows($result) < 1)
        return NULL;
      else
        return mysql_fetch_object($result);
    }
    /** Get the number of rows of a query.
      * @param $result The ressource returned by query(). If NULL, the last result returned by query() will be used.
      * @return The number of rows of the query (0 or more).
      */
    function numRows($result = NULL)
    {
      if ($result == NULL)
        return mysql_num_rows($this->lastResult);
      else
        return mysql_num_rows($result);
    }
    /** Get the result of the query as an object. The query should return a unique row.\n
      * Note: no need to add "LIMIT 1" at the end of your query because
      * the method will add that (for optimisation purpose).
      * @param $query The query.
      * @param $debug If true, it output the query and the resulting row.
      * @return An object representing a data row (or NULL if result is empty).
      */
    function queryUniqueObject($query, $debug = -1)
    {
      $query = "$query LIMIT 1";

      $this->nbQueries++;
      $result = mysql_query($query) or $this->debugAndDie($query);

      $this->debug($debug, $query, $result);

      return mysql_fetch_object($result);
    }
    /** Get the result of the query as value. The query should return a unique cell.\n
      * Note: no need to add "LIMIT 1" at the end of your query because
      * the method will add that (for optimisation purpose).
      * @param $query The query.
      * @param $debug If true, it output the query and the resulting value.
      * @return A value representing a data cell (or NULL if result is empty).
      */
    function queryUniqueValue($query, $debug = -1)
    {
      $query = "$query LIMIT 1";

      $this->nbQueries++;
      $result = mysql_query($query) or $this->debugAndDie($query);
      $line = mysql_fetch_row($result);

      $this->debug($debug, $query, $result);

      return $line[0];
    }
    /** Get the maximum value of a column in a table, with a condition.
      * @param $column The column where to compute the maximum.
      * @param $table The table where to compute the maximum.
      * @param $where The condition before to compute the maximum.
      * @return The maximum value (or NULL if result is empty).
      */
    function maxOf($column, $table, $where)
    {
      return $this->queryUniqueValue("SELECT MAX(`$column`) FROM `$table` WHERE $where");
    }
    /** Get the maximum value of a column in a table.
      * @param $column The column where to compute the maximum.
      * @param $table The table where to compute the maximum.
      * @return The maximum value (or NULL if result is empty).
      */
    function maxOfAll($column, $table)
    {
      return $this->queryUniqueValue("SELECT MAX(`$column`) FROM `$table`");
    }
    /** Get the count of rows in a table, with a condition.
      * @param $table The table where to compute the number of rows.
      * @param $where The condition before to compute the number or rows.
      * @return The number of rows (0 or more).
      */
    function countOf($table, $where)
    {
      return $this->queryUniqueValue("SELECT COUNT(*) FROM `$table` WHERE $where");
    }
    /** Get the count of rows in a table.
      * @param $table The table where to compute the number of rows.
      * @return The number of rows (0 or more).
      */
    function countOfAll($table)
    {
      return $this->queryUniqueValue("SELECT COUNT(*) FROM `$table`");
    }

	function getNoFaktur()
    {
	  $sql = mysql_query("SELECT distinct no_fa from hutang where status_bunga='BELUM'");
	  if(mysql_num_rows($sql))
	  {
	  $select= '<select style="height: 30px;width: 206px;" id="no_fakturastra" name="no_fakturastra">';
	  $select.='<option value="">Tidak ada</option>';
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $select.='<option value="'.$rs['no_fa'].'">'.$rs['no_fa'].'</option>';
	   /*$id++;*/
	   }
	  }
	  $select.='</select>';
	  return $select;
    }
	
	function getTipe()
    {
	  $sql = mysql_query("SELECT distinct KD_TIPE FROM msttype");
	  if(mysql_num_rows($sql))
	  {
	  $select= '<select style="height: 30px;margin-top: 7px;width: 206px;" class="kd_tipe" id="kd_tipe1" name="kd_tipe[]" onchange="showKodeTipe(1);">';
	  $select.='<option value="">Tidak ada</option>';
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $select.='<option value="'.$rs['KD_TIPE'].'">'.$rs['KD_TIPE'].'</option>';
	   /*$id++;*/
	   }
	  }
	  $select.='</select>';
	  return $select;
    }
	
	function getDeskripsi()
    {
	  $sql = mysql_query("SELECT distinct NM_TIPE FROM msttype order by nm_tipe");
	  if(mysql_num_rows($sql))
	  {
	  $select= '<select style="height: 30px;margin-top: 7px;width: 206px;" class="namatipe" id="namatipe1" name="namatipe[]" onchange="showKodeTipe(1);" required>';
	  $select.='<option value="">Tidak ada</option>';
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $select.='<option value="'.$rs['NM_TIPE'].'">'.$rs['NM_TIPE'].'</option>';
	   /*$id++;*/
	   }
	  }
	  $select.='</select>';
	  return $select;
    }

	function getDeskripsiSPES()
    {
	  $sql = mysql_query("SELECT distinct NM_TIPE FROM msttype order by nm_tipe");
	  if(mysql_num_rows($sql))
	  {
	  $select= '<select style="height: 30px;margin-top: 7px;width: 206px;" class="namatipe" id="namatipe1" name="namatipe[]" onchange="showKodeTipeSPES(1);" required>';
	  $select.='<option value="">Tidak ada</option>';
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $select.='<option value="'.$rs['NM_TIPE'].'">'.$rs['NM_TIPE'].'</option>';
	   /*$id++;*/
	   }
	  }
	  $select.='</select>';
	  return $select;
    }
	
	function getAksesoris()
    {
	  $sql = mysql_query("SELECT distinct nm_aksesoris FROM mstaksesoris union select distinct nm_part FROM mstpart union select distinct kategori from mstmerchandise");
	  if(mysql_num_rows($sql))
	  {
	  $select= '<select style="height: 30px;margin-top: 7px;width: 206px;" class="namatipe" id="namatipe1" name="namatipe[]" onchange="showNamaTipe(1);" required>';
	  $select.='<option value="">Tidak ada</option>';
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $select.='<option value="'.$rs['nm_aksesoris'].'">'.$rs['nm_aksesoris'].'</option>';
	   /*$id++;*/
	   }
	  }
	  $select.='</select>';
	  return $select;
    }
	
	function getShippingDetail($shippingnumber)
    {
	  $sql = mysql_query("SELECT * from trbelidetail where no_fa='".$shippingnumber."'");
      $query = "<tr style='background-color:#ccccff; -webkit-print-color-adjust:exact'>
      <th width=20%> KODE </th>
      <th width=20%> TIPE </th>
      <th width=20%> NAMA </font></th>
      <th width=20%> NO. RANGKA</th>
      <th width=20%> NO. MESIN</th>";
	  if(mysql_num_rows($sql))
	  {
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
      $query.= "<tr>
	   <td width=20%><b>".$rs['KD_ASTRA']."</td>
       <td width=20%>".$rs['KD_TIPE']."</td>
       <td width=20%>".$rs['NM_TIPE']."</td>
       <td width=20%>".$rs['NO_RANGKA']."</td>
	   <td width=20%>".$rs['NO_MESIN']."</td>
	   </tr>";
	  /*$id++;*/
	   }
	  }
	  return $query;
    }
	
	function getLeasing()
    {
	  $sql = mysql_query("SELECT distinct KD_LEASE,NM_LEASE FROM mstlease");
	  if(mysql_num_rows($sql))
	  {
	  $select= '<select style="height: 30px;margin-top: 7px;width: 206px;" id="kd_lease" name="kd_lease">';
	  $select.='<option value="">Tidak ada</option>';
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $select.='<option value="'.$rs['KD_LEASE'].'">'.$rs['NM_LEASE'].'</option>';
	   /*$id++;*/
	   }
	  }
	  $select.='</select>';
	  return $select;
    }
	
	
	function getJumlahBeli($nota)
    {
	  $sql = mysql_query("SELECT KD_CUST from trjual where NO_NOTA='$nota'");
	  $jmlbeli = mysql_query("select FORMAT(sum(quantity),0) from trjualdetail where NO_NOTA = '$nota'");
	  $beli = mysql_fetch_row($jmlbeli);
	  $beliqty = $beli[0];
	  if(mysql_num_rows($sql))
	  {
	  $querybeli = "";
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $querybeli.="update mstcust set jml_beli=jml_beli -".$beliqty." where kd_cust='".$rs['KD_CUST']."'";
	   /*$id++;*/
	   }
	  }
	  //$gabungan = implode(';', $multiquery);
	  return $querybeli;
    }
	
	function getJumlahJual($terima)
    {
	  $sql = mysql_query("SELECT KD_SUP from trbeli where NO_TERIMA='$terima'");
	  $jmljual = mysql_query("select FORMAT(sum(quantity),0) from trbelidetail where NO_TERIMA = '$terima'");
	  $jual = mysql_fetch_row($jmljual);
	  $jualqty = $jual[0];
	  if(mysql_num_rows($sql))
	  {
	  $queryjual = "";
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $queryjual.="update mstsup set jml_jual=jml_jual -".$jualqty." where kd_sup='".$rs['KD_SUP']."'";
	   /*$id++;*/
	   }
	  }
	  //$gabungan = implode(';', $multiquery);
	  return $queryjual;
    }
	
	function getMotor($nota)
    {
	  $sql = mysql_query("SELECT NO_RANGKA,FORMAT(QUANTITY,0) AS QTY from trjualdetail where NO_NOTA='$nota'");
	  
	  if(mysql_num_rows($sql))
	  {
	  $multiquery = array();
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $multiquery[]="update motor set jumlah=jumlah +".$rs['QTY']." where no_rangka='".$rs['NO_RANGKA']."'";
	   /*$id++;*/
	   }
	  }
	  //$gabungan = implode(';', $multiquery);
	  return $multiquery;
    }
	
	function getMotorBeli($terima)
    {
	  $sql = mysql_query("SELECT NO_RANGKA,FORMAT(QUANTITY,0) AS QTY from trbelidetail where NO_TERIMA='$terima'");
	  
	  if(mysql_num_rows($sql))
	  {
	  $multiquery5 = array();
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $multiquery5[]="update motor set jumlah=jumlah -".$rs['QTY']." where no_rangka='".$rs['NO_RANGKA']."'";
	   /*$id++;*/
	   }
	  }
	  //$gabungan = implode(';', $multiquery);
	  return $multiquery5;
    }
	
	function getCurrentPart($nota)
    {
	  $sql = mysql_query("SELECT KD_PART from trjualpart where NO_NOTA='$nota'");
	  $jmlpart = mysql_query("select FORMAT(sum(quantity),0) from trjualdetail where NO_NOTA = '$nota'");
	  $part = mysql_fetch_row($jmlpart);
	  $qty = $part[0];
	  if(mysql_num_rows($sql))
	  {
	  $multiquery2 = array();
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $multiquery2[]="update mstpart set jumlah=jumlah +".$qty." where kd_part='".$rs['KD_PART']."'";
	   /*$id++;*/
	   }
	  }
	  //$gabungan = implode(';', $multiquery);
	  return $multiquery2;
    }
	
	function getCurrentPromo($nota)
    {
	  $sql = mysql_query("SELECT KD_PROMO from trjualpromo where NO_NOTA='$nota'");
	  $jmlpromo = mysql_query("select FORMAT(sum(quantity),0) from trjualdetail where NO_NOTA = '$nota'");
	  $promo = mysql_fetch_row($jmlpromo);
	  $qtypromo = $promo[0];
	  if(mysql_num_rows($sql))
	  {
	  $multiquery3 = array();
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $multiquery3[]="update mstpromo set jumlah=jumlah +".$qtypromo." where kd_promo='".$rs['KD_PROMO']."'";
	   /*$id++;*/
	   }
	  }
	  //$gabungan = implode(';', $multiquery);
	  return $multiquery3;
    }
	
	function getKodeTipe()
    {
	  $sql = mysql_query("SELECT distinct KD_TIPE FROM msttype");
	  if(mysql_num_rows($sql))
	  {
	  $select= '<select class="kd_tipe" id="kd_tipe" name="kd_tipe" onchange="getNoRangka()">';
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $select.='<option value="'.$rs['KD_TIPE'].'">'.$rs['KD_TIPE'].'</option>';
	   /*$id++;*/
	   }
	  }
	  $select.='</select>';
	  return $select;
    }
	
	function getKodeWarna()
    {
	  $sql = mysql_query("SELECT distinct KD_WARNA,NM_WARNA FROM mstwarna");
	  if(mysql_num_rows($sql))
	  {
	  $select= '<select class="kd_warna" id="kd_warna" name="kd_warna">';
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $select.='<option value="'.$rs['KD_WARNA'].'">'.$rs['NM_WARNA'].'</option>';
	   /*$id++;*/
	   }
	  }
	  $select.='</select>';
	  return $select;
    }
	
	function getTipePart()
    {
	  $sql = mysql_query("SELECT distinct KD_TIPE FROM mstpart");
	  if(mysql_num_rows($sql))
	  {
	  $select= '<select class="kd_part" id="kd_part" name="kd_part">';
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $select.='<option value="'.$rs['KD_TIPE'].'">'.$rs['KD_TIPE'].'</option>';
	   /*$id++;*/
	   }
	  }
	  $select.='</select>';
	  return $select;
    }
	
	function getSupplier()
    {
	  $sql = mysql_query("SELECT distinct KD_SUP,NM_SUP FROM mstsup");
	  if(mysql_num_rows($sql))
	  {
	  $select= '<select style="height: 30px;margin-bottom: 0px" class="kd_sup" id="kd_sup" name="kd_sup" readonly="">';
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $select.='<option value="'.$rs['KD_SUP'].'">'.$rs['NM_SUP'].'</option>';
	   /*$id++;*/
	   }
	  }
	  $select.='</select>';
	  return $select;
    }
	
	function getSupplierLine()
    {
	  $sql = mysql_query("SELECT distinct KD_SUP,NM_SUP FROM mstsup");
	  if(mysql_num_rows($sql))
	  {
	  $select= '<select style="height: 30px;margin-top: 7px" id="kd_sup1" name="kd_sup[]">';
	   while($rs=mysql_fetch_array($sql))
	   {
	   /*$id = 1;*/
       $select.='<option value="'.$rs['KD_SUP'].'">'.$rs['NM_SUP'].'</option>';
	   /*$id++;*/
	   }
	  }
	  $select.='</select>';
	  return $select;
    }
	
    function getKelengkapan()
    {
    $sql = mysql_query("SELECT distinct KD_PART,NM_PART FROM mstpart");
    if(mysql_num_rows($sql))
    {
    $select= '<select class="kelengkapan" id="kelengkapan1" name="kelengkapan[]">';
    $select.='<option value="">Tidak ada</option>';
     while($rs=mysql_fetch_array($sql))
     {
     /*$id = 1;*/
       $select.='<option value="'.$rs['KD_PART'].'">'.$rs['NM_PART'].'</option>';
     /*$id++;*/
     }
    }
    $select.='</select>';
    return $select;
    }

    function getPromo()
    {
    $sql = mysql_query("SELECT distinct KD_PROMO,NM_PROMO FROM mstpromo where jumlah>0");
    if(mysql_num_rows($sql))
    {
    $select= '<select style="height: 30px;margin-top: 7px;width: 206px;" class="aksesorispromo" id="aksesorispromo1" name="aksesorispromo[]">';
    $select.='<option value="">Tidak ada</option>';
     while($rs=mysql_fetch_array($sql))
     {
     /*$id = 1;*/
       $select.='<option value="'.$rs['KD_PROMO'].'">'.$rs['NM_PROMO'].'</option>';
     /*$id++;*/
     }
    }
    $select.='</select>';
    return $select;
    }
	
	function getBroker()
    {
    $sql = mysql_query("SELECT distinct KD_BROKER,NM_BROKER FROM broker");
    if(mysql_num_rows($sql))
    {
    $select= '<select style="height: 30px;margin-top: 7px;width: 206px;" class="broker" id="broker" name="broker">';
    $select.='<option value="">Tidak ada</option>';
     while($rs=mysql_fetch_array($sql))
     {
     /*$id = 1;*/
       $select.='<option value="'.$rs['KD_BROKER'].'">'.$rs['NM_BROKER'].'</option>';
     /*$id++;*/
     }
    }
    $select.='</select>';
    return $select;
    }

    function getKodeAstra()
    {
    $sql = mysql_query("SELECT distinct KD_ASTRA FROM msttype");
    if(mysql_num_rows($sql))
    {
    $select= '<select style="height: 30px;margin-top: 7px;width: 206px;" class="kd_astra" id="kd_astra1" name="kd_astra[]" onchange="showKodeAstra(1);" required>';
    $select.='<option value="">Tidak ada</option>';
	 while($rs=mysql_fetch_array($sql))
     {
     /*$id = 1;*/
       $select.='<option value="'.$rs['KD_ASTRA'].'">'.$rs['KD_ASTRA'].'</option>';
     /*$id++;*/
     }
    }
    $select.='</select>';
    return $select;
    }
		
    function getWarna()
    {
    $sql = mysql_query("SELECT distinct KD_WARNA,NM_WARNA FROM mstwarna order by kd_warna");
    if(mysql_num_rows($sql))
    {
    $select= '<select style="height: 30px;margin-top: 7px;width: 206px;" class="kd_warna" id="kd_warna1" name="kd_warna[]" required>';
    $select.='<option value="">Tidak ada</option>';
	while($rs=mysql_fetch_array($sql))
     {
     /*$id = 1;*/
       $select.='<option value="'.$rs['KD_WARNA'].'">'.$rs['KD_WARNA'].'</option>';
     /*$id++;*/
     }
    }
    $select.='</select>';
    return $select;
    }


    function getSalesman()
    {
    $sql = mysql_query("SELECT distinct NM_SALES FROM mstsales");
    if(mysql_num_rows($sql))
    {
    $select= '<select style="height: 30px;margin-top: 7px;width: 206px;" id="namasales" name="namasales">';
     while($rs=mysql_fetch_array($sql))
     {
     /*$id = 1;*/
       $select.='<option value="'.$rs['NM_SALES'].'">'.$rs['NM_SALES'].'</option>';
     /*$id++;*/
     }
    }
    $select.='</select>';
    return $select;
    }


    /** Internal function to debug when MySQL encountered an error,
      * even if debug is set to Off.
      * @param $query The SQL query to echo before diying.
      */
	function sumOfJumlah($table,$column)
    {
      return $this->queryUniqueValue("SELECT SUM($column) FROM `$table`");
    }
    function debugAndDie($query)
    {
      $this->debugQuery($query, "Error");
      die("<p style=\"margin: 2px;\">".mysql_error()."</p></div>");
    }
    /** Internal function to debug a MySQL query.\n
      * Show the query and output the resulting table if not NULL.
      * @param $debug The parameter passed to query() functions. Can be boolean or -1 (default).
      * @param $query The SQL query to debug.
      * @param $result The resulting table of the query, if available.
      */
    function debug($debug, $query, $result = NULL)
    {
      if ($debug === -1 && $this->defaultDebug === false)
        return;
      if ($debug === false)
        return;

      $reason = ($debug === -1 ? "Default Debug" : "Debug");
      $this->debugQuery($query, $reason);
      if ($result == NULL)
        echo "<p style=\"margin: 2px;\">Number of affected rows: ".mysql_affected_rows()."</p></div>";
      else
        $this->debugResult($result);
    }
    /** Internal function to output a query for debug purpose.\n
      * Should be followed by a call to debugResult() or an echo of "</div>".
      * @param $query The SQL query to debug.
      * @param $reason The reason why this function is called: "Default Debug", "Debug" or "Error".
      */
    function debugQuery($query, $reason = "Debug")
    {
      $color = ($reason == "Error" ? "red" : "orange");
      echo "<div style=\"border: solid $color 1px; margin: 2px;\">".
           "<p style=\"margin: 0 0 2px 0; padding: 0; background-color: #DDF;\">".
           "<strong style=\"padding: 0 3px; background-color: $color; color: white;\">$reason:</strong> ".
           "<span style=\"font-family: monospace;\">".htmlentities($query)."</span></p>";
    }
    /** Internal function to output a table representing the result of a query, for debug purpose.\n
      * Should be preceded by a call to debugQuery().
      * @param $result The resulting table of the query.
      */
    function debugResult($result)
    {
      echo "<table border=\"1\" style=\"margin: 2px;\">".
           "<thead style=\"font-size: 80%\">";
      $numFields = mysql_num_fields($result);
      // BEGIN HEADER
      $tables    = array();
      $nbTables  = -1;
      $lastTable = "";
      $fields    = array();
      $nbFields  = -1;
      while ($column = mysql_fetch_field($result)) {
        if ($column->table != $lastTable) {
          $nbTables++;
          $tables[$nbTables] = array("name" => $column->table, "count" => 1);
        } else
          $tables[$nbTables]["count"]++;
        $lastTable = $column->table;
        $nbFields++;
        $fields[$nbFields] = $column->name;
      }
      for ($i = 0; $i <= $nbTables; $i++)
        echo "<th colspan=".$tables[$i]["count"].">".$tables[$i]["name"]."</th>";
      echo "</thead>";
      echo "<thead style=\"font-size: 80%\">";
      for ($i = 0; $i <= $nbFields; $i++)
        echo "<th>".$fields[$i]."</th>";
      echo "</thead>";
      // END HEADER
      while ($row = mysql_fetch_array($result)) {
        echo "<tr>";
        for ($i = 0; $i < $numFields; $i++)
          echo "<td>".htmlentities($row[$i])."</td>";
        echo "</tr>";
      }
      echo "</table></div>";
      $this->resetFetch($result);
    }
    /** Get how many time the script took from the begin of this object.
      * @return The script execution time in seconds since the
      * creation of this object.
      */
    function getExecTime()
    {
      return round(($this->getMicroTime() - $this->mtStart) * 1000) / 1000;
    }
    /** Get the number of queries executed from the begin of this object.
      * @return The number of queries executed on the database server since the
      * creation of this object.
      */
    function getQueriesCount()
    {
      return $this->nbQueries;
    }
    /** Go back to the first element of the result line.
      * @param $result The resssource returned by a query() function.
      */
    function resetFetch($result)
    {
      if (mysql_num_rows($result) > 0)
        mysql_data_seek($result, 0);
    }
    /** Get the id of the very last inserted row.
      * @return The id of the very last inserted row (in any table).
      */
    function lastInsertedId()
    {
      return mysql_insert_id();
    }
    /** Close the connexion with the database server.\n
      * It's usually unneeded since PHP do it automatically at script end.
      */
    function close()
    {
      mysql_close();
    }

    /** Internal method to get the current time.
      * @return The current time in seconds with microseconds (in float format).
      */
    function getMicroTime()
    {
      list($msec, $sec) = explode(' ', microtime());
      return floor($sec / 1000) + $msec;
    }
  } // class DB
?>


<?php 

/**
* 
*/
class Database
{
    /**
     * Khai báo biến kết nối
     * @var [type]
     */
    public $link;
function xss_clean($data)
{
    // Fix &entity\n;
    $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    do
    {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    }
    while ($old_data !== $data);

    // we are done...
    return $data;
}

    public function __construct()
    {
        $this->link = mysqli_connect("localhost","root","","fruitstore") or die ();
        mysqli_set_charset($this->link,"utf8");
    }

    

    /**
     * [insert description] hàm insert 
     * @param  $table
     * @param  array  $data  
     * @return integer
     */
    public function insert($table, array $data)
    {
        //code
        $sql = "INSERT INTO {$table} ";
        $columns = implode(',', array_keys($data));
        $values  = "";
        $sql .= '(' . $columns . ')';
        foreach($data as $field => $value) {
            if(is_string($value)) {
                $values .= "'". mysqli_real_escape_string($this->link,$value) ."',";
            } else {
                $values .= mysqli_real_escape_string($this->link,$value) . ',';
            }
        }
        $values = substr($values, 0, -1);
        $sql .= " VALUES (" . $values . ')';
        // _debug($sql);die;
        mysqli_query($this->link, $sql) or die("Lỗi  query  insert ----" .mysqli_error($this->link));
        return mysqli_insert_id($this->link);
    }

    public function update($table, array $data, array $conditions)
    {
        $sql = "UPDATE {$table}";

        $set = " SET ";

        $where = " WHERE ";

        foreach($data as $field => $value) {
            if(is_string($value)) {
                $set .= $field .'='.'\''. mysqli_real_escape_string($this->link, xss_clean($value)) .'\',';
            } else {
                $set .= $field .'='. mysqli_real_escape_string($this->link, xss_clean($value)) . ',';
            }
        }

        $set = substr($set, 0, -1);


        foreach($conditions as $field => $value) {
            if(is_string($value)) {
                $where .= $field .'='.'\''. mysqli_real_escape_string($this->link, xss_clean($value)) .'\' AND ';
            } else {
                $where .= $field .'='. mysqli_real_escape_string($this->link, xss_clean($value)) . ' AND ';
            }
        }

        $where = substr($where, 0, -5);

        $sql .= $set . $where;
        // _debug($sql);die;

        mysqli_query($this->link, $sql) or die( "Lỗi truy vấn Update -- " .mysqli_error(1));

        return mysqli_affected_rows($this->link);
    }
    public function updateview($sql)
    {
        $result = mysqli_query($this->link,$sql)  or die ("Lỗi update view " .mysqli_error($this->link));
        return mysqli_affected_rows($this->link);

    }
    public function countTable($table)
    {
        $sql = "SELECT id FROM  {$table}";
        $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
        $num = mysqli_num_rows($result);
        return $num;
    }


    /**
     * [delete description] hàm delete
     * @param  $table      [description]
     * @param  array  $conditions [description]
     * @return integer             [description]
     */
    public function delete ($table ,  $id )
    {
        $sql = "DELETE FROM {$table} WHERE id = $id ";

        mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
        return mysqli_affected_rows($this->link);
    }

    /**
     * delete array 
     */
    
    public function deletewhere($table,$data = array())
    {
        foreach ($data as $id)
        {
            $id = intval($id);
            $sql = "DELETE FROM {$table} WHERE id = $id ";
            mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
        }
        return true;
    }

    public function fetchsql( $sql )
    {
        $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($this->link));
        $data = [];
        if( $result)
        {
            while ($num = mysqli_fetch_assoc($result))
            {
                $data[] = $num;
            }
        }
        return $data;
    } 

    public function fetchID($table , $id )
    {
        $sql = "SELECT * FROM {$table} WHERE id = $id ";
        $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
        return mysqli_fetch_assoc($result);
    }

    public function fetchOne($table , $query)
    {
        $sql  = "SELECT * FROM {$table} WHERE ";
        $sql .= $query;
        $sql .= "LIMIT 1";
        $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchOne " .mysqli_error($this->link));
        return mysqli_fetch_assoc($result);
    }

    public function deletesql ($table ,  $sql )
    {
        $sql = "DELETE FROM {$table} WHERE " .$sql;
        // _debug($sql);die;
        mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
        return mysqli_affected_rows($this->link);
    }

    

     public function fetchAll($table)
    {
        $sql = "SELECT * FROM {$table} WHERE 1" ;
        $result = mysqli_query($this->link,$sql) or die("Lỗi Truy Vấn fetchAll " .mysqli_error($this->link));
        $data = [];
        if( $result)
        {
            while ($num = mysqli_fetch_assoc($result))
            {
                $data[] = $num;
            }
        }
        return $data;
    }


    // public  function fetchJones($table,$sql,$total = 1,$page,$row ,$pagi = true )
    // {
        
    //     $data = [];

    //     if ($pagi == true )
    //     {
    //         $sotrang = ceil($total / $row);
    //         $start = ($page - 1 ) * $row ;
    //         $sql .= " LIMIT $start,$row ";
    //         $data = [ "page" => $sotrang];
          
           
    //         $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
    //     }
    //     else
    //     {
    //         $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
    //     }
        
    //     if( $result)
    //     {
    //         while ($num = mysqli_fetch_assoc($result))
    //         {
    //             $data[] = $num;
    //         }
    //     }
        
    //     return $data;
    // }
    //  public  function fetchJone($table,$sql ,$page = 0,$row ,$pagi = false )
    // {
        
    //     $data = [];
    //     // _debug($sql);die;
    //     if ($pagi == true )
    //     {
    //         $total = $this->countTable($table);
    //         $sotrang = ceil($total / $row);
    //         $start = ($page - 1 ) * $row ;
    //         $sql .= " LIMIT $start,$row";
    //         $data = [ "page" => $sotrang];
           
    //         $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
    //     }
    //     else
    //     {
    //         $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
    //     }
        
    //     if( $result)
    //     {
    //         while ($num = mysqli_fetch_assoc($result))
    //         {
    //             $data[] = $num;
    //         }
    //     }
    //     // _debug($data);
    //     return $data;
    // }


    // public  function fetchJoneDetail($table , $sql ,$page = 0,$total ,$pagi )
    // {
    //     $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));

    //     $sotrang = ceil($total / $pagi);
    //     $start = ($page - 1 ) * $pagi ;
    //     $sql .= " LIMIT $start,$pagi";

    //     $result = mysqli_query($this->link , $sql);
    //     $data = [];
    //     $data = [ "page" => $sotrang];
    //     if( $result)
    //     {
    //         while ($num = mysqli_fetch_assoc($result))
    //         {
    //             $data[] = $num;
    //         }
    //     }
    //     return $data;
    // }

    public function total($sql)
    {
        $result = mysqli_query($this->link  , $sql);
        $tien = mysqli_fetch_assoc($result);
        return $tien;
    }
}

?>
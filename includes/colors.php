<?php 
  class ATH_Colors{

    public function pallete($color='vdb'){
      switch($color){        
        
        case 'vdb':
        $pal = array('#15CEFC','#29B6F6','#46CC6E','#3E464F','#ffffff');
        break;
        
        case 'chiclets':
        $pal = array('#FCCD05','#A64AC9','#FCAD88','#202833','#ffffff');
        break;

        case 'teal':
        $pal = array('#5CDB94','#389482','#04386C','#3E464F','#ffffff');
        break;

        case 'ruby':
        $pal = array('#FC4444','#D73A3A','#3DEEE4','#2C2234','#ffffff');
        break;

        case 'cherry':
        $pal = array('#6F2232','#950741','#C3083F','#ffffff','#26262C');
        break;

        case 'candy':
        $pal = array('#44318D','#8265A7','#D93F87','#ffffff','#2A1B3C');
        break;

        default:
        $pal = array('#15CEFC','#29B6F6','#46CC6E','#3E464F','#ffffff');
        break;
      
      }
      return $pal;
    }
  }

  $ath_colors = new ATH_Colors();
  global $ath_colors;

?>
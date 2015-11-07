<?php
defined ('_JEXEC') or die();
require_once JPATH_COMPONENT.DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."PHPExcel.php";

class loadexcelfileModelloadexcelfile extends JModelLegacy
{
    //Выбираем один определенный столбец
    public function getColumnValue($massValue,$col_number)
    {
        $tempMas  = array();
        for ($i = 0; $i < count($massValue); $i++)
        {
            $tempMas[] = $massValue[$i][$col_number];
        }
        return $tempMas;
    }
    //Формируем массив значений из файла MS Excel
    public function takeXlsFile($path_file,$row_number)
    {
        $PHPExcel_file = PHPExcel_IOFactory::load($path_file);
        $PHPExcel_file->setActiveSheetIndex(0);
        $worksheet     = $PHPExcel_file->getActiveSheet();
        $mas_cells = array();
        for ($i = $row_number; $i <= $worksheet->getHighestRow(); $i++) {
            $nColumn = PHPExcel_Cell::columnIndexFromString($worksheet->getHighestColumn());
            for ($j = 0; $j < $nColumn; $j++) {
                $value = $worksheet->getCellByColumnAndRow($j, $i)->getValue();
                $mas_cells[$i-$row_number][] = $value;
            }
        }
        return $mas_cells;
    }
    //Загружаем для обработки файл MS Excel
    public function loadFile()
    {
        if ($_FILES['file_load']['name'] != "") {
            $path_file = JPATH_SITE.DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR."temp.xls";
            if (move_uploaded_file($_FILES['file_load']['tmp_name'], $path_file)) {
                return $path_file;
            } else {
                echo "Возникла проблема с файлом источником записей.";
                exit();
            }
        }
        return false;
    }
    //Сохраняем файл в JSON формате
    public function saveFile($mass,$path_json_file)
    {
        $strJSON = json_encode($mass);
        $strJSON = "var obj = ".$strJSON;
        if (file_exists($path_json_file))
        {
            unlink($path_json_file);
            $fh = fopen($path_json_file, "a+");
        } else
        {
            $fh = fopen($path_json_file, "w");
        }
        fwrite($fh, $strJSON);
        fclose($fh);
        return true;
    }
    //Записываем данные в БД
    public function insertBD($nameTable,$massField,$massValue)
    {
        $db		= JFactory::getDbo();
        $pTable = '`#__'. $nameTable.'`';
        $strFields = '';
        $strValue = '';

        //Fields
        $i = 0;
        for(; $i < count($massField)-1; $i++)
        {
            $strFields = $strFields.'`'.$massField[$i].'`,';
        }
        $strFields .= '`'.$massField[$i].'`';

        //Value in need format
        for ($j = 0; $j < count($massValue[0]); $j++)
        {
            $strValue .='(';
            for ($i = 0; $i < count($massValue); $i++)
            {
                $strValue .= '\''.$massValue[$i][$j].'\'';
                if ($i < count($massValue) - 1)
                {
                   $strValue .= ',';
                }
            }
            $strValue .=')';
            if ($j < count($massValue[0]) - 1)
            {
                $strValue .= ',';
            }
        }
        //end formated value in need string

        $query	= "INSERT INTO $pTable ( $strFields ) VALUES $strValue ";
        $db->setQuery($query);
        try {
            $db->query();
        } catch (Exception $e) {
            echo 'Ошибка выполнения запроса: ',  $e->getMessage(), "\n";
            exit();
        }
        return true;
    }
}
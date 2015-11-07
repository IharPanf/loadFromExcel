<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

class loadexcelfileViewloadexcelfile extends JViewLegacy
{
	function display($tpl = null)
	{
        $row_number     = JRequest::getVar('countfield');
        $checkin        = JRequest::getVar('checkin');
        $checkBD        = JRequest::getVar('checkBD');
        $nameTable      = JRequest::getVar('BD');
        $massField      = JRequest::getVar('field', array(), 'post');
        $massColExcel   = JRequest::getVar('number',array(),'post');
        $path_json_file = JRequest::getVar('pathJSON');
        $path_json_file = trim($path_json_file);
        $messageStr     = '';
        $col_number     = $massColExcel[0];

        if (!isset($row_number)) {$row_number = 1;};
        $row_number = strval($row_number);

        $path_json_file = JPATH_SITE.DIRECTORY_SEPARATOR.$path_json_file;

        $model = $this->getModel();
        $pathfile  = $model->loadFile();

        // Формируем массив значений
        if ($pathfile) {
            $massCells = $model->takeXlsFile($pathfile,$row_number);

            for ($i = 0; $i < count($massColExcel); $i++)
            {
                $massValue [] = $model->getColumnValue($massCells,$massColExcel[$i]);
            }

            if($checkin == 'on')
            {
                $model->saveFile($massValue,$path_json_file);
                $messageStr = '<br>Файл сохранен в формате JSON по адресу : '.$path_json_file;
            }
            //Сохраним значения в БД
            if ($checkBD == 'on' && $nameTable !='')
            {
                $model->insertBD($nameTable,$massField,$massValue);
                 $messageStr .= '<br> Данные успешно записаны в БД';
            }
            if ($checkin != 'on' && $checkBD != 'on')
            {
               $messageStr .= '<br> Необходимо выбрать дейтвие: <strong>сохранение в БД</strong> и (или) <strong>запись в файл</strong> формата JSON';
            }
        } else {
           $messageStr = 'Нет файла - источника данных!';
        }
        $this->assignRef( 'showMessage', $messageStr);
        parent::display($tpl);
	}
}
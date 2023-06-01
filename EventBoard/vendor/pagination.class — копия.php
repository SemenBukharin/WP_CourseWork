<?php
 class Pagination{
     protected $baseURL      = '';
     protected $totalRows    = '';
     protected $perPage      = 10;
     protected $numLinks     =  2;
     protected $currentPage  =  0;
     protected $firstLink    = '<<';
     protected $nextLink     = '>';
     protected $prevLink     = '<';
     protected $lastLink     = '>>';
     protected $fullTagOpen  = '<div class="pagination">';
     protected $fullTagClose = '</div>';
     protected $firstTagOpen = '';
     protected $firstTagClose= '&nbsp;';
     protected $lastTagOpen  = '&nbsp;';
     protected $lastTagClose = '';
     protected $curTagOpen   = '&nbsp;<b>';
     protected $curTagClose  = '</b>';
     protected $nextTagOpen  = '&nbsp;';
     protected $nextTagClose = '&nbsp;';
     protected $prevTagOpen  = '&nbsp;';
     protected $prevTagClose = '';
     protected $numTagOpen   = '&nbsp;';
     protected $numTagClose  = '';
     protected $showCount    = true;
     protected $currentOffset= 0;
     protected $queryStringSegment = 'page';
     
     function __construct($params = array()){
         if (count($params) > 0){
             $this->initialize($params);        
         }
     }
     
     function initialize($params = array()){
         if (count($params) > 0){
             foreach ($params as $key => $val){
                 if (isset($this->$key)){
                     $this->$key = $val;
                 }
             }        
         }
     }
     
     /**
      * Генерируем ссылки на страницы
      */    
     function createLinks(){ 
         // Если общее количество записей 0, не продолжать
         if ($this->totalRows == 0 || $this->perPage == 0){
            return '';
         }
         // Считаем общее количество страниц
         $numPages = ceil($this->totalRows / $this->perPage);
         // Если страница только одна, не продолжать
         if ($numPages == 1){
             if ($this->showCount){
                 $info = 'Showing : ' . $this->totalRows;
                 return $info;
             }else{
                 return '';
             }
         }
         
         // Определяем строку запроса
         $query_string_sep = (strpos($this->baseURL, '?') === FALSE) ? '?page=' : '&amp;page=';
         $this->baseURL = $this->baseURL.$query_string_sep;
         
         // Определяем текущую страницу
         $this->currentPage = $_GET[$this->queryStringSegment];
         
         if (!is_numeric($this->currentPage) || $this->currentPage == 0){
             $this->currentPage = 1;
         }
         
         // Строковая переменная вывода контента
         $output = '';
         
         // // Отображаем сообщение о ссылках на другие страницы
         // if ($this->showCount){
         //    $currentOffset = ($this->currentPage > 1)?($this->currentPage - 1)*$this->perPage:$this->currentPage;
         //    $info = 'Показаны элементы с ' . $currentOffset . ' по ' ;
         
         //    if( ($currentOffset + $this->perPage) < $this->totalRows )
         //       $info .= $this->currentPage * $this->perPage;
         //    else
         //       $info .= $this->totalRows;
         
         //    $info .= ' из ' . $this->totalRows . ' | ';
         
         //    $output .= $info;
         // }
         
         $this->numLinks = (int)$this->numLinks;
         
         // Если номер страницы больше максимального значения, отображаем последнюю страницу
         if($this->currentPage > $this->totalRows){
             $this->currentPage = $numPages;
         }
         
         $uriPageNum = $this->currentPage;
         
         // Рассчитываем первый и последний элементы 
         $start = (($this->currentPage - $this->numLinks) > 0) ? $this->currentPage - ($this->numLinks - 1) : 1;
         $end   = (($this->currentPage + $this->numLinks) < $numPages) ? $this->currentPage + $this->numLinks : $numPages;
         
         // Выводим ссылку на первую страницу
         if($this->currentPage > $this->numLinks){
             $firstPageURL = str_replace($query_string_sep,'',$this->baseURL);
             $output .= $this->firstTagOpen.'<a class="no-underline" href="'.$firstPageURL.'"><div class="text-white bg-darkGray d-flex align-items-center justify-content-center br-10" style="width:55px; height:55px;"><h5>'.$this->firstLink.'</h5></div></a>'.$this->firstTagClose;
         }
         // Выводим ссылку на предыдущую страницу
         if($this->currentPage != 1){
             $i = ($uriPageNum - 1);
             if($i == 0) $i = '';
             $output .= $this->prevTagOpen.'<a class="no-underline" href="'.$this->baseURL.$i.'"><div class="text-white bg-darkGray d-flex align-items-center justify-content-center br-10" style="width:55px; height:55px;"><h5>'.$this->prevLink.'</h5></div></a>'.$this->prevTagClose;
         }
         // Выводим цифровые ссылки
         for($loop = $start -1; $loop <= $end; $loop++){
             $i = $loop;
             if($i >= 1){
                 if($this->currentPage == $loop){
                     $output .= $this->curTagOpen.'<div class="text-white bg-mainGreen d-flex align-items-center justify-content-center br-10" style="width:55px; height:55px;"><h5>'.$loop.'</h5></div>'.$this->curTagClose;
                 }else{
                     $output .= $this->numTagOpen.'<a class="no-underline" href="'.$this->baseURL.$i.'"> <div class="text-white bg-darkGray d-flex align-items-center justify-content-center br-10" style="width:55px; height:55px;"><h5>'.$loop.'</h5></div></a>'.$this->numTagClose;
                 }
             }
         }
         // Выводим ссылку на следующую страницу
         if($this->currentPage < $numPages){
             $i = ($this->currentPage + 1);
             $output .= $this->nextTagOpen.'<a class="no-underline" href="'.$this->baseURL.$i.'"><div class="text-white bg-darkGray d-flex align-items-center justify-content-center br-10" style="width:55px; height:55px;"><h5>'.$this->nextLink.'</h5></div></a>'.$this->nextTagClose;
         }
         // Выводим ссылку на последнюю страницу
         if(($this->currentPage ) < $numPages){
             $i = $numPages;
             $output .= $this->lastTagOpen.'<a class="no-underline" href="'.$this->baseURL.$i.'"><div class="text-white bg-darkGray d-flex align-items-center justify-content-center br-10" style="width:55px; height:55px;"><h5>'.$this->lastLink.'</h5></div></a>'.$this->lastTagClose;
         }
         // Удаляем двойные косые
         $output = preg_replace("#([^:])//+#", "\1/", $output);
         // Добавляем открывающий и закрывающий тэги блока
         $output = $this->fullTagOpen.$output.$this->fullTagClose;
         
         return $output;        
     }
 }
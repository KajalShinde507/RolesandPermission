<?php
    use \koolreport\excel\Table;
    use \koolreport\excel\PivotTable;
    use \koolreport\excel\BarChart;
    use \koolreport\excel\LineChart;

    $sheet1 = "together";
?>
<meta charset="UTF-8">

<div sheet-name="<?php echo $sheet1; ?>">
    <?php
    $styleArray = [
        'font' => [
            'name' => 'Calibri', 
            'size' => 30,
            'bold' => true,
            'italic' => FALSE,
            'underline' => 'none', 
            'strikethrough' => FALSE,
            'superscript' => false,
            'subscript' => false,
            'color' => [
                'rgb' => '000000',
                'argb' => 'FF000000',
            ]
        ],
        'alignment' => [
            'horizontal' => 'general',
            'vertical' => 'bottom',
            'textRotation' => 0,
            'wrapText' => false,
            'shrinkToFit' => false,
            'indent' => 0,
            'readOrder' => 0,
        ],
        'borders' => [
            'top' => [
                'borderStyle' => 'none', 
                'color' => [
                    'rgb' => '808080',
                    'argb' => 'FF808080',
                ]
            ],
            
        ],
        'fill' => [
            'fillType' => 'none', 
            'rotation' => 90,
            'color' => [
                'rgb' => 'A0A0A0',
                'argb' => 'FFA0A0A0',
            ],
            'startColor' => [
                'rgb' => 'A0A0A0',
                'argb' => 'FFA0A0A0',
            ],
            'endColor' => [
                'argb' => 'FFFFFF',
                'argb' => 'FFFFFFFF',
            ],
        ],
    ];
    ?>
    
    <div>
       <?php
       if (!empty($this->params["gstin_uin_of_supplier"])){
        echo "Treadname: " .implode(',',$this->params["gstin_uin_of_supplier"]); 
        
       }
       if(!empty($this->params["fp"]))
       {
       
        echo "<br/>"." Return Period: " .$this->params["fp"]."\n"; 

        
       }
      if(!empty($this->params["doc_type"])){
        echo "<br/>". "Doctype: " .implode(',',$this->params["doc_type"])."\n"; 
        
       }
       if(!empty($this->params["category"])){

        echo "<br/>"."category: " .implode(',',$this->params["category"])."\n"; 
        
       }
       if(!empty($this->params["salestatus"])){
        echo "<br/>"."status: " .implode(',',$this->params["salestatus"])."\n";
        
       }
       if(!empty($this->params["summary"])){ 
        echo "<br/>"."summary Type: " .$this->params["summary"]."\n"; 
        
       }
       ?>
        
    </div>
    
    <div>
    
        <?php
        Table::create(array(
            "dataSource" => $this->dataStore('together'),
            ));
        ?>
    </div>
    
</div>

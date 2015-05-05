<?php

require_once(app_path() . '/../libraries/jpgraph/jpgraph.php');
require_once(app_path() . '/../libraries/jpgraph/jpgraph_line.php');
require_once(app_path() . '/../libraries/jpgraph/jpgraph_bar.php');

class GraphService
{
    protected $color = "#224681";
    protected $font_size = 11;
    protected $width = 680;
    protected $height = 389;

    public function generateBarGraph($data, $formatter, $attributes)
    {
        $datay = $data['datay'];
        $datax = $data['datax'];
        $title = $data['title'];;

        // Width and height of the graph
        $width = (isset($attributes['width']) ? $attributes['width'] : $this->width);
        $height = (isset($attributes['height']) ? $attributes['height'] : $this->height);;

        // Create a graph instance
        $graph = new Graph($width, $height);
                
        $graph->SetScale('textlin');
         
        // Setup a title for the graph
        $graph->title->Set('');		 
            
        $graph->xaxis->SetTitle($title, 'center');		

        if (isset($attributes['xaxis_title_margin'])) {
            $graph->xaxis->SetTitleMargin($attributes['xaxis_title_margin']);		
        }

        // Setup Y-axis title
        $graph->yaxis->title->Set('');						

        $graph->xaxis->SetTickLabels($datax);
        
        if (isset($formatter['label'])) {
            $graph->yaxis->SetLabelFormatCallback([$formatter['label']['obj'], $formatter['label']['method']]);		
        }

        //Create the bar plot
        $barplot=new BarPlot($datay);

        // Add the plot to the graph
        $graph->Add($barplot);

        $color = (!isset($attributes['fillcolor']) ? $this->color : $attributes['fillcolor']);
        $txtcolor = (!isset($attributes['txtcolor']) ? $this->color : $attributes['txtcolor']);

        $barplot->setColor($color); //#FECB38
        $barplot->setFillColor($color); //#FECB38

        if (isset($formatter['value'])) {
            $barplot->value->SetFormatCallback([$formatter['value']['obj'], $formatter['value']['method']]);		
        }

        $barplot->value->HideZero(isset($attributes['hidezero']) ? $attributes['hidezero'] : true);

        $barplot->value->setColor($this->color);
        $barplot->value->SetFont(FF_ARIAL, FS_NORMAL, $this->font_size);
        $barplot->value->show(isset($attributes['showvalue']) ? $attributes['showvalue'] : false);

        if (isset($attributes['value_angle'])) {
            $barplot->value->SetAngle($attributes['value_angle']);
        }

        $this->setGraphStyle($graph, $txtcolor);
        $graph->xaxis->SetPos("min");

        if (isset($attributes['xaxis_label_angle'])) {
            $graph->xaxis->SetLabelAngle($attributes['xaxis_label_angle']);
        }

        $graph->SetMargin(
            80, 
            50, 
            isset($attributes['top_margin']) ? $attributes['top_margin'] : 30, 
            isset($attributes['bottom_margin']) ? $attributes['bottom_margin'] : 50
        ); 

        // Display the graph
                
        $imghandler = $graph->Stroke(_IMG_HANDLER);
        //return $graph->Stroke($filename);

        //$filename = BASE_PATH . "/images/graph/image.png";
        //$graph->img->Stream($filename);

        return $imghandler;
    }

    protected function setGraphStyle($graph, $color) 
    {
        $graph->xaxis->SetColor($color);
        $graph->yaxis->SetColor($color);		
        $graph->yaxis->HideLine(true);
        $graph->yaxis->setWeight(0);		
        $graph->img->SetAntiAliasing(false); 

        $graph->ygrid->SetFill('false', "#ffffff", '#ffffff');		
        $graph->ygrid->SetLineStyle('dashed');
        $graph->ygrid->SetColor('#ccc');		
        $graph->SetBox(false);
        $graph->SetTickDensity(TICKD_SPARSE, TICKD_NORMAL);

        $graph->yaxis->SetFont(FF_ARIAL, FS_NORMAL, $this->font_size);
        $graph->xaxis->SetFont(FF_ARIAL, FS_NORMAL, $this->font_size);
        $graph->xaxis->title->SetFont(FF_ARIAL, FS_NORMAL, $this->font_size);
        $graph->xaxis->title->setColor($color);

        $graph->graph_theme=null;
    }
}
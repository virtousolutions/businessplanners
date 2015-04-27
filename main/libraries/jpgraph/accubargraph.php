<?php // content="text/plain; charset=utf-8"

require_once('jpgraph.php');
require_once ('jpgraph_line.php');
require_once('jpgraph_bar.php');

/**
 * TCPDF class extension with custom header and footer for TOC page
 */
class GraphHandler {

	public function genSingGraph($data=null) {
	
		$datay = array(2500, 18000, 6000, 4000, 8000, 4500, 70000, 0, 45000, 0, 60000, 210);
		$datax = array("Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul");
	
		// Width and height of the graph
		$width = 589; $height = 389;
		 
		// Create a graph instance
		$graph = new Graph($width,$height);
				
		$graph->SetScale('textint');
		 
		// Setup a title for the graph
		$graph->title->Set('');
		 
		// Setup titles and X-axis labels
		$graph->yaxis->SetFont(FF_ARIAL, FS_NORMAL, 8);		
		$graph->xaxis->SetTitle('Months in Year 1', 'center');		
		
		// Setup Y-axis title
		$graph->yaxis->title->Set('');
						
		
		$graph->xaxis->SetTickLabels($datax);
				
		
		//Create the bar plot
		$barplot=new BarPlot($datay);
		
		// Add the plot to the graph
		$graph->Add($barplot);
		$barplot->setColor("#FECB38"); //#FECB38
		$barplot->setFillColor("#FECB38"); //#FECB38
		
		$this->setGraphStyle($graph);
	
		
		//$fileName = "/tmp/imagefile.jpg";
		//$graph->img->Stream($fileName);	
 
		 
		// Display the graph
		$graph->Stroke();
	
	
	}
	
	
	public function genAccuBar($data=null) {
	
		
		$data1y = array(2500, 18000, 6000, 4000, 8000, 4500, 70000, 0, 45000, 0, 60000, 210);
		$data2y = array(250, 1800, 60000, 42000, 80500, 4900, 20000, 0, 65000, 0, 2000, 5210);
		$datax = array("Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul");
	
	
	
		// Width and height of the graph
		$width = 589; $height = 389;
		 
		// Create a graph instance
		$graph = new Graph($width,$height);
				
		$graph->SetScale('textint');
		 
		// Setup a title for the graph
		$graph->title->Set('');
		 
		// Setup titles and X-axis labels
		$graph->yaxis->SetFont(FF_ARIAL, FS_NORMAL, 8);		
		$graph->xaxis->SetTitle('Months in Year 1', 'center');		
		
		// Setup Y-axis title
		$graph->yaxis->title->Set('');						
		
		$graph->xaxis->SetTickLabels($datax);				
		
		//Create the bar plot
		$barplot1=new BarPlot($data1y);
		$barplot2=new BarPlot($data2y);
		
		
		$ab1plot = new AccBarPlot(array($barplot1,$barplot2)); 
		
		// Add the plot to the graph
		$graph->Add($ab1plot);
		$barplot1->setColor("#FECB38"); //#FECB38
		$barplot1->setFillColor("#FECB38"); //#FECB38
		$barplot1->setLegend("Other Expenses");
		
		$barplot2->setColor("#000"); //#FECB38
		$barplot2->setFillColor("#000"); //#FECB38
		$barplot2->setLegend("Direct Cost");
		
			
		$this->setLegendStyle($graph);
		$this->setGraphStyle($graph);
		$graph->SetMargin(50,140,50,50);	
		
		//$fileName = "/tmp/imagefile.jpg";
		//$graph->img->Stream($fileName);	
 
		 
		// Display the graph
		$graph->Stroke();
	
	}
	
	public function genNegGraph($data=null) {
	
		$datay = array(-2500, 18000, -6000);
		$datax = array("Aug", "Sep", "Oct");
	
		// Width and height of the graph
		$width = 589; $height = 389;
		 
		// Create a graph instance
		$graph = new Graph($width,$height);
				
		$graph->SetScale('textint');
		 
		// Setup a title for the graph
		$graph->title->Set('');
		 
		// Setup titles and X-axis labels
		$graph->yaxis->SetFont(FF_ARIAL, FS_NORMAL, 8);		
		$graph->xaxis->SetTitle('Months in Year 1', 'center');		
		
		// Setup Y-axis title
		$graph->yaxis->title->Set('');
						
		
		$graph->xaxis->SetTickLabels($datax);
				
		
		//Create the bar plot
		$barplot=new BarPlot($datay);
		
		// Add the plot to the graph
		$graph->Add($barplot);
		$barplot->setColor("#FECB38"); //#FECB38
		$barplot->setFillColor("#FECB38"); //#FECB38
		
		$this->setGraphStyle($graph);
		//$graph->SetAxisStyle(AXSTYLE_BOXOUT);
		$graph->xaxis->SetPos("min");
		
		//$fileName = "/tmp/imagefile.jpg";
		//$graph->img->Stream($fileName);	
 
		 
		// Display the graph
		$graph->Stroke();
	
	}
	
	
	
	protected function setGraphStyle($graph) {
		$graph->xaxis->SetColor('#888');
		$graph->yaxis->SetColor('#888');		
		$graph->yaxis->HideLine(true);
		$graph->yaxis->setWeight(0);		
		$graph->img->SetAntiAliasing(false); 
		
		$graph->ygrid->SetFill('false', "#ffffff", '#ffffff');		
		$graph->ygrid->SetLineStyle('dashed');
		$graph->ygrid->SetColor('#ccc');		
		$graph->SetBox(false);
		
	
	}
	
	protected function setLegendStyle($graph) {
		$graph->legend->setColor('#888');
		$graph->legend->SetColumns(1);
		$graph->legend->SetPos(0.9,0.45,'center','top');
		$graph->legend->SetMarkAbsSize(10);
		$graph->legend->SetFont(FF_ARIAL, FS_NORMAL, 8);
		$graph->legend->SetLineWeight(0);	
	}
	
	
	public function genDblBar($data=null) {
	
		
		$data1y = array(2500, 18000, 6000, 4000, 8000, 4500, 70000, 0, 45000, 0, 60000, 210);
		$data2y = array(250, 1800, 60000, 42000, 80500, 4900, 20000, 0, 65000, 0, 2000, 5210);
		$datax = array("Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul");
	
	
	
		// Width and height of the graph
		$width = 589; $height = 389;
		 
		// Create a graph instance
		$graph = new Graph($width,$height);
		
		
		$graph->SetScale('textint');
		 
		// Setup a title for the graph
		$graph->title->Set('');
		 
		// Setup titles and X-axis labels
		//$graph->yaxis->SetFont(FF_ARIAL, FS_NORMAL, 8);		
		$graph->xaxis->SetTitle('Months in Year 1', 'center');		
		
		// Setup Y-axis title
		$graph->yaxis->title->Set('');						
		
		$graph->xaxis->SetTickLabels($datax);				
		
		//Create the bar plot
		$barplot1=new BarPlot($data1y);
		$barplot2=new BarPlot($data2y);
		
		

		$ab1plot = new GroupBarPlot(array($barplot1,$barplot2)); 
		
		// Add the plot to the graph
		$graph->Add($ab1plot);
		$barplot1->setColor("#FECB38"); //#FECB38
		$barplot1->setFillColor("#FECB38"); //#FECB38
		$barplot1->setLegend("Other Expenses");
		
		$barplot2->setColor("#000"); //#FECB38
		$barplot2->setFillColor("#000"); //#FECB38
		$barplot2->setLegend("Direct Cost");
		
			
		$this->setLegendStyle($graph);
		$this->setGraphStyle($graph);
		$graph->SetMargin(50,140,50,50);	
		
		$fileName = "tmpimagefile.jpg";
		//$graph->img->Stream($fileName);	
 
		 
		// Display the graph
		return $graph->Stroke(_IMG_HANDLER);
	
	}
	
	
	
}
	
	//$grapher = new GraphHandler();
	
	//$grapher->genNegGraph();
	//$grapher->genAccuBar();
	//$grapher->genDblBar();
	

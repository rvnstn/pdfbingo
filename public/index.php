<?php
if (isset($_GET[pages])) {
	
	require __DIR__ . '/../vendor/autoload.php';
	
	class PDF extends FPDF
	{
		var $cell_width=51;
		var $cell_height=28;
		function get_five_numbers($start,$stop)
		{
	        	srand();
		        $arr=array();
		        for($i=0;$i<5;$i++)
		        {
		                do
		                {
		                        $r=rand($start,$stop);
		                }
		                while(in_array($r,$arr));
		                $arr[$i]=$r;
		        }
		        return $arr;
		}	
	
		function create_bingo()
		{
			// Array for Random Numbers
			$col=array();
			$col[1]=$this->get_five_numbers(1,15);
			$col[2]=$this->get_five_numbers(16,30);
			$col[3]=$this->get_five_numbers(31,45);
			$col[4]=$this->get_five_numbers(46,60);
			$col[5]=$this->get_five_numbers(61,75);
			
			// Write Headers
			$this->SetFillColor(0,0,0);
			$this->SetTextColor(255,255,255);
		
			$this->cell($this->cell_width,$this->cell_height,'B',1,0,'C',1,0);
			$this->cell($this->cell_width,$this->cell_height,'I',1,0,'C',1,0);
			$this->cell($this->cell_width,$this->cell_height,'N',1,0,'C',1,0);
			$this->cell($this->cell_width,$this->cell_height,'G',1,0,'C',1,0);
			$this->cell($this->cell_width,$this->cell_height,'O',1,0,'C',1,0);
			
			$this->Ln();
			
			// Write Numbers
			$this->SetTextColor(0,0,0);
			$this->SetFillColor(255,255,255);
			
			for($a=0;$a<5;$a++)
			{
				for($b=0;$b<5;$b++)
				{
					$number=$col[$b+1][$a];
					$this->cell($this->cell_width,$this->cell_height,$number,1,0,'C',1,0);
				}
				$this->Ln();
			}
			
		}
	
	}
	if ($_GET[pages]>500)$_GET[pages]=500;
	$pdf=new PDF('L','mm','A4');
	$pdf->SetFont('Arial','',60);
	$pdf->SetMargins(20,20,20);
	for($p=0;$p<$_GET[pages];$p++)
	{
		$pdf->AddPage();
		$pdf->create_bingo();
	}
	$pdf->Output();
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de-DE">
        <head>
                <title>Bingo PDF Generator</title>
        </head>
        <body>
                <h1>Bingo PDF Generator</h1>
                <h4>Autor: Tobias Ravenstein &lt;<a href="mailto:tobias@rvnstn.de">tobias@rvnstn.de</a>&gt;</h4>
                <h4>PHP PDF Klasse: fpdf ( <a href="http://fpf.org/">fpdf.org</a> )</h4>
                <hr>
                <form action="index.php" method="GET">
                        Bitte geben Sie die Anzahl der Seiten an, die Sie generieren m&ouml;chten:
                        <br /><br />
                        <input type="text" name="pages" value="1" size="4" />
                        Seite(n)
                        <input type="submit" name="button" value="Generieren" />
                        <br /><br />
                        (Maximal 500 Seiten.)
                </form>
        </body>

</html>
<?
}

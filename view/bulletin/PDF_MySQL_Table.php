<?php
require('../../public/fpdf182/fpdf.php');

class PDF_MySQL_Table extends FPDF
{
    protected $ProcessingTable=false;
    protected $aCols=array();
    protected $TableX;
    protected $HeaderColor;
    protected $RowColors;
    protected $ColorIndex;

    private $moy;
    private $matricule;
    private $nom;
    private $date;
    private $lieu;
    private $genre;
    private $anneeAcad;
    private $semestre;
    private $effectif;
    private $classe;

    /**
     * @return mixed
     */
    public function getAnneeAcad()
    {
        return $this->anneeAcad;
    }

    /**
     * @param mixed $anneeAcad
     */
    public function setAnneeAcad($anneeAcad)
    {
        $this->anneeAcad = $anneeAcad;
    }

    /**
     * @return mixed
     */
    public function getSemestre()
    {
        return $this->semestre;
    }

    /**
     * @param mixed $semestre
     */
    public function setSemestre($semestre)
    {
        $this->semestre = $semestre;
    }

    /**
     * @return mixed
     */
    public function getEffectif()
    {
        return $this->effectif;
    }

    /**
     * @param mixed $effectif
     */
    public function setEffectif($effectif)
    {
        $this->effectif = $effectif;
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param mixed $classe
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }


    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * @param mixed $matricule
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }

    /**
     * @return mixed
     */
    public function getMoy()
    {
        return $this->moy;
    }

    /**
     * @param mixed $moy
     */
    public function setMoy($moy)
    {
        $this->moy = $moy;
    }

    // En-tête
    function Header()
    {
        // Police Arial gras 15
        $this->SetFont('Times','B',10);
        $this->SetX(30);
        $this->Cell(20,25,'Ministère de l\'Éducation Nationale',0,0,'C');

        $this->SetX(160);
        $this->SetFont('Times','',10);
        $this->Cell(20,25,'Année Scolaire : ',0,0,'R');
        $this->SetX(175);
        $this->SetFont('Times','B',10);
        $this->Cell(20,25,$this->getAnneeAcad(),0,0,'R');
        $this->Ln(5);

        $this->SetX(172);
        $this->SetFont('Times','',10);
        $this->Cell(20,25,'Semestre : ',0,0,'R');
        $this->SetX(175);
        $this->SetFont('Times','B',10);
        $this->Cell(20,25,$this->getSemestre(),0,0,'R');

        $this->SetX(13);
        $this->SetFont('Times','',10);
        $this->Cell(20,25,'IDEN DE THIAROYE',0,0,'L');
        $this->Ln(5);
        $this->SetX(13);
        // Police Arial gras 15
        $this->SetFont('Times','B',12);
        $this->Cell(20,25,'Groupe Scolaire Thierno Hamidou Ndendory',0,0,'L');

        $this->Ln(6);
        $this->SetX(13);
        // Police Arial gras 15
        $this->SetFont('Times','',10);
        $this->Cell(20,25,'Km 16, Route Grand Mbao',0,0,'L');
        $this->Ln(5);
        $this->SetX(13);
        // Police Arial gras 15
        $this->SetFont('Times','',10);
        $this->Cell(20,25,'Dakar - Sénégal',0,0,'L');

        $this->Ln(1);
        $this->SetX(13);
        $this->SetFont('Times','',20);
        $this->Cell(15,25,'______',0,0,'L');

        $this->Ln(10);
        $this->SetX(13);
        // Police Arial gras 15
        $this->SetFont('Times','',12);
        $this->Cell(20,25,'Matricule : ',0,0,'L');

        $this->SetX(33);
        // Police Arial gras 15
        $this->SetFont('Times','B',12);
        $this->Cell(20,25, ''.$this->getMatricule(),0,0,'L');

        $this->Ln(7);
        $this->SetX(13);
        // Police Arial gras 15
        $this->SetFont('Times','',12);
        $this->Cell(20,25,'Nom : ',0,0,'L');

        $this->SetX(25);
        // Police Arial gras 15
        $this->SetFont('Times','',12);
        $this->Cell(20,25,$this->getNom(),0,0,'L');

        $this->Ln(7);
        $this->SetX(13);
        // Police Arial gras 15
        $this->SetFont('Times','',12);
        $this->Cell(20,25,'Date de Naissance : ',0,0,'L');

        $this->SetX(48);
        // Police Arial gras 15
        $this->SetFont('Times','',12);
        $this->Cell(20,25,$this->getDate(),0,0,'L');

        $this->SetX(165);
        $this->SetFont('Times','',12);
        $this->Cell(20,25,'Classe : ',0,0,'R');
        $this->SetX(175);
        $this->SetFont('Times','B',12);
        $this->Cell(20,25,$this->getClasse(),0,0,'R');


        $this->Ln(7);
        $this->SetX(13);
        // Police Arial gras 15
        $this->SetFont('Times','',12);
        $this->Cell(20,25,'Lieu de Naissance : ',0,0,'L');

        $this->SetX(48);
        // Police Arial gras 15
        $this->SetFont('Times','',12);
        $this->Cell(20,25,$this->getLieu(),0,0,'L');

        $this->SetX(165);
        $this->SetFont('Times','',12);
        $this->Cell(20,25,'Effectif : ',0,0,'R');
        $this->SetX(175);
        $this->SetFont('Times','B',12);
        $this->Cell(20,25,$this->getEffectif(),0,0,'R');

        $this->Ln(15);
        $this->SetX(95);
        $this->SetFont('Times','BU',13);
        $this->Cell(15,25,'BULLETIN DE NOTES',0,0,'C');


        $this->Ln(20);
    }

// Pied de page
    function Footer()
    {
        $this->SetY(-60);
        // Police Arial italique 8
        $this->SetFont('Times','U',12);
        $this->SetX(165);
        $this->Cell(0,10,'Le Directeur',0,0,'L');


        // Positionnement à 1,5 cm du bas
        $this->SetY(-25);
        // Police Arial italique 8
        $this->SetFont('Times','',20);
        $this->SetX(13);
        // Numéro de page
        $this->Cell(0,10,'___________________________________________________',0,0,'L');
        $this->Ln(-2);
        $this->SetX(100);
        $this->SetFont('Times','B',10);
        $this->Cell(15,25,'Groupe Scolaire Thierno Hamidou Ndendory',0,0,'C');

        $this->Ln(3);
        $this->SetX(100);
        $this->SetFont('Times','',8);
        $this->Cell(15,25,'Km 16, Route Grand Mbao',0,0,'C');

        $this->Ln(3);
        $this->SetFont('Times','',8);
        $this->SetX(100);
        $this->Cell(15,25, 'Dakar - Sénégal',0,0,'C');

    }

    function TableHeader()
    {
        $this->SetFont('Times','B',12);
        //$this->SetX($this->TableX);
        $this->SetX(9);
        $fill=!empty($this->HeaderColor);
        if($fill)
            $this->SetFillColor($this->HeaderColor[0],$this->HeaderColor[1],$this->HeaderColor[2]);
        foreach($this->aCols as $col)
            $this->Cell($col['w'],12,$col['c'],1,0,'C',$fill);
        $this->Ln();
    }

    function Row($data)
    {
        //$this->SetX($this->TableX);
        $this->SetX(9);
        $ci=$this->ColorIndex;
        $fill=!empty($this->RowColors[$ci]);
        if($fill)
            $this->SetFillColor($this->RowColors[$ci][0],$this->RowColors[$ci][1],$this->RowColors[$ci][2]);
        foreach($this->aCols as $col)
            $this->Cell($col['w'],9,$data[$col['f']],1,0,$col['a'],$fill);
        $this->Ln();
        $this->ColorIndex=1-$ci;
    }

    function CalcWidths($width, $align)
    {
        // Compute the widths of the columns
        $TableWidth=0;
        foreach($this->aCols as $i=>$col)
        {
            $w=$col['w'];
            if($w==-1)
                $w=$width/count($this->aCols);
            elseif(substr($w,-1)=='%')
                $w=$w/100*$width;
            $this->aCols[$i]['w']=$w;
            $TableWidth+=$w;
        }
        // Compute the abscissa of the table
        if($align=='C')
            $this->TableX=max(($this->w-$TableWidth)/2,0);
        elseif($align=='R')
            $this->TableX=max($this->w-$this->rMargin-$TableWidth,0);
        else
            $this->TableX=$this->lMargin;
    }

    function AddCol($field=-1, $width=-1, $caption='', $align='C')
    {
        // Add a column to the table
        if($field==-1)
            $field=count($this->aCols);
        $this->aCols[]=array('f'=>$field,'c'=>$caption,'w'=>$width,'a'=>$align);
    }

    function Table($link, $query, $prop=array())
    {
        // Execute query
        $res=mysqli_query($link,$query) or die('Error: '.mysqli_error($link)."<br>Query: $query");
        // Add all columns if none was specified
        if(count($this->aCols)==0)
        {
            //Gestion taille colonnes
            $nb=mysqli_num_fields($res);
            for($i=0;$i<$nb;$i++){
                if ($i==0)
                    $this->AddCol(-1,55);
                if ($i==1)
                    $this->AddCol(-1,17);
                if ($i==2)
                    $this->AddCol(-1,17);
                if ($i==3)
                    $this->AddCol(-1,17);
                if ($i==4)
                    $this->AddCol(-1,15);
                if ($i==5)
                    $this->AddCol(-1,17);
                if ($i==6)
                    $this->AddCol(-1,55);
            }
        }
        // Retrieve column names when not specified
        foreach($this->aCols as $i=>$col)
        {
            if($col['c']=='')
            {
                if(is_string($col['f']))
                    $this->aCols[$i]['c']=utf8_decode($col['f']);
                else
                    $this->aCols[$i]['c']=utf8_decode(mysqli_fetch_field_direct($res, $col['f'])->name);
            }
        }
        // Handle properties
        if(!isset($prop['width']))
            $prop['width']=0;
        if($prop['width']==0)
            $prop['width']=$this->w-$this->lMargin-$this->rMargin;
        if(!isset($prop['align']))
            $prop['align']='C';
        if(!isset($prop['padding']))
            $prop['padding']=$this->cMargin;
        $cMargin=$this->cMargin;
        $this->cMargin=$prop['padding'];
        if(!isset($prop['HeaderColor']))
            $prop['HeaderColor']=array();
        $this->HeaderColor=$prop['HeaderColor'];
        if(!isset($prop['color1']))
            $prop['color1']=array();
        if(!isset($prop['color2']))
            $prop['color2']=array();
        $this->RowColors=array($prop['color1'],$prop['color2']);
        // Compute column widths
        $this->CalcWidths(170,$prop['align']);
        // Print header
        $this->TableHeader();
        // Print rows
        $this->SetFont('Times','',12);
        $this->ColorIndex=0;
        $this->ProcessingTable=true;
        while($row=mysqli_fetch_array($res))
            $this->Row($row);
        $this->ProcessingTable=false;
        $this->cMargin=$cMargin;
        $this->aCols=array();
    }
}
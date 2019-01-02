<?php

class Paginator
{
	private $_perPage;
	private $_instance;
	private $_page;
	private $_limit;
    private $_position;
	private $_totalRows = 0;

	public function __construct($perPage, $instance, $position = "justify-content-end")
	{
		$this->_instance = $instance;		
		$this->_perPage = $perPage;
		$this->set_instance();		
        $this->_position = $position;	
	}

	public function get_start()
	{
		return ($this->_page * $this->_perPage) - $this->_perPage;
	}

	private function set_instance()
	{
		$this->_page = (int) (!isset($_GET[$this->_instance]) ? 1 : $_GET[$this->_instance]); 
		$this->_page = ($this->_page == 0 ? 1 : $this->_page);
	}

	public function set_total($_totalRows)
	{
		$this->_totalRows = $_totalRows;
	}

	public function get_limit()
	{
		return "LIMIT ".$this->get_start().",$this->_perPage";
	}
	
	public function get_limit_keys(){
		return ['offset' => $this->get_start(), 'limit' => $this->_perPage];
    }

	public function page_links($path='?', $ext=null)
	{
	    $adjacents = "2";
	    $prev = $this->_page - 1;
	    $next = $this->_page + 1;
	    $lastpage = ceil($this->_totalRows/$this->_perPage);
	    $lpm1 = $lastpage - 1;
	    $pagination = "";
		if($lastpage > 1)
		{   
		    $pagination .= "<nav><ul class='pagination ".$this->_position."'>";
		if ($this->_page > 1)
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=$prev"."$ext'><i class='fas fa-chevron-left'></i></a></li>";
		else
		    $pagination.= "";   
		if ($lastpage < 7 + ($adjacents * 2))
		{   
		for ($counter = 1; $counter <= $lastpage; $counter++)
		{
		if ($counter == $this->_page)
		    $pagination.= "<li class='page-item active'><a href='#' class='page-link'>$counter</a></li>";
		else
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=$counter"."$ext'>$counter</a></li>";                   
		}
		}
		elseif($lastpage > 5 + ($adjacents * 2))
		{
		if($this->_page < 1 + ($adjacents * 2))       
		{
		for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
		{
		if ($counter == $this->_page)
		    $pagination.= "<li class='page-item active'><a href='#' class='page-link'>$counter</a></li>";
		else
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=$counter"."$ext'>$counter</a></li>";                   
		}
		    $pagination.= "...";
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=$lpm1"."$ext'>$lpm1</a></li>";
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=$lastpage"."$ext'>$lastpage</a></li>";       
		}
		elseif($lastpage - ($adjacents * 2) > $this->_page && $this->_page > ($adjacents * 2))
		{
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=1"."$ext'>1</a></li>";
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=2"."$ext'>2</a></li>";
		    $pagination.= "...";
		for ($counter = $this->_page - $adjacents; $counter <= $this->_page + $adjacents; $counter++)
		{
		if ($counter == $this->_page)
		    $pagination.= "<li class='page-item active'><a href='#' class='page-link'>$counter</a></li>";
		else
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=$counter"."$ext'>$counter</a></li>";                   
		}
		    $pagination.= "..";
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=$lpm1"."$ext'>$lpm1</a></li>";
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=$lastpage"."$ext'>$lastpage</a></li>";       
		}
		else
		{
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=1"."$ext'>1</a></li>";
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=2"."$ext'>2</a></li>";
		    $pagination.= "..";
		for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
		{
		if ($counter == $this->_page)
		    $pagination.= "<li class='page-item active'><a href='#' class='page-link'>$counter</a></li>";
		else
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=$counter"."$ext'>$counter</a></li>";                   
		}
		}
		}
		if ($this->_page < $counter - 1)
		    $pagination.= "<li class='page-item'><a class='page-link' href='".$path."$this->_instance=$next"."$ext'><i class='fas fa-chevron-right'></i></a></li>";
		else
		    $pagination.= "";
		    $pagination.= "</ul></nav>\n";       
		}
		return $pagination;
	}
    
}
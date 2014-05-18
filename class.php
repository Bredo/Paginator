<?php
class Paginator {
	public  $perpage;
	public	$startpage;
	public	$elements;
	function __construct($perpage, $startpage, $elements){
		$this->perpage		= $perpage;
		$this->startpage	= $startpage;
		$this->elements		= $elements;
	}
	function pagesNum(){
		return ceil($this->elements/$this->perpage);
	}
	function startAt(){
		return $this->perpage*$this->startpage-$this->perpage;
	}
	function endAt(){
		return $this->startAt()+$this->perpage;
	}
	function linkbox($links){
		if($this->startpage != 1)
			$pretabs	= true;
		if($this->startpage != $this->pagesNum())
			$apptabs	= true;
		if($this->startpage < (0.5*$links)){
			for($n=1;$n<$links+1;$n++){
				$box	.= ($n == $this->startpage) ? "<b>{$n}</b> " : "<a href=\"?currentpage={$n}\">{$n}</a> ";
			}
		}elseif($this->startpage > ($this->pagesNum()-($links*0.5))){
			for($n=($this->pagesNum()-$links+1);$n<($this->pagesNum()+1);$n++){
				$box	.= ($n == $this->startpage) ? "<b>{$n}</b> " : "<a href=\"?currentpage={$n}\">{$n}</a> ";
			}
		}else{
			for($n=($this->startpage-ceil($links*0.5)+1);$n<($this->startpage+ceil($links*0.5));$n++){
				$box	.= ($n == $this->startpage) ? "<b>{$n}</b> " : "<a href=\"?currentpage={$n}\">{$n}</a> ";
			}
		}
		return ($pretabs ? "<a href=\"?currentpage=1\">First</a> <a href=\"?currentpage=".( $this->startpage - 1 )."\">Back</a> " : "").$box.($apptabs ? "<a href=\"?currentpage=".($this->startpage + 1 )."\">Next</a> <a href=\"?currentpage=".$this->pagesNum()."\">Last</a>" : "");
	}
}
$p	= new Page(5, $_GET["currentpage"], 501);
echo $p->linkbox(30)."<br># pages: ".$p->pagesNum()."<br>For MySQL: Start at ".$p->startAt().", and show ".$p->perpage." rows.";
?>

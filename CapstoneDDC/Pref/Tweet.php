<?php
class Tweet
{
	//member variables
	protected $productId;
	protected $description;
	protected $price;
	protected $search;
	
	/*construct a Tweet
	 *input: integer product Id
	 *input: string description
	 *input: double price
	 *input: text search
	 *throws: if invalid input detected*/
	 public function __construct($newProductId, $newDescription, $newPrice, $newSearch)
	 	{
	 		try
	 		 {
	 		 	$this->setProductId($newProductId);
	 		 	$this->setDescription($newDescription);
	 		 	$this->setPrice($newPrice);
	 		 	$this->setSearch($newSearch);
	 		 }
	 		catch(Exception $error)
	 		{
	 			throw(new Exception("unable to construct Tweet"));
	 		}
	 		
	 	}
	/*accessor method for productId
	 *input: n/a
	 *output: integer value of productId*/
	 public function getProductId()
	 {
	 	return($this->productId);
	 }
	 /*mutator method for productId
	  *input: integer productid
	  *output: n/a
	  *throws: invalid input*/
	  public function setProductId($newProductId)
	  {
	  	//make sure data is good, clean it baby
	  	if(empty($newProductId ))
	  	{
	  		throw(new Exception("invalid product id, can't be empty"));
	  	}
	  	
	  	$this->productId = $newProductId;
	  		
	  }
	  /*accessor method for description
	   *input: n/a
	   *output: string value of description*/
	   public function getDescription()
	   {
	   	return($this->description);
	   }
	    /*mutator method for description
	  *input: string description
	  *output: n/a
	  *throws: invalid input*/
	  public function setDescription($newDescription)
	  {
	  	if(empty($newDescription))
	  	{
	  		throw(new Exception("invalid description"));
	  	}
	  	$this->description = $newDescription;
	  }
	   /*accessor method for price
	   *input: n/a
	   *output: double value of price*/
	   public function getPrice()
	   {
	   	return($this->price);
	   }
	   /*mutator method for price
	   *input: double value price
	   *output: n/a
	   *throws: when invalid data*/
	   public function setPrice($newPrice)
	   {
	   	if(!is_numeric($newPrice) || $newPrice <= 0.0)
	   	{
	   		throw(new Exception("invalid price"));
	   	}
	   	$this->price = $newPrice;
	   }
	   /*accessor method for search
	 *input: n/a
	 *output: text value of search*/
	 public function getSearch()
	 {
	 	return($this->search);
	 }
	 /*mutator method for search
	   *input: text value search
	   *output: n/a
	   *throws: when invalid data*/
	public function setSearch($newSearch)
	{
		/*if(empty($newSearch))
		{
			throw(new Exception("invalid search code for tweet"));
		}*/
		$this->search = $newSearch;
	}
}
?>
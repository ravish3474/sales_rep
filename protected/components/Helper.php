<?php
/**
* 
*/
class Helper
{

	public static function usFormat($value)
	{
		if ($value > 0) {
			$result = "$ " .  $value;
			// $result = "$ " .  number_format($value, 2, ".", ",");
		} else {
			//$result = 'N/A';
			$result = '';
		}

		return $result;
	}

	public static function usFormatIncrease($value)
	{
		$value = !is_null($value)?$value:0;
		preg_match_all('!\d+(?:\.\d+)?!', $value, $matches);
		if ($matches[0][0] > 0) {
			// $result = 'Increase ' . self::usFormat($value);
			$result = str_replace($matches[0][0], self::usFormat($matches[0][0]), $value);
		} else {
			//$result = 'N/A';
			$result = '';
		}

		return $result;
	}

	public static function usFormatPlus($value)
	{
		$value = !is_null($value)?$value:0;
		preg_match_all('!\d+(?:\.\d+)?!', $value, $matches);
		if ($matches[0][0] > 0) {
			// $result = self::usFormat($value) . '+';
			$result = str_replace($matches[0][0], self::usFormat($matches[0][0]), $value);
		} else {
			//$result = 'N/A';
			$result = '';
		}
		
		return $result;
	}

	public static function thFormat($value)
	{
		if ($value > 0) {
			$result = number_format($value, 0) . ' THB';
		} else {
			//$result = 'N/A';
			$result = '';
		}

		return $result;
	}

	public static function getYearOptions()
	{
		$maxYear = date('Y');
		$minYear = 2015;
		$year = array();
		for ($i=$maxYear; $i >= $minYear; $i--) { 
			$year[$i] = $i;
		}

		return $year;
	}

	public static function getQtyNameOptions()
	{
		return array(
			'QTY 25-99'   => 'QTY 25-99',
			'QTY 100-299' => 'QTY 100-299',
			'QTY 300+'    => 'QTY 300+',
			);
	}

	public static function getIconFile($fileType)
	{
		switch ($fileType) {
			case 'doc':
			case 'docx':
				$result = '<i class="fa fa-file-word-o" aria-hidden="true"></i>';
				break;
			case 'ppt':
			case 'pptx':
				$result = '<i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>';
				break;
			case 'xls':
			case 'xlsx':
				$result = '<i class="fa fa-file-excel-o" aria-hidden="true"></i>';
				break;
			case 'pdf':
				$result = '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>';
				break;
			case 'txt':
				$result = '<i class="fa fa-file-text-o" aria-hidden="true"></i>';
				break;
			
			default:
				$result = '<i class="fa fa-file-o" aria-hidden="true"></i>';
				break;
		}

		return $result;
	}
	
	public static function getInvoiceStatis()
	{
		return array(
			'Paid'   => 'Paid',
			'Outstanding' => 'Outstanding',
			);
	}
	
	
}
?>
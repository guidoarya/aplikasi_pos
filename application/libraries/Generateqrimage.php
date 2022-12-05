<?php
defined('BASEPATH') or exit('No direct script access allowed');
// panggil autoload dompdf nya
require_once('phpqrcode/qrlib.php');

class generateqrimage
{
	public function generate()
	{
		$qrvalue = "Hello...";

		$tempDir = "pdfqrcodes/";
		$codeContents = $qrvalue;
		$fileName = 'someqrcode.png';
		$pngAbsoluteFilePath = $tempDir . $fileName;
		$urlRelativeFilePath = $tempDir . $fileName;
		if (!file_exists($pngAbsoluteFilePath)) {
			QRcode::png($codeContents, $pngAbsoluteFilePath);
		}

		echo "Done generating QR Code Image.";
	}
}

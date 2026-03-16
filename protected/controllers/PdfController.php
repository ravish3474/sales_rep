<?php
//Yii::import('ext.MYPDF'); //here is import
class PdfController extends Controller
{

	
	public function actionHockeyLine()
	{
		# mPDF
        /*$mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/hockeyLine', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/hockeyLine', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();*/

        $html = $this->renderPartial('priceGuide/hockeyLine', array(), true);

        include_once(Yii::app()->getBasePath()."/vendors/mpdf/mpdf.php");
        $mpdf=new mPDF('c'); 
        //$mpdf->AddPage('L');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
 
        ////////////////////////////////////////////////////////////////////////////////////
 /*
        # HTML2PDF has very similar syntax
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('priceGuide/hockeyLine', array(), true));
        $html2pdf->Output();
 */
        ////////////////////////////////////////////////////////////////////////////////////
 /*
        # Example from HTML2PDF wiki: Send PDF by email
        $content_PDF = $html2pdf->Output('', EYiiPdf::OUTPUT_TO_STRING);
        require_once(dirname(__FILE__).'/pjmail/pjmail.class.php');
        $mail = new PJmail();
        $mail->setAllFrom('webmaster@my_site.net', "My personal site");
        $mail->addrecipient('mail_user@my_site.net');
        $mail->addsubject("Example sending PDF");
        $mail->text = "This is an example of sending a PDF file";
        $mail->addbinattachement("my_document.pdf", $content_PDF);
        $res = $mail->sendmail();
	*/	
	}
        public function actionHockeyLineXLS(){
                $this->renderPartial('priceGuide/hockeyLineXLS');
        }

	public function actionTracksuits()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/tracksuits', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/tracksuits', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionTracksuitsXLS(){
                $this->renderPartial('priceGuide/tracksuitsXLS');
        }

	public function actionHoodies()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/hoodies', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/hoodies', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionHoodiesXLS(){
                $this->renderPartial('priceGuide/hoodiesXLS');
        }

	public function actionTshirts()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/tshirts', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/tshirts', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionTshirtsXLS(){
                $this->renderPartial('priceGuide/tshirtsXLS');
        }

	public function actionPolo()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/polo', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/polo', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionPoloXLS(){
                $this->renderPartial('priceGuide/poloXLS');
        }

	public function actionBaseball()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/baseball', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/baseball', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionBaseballXLS(){
                $this->renderPartial('priceGuide/baseballXLS');
        }

	public function actionBasketball()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/basketball', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/basketball', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionBasketballXLS(){
                $this->renderPartial('priceGuide/basketballXLS');
        }

	public function actionSoccer()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/soccer', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/soccer', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionSoccerXLS(){
                $this->renderPartial('priceGuide/soccerXLS');
        }

	public function actionVolleyball()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/volleyball', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/volleyball', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionVolleyballXLS(){
                $this->renderPartial('priceGuide/volleyballXLS');
        }
	
	//////////// START SALES DEALERS/////////////////////////
	
	public function actionDhockeyLine()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/d_hockeyLine', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/d_hockeyLine', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDhockeyLineXLS(){
                $this->renderPartial('priceGuide/d_hockeyLineXLS');
        }

	public function actionDtracksuits()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/d_tracksuits', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/d_tracksuits', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDtracksuitsXLS(){
                $this->renderPartial('priceGuide/d_tracksuitsXLS');
        }
	
	public function actionDhoodies()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/d_hoodies', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/d_hoodies', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	}
        public function actionDhoodiesXLS(){
                $this->renderPartial('priceGuide/d_hoodiesXLS');
        }

	public function actionDtshirts()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/d_tshirts', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/d_tshirts', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDtshirtsXLS(){
                $this->renderPartial('priceGuide/d_tshirtsXLS');
        }

	public function actionDpolo()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/d_polo', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/d_polo', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDpoloXLS(){
                $this->renderPartial('priceGuide/d_poloXLS');
        }

	public function actionDbaseball()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/d_baseball', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/d_baseball', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDbaseballXLS(){
                $this->renderPartial('priceGuide/d_baseballXLS');
        }

	public function actionDbasketball()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/d_basketball', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/d_basketball', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDbasketballXLS(){
                $this->renderPartial('priceGuide/d_basketballXLS');
        }

	public function actionDsoccer()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/d_soccer', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/d_soccer', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDsoccerXLS(){
                $this->renderPartial('priceGuide/d_soccerXLS');
        }

	public function actionDvolleyball()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/d_volleyball', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/d_volleyball', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDvolleyballXLS(){
                $this->renderPartial('priceGuide/d_volleyballXLS');
        }
	//////////// END SALES DEALERS/////////////////////////
	
	//////////// START DEALERS/////////////////////////
	
	public function actionDealersHockeyLine()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/dl_hockeyLine', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/dl_hockeyLine', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDealersHockeyLineXLS(){
                $this->renderPartial('priceGuide/dl_hockeyLineXLS');
        }

	public function actionDealersTracksuits()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/dl_tracksuits', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/dl_tracksuits', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDealersTracksuitsXLS(){
                $this->renderPartial('priceGuide/dl_tracksuitsXLS');
        }
	
	public function actionDealersHoodies()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/dl_hoodies', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/dl_hoodies', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	}
        public function actionDealersHoodiesXLS(){
                $this->renderPartial('priceGuide/dl_hoodiesXLS');
        }

	public function actionDealersTshirts()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/dl_tshirts', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/dl_tshirts', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDealersTshirtsXLS(){
                $this->renderPartial('priceGuide/dl_tshirtsXLS');
        }

	public function actionDealersPolo()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/dl_polo', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/dl_polo', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDealersPoloXLS(){
                $this->renderPartial('priceGuide/dl_poloXLS');
        }

	public function actionDealersBaseball()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/dl_baseball', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/dl_baseball', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDealersBaseballXLS(){
                $this->renderPartial('priceGuide/dl_baseballXLS');
        }

	public function actionDealersBasketball()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/dl_basketball', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/dl_basketball', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDealersBasketballXLS(){
                $this->renderPartial('priceGuide/dl_basketballXLS');
        }

	public function actionDealersSoccer()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/dl_soccer', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/dl_soccer', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
        public function actionDealersSoccerXLS(){
                $this->renderPartial('priceGuide/dl_soccerXLS');
        }

	public function actionDealersVolleyball()
	{
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('priceGuide/dl_volleyball', array(), true));
 
        # Load a stylesheet
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
        $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('priceGuide/dl_volleyball', array(), true));
 
        # Renders image
        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
 	
	}
	public function actionDealersVolleyballXLS(){
                $this->renderPartial('priceGuide/dl_volleyballXLS');
        }
	
	//////////// END DEALERS/////////////////////////
	public function actionCommissionAll($year)
	{
		if(Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1"){
			$result['year'] = $year;
			# mPDF
			$mPDF1 = Yii::app()->ePdf->mpdf();
	 
			# You can easily override default constructor's params
			$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
	 
			# render (full page)
			$mPDF1->WriteHTML($this->render('calculator/salesComissionAll', $result, true));
	 
			# Load a stylesheet
			$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
			$mPDF1->WriteHTML($stylesheet, 1);
	 
			# renderPartial (only 'view' of current controller)
			$mPDF1->WriteHTML($this->renderPartial('calculator/salesComissionAll', $result, true));
	 
			# Renders image
			$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
	 
			# Outputs ready PDF
			$mPDF1->Output();
		}else{
			$this->redirect(array('calculator/ShowCommissionAll/year/'.$year));
		}
	}
	
	public function actionCommissionSale($year, $sale)
	{
		if(Yii::app()->user->getState('userGroup') != ""){
			if(Yii::app()->user->getState('fullName') == $sale || (Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1")){
				
				$result['year'] = $year;
				$result['sale'] = $sale;
				
				# mPDF
				$mPDF1 = Yii::app()->ePdf->mpdf();
				
				# You can easily override default constructor's params
				$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		 
				# render (full page)
				$mPDF1->WriteHTML($this->render('calculator/salesComissionSalel', $result, true));
		 
				# Load a stylesheet
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
				$mPDF1->WriteHTML($stylesheet, 1);
		 
				# renderPartial (only 'view' of current controller)
				$mPDF1->WriteHTML($this->renderPartial('calculator/salesComissionSalel', $result, true));
		 
				# Renders image
				$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
				
				
		 
				# Outputs ready PDF
				$mPDF1->Output();
				
			}else{
					
				$this->redirect(array('calculator/ShowCommissionAll/year/'.$year));
					
			}
			
				
		}else{
			$this->redirect(array('login/index'));
		}
		
 	
	}
	public function actionCommissionSaleUSD($year, $sale, $month="")
	{

		if(Yii::app()->user->getState('userGroup') != ""){
			if(Yii::app()->user->getState('fullName') == $sale || (Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1")){
				
				$result['year'] = $year;
				$result['sale'] = $sale;
                $result['month'] = $month;

                $result['search_date_start'] = (isset($_REQUEST["search_date_start"]))?$_REQUEST["search_date_start"]:"";
                $result['search_date_end'] = (isset($_REQUEST["search_date_end"]))?$_REQUEST["search_date_end"]:"";
                $result['search_invoice'] = (isset($_REQUEST["search_invoice_form"]))?$_REQUEST["search_invoice_form"]:"";
                $result['search_orderno'] = (isset($_REQUEST["search_orderno_form"]))?$_REQUEST["search_orderno_form"]:"";
                $result['search_ordername'] = (isset($_REQUEST["search_ordername_form"]))?$_REQUEST["search_ordername_form"]:"";
                $result['invoice_status'] = (isset($_REQUEST["invoice_status_form"]))?$_REQUEST["invoice_status_form"]:"";
                $result['aproved_status'] = (isset($_REQUEST["aproved_status_form"]))?$_REQUEST["aproved_status_form"]:"";
                $result['commission_status'] = (isset($_REQUEST["commission_status_form"]))?$_REQUEST["commission_status_form"]:"";

				
				# mPDF
				$mPDF1 = Yii::app()->ePdf->mpdf();
				
				# You can easily override default constructor's params
				$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		 
				# render (full page)
				$mPDF1->WriteHTML($this->render('calculator/salesComissionSalelUSD', $result, true));
		 
				# Load a stylesheet
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
				$mPDF1->WriteHTML($stylesheet, 1);
		 
				# renderPartial (only 'view' of current controller)
				$mPDF1->WriteHTML($this->renderPartial('calculator/salesComissionSalelUSD', $result, true));
		 
				# Renders image
				$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
				
				
		 
				# Outputs ready PDF
				$mPDF1->Output();
				
			}else{
					
				$this->redirect(array('calculator/ShowCommissionAll/year/'.$year));
					
			}
			
				
		}else{
			$this->redirect(array('login/index'));
		}
		
 	
	}

        public function actionCommissionSaleUSDEX($year, $sale, $month="")
        {
                $result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['payCreditUSD'] = 0;
		$result['payCreditCAD'] = 0;
		$result['payCreditSGD'] = 0;
		$result['payCreditTHB'] = 0;
		
		$result['totalPayByCustomerUSD'] = 0;
		$result['totalPayByCustomerCAD'] = 0;
		$result['totalPayByCustomerSGD'] = 0;
		$result['totalPayByCustomerTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		
		$result['currency'] = Array();
                if(Yii::app()->user->getState('userGroup') != ""){
                if(Yii::app()->user->getState('fullName') == $sale || (Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1")){
                
                $result['year'] = $year;
                $result['sale'] = $sale;
                $result['month'] = $month;

                $result['search_date_start'] = (isset($_REQUEST["search_date_start"])) ? $_REQUEST["search_date_start"] : "";
                $result['search_date_end'] = (isset($_REQUEST["search_date_end"])) ? $_REQUEST["search_date_end"] : "";
                $result['search_invoice'] = (isset($_REQUEST["search_invoice_form"])) ? $_REQUEST["search_invoice_form"] : "";
                $result['search_orderno'] = (isset($_REQUEST["search_orderno_form"])) ? $_REQUEST["search_orderno_form"] : "";
                $result['search_ordername'] = (isset($_REQUEST["search_ordername_form"])) ? $_REQUEST["search_ordername_form"] : "";
                $result['invoice_status'] = (isset($_REQUEST["invoice_status_form"])) ? $_REQUEST["invoice_status_form"] : "";
                $result['aproved_status'] = (isset($_REQUEST["aproved_status_form"])) ? $_REQUEST["aproved_status_form"] : "";
                $result['commission_status'] = (isset($_REQUEST["commission_status_form"])) ? $_REQUEST["commission_status_form"] : "";

                

                $tmp_year = $year;
		if(isset($month) && $month!=""){
			$tmp_year .= "-".$month;
		}
                
                        $result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.sales_manager = "'.$sale.'"')
			->andwhere('cal.date_quarter LIKE "'.$tmp_year.'%"')
                        ->andwhere('cal.currency = "USD"')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			
				
			foreach ($result['getData']as $key_data => $value_data) {					
				if($value_data['currency'] == "USD"){				
                                        $result['sumtotalUSD'] += ($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost'];
                                        $result['totalcommissionUSD'] +=  $value_data['commission'];                                
                                        $result['payoutUSD'] +=  $value_data['pay_for_sales'];                                
                                        $result['totalPayByCustomerUSD'] += $value_data['pay_by_customer'];                                
                                        $result['payCreditUSD'] += $value_data['pay_by_credit'];
                                        if($value_data['invoice_status'] == "Paid"){                                                                
                                                $result['sumAmountReceivedUSD'] += $value_data['invoice_amount_received'];                                                
                                                if($value_data['commisson_payment_status'] == "Paid"){
                                                        $result['commissionPaymentUSD'] +=  ($value_data['commission'] - $value_data['pay_for_sales'])-$value_data['pay_by_credit'];
                                                        $result['sumCommissionPaymaentUSD'] += $value_data['pay_for_sales']+$value_data['pay_by_credit'];
                                                }else{
                                                        $result['commissionPaymentUSD'] += $value_data['commission'];
                                                }
                                        }
                                }
                                if($value_data['currency'] == "CAD"){                                        
                                        $result['sumtotalCAD'] +=  ($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost'];
                                        $result['totalcommissionCAD'] +=  $value_data['commission'];                                        
                                        $result['payoutCAD'] +=  $value_data['pay_for_sales'];                                        
                                        $result['totalPayByCustomerCAD'] +=  $value_data['pay_by_customer'];                                        
                                        $result['payCreditCAD'] += $value_data['pay_by_credit'];                                        
                                        if($value_data['invoice_status'] == "Paid"){		
                                                $result['sumAmountReceivedCAD'] += $value_data['invoice_amount_received'];                                                
                                                if($value_data['commisson_payment_status'] == "Paid"){
                                                        $result['commissionPaymentCAD'] +=  ($value_data['commission']-$value_data['pay_for_sales'])-$value_data['pay_by_credit'];
                                                        $result['sumCommissionPaymaentCAD'] += $value_data['pay_for_sales']+$value_data['pay_by_credit'];;
                                                }else{
                                                        $result['commissionPaymentCAD'] += $value_data['commission'];
                                                }
                                        }		
                                }
                                if($value_data['currency'] == "SGD"){                                  
                                        $result['sumtotalSGD'] +=  ($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost'];
                                        $result['totalcommissionSGD'] +=  $value_data['commission'];                                        
                                        $result['payoutSGD'] +=  $value_data['pay_for_sales'];                                        
                                        $result['totalPayByCustomerSGD'] +=  $value_data['pay_by_customer'];
                                        $result['payCreditSGD'] += $value_data['pay_by_credit'];
                                        if($value_data['invoice_status'] == "Paid"){	
                                                $result['sumAmountReceivedSGD'] += $value_data['invoice_amount_received'];
                                                if($value_data['commisson_payment_status'] == "Paid"){
                                                        $result['commissionPaymentSGD'] += ($value_data['commission'] - $value_data['pay_for_sales'])-$value_data['pay_by_credit'];
                                                        $result['sumCommissionPaymaentSGD'] += $value_data['pay_for_sales']+$value_data['pay_by_credit'];;
                                                }else{
                                                        $result['commissionPaymentSGD'] += $value_data['commission'];
                                                }
                                        }		
                                }
                                if($value_data['currency'] == "THB"){                                 
                                                        $result['sumtotalTHB'] += ($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost'];
                                                        $result['totalcommissionTHB'] +=  $value_data['commission'];
                                                        
                                                        $result['payoutTHB'] +=  $value_data['pay_for_sales'];
                                                        
                                                        $result['totalPayByCustomerTHB'] +=  $value_data['pay_by_customer'];
                                                        $result['payCreditTHB'] += $value_data['pay_by_credit'];
                                        if($value_data['invoice_status'] == "Paid"){	
                                                $result['sumAmountReceivedTHB'] += $value_data['invoice_amount_received'];
                                                if($value_data['commisson_payment_status'] == "Paid"){
                                                        $result['commissionPaymentTHB'] += ($value_data['commission'] - $value_data['pay_for_sales'])-$value_data['pay_by_credit'];
                                                        $result['sumCommissionPaymaentTHB'] += $value_data['pay_for_sales']+$value_data['pay_by_credit'];;
                                                }else{
                                                        $result['commissionPaymentTHB'] += $value_data['commission'];
                                                }
                                        }		
                                }
								
				$result['currency'][] = $value_data['currency'];
				//echo $result['sumtotalUSD']."<br>";
		        }
                // echo "<pre>";
                // print_r($result);
                // die;
                // Load PHPExcel
                require_once(Yii::app()->basePath . '/vendors/PHPExcel/Classes/PHPExcel.php');
                
                // Create new PHPExcel object
                $objPHPExcel = new PHPExcel();

                // Set properties
                $objPHPExcel->getProperties()->setCreator("Your Name")
                                                ->setLastModifiedBy("Your Name")
                                                ->setTitle("Commission Sales")
                                                ->setSubject("Commission Sales")
                                                ->setDescription("Commission Sales Report")
                                                ->setKeywords("commission sales report");

                // Set column headers and data
                // Example:

                $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('A1:D1') // Merge cells for the top header row
                ->setCellValue('A1', ' Invoice # ') // Set the top header text
                ->getStyle('A1')->getFont()->setBold(true);

                $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('E1:F1') // Merge cells for the top header row
                ->setCellValue('E1', ' Invoice Payment Status ') // Set the top header text
                ->getStyle('E1')->getFont()->setBold(true); // Make the top header text bold
               
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('G1', 'Position Responsible')
                ->getStyle('G1')->getFont()->setBold(true);

                $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('H1:K1') // Merge cells for the top header row
                ->setCellValue('H1', 'Commission Calculator') // Set the top header text
                ->getStyle('H1')->getFont()->setBold(true); // Make the top header text bold

                $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('L1:M1') // Merge cells for the top header row
                ->setCellValue('L1', 'Commission Payment Status') // Set the top header text
                ->getStyle('L1')->getFont()->setBold(true); // Make the top header text bold

                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('N1', 'Comment')
                ->getStyle('N1')->getFont()->setBold(true);

                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('O1', 'Update')
                ->getStyle('O1')->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

                // Set headers
                $objPHPExcel->setActiveSheetIndex(0)             
                ->setCellValue('A2', 'Invoice #')
                ->setCellValue('B2', 'Order No.')
                ->setCellValue('C2', 'Order Name')
                ->setCellValue('D2', 'Date/Quarter')
                ->setCellValue('E2', 'Invoice Status')
                ->setCellValue('F2', 'Amount Received')
                ->setCellValue('G2', 'Position')
                ->setCellValue('H2', 'Total Sales')
                ->setCellValue('I2', 'Commission %')
                ->setCellValue('J2', 'Commission')
                ->setCellValue('K2', 'Balance')
                ->setCellValue('L2', 'Commission Status')
                ->setCellValue('M2', 'Commission Payment')
                ->setCellValue('N2', 'Comments')
                ->setCellValue('O2', 'Last Update');

                $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
                // Populate data
                $row = 3; // Start from row 2
                foreach ($result['getData'] as $data) {
                        $Balance= '';
                        $totalsale = ((($data['total_sales'] - $data['shipping_cost']) - $data['creditcard_feecost']) - $data['comp_itemcost']);
                        if ($data['invoice_status'] == "Paid") {
                                if($data['commisson_payment_status'] == "Paid"){
                                        $balance_invoice = ($data['commission'] - $data['pay_for_sales']) - $data['pay_by_credit'];
                                        if ($balance_invoice != 0) {
                                               $Balance =   number_format($balance_invoice, 2) . " " . $data['currency']  ;
                                        } else {
                                                $Balance = " $ " . number_format($balance_invoice, 2) . " " . $data['currency']  ;
                                        }
                                } else {
                                        if ($totalsale != 0) {
                                                if ($data['commission'] != 0) {
                                                        $Balance =  number_format($data['commission'], 2) . " " . $data['currency']  ;
                                                } else {
                                                        $Balance = "$ " . number_format($data['commission'], 2) . " " . $data['currency'] ;
                                                }
                                        }
                                }
                        }


                        $objPHPExcel->getActiveSheet()                        
                        ->setCellValue('A'.$row, $data['invoice'])
                        ->setCellValue('B'.$row, $data['order_no'])
                        ->setCellValue('C'.$row, $data['order_name'])
                        ->setCellValue('D'.$row, $data['date_quarter'])
                        ->setCellValue('E'.$row, $data['invoice_status'])
                        ->setCellValue('F'.$row, $data['invoice_amount_received'])
                        ->setCellValue('G'.$row, $data['sales_manager'])
                        ->setCellValue('H'.$row, $totalsale)
                        ->setCellValue('I'.$row, $data['commission_percent'])
                        ->setCellValue('J'.$row, $data['commission'])
                        ->setCellValue('K'.$row, $Balance) // Add formula for balance if needed
                        ->setCellValue('L'.$row, $data['status_commission'])
                        ->setCellValue('M'.$row, $data['commisson_payment_status'])
                        ->setCellValue('N'.$row, $data['comments'])
                        ->setCellValue('O'.$row, $data['update_date']);
                        $row++;
                }
               
                $objPHPExcel->getActiveSheet()                        
                ->setCellValue('F'.$row, $result['sumAmountReceivedUSD'])
                ->getStyle('F'.$row)->getFont()->setColor(new PHPExcel_Style_Color('006400')); // Set font color to green for cell F$row

                $objPHPExcel->getActiveSheet()                        
                ->setCellValue('H'.$row, $result['sumtotalUSD'])
                ->getStyle('H'.$row)->getFont()->setColor(new PHPExcel_Style_Color('006400')); // Set font color to green for cell H$row

                $objPHPExcel->getActiveSheet()                        
                ->setCellValue('J'.$row, $result['totalcommissionUSD'])
                ->getStyle('J'.$row)->getFont()->setColor(new PHPExcel_Style_Color('006400')); // Set font color to red for cell J$row

                $objPHPExcel->getActiveSheet()                        
                ->setCellValue('K'.$row, $result['commissionPaymentUSD'])
                ->getStyle('K'.$row)->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED)); // Set font color to red for cell K$row

                $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':O'.$row)->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => 'c1ffe6')
                            ),                            
                        )
                    );


                $objPHPExcel->getActiveSheet()->getStyle('A1:O1')->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '89939c')
                            ),
                            'font' => array(
                                'color' => array('rgb' => 'ffff'),
                            )
                        )
                    );

                    $objPHPExcel->getActiveSheet()->getStyle('A2:O2')->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '5c656d')
                            ),
                            'font' => array(
                                'color' => array('rgb' => 'ffff'),
                            )
                        )
                    );


                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="commission_sales.xlsx"');
                header('Cache-Control: max-age=0');
                
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;
                
                } else {
                $this->redirect(array('calculator/ShowCommissionAll/year/'.$year));
                }
                } else {
                        $this->redirect(array('login/index'));
                }
        }

        public function actionCommissionSaleCADEX($year, $sale, $month="")
        {
                $result['sumtotalUSD'] = 0;
		$result['sumtotalCAD'] = 0;
		$result['sumtotalSGD'] = 0;
		$result['sumtotalTHB'] = 0;
		$result['totalcommissionUSD'] = 0;
		$result['totalcommissionCAD'] = 0;
		$result['totalcommissionSGD'] = 0;
		$result['totalcommissionTHB'] = 0;
		$result['payoutUSD'] = 0;
		$result['payoutCAD'] = 0;
		$result['payoutSGD'] = 0;
		$result['payoutTHB'] = 0;
		$result['commissionPaymentUSD'] = 0;
		$result['commissionPaymentCAD'] = 0;
		$result['commissionPaymentSGD'] = 0;
		$result['commissionPaymentTHB'] = 0;
		
		$result['payCreditUSD'] = 0;
		$result['payCreditCAD'] = 0;
		$result['payCreditSGD'] = 0;
		$result['payCreditTHB'] = 0;
		
		$result['totalPayByCustomerUSD'] = 0;
		$result['totalPayByCustomerCAD'] = 0;
		$result['totalPayByCustomerSGD'] = 0;
		$result['totalPayByCustomerTHB'] = 0;
		
		$result['sumCommissionPaymaentUSD'] = 0;
		$result['sumCommissionPaymaentCAD'] = 0;
		$result['sumCommissionPaymaentSGD'] = 0;
		$result['sumCommissionPaymaentTHB'] = 0;
		
		$result['sumAmountReceivedUSD'] = 0;
		$result['sumAmountReceivedCAD'] = 0;
		$result['sumAmountReceivedSGD'] = 0;
		$result['sumAmountReceivedTHB'] = 0;
		
		$result['currency'] = Array();
                if(Yii::app()->user->getState('userGroup') != ""){
                if(Yii::app()->user->getState('fullName') == $sale || (Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1")){
                
                $result['year'] = $year;
                $result['sale'] = $sale;
                $result['month'] = $month;

                $result['search_date_start'] = (isset($_REQUEST["search_date_start"])) ? $_REQUEST["search_date_start"] : "";
                $result['search_date_end'] = (isset($_REQUEST["search_date_end"])) ? $_REQUEST["search_date_end"] : "";
                $result['search_invoice'] = (isset($_REQUEST["search_invoice_form"])) ? $_REQUEST["search_invoice_form"] : "";
                $result['search_orderno'] = (isset($_REQUEST["search_orderno_form"])) ? $_REQUEST["search_orderno_form"] : "";
                $result['search_ordername'] = (isset($_REQUEST["search_ordername_form"])) ? $_REQUEST["search_ordername_form"] : "";
                $result['invoice_status'] = (isset($_REQUEST["invoice_status_form"])) ? $_REQUEST["invoice_status_form"] : "";
                $result['aproved_status'] = (isset($_REQUEST["aproved_status_form"])) ? $_REQUEST["aproved_status_form"] : "";
                $result['commission_status'] = (isset($_REQUEST["commission_status_form"])) ? $_REQUEST["commission_status_form"] : "";

                

                $tmp_year = $year;
		if(isset($month) && $month!=""){
			$tmp_year .= "-".$month;
		}
                
                        $result['getData'] = Yii::app()->db->createCommand()
			->select('*')
			->from('calculator cal')
			->where('cal.sales_manager = "'.$sale.'"')
			->andwhere('cal.date_quarter LIKE "'.$tmp_year.'%"')
                        ->andwhere('cal.currency = "CAD"')
			->order('cal.date_quarter ASC , cal.invoice ASC ')
			->queryAll();
			
			$result['search_invoice'] = "";
			$result['search_invoice2'] = "";
			$result['search_dateQuarter'] = "";
			$result['search_dateQuarter2'] = "";
			$result['search_orderno'] = "";
			$result['search_orderno2'] = "";
			$result['search_ordername'] = "";
			$result['commission_status'] = "";
			$result['aproved_status'] = "";
			$result['invoice_status'] = "";
			                        
				
			foreach ($result['getData']as $key_data => $value_data) {					
				if($value_data['currency'] == "USD"){				
                                        $result['sumtotalUSD'] += ($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost'];
                                        $result['totalcommissionUSD'] +=  $value_data['commission'];                                
                                        $result['payoutUSD'] +=  $value_data['pay_for_sales'];                                
                                        $result['totalPayByCustomerUSD'] += $value_data['pay_by_customer'];                                
                                        $result['payCreditUSD'] += $value_data['pay_by_credit'];
                                        if($value_data['invoice_status'] == "Paid"){                                                                
                                                $result['sumAmountReceivedUSD'] += $value_data['invoice_amount_received'];                                                
                                                if($value_data['commisson_payment_status'] == "Paid"){
                                                        $result['commissionPaymentUSD'] +=  ($value_data['commission'] - $value_data['pay_for_sales'])-$value_data['pay_by_credit'];
                                                        $result['sumCommissionPaymaentUSD'] += $value_data['pay_for_sales']+$value_data['pay_by_credit'];
                                                }else{
                                                        $result['commissionPaymentUSD'] += $value_data['commission'];
                                                }
                                        }
                                }
                                if($value_data['currency'] == "CAD"){                                        
                                        $result['sumtotalCAD'] +=  ($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost'];
                                        $result['totalcommissionCAD'] +=  $value_data['commission'];                                        
                                        $result['payoutCAD'] +=  $value_data['pay_for_sales'];                                        
                                        $result['totalPayByCustomerCAD'] +=  $value_data['pay_by_customer'];                                        
                                        $result['payCreditCAD'] += $value_data['pay_by_credit'];                                        
                                        if($value_data['invoice_status'] == "Paid"){		
                                                $result['sumAmountReceivedCAD'] += $value_data['invoice_amount_received'];                                                
                                                if($value_data['commisson_payment_status'] == "Paid"){
                                                        $result['commissionPaymentCAD'] +=  ($value_data['commission']-$value_data['pay_for_sales'])-$value_data['pay_by_credit'];
                                                        $result['sumCommissionPaymaentCAD'] += $value_data['pay_for_sales']+$value_data['pay_by_credit'];;
                                                }else{
                                                        $result['commissionPaymentCAD'] += $value_data['commission'];
                                                }
                                        }		
                                }
                                if($value_data['currency'] == "SGD"){                                  
                                        $result['sumtotalSGD'] +=  ($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost'];
                                        $result['totalcommissionSGD'] +=  $value_data['commission'];                                        
                                        $result['payoutSGD'] +=  $value_data['pay_for_sales'];                                        
                                        $result['totalPayByCustomerSGD'] +=  $value_data['pay_by_customer'];
                                        $result['payCreditSGD'] += $value_data['pay_by_credit'];
                                        if($value_data['invoice_status'] == "Paid"){	
                                                $result['sumAmountReceivedSGD'] += $value_data['invoice_amount_received'];
                                                if($value_data['commisson_payment_status'] == "Paid"){
                                                        $result['commissionPaymentSGD'] += ($value_data['commission'] - $value_data['pay_for_sales'])-$value_data['pay_by_credit'];
                                                        $result['sumCommissionPaymaentSGD'] += $value_data['pay_for_sales']+$value_data['pay_by_credit'];;
                                                }else{
                                                        $result['commissionPaymentSGD'] += $value_data['commission'];
                                                }
                                        }		
                                }
                                if($value_data['currency'] == "THB"){                                 
                                                        $result['sumtotalTHB'] += ($value_data['total_sales']-$value_data['shipping_cost'])-$value_data['creditcard_feecost'];
                                                        $result['totalcommissionTHB'] +=  $value_data['commission'];
                                                        
                                                        $result['payoutTHB'] +=  $value_data['pay_for_sales'];
                                                        
                                                        $result['totalPayByCustomerTHB'] +=  $value_data['pay_by_customer'];
                                                        $result['payCreditTHB'] += $value_data['pay_by_credit'];
                                        if($value_data['invoice_status'] == "Paid"){	
                                                $result['sumAmountReceivedTHB'] += $value_data['invoice_amount_received'];
                                                if($value_data['commisson_payment_status'] == "Paid"){
                                                        $result['commissionPaymentTHB'] += ($value_data['commission'] - $value_data['pay_for_sales'])-$value_data['pay_by_credit'];
                                                        $result['sumCommissionPaymaentTHB'] += $value_data['pay_for_sales']+$value_data['pay_by_credit'];;
                                                }else{
                                                        $result['commissionPaymentTHB'] += $value_data['commission'];
                                                }
                                        }		
                                }
								
				$result['currency'][] = $value_data['currency'];
				//echo $result['sumtotalUSD']."<br>";
		        }
                // echo "<pre>";
                // print_r($result);
                // die;
                // Load PHPExcel
                require_once(Yii::app()->basePath . '/vendors/PHPExcel/Classes/PHPExcel.php');
                
                // Create new PHPExcel object
                $objPHPExcel = new PHPExcel();

                // Set properties
                $objPHPExcel->getProperties()->setCreator("Your Name")
                                                ->setLastModifiedBy("Your Name")
                                                ->setTitle("Commission Sales")
                                                ->setSubject("Commission Sales")
                                                ->setDescription("Commission Sales Report")
                                                ->setKeywords("commission sales report");

                // Set column headers and data
                // Example:

                $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('A1:D1') // Merge cells for the top header row
                ->setCellValue('A1', ' Invoice # ') // Set the top header text
                ->getStyle('A1')->getFont()->setBold(true);

                $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('E1:F1') // Merge cells for the top header row
                ->setCellValue('E1', ' Invoice Payment Status ') // Set the top header text
                ->getStyle('E1')->getFont()->setBold(true); // Make the top header text bold
               
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('G1', 'Position Responsible')
                ->getStyle('G1')->getFont()->setBold(true);

                $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('H1:K1') // Merge cells for the top header row
                ->setCellValue('H1', 'Commission Calculator') // Set the top header text
                ->getStyle('H1')->getFont()->setBold(true); // Make the top header text bold

                $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('L1:M1') // Merge cells for the top header row
                ->setCellValue('L1', 'Commission Payment Status') // Set the top header text
                ->getStyle('L1')->getFont()->setBold(true); // Make the top header text bold

                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('N1', 'Comment')
                ->getStyle('N1')->getFont()->setBold(true);

                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('O1', 'Update')
                ->getStyle('O1')->getFont()->setBold(true);

                $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);

                // Set headers
                $objPHPExcel->setActiveSheetIndex(0)             
                ->setCellValue('A2', 'Invoice #')
                ->setCellValue('B2', 'Order No.')
                ->setCellValue('C2', 'Order Name')
                ->setCellValue('D2', 'Date/Quarter')
                ->setCellValue('E2', 'Invoice Status')
                ->setCellValue('F2', 'Amount Received')
                ->setCellValue('G2', 'Position')
                ->setCellValue('H2', 'Total Sales')
                ->setCellValue('I2', 'Commission %')
                ->setCellValue('J2', 'Commission')
                ->setCellValue('K2', 'Balance')
                ->setCellValue('L2', 'Commission Status')
                ->setCellValue('M2', 'Commission Payment')
                ->setCellValue('N2', 'Comments')
                ->setCellValue('O2', 'Last Update');

                $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
                // Populate data
                $row = 3; // Start from row 2
                foreach ($result['getData'] as $data) {
                        $Balance= '';
                        $totalsale = ((($data['total_sales'] - $data['shipping_cost']) - $data['creditcard_feecost']) - $data['comp_itemcost']);
                        if ($data['invoice_status'] == "Paid") {
                                if($data['commisson_payment_status'] == "Paid"){
                                        $balance_invoice = ($data['commission'] - $data['pay_for_sales']) - $data['pay_by_credit'];
                                        if ($balance_invoice != 0) {
                                               $Balance =   number_format($balance_invoice, 2) . " " . $data['currency']  ;
                                        } else {
                                                $Balance = " $ " . number_format($balance_invoice, 2) . " " . $data['currency']  ;
                                        }
                                } else {
                                        if ($totalsale != 0) {
                                                if ($data['commission'] != 0) {
                                                        $Balance =  number_format($data['commission'], 2) . " " . $data['currency']  ;
                                                } else {
                                                        $Balance = "$ " . number_format($data['commission'], 2) . " " . $data['currency'] ;
                                                }
                                        }
                                }
                        }


                        $objPHPExcel->getActiveSheet()                        
                        ->setCellValue('A'.$row, $data['invoice'])
                        ->setCellValue('B'.$row, $data['order_no'])
                        ->setCellValue('C'.$row, $data['order_name'])
                        ->setCellValue('D'.$row, $data['date_quarter'])
                        ->setCellValue('E'.$row, $data['invoice_status'])
                        ->setCellValue('F'.$row, $data['invoice_amount_received'])
                        ->setCellValue('G'.$row, $data['sales_manager'])
                        ->setCellValue('H'.$row, $totalsale)
                        ->setCellValue('I'.$row, $data['commission_percent'])
                        ->setCellValue('J'.$row, $data['commission'])
                        ->setCellValue('K'.$row, $Balance) // Add formula for balance if needed
                        ->setCellValue('L'.$row, $data['status_commission'])
                        ->setCellValue('M'.$row, $data['commisson_payment_status'])
                        ->setCellValue('N'.$row, $data['comments'])
                        ->setCellValue('O'.$row, $data['update_date']);
                        $row++;
                }
               
                $objPHPExcel->getActiveSheet()                        
                ->setCellValue('F'.$row, $result['sumAmountReceivedCAD'])
                ->getStyle('F'.$row)->getFont()->setColor(new PHPExcel_Style_Color('006400')); // Set font color to green for cell F$row

                $objPHPExcel->getActiveSheet()                        
                ->setCellValue('H'.$row, $result['sumtotalCAD'])
                ->getStyle('H'.$row)->getFont()->setColor(new PHPExcel_Style_Color('006400')); // Set font color to green for cell H$row

                $objPHPExcel->getActiveSheet()                        
                ->setCellValue('J'.$row, $result['totalcommissionCAD'])
                ->getStyle('J'.$row)->getFont()->setColor(new PHPExcel_Style_Color('006400')); // Set font color to red for cell J$row

                $objPHPExcel->getActiveSheet()                        
                ->setCellValue('K'.$row, $result['commissionPaymentCAD'])
                ->getStyle('K'.$row)->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED)); // Set font color to red for cell K$row

                $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':O'.$row)->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => 'c1ffe6')
                            ),                            
                        )
                    );


                $objPHPExcel->getActiveSheet()->getStyle('A1:O1')->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '89939c')
                            ),
                            'font' => array(
                                'color' => array('rgb' => 'ffff'),
                            )
                        )
                    );

                    $objPHPExcel->getActiveSheet()->getStyle('A2:O2')->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '5c656d')
                            ),
                            'font' => array(
                                'color' => array('rgb' => 'ffff'),
                            )
                        )
                    );


                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="commission_sales.xlsx"');
                header('Cache-Control: max-age=0');
                
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;
                
                } else {
                $this->redirect(array('calculator/ShowCommissionAll/year/'.$year));
                }
                } else {
                        $this->redirect(array('login/index'));
                }
        }
        
	public function actionCommissionSaleCAD($year, $sale, $month="")
	{
		if(Yii::app()->user->getState('userGroup') != ""){
			if(Yii::app()->user->getState('fullName') == $sale || (Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1")){
				
				$result['year'] = $year;
				$result['sale'] = $sale;
                                $result['month'] = $month;

                                $result['search_date_start'] = (isset($_REQUEST["search_date_start"]))?$_REQUEST["search_date_start"]:"";
                                $result['search_date_end'] = (isset($_REQUEST["search_date_end"]))?$_REQUEST["search_date_end"]:"";
            
                $result['search_invoice'] = (isset($_REQUEST["search_invoice_form"]))?$_REQUEST["search_invoice_form"]:"";
                $result['search_orderno'] = (isset($_REQUEST["search_orderno_form"]))?$_REQUEST["search_orderno_form"]:"";
                $result['search_ordername'] = (isset($_REQUEST["search_ordername_form"]))?$_REQUEST["search_ordername_form"]:"";
                $result['invoice_status'] = (isset($_REQUEST["invoice_status_form"]))?$_REQUEST["invoice_status_form"]:"";
                $result['aproved_status'] = (isset($_REQUEST["aproved_status_form"]))?$_REQUEST["aproved_status_form"]:"";
                $result['commission_status'] = (isset($_REQUEST["commission_status_form"]))?$_REQUEST["commission_status_form"]:"";
				
				# mPDF
				$mPDF1 = Yii::app()->ePdf->mpdf();
				
				# You can easily override default constructor's params
				$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		 
				# render (full page)
				$mPDF1->WriteHTML($this->render('calculator/salesComissionSalelCAD', $result, true));
		 
				# Load a stylesheet
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
				$mPDF1->WriteHTML($stylesheet, 1);
		 
				# renderPartial (only 'view' of current controller)
				$mPDF1->WriteHTML($this->renderPartial('calculator/salesComissionSalelCAD', $result, true));
		 
				# Renders image
				$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
				
				
		 
				# Outputs ready PDF
				$mPDF1->Output();
				
			}else{
					
				$this->redirect(array('calculator/ShowCommissionAll/year/'.$year));
					
			}
			
				
		}else{
			$this->redirect(array('login/index'));
		}
		
 	
	}
	public function actionCommissionSaleSGD($year, $sale, $month="")
	{
		if(Yii::app()->user->getState('userGroup') != ""){
			if(Yii::app()->user->getState('fullName') == $sale || (Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1")){
				
				$result['year'] = $year;
				$result['sale'] = $sale;
                                $result['month'] = $month;

                                $result['search_date_start'] = (isset($_REQUEST["search_date_start"]))?$_REQUEST["search_date_start"]:"";
                                $result['search_date_end'] = (isset($_REQUEST["search_date_end"]))?$_REQUEST["search_date_end"]:"";
                                
                $result['search_invoice'] = (isset($_REQUEST["search_invoice_form"]))?$_REQUEST["search_invoice_form"]:"";
                $result['search_orderno'] = (isset($_REQUEST["search_orderno_form"]))?$_REQUEST["search_orderno_form"]:"";
                $result['search_ordername'] = (isset($_REQUEST["search_ordername_form"]))?$_REQUEST["search_ordername_form"]:"";
                $result['invoice_status'] = (isset($_REQUEST["invoice_status_form"]))?$_REQUEST["invoice_status_form"]:"";
                $result['aproved_status'] = (isset($_REQUEST["aproved_status_form"]))?$_REQUEST["aproved_status_form"]:"";
                $result['commission_status'] = (isset($_REQUEST["commission_status_form"]))?$_REQUEST["commission_status_form"]:"";
				
				# mPDF
				$mPDF1 = Yii::app()->ePdf->mpdf();
				
				# You can easily override default constructor's params
				$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		 
				# render (full page)
				$mPDF1->WriteHTML($this->render('calculator/salesComissionSalelSGD', $result, true));
		 
				# Load a stylesheet
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
				$mPDF1->WriteHTML($stylesheet, 1);
		 
				# renderPartial (only 'view' of current controller)
				$mPDF1->WriteHTML($this->renderPartial('calculator/salesComissionSalelSGD', $result, true));
		 
				# Renders image
				$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
				
				
		 
				# Outputs ready PDF
				$mPDF1->Output();
				
			}else{
					
				$this->redirect(array('calculator/ShowCommissionAll/year/'.$year));
					
			}
			
				
		}else{
			$this->redirect(array('login/index'));
		}
		
 	
	}
	public function actionCommissionSaleTHB($year, $sale, $month="")
	{
		if(Yii::app()->user->getState('userGroup') != ""){
			if(Yii::app()->user->getState('fullName') == $sale || (Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1")){
				
				$result['year'] = $year;
				$result['sale'] = $sale;
                                $result['month'] = $month;

                                $result['search_date_start'] = (isset($_REQUEST["search_date_start"]))?$_REQUEST["search_date_start"]:"";
                                $result['search_date_end'] = (isset($_REQUEST["search_date_end"]))?$_REQUEST["search_date_end"]:"";
                                
                $result['search_invoice'] = (isset($_REQUEST["search_invoice_form"]))?$_REQUEST["search_invoice_form"]:"";
                $result['search_orderno'] = (isset($_REQUEST["search_orderno_form"]))?$_REQUEST["search_orderno_form"]:"";
                $result['search_ordername'] = (isset($_REQUEST["search_ordername_form"]))?$_REQUEST["search_ordername_form"]:"";
                $result['invoice_status'] = (isset($_REQUEST["invoice_status_form"]))?$_REQUEST["invoice_status_form"]:"";
                $result['aproved_status'] = (isset($_REQUEST["aproved_status_form"]))?$_REQUEST["aproved_status_form"]:"";
                $result['commission_status'] = (isset($_REQUEST["commission_status_form"]))?$_REQUEST["commission_status_form"]:"";
				
				# mPDF
				$mPDF1 = Yii::app()->ePdf->mpdf();
				
				# You can easily override default constructor's params
				$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		 
				# render (full page)
				$mPDF1->WriteHTML($this->render('calculator/salesComissionSalelTHB', $result, true));
		 
				# Load a stylesheet
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
				$mPDF1->WriteHTML($stylesheet, 1);
		 
				# renderPartial (only 'view' of current controller)
				$mPDF1->WriteHTML($this->renderPartial('calculator/salesComissionSalelTHB', $result, true));
		 
				# Renders image
				$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
				
				
		 
				# Outputs ready PDF
				$mPDF1->Output();
				
			}else{
					
				$this->redirect(array('calculator/ShowCommissionAll/year/'.$year));
					
			}
			
				
		}else{
			$this->redirect(array('login/index'));
		}
		
 	
	}
	public function actionCommissionDetail($id,$sale)
	{
		if(Yii::app()->user->getState('userGroup') != ""){
			if(Yii::app()->user->getState('fullName') == $sale || (Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1")){
				
				//$result['year'] = $year;
				$result['sale'] = $sale;
				$result['id'] = $id;
				
				# mPDF
				$mPDF1 = Yii::app()->ePdf->mpdf();
				
				# You can easily override default constructor's params
				$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		 
				# render (full page)
				$mPDF1->WriteHTML($this->render('calculator/commissionDetail', $result, true));
		 
				# Load a stylesheet
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
				$mPDF1->WriteHTML($stylesheet, 1);
		 
				# renderPartial (only 'view' of current controller)
				$mPDF1->WriteHTML($this->renderPartial('calculator/commissionDetail', $result, true));
		 
				# Renders image
				$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
				
				
		 
				# Outputs ready PDF
				$mPDF1->Output();
				
			}else{
					
				$this->redirect(array('calculator/ShowCommissionAll/year/'.$year));
					
			}
			
				
		}else{
			$this->redirect(array('login/index'));
		}
		
 	
	}
	public function actionInvioceAll($year)
	{
		if(Yii::app()->user->getState('userGroup') != ""){
			if(Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1"){
				
				$result['year'] = $year;
				
				
				# mPDF
				$mPDF1 = Yii::app()->ePdf->mpdf();
				
				# You can easily override default constructor's params
				$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		 
				# render (full page)
				$mPDF1->WriteHTML($this->render('calculator/invioceAll', $result, true));
		 
				# Load a stylesheet
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
				$mPDF1->WriteHTML($stylesheet, 1);
		 
				# renderPartial (only 'view' of current controller)
				$mPDF1->WriteHTML($this->renderPartial('calculator/invioceAll', $result, true));
		 
				# Renders image
				$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
				
				
		 
				# Outputs ready PDF
				$mPDF1->Output();
				
			}
			
				
		}else{
			$this->redirect(array('login/index'));
		}
		
 	
	}
	
	public function actionInvioceUSDCurrent($year)
	{
		if(Yii::app()->user->getState('userGroup') != ""){
			if(Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1"){
				
				$result['year'] = $year;
				
				
				# mPDF
				$mPDF1 = Yii::app()->ePdf->mpdf();
				
				# You can easily override default constructor's params
				$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		 
				# render (full page)
				$mPDF1->WriteHTML($this->render('calculator/invioceUSDCurrent', $result, true));
		 
				# Load a stylesheet
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
				$mPDF1->WriteHTML($stylesheet, 1);
		 
				# renderPartial (only 'view' of current controller)
				$mPDF1->WriteHTML($this->renderPartial('calculator/invioceUSDCurrent', $result, true));
		 
				# Renders image
				$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
				
				
		 
				# Outputs ready PDF
				$mPDF1->Output();
				
			}
			
				
		}else{
			$this->redirect(array('login/index'));
		}
		
 	
	}
	
	public function actionInvioceUSD($year)
	{
		if(Yii::app()->user->getState('userGroup') != ""){
			if(Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1"){
				
				$result['year'] = $year;
				
				
				# mPDF
				$mPDF1 = Yii::app()->ePdf->mpdf();
				
				# You can easily override default constructor's params
				$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		 
				# render (full page)
				$mPDF1->WriteHTML($this->render('calculator/invioceUSD', $result, true));
		 
				# Load a stylesheet
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
				$mPDF1->WriteHTML($stylesheet, 1);
		 
				# renderPartial (only 'view' of current controller)
				$mPDF1->WriteHTML($this->renderPartial('calculator/invioceUSD', $result, true));
		 
				# Renders image
				$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
				
				
		 
				# Outputs ready PDF
				$mPDF1->Output();
				
			}
			
				
		}else{
			$this->redirect(array('login/index'));
		}
		
 	
	}
	
	public function actionInvioceCAD($year)
	{
		if(Yii::app()->user->getState('userGroup') != ""){
			if(Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1"){
				
				$result['year'] = $year;
				
				
				# mPDF
				$mPDF1 = Yii::app()->ePdf->mpdf();
				
				# You can easily override default constructor's params
				$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		 
				# render (full page)
				$mPDF1->WriteHTML($this->render('calculator/invioceCAD', $result, true));
		 
				# Load a stylesheet
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
				$mPDF1->WriteHTML($stylesheet, 1);
		 
				# renderPartial (only 'view' of current controller)
				$mPDF1->WriteHTML($this->renderPartial('calculator/invioceCAD', $result, true));
		 
				# Renders image
				$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
				
				
		 
				# Outputs ready PDF
				$mPDF1->Output();
				
			}
			
				
		}else{
			$this->redirect(array('login/index'));
		}
		
 	
	}
	
	public function actionInvioceSGD($year)
	{
		if(Yii::app()->user->getState('userGroup') != ""){
			if(Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1"){
				
				$result['year'] = $year;
				
				
				# mPDF
				$mPDF1 = Yii::app()->ePdf->mpdf();
				
				# You can easily override default constructor's params
				$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		 
				# render (full page)
				$mPDF1->WriteHTML($this->render('calculator/invioceSGD', $result, true));
		 
				# Load a stylesheet
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
				$mPDF1->WriteHTML($stylesheet, 1);
		 
				# renderPartial (only 'view' of current controller)
				$mPDF1->WriteHTML($this->renderPartial('calculator/invioceSGD', $result, true));
		 
				# Renders image
				$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
				
				
		 
				# Outputs ready PDF
				$mPDF1->Output();
				
			}
			
				
		}else{
			$this->redirect(array('login/index'));
		}
		
 	
	}
	
	public function actionInvioceTHB($year)
	{
		if(Yii::app()->user->getState('userGroup') != ""){
			if(Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1"){
				
				$result['year'] = $year;
				
				
				# mPDF
				$mPDF1 = Yii::app()->ePdf->mpdf();
				
				# You can easily override default constructor's params
				$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		 
				# render (full page)
				$mPDF1->WriteHTML($this->render('calculator/invioceTHB', $result, true));
		 
				# Load a stylesheet
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . 'css/custom.css');
				$mPDF1->WriteHTML($stylesheet, 1);
		 
				# renderPartial (only 'view' of current controller)
				$mPDF1->WriteHTML($this->renderPartial('calculator/invioceTHB', $result, true));
		 
				# Renders image
				$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
				
				
		 
				# Outputs ready PDF
				$mPDF1->Output();
				
			}
			
				
		}else{
			$this->redirect(array('login/index'));
		}
		
 	
	}
}
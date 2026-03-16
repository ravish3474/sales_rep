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
	public function actionCommissionSaleCAD($year, $sale, $month="")
	{
		if(Yii::app()->user->getState('userGroup') != ""){
			if(Yii::app()->user->getState('fullName') == $sale || (Yii::app()->user->getState('userGroup') == "99" || Yii::app()->user->getState('userGroup') == "1")){
				
				$result['year'] = $year;
				$result['sale'] = $sale;
                                $result['month'] = $month;

                                $result['search_date_start'] = (isset($_REQUEST["search_date_start"]))?$_REQUEST["search_date_start"]:"";
                                $result['search_date_end'] = (isset($_REQUEST["search_date_end"]))?$_REQUEST["search_date_end"]:"";
				
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
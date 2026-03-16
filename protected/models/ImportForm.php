<?php

class ImportForm extends CFormModel
{
    public $excelFile;

    public function rules()
    {
        return array(
            array('excelFile', 'file', 'types' => 'xls, xlsx'),
        );
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->excelFile->saveAs(Yii::app()->basePath . '/uploads/' . $this->excelFile->name);
            return true;
        } else {
            return false;
        }
    }
}

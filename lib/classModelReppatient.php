<?php

require_once('../lib/classModelItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions


class ModelReppatient extends ModelItem {

//---------------------------------------------------------------------------------------------------------------
    public function getMainList($param)
    {
        $this->data = array();

        if(is_numeric($param['doctor'])) {
            if($param['doctor'] > 0) {
                $doctor_sql = " and patient.doctor = :doctor";
                $this->data['doctor'] = $param['doctor'];
            } else {
                $doctor_sql = "";
            }
        }

        if(is_numeric($param['manager'])) {
            if($param['manager'] > 0) {
                $manager_sql = " and d.manager = :manager";
                $this->data['manager'] = $param['manager'];
            } else {
                $manager_sql = "";
            }
        }


        $date = DateTime::createFromFormat('d.m.Y', trim($param['dt_start']));
        if ($date) {
            $dt_start_sql = " and p.dt >= :dt_start";
            $this->data['dt_start'] = DateConvert($param['dt_start'], 'db');
        }

        $date = DateTime::createFromFormat('d.m.Y', trim($param['dt_end']));
        if ($date) {
            $dt_end_sql = " and p.dt <= :dt_end";
            $this->data['dt_end'] = DateConvert($param['dt_end'], 'db');
        }


        $this->sql = "select patient.id, DATE_FORMAT(patient.dt_plan,'%d.%m.%Y') as dt_plan, DATE_FORMAT(p.dt,'%d.%m.%Y') as dt_consultion,"
                    . " d.name as doctor, patient.mo_id, patient.name as patient, patient.comment"
                    . " from patient"
                    . " left join payment as p on p.patient=patient.id "
                    . " left join doctor as d on d.id=patient.doctor"
                    . " where patient.state = 1 and patient.status >= 2 $doctor_sql $manager_sql $dt_start_sql $dt_end_sql"
                    . " order by p.dt";

Debug($this->sql, $this->data);
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);

        $this->records = $stmt->fetchAll();
        Debug("REPORT main list: " . $this->sql, $this->records);
        return $this->records;

    }

//---------------------------------------------------------------------------------------------------------------

}
<?php

require_once('../lib/classModelItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions


class ModelRepdoctor extends ModelItem {

//---------------------------------------------------------------------------------------------------------------
    public function getMainList($param)
    {
        $this->data = array();

        if(is_numeric($param['special'])) {
            if($param['special'] > 0) {
                $special_sql = " and doctor.special = :special";
                $this->data['special'] = $param['special'];
            } else {
                $special_sql = "";
            }
        }

        if(is_numeric($param['clinic'])) {
            if($param['clinic'] > 0) {
                $clinic_sql = " and doctor.clinic = :clinic";
                $this->data['clinic'] = $param['clinic'];
            } else {
                $clinic_sql = "";
            }
        }


        $date = DateTime::createFromFormat('d.m.Y', trim($param['dt_start']));
        if ($date) {
            $dt_start_sql = " and f.dt >= :dt_start";
            $this->data['dt_start'] = DateConvert($param['dt_start'], 'db');
        }

        $date = DateTime::createFromFormat('d.m.Y', trim($param['dt_end']));
        if ($date) {
            $dt_end_sql = " and f.dt <= :dt_end";
            $this->data['dt_end'] = DateConvert($param['dt_end'], 'db');
        }


        else
            $dt_plan = NULL;

        $this->sql = "select doctor.id, doctor.name,  count(distinct p.id) as patients,"
                   ." sum(distinct ROUND(f.sum,2)) as sum, sum(distinct ROUND(f.bonus,2)) as bonus from doctor"
                   . " left join patient as p on p.doctor=doctor.id"
                   . "   left join fin as f on f.mo_id=p.mo_id"
                   . "  where doctor.state=1 and p.mo_id in (select mo_id from fin) $clinic_sql $special_sql $dt_start_sql $dt_end_sql"
                   . "  group by doctor.name";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);

        $this->records = $stmt->fetchAll();

        return $this->records;

    }

//---------------------------------------------------------------------------------------------------------------

}
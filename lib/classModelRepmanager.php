<?php

require_once('../lib/classModelItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions


class ModelRepmanager extends ModelItem {

//---------------------------------------------------------------------------------------------------------------
    public function getMainList($param)
    {
        $this->data = array();

        if(is_numeric($param['region'])) {
            if($param['region'] > 0) {
                $region_sql = " and manager.region = :region";
                $this->data['region'] = $param['region'];
            } else {
                $region_sql = "";
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

/*
        $this->sql = "select manager.id, u.name, count(distinct d.id) as doctors, count(distinct p.id) as patients, sum(distinct ROUND(s.sum,2)) as sum, sum(distinct v.expens) as expenses from manager"
                    . " left join users as u on u.id=manager.user"
                    . " left join doctor as d on d.manager=manager.id"
                    . " left join patient as p on p.doctor=d.id"
                    . " left join payment as s on s.mo_id=p.mo_id"
                    . " left join visit as v on v.manager=manager.id"
                    . " where manager.state=1 $region_sql $dt_start_sql $dt_end_sql"
                    . " group by u.name";
*/

        $this->sql = "select manager.id, u.name, count(distinct d.id) as doctors, count(distinct p.id) as patients, "
                    ." sum(distinct ROUND(f.sum,2)) as sum, sum(distinct ROUND(f.bonus,2)) as bonus "
                    ." from manager"
                    ."  left join users as u on u.id=manager.user"
                    ."  left join doctor as d on d.manager=manager.id"
                    ."  left join patient as p on p.doctor=d.id"
                    ."  left join fin as f on f.mo_id=p.mo_id"
                    ."  where manager.state=1 and p.mo_id in (select mo_id from fin) $region_sql $dt_start_sql $dt_end_sql"
                    ." group by u.name";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);

        $this->records = $stmt->fetchAll();

        return $this->records;

    }

//---------------------------------------------------------------------------------------------------------------

}
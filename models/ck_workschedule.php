<?php

class WorkSchedule extends Database
{
    public function getTable($value = '', $userId)
    {
        if ($value == '') {
            $result = $this->ppic_Table("", "ppic_workschedule");
        }

        $getVal = explode("-", $value);
        $newVal = $getVal[0];

        $data = [];
        $totalData = 0;

        $data = $this->numRows($result, $totalData);

        if ($newVal == "21") {
            $result = $this->ppic_Table($value, "ppic_workschedule2021");
            $data = $this->numRows($result, $totalData, $newVal, $value);
        } else if ($newVal == "20") {
            $result = $this->ppic_Table($value, "ppic_workschedule2020");
            $data = $this->numRows($result, $totalData, $newVal, $value);
        } else {
            $result = $this->ppic_Table($value, "ppic_workschedule");
            $data = $this->numRows($result, $totalData, $newVal, $value);
        }

        $json_data = array(
            "draw"            => 1,   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal"    => intval($totalData),  // total number of records
            "recordsFiltered" => intval($totalData), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
        );

        return json_encode($json_data);  // send data as json format
    }

    private function ppic_Table($val = '', $table)
    {
        $sql = "";
        $sql .= "SELECT
                lotNumber,
                processCode,
                processOrder,
                processSection,
                processRemarks,
                targetFinish,
                actualFinish,
                quantity,
                employeeId,
                status
                FROM $table";

        if (!empty($val)) {
            $sql .= " WHERE lotNumber LIKE '%$val%'";
        }

        $result = $this->connect()->query($sql);

        return $result;
    }

    private function numRows($result, $totalData, $newVal = '', $value = '')
    {
        if (empty($newVal)) {
            if ($result->num_rows > 0) {
                $data = $this->query($result, $totalData);
            } else {
                $data = $this->emptyData();
            }
        } else if ($newVal == "21") {
            if ($result->num_rows > 0) {
                $data = $this->query($result, $totalData);
            } else {
                $result = $this->ppic_Table($value, "ppic_workschedule");

                if ($result->num_rows > 0) {
                    $data = $this->query($result, $totalData);
                } else {
                    $data = $this->emptyData();
                }
            }
        } else if ($newVal == "20") {
            if ($result->num_rows > 0) {
                $data = $this->query($result, $totalData);
            } else {
                $result = $this->ppic_Table($value, "ppic_workschedule");

                if ($result->num_rows > 0) {
                    $data = $this->query($result, $totalData);
                } else {
                    $data = $this->emptyData();
                }
            }
        } else {
            $result = $this->ppic_Table($value, "ppic_workschedule");
            if ($result->num_rows > 0) {
                $data = $this->query($result, $totalData);
            } else {
                $data = $this->emptyData();
            }
        }

        return $data;
    }

    private function query($result, $totalData)
    {
        while ($row = $result->fetch_assoc()) {
            extract($row);

            $data[] = [
                $lotNumber,
                $processCode,
                $processOrder,
                $processSection,
                $processRemarks,
                ($targetFinish == "0000-00-00") ? "" : date("F j, Y", strtotime($targetFinish)),
                ($actualFinish == "0000-00-00") ? "" : date("F j, Y", strtotime($actualFinish)),
                $quantity,
                $employeeId,
                ($status == "0") ? "Inactive" : "Active"
            ];
            $totalData++;
        }

        return $data;
    }

    private function emptyData()
    {
        $data = [];

        $data[] = [
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            ""
        ];

        return $data;
    }
}

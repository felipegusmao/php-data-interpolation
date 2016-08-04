<?php

namespace Fgunix\DataInterpolation;

/**
 * Class DataInterpolation
 * @package Fgunix\DataInterpolation
 */
class DataInterpolation
{
    /**
     * @var
     */
    var $entries;

    /**
     * @var
     */
    var $threshold;

    /**
     * DataInterpolation constructor.
     */
    function __construct() {
    }

    /**
     * @return DataInterpolation
     */
    public static function create() {
        $instance = new self();
        return $instance;
    }

    /**
     * @return mixed
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @param $values
     * @return $this
     */
    public function setEntries( $values )
    {
        // All the data validation has been done already
        foreach ($values as $data => $value) {
            $i = count($this->entries);
            $this->entries[$i]['date'] = \DateTime::createFromFormat('Y-m-d H:i:s', $data);
            $this->entries[$i]['value'] = $value;
        }
        return $this;
    }

    /**
     * @return int
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * @param $threshold
     * @return $this
     */
    public function setThreshold( $threshold )
    {
        $this->threshold = $threshold;
        return $this;
    }

    /**
     * @param $beforeDate
     * @param $date
     * @param $afterDate
     * @param $beforeMeasurement
     * @param $afterMeasurement
     * @return float
     */
    private function calculateInterpolation( $beforeDate, $date, $afterDate, $beforeMeasurement, $afterMeasurement) {

        return (float) ($beforeMeasurement+(($date-$beforeDate)*($afterMeasurement-$beforeMeasurement))/($afterDate-$beforeDate));
    }

    /**
     * @return array
     */
    function getResult() {

        $result = null;

        for ($i = 0; $i < count($this->entries)-1; $i++) {

            $entry = $this->entries[$i];
            $nextEntry = $this->entries[$i+1];
            $delta = 1;

            if ($entry['date']->format("j") > $this->threshold)
                $delta = 2;

            $date = \DateTime::createFromFormat('Y-n-d H:i:s', $entry['date']->format("Y")."-".($entry['date']->format("n")+$delta)."-01 00:00:00");
            $result[$date->format('Y-m-d H:i:s')] = $this->calculateInterpolation($entry['date']->getTimeStamp(), $date->getTimeStamp(), $nextEntry['date']->getTimeStamp(), $entry['value'], $nextEntry['value']);
        }

        return $result;
    }
}

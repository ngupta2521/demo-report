<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class Coremanager{
    private $CI;
    private $response;
    public function __construct() {
         $this->CI =& get_instance();
         $this->response = null;
    }

    /**
     * 
     * To prepare Date Range Filter Array
     * 1. This Week
     * 2. Last Week
     * 3. Last 2 Weeks
     * 4. This Month
     * 5. Last Month
     * @return Array
     */
    public function prepareDateRangeFilter(){
        $data = array();
        //This Week
        $data['this_week'] = $this->thisWeek();
        $data['this_week']['label'] = 'This Week';
        //Last Week
        $data['last_week'] = $this->lastWeek();
        $data['last_week']['label'] = 'Last Week';
        //Last 2 Week
        $data['last_two_week'] = $this->lastTwoWeek();
        $data['last_two_week']['label'] = 'Last Two Week';
        //This Month
        $data['this_month'] = $this->thisMonth();
        $data['this_month']['label'] = 'This Month';
        //Last Month
        $data['last_month'] = $this->lastMonth();
        $data['last_month']['label'] = 'Last Month';
        return $data;
    }
    
    /**
     * 
     * To prepare Date Range This Week
     * @return Array
     */
    private function thisWeek(){
        $thisWeek = array();
        $dateTime  = date('Y-m-d H:i:s',strtotime('last monday', strtotime('tomorrow'))); 
        $monday= new \DateTime($dateTime);
        $todayDate = new \DateTime();
        $thisWeek['start_date'] = $monday->format('Y-m-d');
        $thisWeek['end_date'] = $todayDate->format('Y-m-d');
        return $thisWeek;
    }
    
    /**
     * 
     * To prepare Date Range Last Week
     * @return Array
     */
    private function lastWeek(){
        $lastWeek = array();
        $lastWeekMonday = 'last week monday';
        $lastSunday = 'last sunday';
        $startDate = new \DateTime($lastWeekMonday);
        $endDate  = new \DateTime($lastSunday);
        $lastWeek['start_date']  =$startDate->format('Y-m-d');
        $lastWeek['end_date']  = $endDate->format('Y-m-d');
        return $lastWeek;
    }
    
    /**
     * 
     * To prepare Date Range Last 2 Week
     * @return Array
     */
    private function lastTwoWeek(){
        $lastTwoWeek = array();
        $lastWeekMonday = 'last week monday';
        $lastSunday = 'last sunday';
        $startDate = new \DateTime($lastWeekMonday);
        $endDate  = new \DateTime($lastSunday);
        $lastTwoWeek['start_date']  =$startDate->modify('-7 day')->format('Y-m-d');
        $lastTwoWeek['end_date']  = $endDate->format('Y-m-d');
        return $lastTwoWeek;
    }

    /**
     * 
     * To prepare Date Range Of This Month
     * @return Array
     */
    private function thisMonth(){
        $thisMonth = array();
        $firstDayOfThisMonth = date('Y-m-d',strtotime('first day of this month'));
        $todayDate = new \DateTime();
        $thisMonth['start_date']  =$firstDayOfThisMonth;
        $thisMonth['end_date']  = $todayDate->format('Y-m-d');
        return $thisMonth;
    }

    /**
     * 
     * To prepare Date Range Of Last Month
     * @return Array
     */
    private function lastMonth(){
        $lastMonth = array();
        $firstDayOfLastMonth = date('Y-m-d', strtotime('first day of last month'));
        $lastDayOfLastMonth = date('Y-m-d', strtotime('last day of last month'));
        $lastMonth['start_date']  =$firstDayOfLastMonth;
        $lastMonth['end_date']  = $lastDayOfLastMonth;
        return $lastMonth;
    }
}
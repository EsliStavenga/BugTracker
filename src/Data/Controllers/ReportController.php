<?php

namespace BugTracker\Data\Controllers;

use BugTracker\Data\Interfaces\IReportRepository;

class ReportController implements IReportRepository
{
    
    public function GetAllReports() : array {
        
    }

    public function GetReportById(int $id) : Report {

    }

    public function GetReportsByProjectId(int $projectId) : array {

    }

    public function GetReportsByCompanyId(int $companyId) : array {

    }
    
}
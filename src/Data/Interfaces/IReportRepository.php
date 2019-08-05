<?php

namespace BugTracker\Data\Interfaces;

use BugTracker\Data\Models\Report;

interface IReportRepository
{
    
    public function GetAllReports() : array;
    public function GetReportById(int $id) : Report;
    public function GetReportsByProjectId(int $projectId) : array;
    public function GetReportsByCompanyId(int $companyId) : array;

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Ticket;
use App\TicketEmployees;
use App\TicketDivisions;
use App\TicketSections;
use App\TicketReferenceCode;
use App\TicketStatus;
use App\Activity;
use App\ActivityLog;
use App\Remarks;
use Session;


class TicketController extends Controller
{
    public function addTicket_internal(Request $request){
        $data = new Ticket();

        $data->date1 = $request->date1;
        $data->employee_code = $request->employee_code;
        $data->sex = $request->sex;
        $data->concerned_division = $request->concerned_division;
        $data->concerned_section = $request->concerned_section;
        $data->clientNote = $request->clientNote;
        $data->supportType = $request->supportType;

        $data->reference_code = $request->reference_code;
        $data->ticket_created = $request->ticket_created;
        $data->internal_external = $request->internal_external;
        $data->mode = $request->mode;
        $data->externalName = $request->externalName; //name
        $data->empDiv = $request->empDiv;
        $data->empEmail = $request->empEmail;
        $data->clientType = $request->clientType;

        $data->save();
    }

    public function addTicket_external(Request $request){
        $data = new Ticket(); // insert into table ticket

        $data->date1 = $request->date1;
        $data->externalName = $request->externalName;
        $data->sex = $request->sex;
        $data->externalAgency = $request->externalAgency;
        $data->externalStartDate = $request->externalStartDate;
        $data->externalEndDate = $request->externalEndDate;
        $data->externalEventTitle = $request->externalEventTitle;
        $data->supportType = $request->supportType;
        $data->externalOtherType = $request->externalOtherType;
        $data->clientNote = $request->clientNote;

        $data->reference_code = $request->reference_code;
        $data->ticket_created = $request->ticket_created;
        $data->internal_external = $request->internal_external;
        $data->mode = $request->mode;
        $data->clientType = $request->clientType;
        $data->save();
    }

    public function addTicketStatus_Pending(Request $request){
        $data = new TicketStatus(); // insert into table ticket_status

        $data->status = $request->status;
        $data->reference_code = $request->reference_code;
        $data->entry_date = $request->entry_date;
        $data->save();
    }

    public function addTicketStatus_Pending_STARBOOKS(Request $request){
        $data = new TicketStatus(); // insert into table ticket_status

        $data->reference_code = $request->reference_code;
        $data->status = $request->status;
        $data->entry_date = $request->entry_date;
        $data->assignedStaff = $request->assignedStaff;
        $data->approved_by = $request->approved_by;
        $data->attended_by = $request->attended_by;
        $data->priority = $request->priority;
        $data->ticket_approved = $request->ticket_approved;
        $data->ticket_attended = $request->ticket_attended;
        $data->problem_that_needed_support = $request->problem_that_needed_support;
        $data->actions_taken = $request->actions_taken;
        $data->remarks = $request->remarks;
        $data->feedback_status = $request->feedback_status;
        $data->rating_status = $request->rating_status;
        $data->date2 = $request->date2;
        $data->natureOfSupport = $request->natureOfSupport;
        $data->hardware = $request->hardware;
        $data->software = $request->software;
        $data->supportType_ = $request->supportType_;
        $data->mode_ = $request->mode_;
        $data->assisted_by_1 = $request->assisted_by_1;
        $data->assisted_by_2 = $request->assisted_by_2;
        $data->clientNote_ = $request->clientNote_;
        $data->type = $request->type;
        $data->ticket_completed = $request->ticket_completed;
        $data->save();
    }

    public function addActivityLog(Request $request){
        $data = new ActivityLog(); // insert into table tblactivitylog

        $data->username = $request->username;
        $data->activity_id = $request->activity_id;
        $data->activity_date = $request->activity_date;
        $data->ticket_id = $request->ticket_id;
        $data->remarks_data = $request->remarks_data;
        $data->save();
    }

    public function addRemarksLog(Request $request){
        $data = new Remarks(); // insert into table tblremarks

        $data->ticket_id = $request->ticket_id;
        $data->remarks_data = $request->remarks_data;
        $data->assigned_staff = $request->assigned_staff;
        $data->remarks_date = $request->remarks_date;
        $data->save();
    }


    public function loadActivityLog(Request $request, $id){
        $data = ActivityLog::join('ticket_statuses','activity_logs.ticket_id', '=', 'ticket_statuses.reference_code')
                            ->join('tickets','ticket_statuses.reference_code', '=', 'tickets.reference_code')
                            ->where('activity_logs.ticket_id', $id)
                            ->select('tickets.id', 'tickets.ticket_created', 'ticket_statuses.ticket_completed', 'tickets.externalName', 'tickets.clientNote', 'tickets.internal_external',
                                    'ticket_statuses.reference_code', 'ticket_statuses.entry_date', 'ticket_statuses.assignedStaff', 'ticket_statuses.approved_by', 'ticket_statuses.remarks', 'ticket_statuses.tech_remarks', 'ticket_statuses.actions_taken',
                                    'ticket_statuses.rating_status', 'activity_logs.ticket_id', 'activity_logs.remarks_data', 'activity_logs.activity_id', 'activity_logs.username', 'activity_logs.created_at')
                            ->orderBy('activity_logs.created_at', 'desc')
                            ->get();

                            // join('tickets','ticket_statuses.reference_code', '=', 'tickets.reference_code')
                            // ->join('ticket_employees', 'tickets.employee_code','=', 'ticket_employees.employee_code')

        return response()->json($data, 200);
    }

    public function loadRemarksLog(Request $request, $id){
        $data = Remarks::join('ticket_statuses','remarks.ticket_id', '=', 'ticket_statuses.reference_code')
                            ->where('remarks.ticket_id', $id)
                            ->select('ticket_statuses.reference_code',
                                    'remarks.remarks_data', 'remarks.assigned_staff', 'remarks.remarks_date')
                            ->orderBy('remarks.created_at', 'desc')
                            ->get('*');

        return response()->json($data, 200);
    }

    public function technical_addTicket_internal(Request $request){
        $data = new Ticket();

        $data->reference_code = $request->reference_code;
        $data->ticket_created = $request->ticket_created;
        $data->employee_code = $request->employee_code;
        $data->sex = $request->sex;
        $data->internal_external = $request->internal_external;
        $data->concerned_division = $request->concerned_division;
        $data->concerned_section = $request->concerned_section;
        $data->externalName = $request->externalName;
        $data->empDiv = $request->empDiv;
        $data->empEmail = $request->empEmail;
        $data->clientType = $request->clientType;
        $data->date1 = $request->date1;
        $data->clientNote = $request->clientNote;
        $data->supportType = $request->supportType;
        $data->mode = $request->mode;

        $data->save();
    }

    public function technical_addTicketStatus_Pending(Request $request){
        $data = new TicketStatus(); // insert into table ticket_status

        $data->reference_code = $request->reference_code;
        $data->status = $request->status;
        $data->entry_date = $request->entry_date;
        $data->assignedStaff = $request->assignedStaff;
        $data->approved_by = $request->approved_by;
        $data->attended_by = $request->attended_by;
        $data->priority = $request->priority;
        $data->ticket_approved = $request->ticket_approved;
        $data->ticket_attended = $request->ticket_attended;
        $data->problem_that_needed_support = $request->problem_that_needed_support;
        $data->actions_taken = $request->actions_taken;
        $data->remarks = $request->remarks;
        $data->feedback_status = $request->feedback_status;
        $data->rating_status = $request->rating_status;
        $data->date2 = $request->date2;
        $data->natureOfSupport = $request->natureOfSupport;
        $data->hardware = $request->hardware;
        $data->software = $request->software;
        $data->supportType_ = $request->supportType_;
        $data->mode_ = $request->mode_;
        $data->assisted_by_1 = $request->assisted_by_1;
        $data->assisted_by_2 = $request->assisted_by_2;
        $data->clientNote_ = $request->clientNote_;
        $data->type = $request->type;
        $data->ticket_completed = $request->ticket_completed;
        $data->save();
    }

    public function technical_addTicket_external(Request $request){
        $data = new Ticket();

        $data->date1 = $request->date1;
        $data->externalName = $request->externalName;
        $data->externalAgency = $request->externalAgency;
        $data->sex = $request->sex;
        $data->externalStartDate = $request->externalStartDate;
        $data->externalEndDate = $request->externalEndDate;
        $data->externalEventTitle = $request->externalEventTitle;
        $data->supportType = $request->supportType;
        $data->externalOtherType = $request->externalOtherType;
        $data->clientNote = $request->clientNote;
        $data->reference_code = $request->reference_code;
        $data->ticket_created = $request->ticket_created;
        $data->internal_external = $request->internal_external;
        $data->mode = $request->mode;
        $data->clientType = $request->clientType;

        $data->save();
    }

    public function technical_addTicketStatus_Pending_external(Request $request){
        $data = new TicketStatus(); // insert into table ticket_status

        $data->reference_code = $request->reference_code;
        $data->status = $request->status;
        $data->entry_date = $request->entry_date;
        $data->assignedStaff = $request->assignedStaff;
        $data->approved_by = $request->approved_by;
        $data->attended_by = $request->attended_by;
        $data->priority = $request->priority;
        $data->ticket_approved = $request->ticket_approved;
        $data->ticket_attended = $request->ticket_attended;
        $data->problem_that_needed_support = $request->problem_that_needed_support;
        $data->actions_taken = $request->actions_taken;
        $data->remarks = $request->remarks;
        $data->feedback_status = $request->feedback_status;
        $data->rating_status = $request->rating_status;
        $data->date2 = $request->date2;
        $data->supportType_ = $request->supportType_;
        $data->mode_ = $request->mode_;
        $data->assisted_by_1 = $request->assisted_by_1;
        $data->assisted_by_2 = $request->assisted_by_2;
        $data->clientNote_ = $request->clientNote_;
        $data->type = $request->type;
        $data->ticket_completed = $request->ticket_completed;
        $data->save();
    }

    public function technical_addTicket_starbooks(Request $request){
        $data = new Ticket();

        $data->reference_code = $request->reference_code;
        $data->ticket_created = $request->ticket_created;
        $data->sex = $request->sex;
        $data->internal_external = $request->internal_external;
        $data->externalName = $request->externalName;
        $data->empEmail = $request->empEmail;
        $data->externalAgency = $request->externalAgency;
        $data->date1 = $request->date1;
        $data->clientNote = $request->clientNote;
        $data->supportType = $request->supportType;
        $data->mode = $request->mode;
        $data->save();

    }

    public function technical_addTicketStatus_starbooks(Request $request){
        $data = new TicketStatus(); // insert into table ticket_status

        $data->reference_code = $request->reference_code;
        $data->status = $request->status;
        $data->entry_date = $request->entry_date;
        $data->assignedStaff = $request->assignedStaff;
        $data->approved_by = $request->approved_by;
        $data->attended_by = $request->attended_by;
        $data->priority = $request->priority;
        $data->ticket_approved = $request->ticket_approved;
        $data->ticket_attended = $request->ticket_attended;
        $data->problem_that_needed_support = $request->problem_that_needed_support;
        $data->actions_taken = $request->actions_taken;
        $data->remarks = $request->remarks;
        $data->feedback_status = $request->feedback_status;
        $data->rating_status = $request->rating_status;
        $data->date2 = $request->date2;
        $data->natureOfSupport = $request->natureOfSupport;
        $data->hardware = $request->hardware;
        $data->software = $request->software;
        $data->supportType_ = $request->supportType_;
        $data->mode_ = $request->mode_;
        $data->assisted_by_1 = $request->assisted_by_1;
        $data->assisted_by_2 = $request->assisted_by_2;
        $data->clientNote_ = $request->clientNote_;
        $data->type = $request->type;
        $data->ticket_completed = $request->ticket_completed;
        $data->save();
    }

    public function updatePending(Request $request, $id){
        $data = TicketStatus::where('id', $id)->first();
        $data->reference_code = $request->reference_code;

        //PENDING/NEW UPDATE
        $data->assignedStaff = $request->assignedStaff;
        $data->approved_by = $request->approved_by;
        $data->priority = $request->priority;
        $data->status = $request->status;

        $data->ticket_approved = $request->ticket_approved;
        $data->ticket_updated = $request->ticket_updated;

        $data->save();
    }

    public function updatePending_Ticket(Request $request, $id){
        $data = Ticket::where('id', $id)->first();
        $data->supportType = $request->supportType;

        $data->save();
    }

    public function updateApproved(Request $request, $id){
        $data = TicketStatus::where('id', $id)->first();

        //APPROVED/ASSIGNED UPDATE
        $data->status = $request->status;
        $data->ticket_updated = $request->ticket_updated;
        $data->ticket_attended = $request->ticket_attended;
        $data->attended_by = $request->attended_by;
        $data->save();
    }

    public function updateRemarks(Request $request, $id)
    {
        $data = TicketStatus::where('id', $id)->first();

        //APPROVED/ASSIGNED UPDATE
        $data->ticket_updated = $request->ticket_updated;
        $data->tech_remarks = $request->tech_remarks;
        $data->save();
    }

    public function updateInProg_Ticket_1(Request $request, $id)
    {
        $data = Ticket::where('id', $id)->first();

        //IN PROGRESS UPDATE
        $data->date2 = $request->date2;
        $data->supportType = $request->supportType;
        $data->externalOtherType = $request->externalOtherType;
        $data->mode = $request->mode;
        $data->assisted_by_1 = $request->assisted_by_1;
        $data->assisted_by_2 = $request->assisted_by_2;
        $data->clientNote = $request->clientNote;
        $data->type = $request->type;
        $data->ticket_completed = $request->ticket_completed;
        $data->save();
    }

    public function updateInProg_TicketStatus_1(Request $request, $id)
    {
        $data = TicketStatus::where('id', $id)->first();

        //IN PROGRESS UPDATE
        $data->date2 = $request->date2;
        $data->natureOfSupport = $request->natureOfSupport;
        $data->hardware = $request->hardware;
        $data->software = $request->software;
        $data->supportType_ = $request->supportType_;
        $data->externalOtherType_ = $request->externalOtherType_;
        $data->mode_ = $request->mode_;
        $data->assisted_by_1 = $request->assisted_by_1;
        $data->assisted_by_2 = $request->assisted_by_2;
        $data->clientNote_ = $request->clientNote_;
        $data->type = $request->type;
        $data->ticket_completed = $request->ticket_completed;
        $data->ticket_updated = $request->ticket_updated;
        $data->actions_taken = $request->actions_taken;
        $data->remarks = $request->remarks;
        $data->status = $request->status;
        $data->feedback_status = $request->feedback_status;
        $data->rating_status = $request->rating_status;
        $data->save();
    }

    public function updateApprovedStatus(Request $request, $id)
    {
        $data = TicketStatus::where('id', $id)->first();
        $data->reference_code = $request->reference_code;
        $data->attended_by = $request->attended_by;
        $data->status = $request->status;
        $data->ticket_updated = $request->ticket_updated;
        $data->save();
    }

    public function updateFeedbackStatus(Request $request, $id)
    {
        $data = TicketStatus::where('id', $id)->first();
        $data->feedback_status = $request->feedback_status;
        $data->feedback_received = $request->feedback_received;
        $data->save();
    }

    public function updateRating(Request $request, $id)
    {
        $data = TicketStatus::where('id', $id)->first();
        $data->rating = $request->rating;
        $data->rating_received = $request->rating_received;
        $data->rating_status = $request->rating_status;
        $data->comments_suggestions = $request->comments_suggestions;
        $data->save();
    }

    public function index()
    {
        $events = TicketStatus::orderBy('created_at', 'asc')->paginate();
        return response()->json($events, 200);
    }

    public function setRefCode(Request $request){

        $ref_code = \Request::get('ref_code');
        $request->session()->put('refCode', $ref_code);
        return $request->session()->get('refCode');
    }

    public function setName(Request $request){
        $name = \Request::get('name');
        $request->session()->put('name', $name);
        return $request->session()->get('name');
    }

    public function setDisplayName(Request $request){

        $displayName = \Request::get('ref_code');
        $request->session()->put('displayName', $displayName);
        return $request->session()->get('displayName');
    }

    public function getAllTicketDetails(){
        $data = DB::select("SELECT `tickets`.*, `ticket_employees`.*, `ticket_statuses`.*
                            FROM `tickets`
                            LEFT JOIN `ticket_employees`
                            ON `tickets`.`employee_code`=`ticket_employees`.`employee_code`
                            LEFT JOIN `ticket_statuses`
                            ON `ticket_statuses`.`reference_code`=`tickets`.`reference_code`
                            WHERE `ticket_statuses`.`status` IN ('Pending', 'In Progress', 'Completed')
                            ORDER BY `tickets`.`created_at`
                        ");
        return response()->json($data, 200);
    }
    public function getAllTicketDetails_Assigned(Request $request){
              $data = Ticket::join('ticket_statuses', 'tickets.reference_code','=', 'ticket_statuses.reference_code')
                            ->where('ticket_statuses.assignedStaff', $request->session()->get('name'))
                            ->get('*');
        return response()->json($data, 200);
    }

    public function getAllTicketDetails_Approved_Assigned(Request $request){
            //   $data = Ticket::join('ticket_employees','tickets.employee_code', '=', 'ticket_employees.employee_code')
              $data = Ticket::join('ticket_statuses', 'tickets.reference_code','=', 'ticket_statuses.reference_code')
                            ->where('ticket_statuses.status', "Approved")
                            ->where('ticket_statuses.assignedStaff', $request->session()->get('name'))
                            ->get('*');
        return response()->json($data, 200);
    }

    public function getAllTicketDetails_InProgress_Assigned(Request $request){
            //   $data = Ticket::join('ticket_employees','tickets.employee_code', '=', 'ticket_employees.employee_code')
              $data = Ticket::join('ticket_statuses', 'tickets.reference_code','=', 'ticket_statuses.reference_code')
                            ->where('ticket_statuses.status', "In Progress")
                            ->where('ticket_statuses.assignedStaff', $request->session()->get('name'))
                            ->get('*');
        return response()->json($data, 200);
    }

    public function getAllTicketDetails_Completed_Assigned(Request $request){
            //   $data = Ticket::join('ticket_employees','tickets.employee_code', '=', 'ticket_employees.employee_code')
              $data = Ticket::join('ticket_statuses', 'tickets.reference_code','=', 'ticket_statuses.reference_code')
                            ->where('ticket_statuses.status', "Completed")
                            ->where('ticket_statuses.assignedStaff', $request->session()->get('name'))
                            ->orderBy('tickets.ticket_created', 'DESC')
                            ->get('*');
        return response()->json($data, 200);
    }

    public function getAllTicketDetails_Completed(Request $request){
            //   $data = Ticket::join('ticket_employees','tickets.employee_code', '=', 'ticket_employees.employee_code')
              $data = Ticket::join('ticket_statuses', 'tickets.reference_code','=', 'ticket_statuses.reference_code')
                            ->where('ticket_statuses.status', "Completed")
                            ->orderBy('tickets.ticket_created', 'DESC')
                            ->get('*');
        return response()->json($data, 200);
    }

    public function getAllTicketDetails_Approved(){
        $data = DB::select("SELECT `tickets`.*, `ticket_employees`.*, `ticket_statuses`.*
                            FROM `tickets`
                            LEFT JOIN `ticket_employees`
                            ON `tickets`.`employee_code`=`ticket_employees`.`employee_code`
                            LEFT JOIN `ticket_statuses`
                            ON `ticket_statuses`.`reference_code`=`tickets`.`reference_code`
                            WHERE `ticket_statuses`.`status`='Approved'
                            ORDER BY `ticket_created`
                        ");
        return response()->json($data, 200);
    }

    public function getAllTicketDetails_InProgress(){
        $data = DB::select("SELECT `tickets`.*, `ticket_employees`.*, `ticket_statuses`.*
                            FROM `tickets`
                            LEFT JOIN `ticket_employees`
                            ON `tickets`.`employee_code`=`ticket_employees`.`employee_code`
                            LEFT JOIN `ticket_statuses`
                            ON `ticket_statuses`.`reference_code`=`tickets`.`reference_code`
                            WHERE `ticket_statuses`.`status`='In Progress'
                            ORDER BY `ticket_created`
                        ");
        return response()->json($data, 200);
    }

    public function getAllTicketDetails_Rescheduled(){
        $data = DB::select("SELECT `tickets`.*, `ticket_employees`.*, `ticket_statuses`.*
                            FROM `tickets`
                            LEFT JOIN `ticket_employees`
                            ON `tickets`.`employee_code`=`ticket_employees`.`employee_code`
                            LEFT JOIN `ticket_statuses`
                            ON `ticket_statuses`.`reference_code`=`tickets`.`reference_code`
                            WHERE `ticket_statuses`.`status`='Rescheduled'
                            ORDER BY `ticket_created`
                        ");
        return response()->json($data, 200);
    }

    public function getEmployess(){
        $data = Employee::get();
        return response()->json($data);
    }

    public function getUserData(){
        return Session::get('sessionUserData');
    }

    public function getUserAssignedTicket(){
        $name="";
        $data = DB::select("SELECT `ticket_statuses`.*
                        FROM `ticket_statuses`
                        WHERE `ticket_statuses`.`attended_by`='$name'
                        ");
        return response()->json($data, 200);
    }

    public function getTicketStatus($refCode){
        $data = TicketStatus::join('tickets','ticket_statuses.reference_code', '=', 'tickets.reference_code')
                            // ->join('ticket_employees', 'tickets.employee_code','=', 'ticket_employees.employee_code')
                            ->where('ticket_statuses.reference_code', $refCode)
                            ->get('*');
        return response()->json($data, 200);
    }

    public function loadTicketDetails(Request $request, $id){
        $data = TicketStatus::join('tickets','ticket_statuses.reference_code', '=', 'tickets.reference_code')
                            ->join('ticket_employees', 'tickets.employee_code','=', 'ticket_employees.employee_code')
                            ->where('ticket_statuses.id', $id)
                            ->get('*');

        return response()->json($data, 200);
    }

    public function loadTicketDetails_external(Request $request, $id){
        $data = TicketStatus::join('tickets','ticket_statuses.reference_code', '=', 'tickets.reference_code')
                            // ->join('ticket_employees', 'tickets.employee_code','=', 'ticket_employees.employee_code')
                            ->where('ticket_statuses.id', $id)
                            ->get('*');

        return response()->json($data, 200);
    }

    public function loadTicketDetails_type(Request $request, $id){
        $data = Ticket::where('tickets.id', $id)
                            ->get('tickets.internal_external');

        return response()->json($data, 200);
    }

    public function loadTicketDetails_New(){
        $data = DB::select("SELECT `tickets`.*, `ticket_employees`.*, `ticket_statuses`.*
                            FROM `tickets`
                            LEFT JOIN `ticket_employees`
                            ON `tickets`.`employee_code`=`ticket_employees`.`employee_code`
                            LEFT JOIN `ticket_statuses`
                            ON `ticket_statuses`.`reference_code`=`tickets`.`reference_code`
                            WHERE `ticket_statuses`.`status`='New'
                            ORDER BY `ticket_created`
                        ");
        return response()->json($data, 200);
    }

    public function countEntry($date){
        $data = TicketStatus::where('ticket_statuses.entry_date', $date)
                            ->count();

        return response()->json($data, 200);
    }

    public function countAll(){
        $data = TicketStatus::count();

        return response()->json($data, 200);
    }

    public function countNew_All(){
        $status = "New";
        $data = TicketStatus::where('ticket_statuses.status', $status)
                            ->count();

        return response()->json($data, 200);
    }

    public function countAssigned_All(){
        $status = "Approved";
        $data = TicketStatus::where('ticket_statuses.status', $status)
                            ->count();

        return response()->json($data, 200);
    }

    public function countInProgress_All(){
        $status = "In Progress";
        $data = TicketStatus::where('ticket_statuses.status', $status)
                            ->count();

        return response()->json($data, 200);
    }

    public function countCompleted_All(){
        $status = "Completed";
        $data = TicketStatus::where('ticket_statuses.status', $status)
                            ->count();

        return response()->json($data, 200);
    }

    public function countAssigned_staff($staff){
        $status = "Approved";
        $data = TicketStatus::where('ticket_statuses.status', $status)
                            ->where('ticket_statuses.assignedStaff', $staff)
                            ->count();
        return response()->json($data, 200);
    }

    public function countStaffTickets_PerStatus($staff){

        $data = TicketStatus::selectRaw('
                                    assignedStaff,

                                    SUM(CASE WHEN status = "Completed" THEN 1 ELSE 0 END) as total_Completed,
                                    SUM(CASE WHEN status = "Approved" THEN 1 ELSE 0 END) as total_Pending,
                                    SUM(CASE WHEN status = "In Progress" THEN 1 ELSE 0 END) as total_InProgress
                                ')
                                ->where('assignedStaff', $staff) // Filter for Staff_1
                                ->first(); // Get single record
        return response()->json($data, 200);
    }

    public function countTickets_PerStatus($staff){

        $data = TicketStatus::selectRaw('
                                    assignedStaff,

                                    SUM(CASE WHEN status = "Completed" THEN 1 ELSE 0 END) as total_Completed,
                                    SUM(CASE WHEN status = "Approved" THEN 1 ELSE 0 END) as total_Pending,
                                    SUM(CASE WHEN status = "In Progress" THEN 1 ELSE 0 END) as total_InProgress
                                ')
                                ->first(); // Get single record
        return response()->json($data, 200);
    }

    public function countTickets_Status_Staff(){

        $data = TicketStatus::select(
                                'assignedStaff',
                                DB::raw('SUM(CASE WHEN status = "Approved" THEN 1 ELSE 0 END) as pending_count'),
                                DB::raw('SUM(CASE WHEN status = "In Progress" THEN 1 ELSE 0 END) as in_progress_count'),
                                DB::raw('SUM(CASE WHEN status = "Completed" THEN 1 ELSE 0 END) as completed_count')
                            )
                            ->groupBy('assignedStaff')
                            ->get();
        return response()->json($data, 200);
    }

    public function countInProgress_staff($staff){
        $status = "In Progress";
        $data = TicketStatus::where('ticket_statuses.status', $status)
                            ->where('ticket_statuses.assignedStaff', $staff)
                            ->count();
        return response()->json($data, 200);
    }

    public function countCompleted_staff($staff){
        $status = "Completed";
        $data = TicketStatus::where('ticket_statuses.status', $status)
                            ->where('ticket_statuses.assignedStaff', $staff)
                            ->count();
        return response()->json($data, 200);
    }

    public function validateEmpID($empID){
        $data = TicketEmployees::where('ticket_employees.employee_code', $empID)
                                ->count();
        return response()->json($data, 200);
    }

    public function getEmpDetails($empID){
        $data = TicketEmployees::where('ticket_employees.employee_code', $empID)
                                ->get('*');
        return response()->json($data, 200);
    }

    public function validateGovType($govType){
        $data = Ticket::where('tickets.ifGov', $govType)
                        ->get('*');
        return response()->json($data, 200);
    }

    public function validateRefCode($refCode){
        // $data = TicketEmployees::where('tblemployees.employee_code', $empID)
        $data = TicketStatus::where('ticket_statuses.reference_code', $refCode)
                            ->count();
        return response()->json($data, 200);
    }

    public function validateRefCodeDetails($refCode){
        // $data = TicketEmployees::where('tblemployees.employee_code', $empID)
        $data = Ticket::where('tickets.reference_code', $refCode)
                            ->get('*');
        return response()->json($data, 200);
    }

    public function getMonthlyReportData(Request $request){
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));
        $perPage = $request->input('per_page', 10); // Default to 10 rows per page
        $page = $request->input('page', 1); // Get the current page from request

        // Construct start and end dates
        $startDate = "{$year}-{$month}-01";
        $endDate = date("Y-m-t", strtotime($startDate)); // Last day of the month

        // Debugging SQL Query
        $ticketsQuery = DB::table('tickets as a')
            ->join('ticket_statuses as b', 'b.id', '=', 'a.id')
            ->select([
                'a.reference_code as Reference_Code',
                'a.ticket_created as Requested_Date',
                'b.ticket_approved as Approved_Date',
                'b.ticket_completed as Accomplished_Date',
                'a.externalName as Client_Name',
                'a.empDiv as Division',
                'a.externalAgency as Agency',
                'a.sex as Sex',
                'a.internal_external as Client_Type',
                'a.supportType as Support_Type',
                'a.mode as Mode',
                'b.hardware as Hardware',
                'b.software as Software',
                'b.attended_by as Attended_By',
                'b.assisted_by_1 as Assisted_By',
                'b.assisted_by_2 as Assisted_By_2',
                'b.rating as Rating',
                'a.clientNote as Problem_that_needed_support',
                'b.actions_taken as Actions_Taken',
                'b.remarks as Remarks',
                'b.type as Type',
            ])
            ->whereBetween(DB::raw("STR_TO_DATE(b.ticket_completed, '%M %d %Y %h:%i %p')"), [$startDate, $endDate])
            ->orderBy('a.reference_code', 'asc');

        // Debug the query
        \Log::info("Generated SQL: " . $ticketsQuery->toSql());

        $tickets = $ticketsQuery->paginate($perPage, ['*'], 'page', $page);

        return response()->json($tickets, 200);
    }





    public function getTicketStatusCounts(Request $request)
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $query = DB::table('ticket_statuses')
        ->join('tickets', 'ticket_statuses.reference_code', '=', 'tickets.reference_code') // ✅ Join with tickets table
        ->selectRaw("

            DATE_FORMAT(STR_TO_DATE(tickets.ticket_created, '%M %d %Y %h:%i %p'), '%M') AS month,
            DATE_FORMAT(STR_TO_DATE(tickets.ticket_created, '%M %d %Y %h:%i %p'), '%Y') AS year,

            -- ✅ Count statuses only for 'internal' tickets
            SUM(CASE WHEN ticket_statuses.status = 'New' AND tickets.internal_external = 'Internal' THEN 1 ELSE 0 END) AS new_count,
            SUM(CASE WHEN ticket_statuses.status = 'Pending' AND tickets.internal_external = 'Internal' THEN 1 ELSE 0 END) AS pending_count,
            SUM(CASE WHEN ticket_statuses.status = 'In Progress' AND tickets.internal_external = 'Internal' THEN 1 ELSE 0 END) AS in_progress_count,
            SUM(CASE WHEN ticket_statuses.status = 'Completed' AND tickets.internal_external = 'Internal' THEN 1 ELSE 0 END) AS completed_count,

            -- ✅ Total count of Pending, In Progress, and Completed statuses (Only Internal)
            (
                SUM(CASE WHEN ticket_statuses.status = 'New' AND tickets.internal_external = 'Internal' THEN 1 ELSE 0 END) +
                SUM(CASE WHEN ticket_statuses.status = 'Pending' AND tickets.internal_external = 'Internal' THEN 1 ELSE 0 END) +
                SUM(CASE WHEN ticket_statuses.status = 'In Progress' AND tickets.internal_external = 'Internal' THEN 1 ELSE 0 END) +
                SUM(CASE WHEN ticket_statuses.status = 'Completed' AND tickets.internal_external = 'Internal' THEN 1 ELSE 0 END)
            ) AS total_status_count

            ");

            // ✅ Apply Month Filter Correctly
    if (!empty($month)) {
        $query->whereRaw("DATE_FORMAT(STR_TO_DATE(tickets.ticket_created, '%M %d %Y %h:%i %p'), '%M') = ?", [$month]);
    }

    // ✅ Apply Year Filter Correctly
    if (!empty($year)) {
        $query->whereRaw("DATE_FORMAT(STR_TO_DATE(tickets.ticket_created, '%M %d %Y %h:%i %p'), '%Y') = ?", [$year]);
    }
        $data = $query->first();

        return response()->json($data, 200);
    }

    // ✅ Fetch Hardware, Software, Both, and Livestream Counts
    public function getHardwareSoftwareCounts(Request $request)
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $query = TicketStatus::join('tickets', 'ticket_statuses.reference_code', '=', 'tickets.reference_code')
        ->selectRaw("
                DATE_FORMAT(STR_TO_DATE(tickets.ticket_created, '%M %d %Y %h:%i %p'), '%M') AS month,
                DATE_FORMAT(STR_TO_DATE(tickets.ticket_created, '%M %d %Y %h:%i %p'), '%Y') AS year,

                -- Count only Technical Support cases
                SUM(CASE
                    WHEN tickets.internal_external = 'Internal'
                        AND ticket_statuses.supportType_ = 'Technical Support'
                    AND ticket_statuses.hardware IS NOT NULL AND ticket_statuses.hardware != '' AND ticket_statuses.hardware != 'undefined'
                    AND (ticket_statuses.software IS NULL OR ticket_statuses.software = '' OR ticket_statuses.software = 'undefined')
                    THEN 1 ELSE 0
                END) AS total_hardware,

                SUM(CASE
                    WHEN tickets.internal_external = 'Internal'
                        AND ticket_statuses.supportType_ = 'Technical Support'
                    AND ticket_statuses.software IS NOT NULL AND ticket_statuses.software != '' AND ticket_statuses.software != 'undefined'
                    AND (ticket_statuses.hardware IS NULL OR ticket_statuses.hardware = '' OR ticket_statuses.hardware = 'undefined')
                    THEN 1 ELSE 0
                END) AS total_software,

                SUM(CASE
                    WHEN tickets.internal_external = 'Internal'
                        AND ticket_statuses.supportType_ = 'Technical Support'
                    AND ticket_statuses.hardware IS NOT NULL AND ticket_statuses.hardware != '' AND ticket_statuses.hardware != 'undefined'
                    AND ticket_statuses.software IS NOT NULL AND ticket_statuses.software != '' AND ticket_statuses.software != 'undefined'
                    THEN 1 ELSE 0
                END) AS total_both,

                -- Total Tech Support (Hardware + Software + Both)
                (
                    SUM(CASE
                        WHEN tickets.internal_external = 'Internal'
                        AND ticket_statuses.supportType_ = 'Technical Support'
                        AND ticket_statuses.hardware IS NOT NULL AND ticket_statuses.hardware != '' AND ticket_statuses.hardware != 'undefined'
                        AND (ticket_statuses.software IS NULL OR ticket_statuses.software = '' OR ticket_statuses.software = 'undefined')
                        THEN 1 ELSE 0
                    END) +

                    SUM(CASE
                        WHEN tickets.internal_external = 'Internal'
                        AND ticket_statuses.supportType_ = 'Technical Support'
                        AND ticket_statuses.software IS NOT NULL AND ticket_statuses.software != '' AND ticket_statuses.software != 'undefined'
                        AND (ticket_statuses.hardware IS NULL OR ticket_statuses.hardware = '' OR ticket_statuses.hardware = 'undefined')
                        THEN 1 ELSE 0
                    END) +

                    SUM(CASE
                        WHEN tickets.internal_external = 'Internal'
                        AND ticket_statuses.supportType_ = 'Technical Support'
                        AND ticket_statuses.hardware IS NOT NULL AND ticket_statuses.hardware != '' AND ticket_statuses.hardware != 'undefined'
                        AND ticket_statuses.software IS NOT NULL AND ticket_statuses.software != '' AND ticket_statuses.software != 'undefined'
                        THEN 1 ELSE 0
                    END)
                ) AS total_tech_support,

                -- Other Support Types
                SUM(CASE WHEN tickets.internal_external = 'Internal' AND ticket_statuses.supportType_ = 'Livestream' THEN 1 ELSE 0 END) AS total_livestream,
                SUM(CASE WHEN tickets.internal_external = 'Internal' AND ticket_statuses.supportType_ = 'TWG' THEN 1 ELSE 0 END) AS total_twg,
                SUM(CASE WHEN tickets.internal_external = 'Internal' AND ticket_statuses.supportType_ = 'IS' THEN 1 ELSE 0 END) AS total_infoSystem,

                -- Total Support Types
                (
                    SUM(CASE WHEN tickets.internal_external = 'Internal' AND ticket_statuses.supportType_ = 'Livestream' THEN 1 ELSE 0 END) +
                    SUM(CASE WHEN tickets.internal_external = 'Internal' AND ticket_statuses.supportType_ = 'IS' THEN 1 ELSE 0 END) +
                    SUM(CASE WHEN tickets.internal_external = 'Internal' AND ticket_statuses.supportType_ = 'Technical Support' THEN 1 ELSE 0 END)+
                    SUM(CASE WHEN tickets.internal_external = 'Internal' AND ticket_statuses.supportType_ = 'TWG' THEN 1 ELSE 0 END)
                ) AS total_supportType,

                -- Total Support Types
                (
                    SUM(CASE WHEN tickets.internal_external = 'Internal' THEN 1 ELSE 0 END) +
                    SUM(CASE WHEN tickets.internal_external = 'External' THEN 1 ELSE 0 END)
                ) AS total_internal_external,

                 -- Count Internal & External Tickets
                SUM(CASE WHEN tickets.internal_external = 'Internal' THEN 1 ELSE 0 END) AS total_internal,
                SUM(CASE WHEN tickets.internal_external = 'External' THEN 1 ELSE 0 END) AS total_external

            ")
            ->groupBy('month', 'year')
            ->orderByRaw("STR_TO_DATE(month, '%M')");

        if (!empty($month)) {
            $query->having('month', '=', $month);
        }
        if (!empty($year)) {
            $query->having('year', '=', $year);
        }

        return response()->json($query->get(), 200);
    }

    // ✅ Fetch Ticket Type Counts (PC Setup, Network, Printer, etc.)
    public function getTicketTypeCounts(Request $request)
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $query = TicketStatus::selectRaw("
                DATE_FORMAT(STR_TO_DATE(ticket_completed, '%M %d %Y %h:%i %p'), '%M') AS month,
                DATE_FORMAT(STR_TO_DATE(ticket_completed, '%M %d %Y %h:%i %p'), '%Y') AS year,
                SUM(CASE WHEN type = 'PC Setup & Troubleshooting' THEN 1 ELSE 0 END) AS pc_setup_troubleshooting,
                SUM(CASE WHEN type = 'Network related' THEN 1 ELSE 0 END) AS network_related,
                SUM(CASE WHEN type = 'Printer related' THEN 1 ELSE 0 END) AS printer_related,
                SUM(CASE WHEN type = 'Zoom related' THEN 1 ELSE 0 END) AS zoom_related,
                SUM(CASE WHEN type = 'Website related' THEN 1 ELSE 0 END) AS website_related,
                SUM(CASE WHEN type = 'STARBOOKS related' THEN 1 ELSE 0 END) AS starbooks_related,
                SUM(CASE WHEN type = 'Installation related' THEN 1 ELSE 0 END) AS installation_related,
                SUM(CASE WHEN type IS NULL OR type = '' THEN 1 ELSE 0 END) AS others_type
            ")
            ->where('status', 'completed')
            ->groupBy('month', 'year')
            ->orderByRaw("STR_TO_DATE(month, '%M')");

        if (!empty($month)) {
            $query->having('month', '=', $month);
        }
        if (!empty($year)) {
            $query->having('year', '=', $year);
        }

        return response()->json($query->get(), 200);
    }


    public function getInternalExternalCounts(Request $request)
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $query = DB::table('tickets')
            ->selectRaw("
                SUM(CASE WHEN internal_external = 'Internal' THEN 1 ELSE 0 END) AS internal_count,
                SUM(CASE WHEN internal_external = 'External' THEN 1 ELSE 0 END) AS external_count
            ");

        if (!empty($month)) {
            $query->whereMonth('created_at', date('m', strtotime($month)));
        }
        if (!empty($year)) {
            $query->whereYear('created_at', $year);
        }

        $data = $query->first();

        return response()->json($data, 200);
    }




    // ✅ Fetch Employee Division Counts for Chart
    public function getEmployeeDivisionCounts(Request $request)
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $query = TicketStatus::join('tickets', 'ticket_statuses.reference_code', '=', 'tickets.reference_code')
            ->selectRaw("
                DATE_FORMAT(STR_TO_DATE(ticket_statuses.ticket_completed, '%M %d %Y %h:%i %p'), '%M') AS month,
                DATE_FORMAT(STR_TO_DATE(ticket_statuses.ticket_completed, '%M %d %Y %h:%i %p'), '%Y') AS year,
                SUM(CASE WHEN tickets.empDiv = 'CRPD' THEN 1 ELSE 0 END) AS CRPD,
                SUM(CASE WHEN tickets.empDiv = 'IRAD' THEN 1 ELSE 0 END) AS IRAD,
                SUM(CASE WHEN tickets.empDiv = 'FAD' THEN 1 ELSE 0 END) AS FAD,
                SUM(CASE WHEN tickets.empDiv = 'OD-MISPS' THEN 1 ELSE 0 END) AS OD_MISPS,
                SUM(CASE WHEN tickets.empDiv IS NULL OR tickets.empDiv = '' THEN 1 ELSE 0 END) AS others_total,
                COUNT(*) AS total
            ")
            ->where('ticket_statuses.status', 'completed')
            ->groupBy('month', 'year')
            ->orderByRaw("STR_TO_DATE(month, '%M')");

        if (!empty($month)) {
            $query->having('month', '=', $month);
        }
        if (!empty($year)) {
            $query->having('year', '=', $year);
        }

        return response()->json($query->get(), 200);
    }


}

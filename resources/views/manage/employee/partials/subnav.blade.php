@include('components.subnav',[
        'links' => [
            '/manage/employee/'.$employee->id => 'Details',
            '/manage/employee/'.$employee->id.'/schedule' => 'Schedule',
            '/manage/employee/'.$employee->id.'/pay-rate' => 'Pay Rates',
        ]
    ])
<?php

namespace App\Jobs;

use App\Http\Controllers\DownloadController;
use App\Models\Payroll;
use App\Models\Sendbulkypayslip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\PayrollController;


class SendBulkPayslipsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tries=5;
    public $periodmodel;

    public function __construct(Sendbulkypayslip $sendbulkypayslip)
    {
        $this->periodmodel=$sendbulkypayslip;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->attempts()<5){
            Payroll::where('period',$this->periodmodel->period)
                ->chunk(10,function($pays){
                foreach ($pays as $pay){
                    $this->emailPayslip($pay);
                }
            });

        }
    }

    public function emailPayslip($pay)
    {
        ini_set('memory_limit',-1);
        $download=new DownloadController();
        $path= $download->payslip($pay->id,"FilePath");

        $files = $path.''.$pay->id.'.pdf';

        $name=$pay->fullname;
        $email=$pay->employee->email;
        $email='pomosagwe@gmail.com';

        $body='Attached find your'. date('F Y',strtotime($pay->period)).' payslip.';
        $subject='Payslip';
        $cc_email='test@hks.com';
        $attachpath=array($files);

        $mail=\Mail::send('mail.layout',['mail_body'=>$body] , function($message) use ($email,$name,$attachpath,$subject,$cc_email) {

            $message->to($email, $name)
                ->from('no-reply@hudumakenya.go.ke','Huduma Kenya Secretariat')
                ->subject($subject);;

            foreach($attachpath as $path)
            {
                $message->attach($path);
            }

        });
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class AppointmentController extends Controller
{
    public function showForm()
    {
        return view('book-appointment');
    }

    public function bookAppointment(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $scriptPath = base_path('scripts/bookAppointment.js');
        $process = new Process(['node', $scriptPath, $email, $password]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->json(['message' => 'Process executed successfully', 'output' => $process->getOutput()]);
    }

    public function checkAndBook()
    {
        $process = new Process(['scrapy', 'runspider', base_path('python/bls_spider.py')]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();
        return response()->json(['message' => 'Check and book process executed successfully', 'output' => $output]);
    }
}

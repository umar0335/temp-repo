<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $inputArray = ["insurance.txt" => "Company A",
         "letter.docx" => "Company A",
         "Contract.docx" => "Company B"];

        $outputArray = [];
        foreach ($inputArray as $file => $company) {
            $outputArray[$company][] = $file;
        }

        $outputArray = array_map(function ($files) {
            return array_values($files);
        }, $outputArray);

        print_r($outputArray);
        $response->assertStatus(200);
    }
}

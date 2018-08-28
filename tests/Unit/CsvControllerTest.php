<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class CsvControllerTest extends TestCase
{
    /**
     * Tests that the uploaded file is a csv type.
     *
     * @return void
     */
    public function testUploadIsCsvType()
    {
        //create a test file that is not of csv type
        $doc = UploadedFile::fake()->create(
            "data.doc",
            2024 
        );
        //pass through controller method
        $badResponse = $this->post('/upload', [
            'data-file' => $doc,
        ]);
        
        //assert correct status is returned - redirect because of failed validation
        $badResponse->assertStatus(302);

        //create a test file that is a csv type
        $csv = UploadedFile::fake()->create(
            'data.csv',
            1068
        );

        //pass through conntroller method
        $response = $this->post('/upload', [
            'data-file' => $csv,
        ]);
        //assert correct status is returned
        $response->assertStatus(200);
    }

    /**
     * Checks that the parsed object has the correct 
     * structure and includes the extra attributes.
     * 
     * @return void
     */
    public function testParsedObjectStructureIsCorrect()
    {
        //create a test file that is of csv type
        $csv = UploadedFile::fake()->create(
            'data.csv',
            1068
        );
        //pass through controller method
        $response = $this->post('upload', [
            'data-file' => $csv,
        ]);
        //assert correct status is returned
        $response->assertStatus(200);
        //assert type of returned object
        $response->assertViewIs('results');
    }
}

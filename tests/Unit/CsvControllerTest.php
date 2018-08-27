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
        $badResponse = $this->json('POST','/upload', [
            'data-file' => $doc,
        ]);
        //assert correct status is returned
        $badResponse->assertStatus(422);

        //create a test file that is a csv type
        $csv = UploadedFile::fake()->create(
            'data.csv',
            1068
        );

        //pass through conntroller method
        $response = $this->json('POST', '/upload', [
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
        $response = $this->json('POST', '/upload', [
            'data-file' => $csv,
        ]);
        //assert correct status is reeturned
        $response->assertStatus(200);
        //assert type of returned object
        $response->assertJson();
        //assert returned object has extra attributes
        $response->seeJsonStructure([
            '*' => [
                'invite_sent','invite_channel','invite_type'
            ]
        ]);
    }
}

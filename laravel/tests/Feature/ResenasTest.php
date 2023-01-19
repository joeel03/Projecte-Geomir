<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\Place;
use Illuminate\Support\Facades\Log;




class ResenasTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public static User $testUser;
    public static array $validData = [];
    public static array $invalidData = [];
    public static int $place_id=8;


    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        // Creem usuari/a de prova
        $name = "test_" . time();
        self::$testUser = new User([
            "name" => "{$name}",
            "email" => "{$name}@mailinator.com",
            "password" => "12345678"
        ]);
        // Create fake file
        
        
        $name = "avatar.png";
        $size = 500; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
        // TODO Omplir amb dades vàlides
        self::$validData = [
            "title" => "nombre de prueba",
            "description" => "descripcion de prueba",
            "upload" => $upload,
            "stars" => 5,
            "author_id"=>2,
            "place_id"=>self::$place_id,
        ];
        // TODO Omplir amb dades incorrectes
        self::$invalidData = [
            "title" => "",
            "description" => "descripcion de prueba",
            "upload" => $upload,
            "stars" => 5,
            "author_id"=>2,
            "place_id"=>self::$place_id,
        ];
       
    }

    public function test_myresource_first()
    {
        // Desem l'usuari al primer test
        self::$testUser->save();
        // Comprovem que s'ha creat
        $this->assertDatabaseHas('users', [
            'email' => self::$testUser->email,
        ]);
    }

    public function test_resenas_list()
    {
        //Log::debug();
        $response = $this->get("/api/places/". self::$place_id ."/resenas");
        $response->assertStatus(200);
    }
    public function test_resenas_create()
    {
        Sanctum::actingAs(self::$testUser);
        // Upload fake file using API web service
        $response = $this->postJson("/api/places/". self::$place_id ."/resenas",self::$validData);
        // Check OK response
        $this->_test_ok($response, 201);
        // Check validation errors
        $params = array_keys(self::$validData);
        $response->assertValid($params);
        // Check JSON dynamic values
        $response->assertJsonPath(
            "data.id",
            fn($id) => !empty($id)
        );
        // Read, update and delete dependency!!!
        $json = $response->getData();
        return $json->data;
    }
    public function test_resenas_create_error()
    {
        Sanctum::actingAs(self::$testUser);
        // Upload fake file using API web service
        $response = $this->postJson("/api/places/". self::$place_id ."/resenas", self::$invalidData);
        // Check ERROR response
        $this->_test_error($response);
    }
    /**
     * @depends test_resenas_create
     */
    public function test_resenas_read(object $resena)
    {
        // Read one file
        $response = $this->getJson("/api/places/". self::$place_id ."/resenas/{$resena->id}");
        // Check OK response
        $this->_test_ok($response);
        $response->assertJsonPath(
            "data.title",
            fn($title) => !empty($title)
        );
    }
    public function test_resenas_read_notfound()
    {
        $id = "not_exists";
        $response = $this->getJson("/api/places/". self::$place_id ."/resenas/{$id}");
        $this->_test_notfound($response);
    }
   
    /**
     * @depends test_resenas_create
     */
    public function test_resenas_delete(object $resena)
    {
        Sanctum::actingAs(self::$testUser);
        // Delete one file using API web service
        $response = $this->deleteJson("/api/places/". self::$place_id ."/resenas/{$resena->id}");
        // Check OK response
        $this->_test_ok($response);
    }

    public function test_resenas_delete_notfound()
    {
        Sanctum::actingAs(self::$testUser);
        $id = "not_exists";
        $response = $this->deleteJson("/api/places/". self::$place_id ."/resenas/{$id}");
        $this->_test_notfound($response);
    }

    protected function _test_error($response)
    {
        // Check response
        $response->assertStatus(422);
        // Check validation errors
        $response->assertInvalid(["title"]);
        // Check JSON properties
        $response->assertJson([
            "message" => true,
            // any value
            "errors" => true, // any value
        ]);
        // Check JSON dynamic values
        $response->assertJsonPath(
            "message",
            fn($message) => !empty($message) && is_string($message)
        );
        $response->assertJsonPath(
            "errors",
            fn($errors) => is_array($errors)
        );
    }

    protected function _test_ok($response, $status = 200)
    {
        // Check JSON response
        $response->assertStatus($status);
        // Check JSON properties
        $response->assertJson([
            "success" => true,
            "data" => true // any value
        ]);
    }
   
    protected function _test_notfound($response)
    {
        // Check JSON response
        $response->assertStatus(404);
        // Check JSON properties
        $response->assertJson([
            "success" => false,
            "message" => true // any value
        ]);
        // Check JSON dynamic values
        $response->assertJsonPath(
            "message",
            fn($message) => !empty($message) && is_string($message)
        );
    }
    public function test_myresource_last()
    {
        // Eliminem l'usuari al darrer test
        self::$testUser->delete();
        // Comprovem que s'ha eliminat
        $this->assertDatabaseMissing('users', [
            'email' => self::$testUser->email,
        ]);
    }

}
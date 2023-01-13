<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Place;
use Laravel\Sanctum\Sanctum;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;


class PlaceTest extends TestCase
{
    public static User $testUser;
    public static array $validData = [];
    public static array $invalidData = [];

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        // Creem usuari/a de prova
        $name = "test_" . time();
        self::$testUser = new User([
            "name"      => "{$name}",
            "email"     => "{$name}@mailinator.com",
            "password"  => "12345678"
        ]);
        // Create fake file
        $name  = "avatar.png";
        $size = 500; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
        // TODO Omplir amb dades vàlides
        self::$validData = [
            "name" => "nombre de prueba",
            "description" => "descripcion de prueba",
            "upload" => $upload,
            "latitude" => 41.2310371,
            "longitude" => 1.7282036
        ];
        // TODO Omplir amb dades incorrectes
        self::$invalidData = [
            "name" => "",
            "description" => "descripcion de prueba",
            "upload" => $upload,
            "latitude" => "",
            "longitude" => 1.7282036
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

    public function test_places_list()
    {
        $response = $this->get('api/places');
        $response->assertStatus(200);
    }
    public function test_places_create()
    {
        Sanctum::actingAs(self::$testUser);
        // Upload fake file using API web service
        $response = $this->postJson("/api/places", self::$validData);
        // Check OK response
        $this->_test_ok($response, 201);
        // Check validation errors
        $params = array_keys(self::$validData);
        $response->assertValid($params);
        // Check JSON dynamic values
        $response->assertJsonPath(
            "data.id",
            fn ($id) => !empty($id)
        );
        // Read, update and delete dependency!!!
        $json = $response->getData();
        return $json->data;
    }
    public function test_places_create_error()
    {
        Sanctum::actingAs(self::$testUser);
        // Upload fake file using API web service
        $response = $this->postJson("/api/places", self::$invalidData);
        // Check ERROR response
        $this->_test_error($response);
    }
    /**
     * @depends test_places_create
     */
    public function test_places_read(object $place)
    {
        // Read one file
        $response = $this->getJson("/api/places/{$place->id}");
        // Check OK response
        $this->_test_ok($response);
        $response->assertJsonPath(
            "data.name",
            fn ($name) => !empty($name)
        );
    }
    public function test_places_read_notfound()
    {
        $id = "not_exists";
        $response = $this->getJson("/api/places/{$id}");
        $this->_test_notfound($response);
    }
    /**
     * @depends test_places_create
     */
    public function test_places_update(object $place)
    {
        Sanctum::actingAs(self::$testUser);
        // Upload fake file using API web service
        $response = $this->putJson("/api/places/{$place->id}", self::$validData);
        // Check OK response
        $this->_test_ok($response);
        // Check validation errors
        $params = array_keys(self::$validData);
        $response->assertValid($params);

        $response->assertJsonPath(
            "data.id",
            fn ($id) => !empty($id)
        );
    }
    /**
     * @depends test_places_create
     */
    public function test_places_update_error(object $place)
    {
        Sanctum::actingAs(self::$testUser);
        // Upload fake file using API web service
        $response = $this->putJson("/api/places/{$place->id}", self::$invalidData);
        // Check ERROR response
        $this->_test_error($response);
    }
    public function test_places_update_notfound()
    {
        Sanctum::actingAs(self::$testUser);
        $id = "not_exists";
        $response = $this->putJson("/api/places/{$id}", []);
        $this->_test_notfound($response);
    }
    /**
     * @depends test_places_create
     */
    public function  test_places_favorite(object $place)
    {
        Sanctum::actingAs(self::$testUser);
        // Delete one file using API web service
        $response = $this->postJson("/api/places/{$place->id}/favorites");
        // Check OK response
        $this->_test_ok($response);
    }
    /**
     * @depends test_places_create
     */
    public function test_places_unfavorite(object $place)
    {
        Sanctum::actingAs(self::$testUser);
        // Delete one file using API web service
        $response = $this->deleteJson("/api/places/{$place->id}/favorites");
        // Check OK response
        $this->_test_ok($response);
    }
    /**
     * @depends test_places_create
     */
    public function test_places_delete(object $place)
    {
        Sanctum::actingAs(self::$testUser);
        // Delete one file using API web service
        $response = $this->deleteJson("/api/places/{$place->id}");
        // Check OK response
        $this->_test_ok($response);
    }

    public function test_places_delete_notfound()
    {
        Sanctum::actingAs(self::$testUser);
        $id = "not_exists";
        $response = $this->deleteJson("/api/places/{$id}");
        $this->_test_notfound($response);
    }

    

    protected function _test_error($response)
    {
        // Check response
        $response->assertStatus(422);
        // Check validation errors
        $response->assertInvalid(["name", "latitude"]);
        // Check JSON properties
        $response->assertJson([
            "message" => true, // any value
            "errors"  => true, // any value
        ]);
        // Check JSON dynamic values
        $response->assertJsonPath(
            "message",
            fn ($message) => !empty($message) && is_string($message)
        );
        $response->assertJsonPath(
            "errors",
            fn ($errors) => is_array($errors)
        );
    }

    protected function _test_ok($response, $status = 200)
    {
        // Check JSON response
        $response->assertStatus($status);
        // Check JSON properties
        $response->assertJson([
            "success" => true,
            "data"    => true // any value
        ]);
    }
    //    public function test_myresource_auth_operation()
    //    {
    //        Sanctum::actingAs(self::$testUser);
    //        // TODO Lògica del test
    //    }

    //    public function test_myresource_guest_operation()
    //    {
    //        // TODO Lògica del test
    //    }

    //    public function test_myresource_create()
    //    {
    //        Sanctum::actingAs(self::$testUser);
    //        // Cridar servei web de l'API
    //        $response = $this->postJson("/api/myresource", self::$validData);
    //        // Revisar que no hi ha errors de validació
    //        $params = array_keys(self::$validData);
    //        $response->assertValid($params);
    //        // TODO Revisar més errors
    //    }

    //    public function test_myresource_create_error()
    //    {
    //        Sanctum::actingAs(self::$testUser);
    //        // Cridar servei web de l'API
    //        $response = $this->postJson("/api/myresource", self::$invalidData);
    //        // TODO Revisar errors de validació
    //        $params = [ ];
    //        $response->assertInvalid($params);
    //        // TODO Revisar més errors
    //    }

    // TODO Sub-tests de totes les operacions CRUD

    public function test_myresource_last()
    {
        // Eliminem l'usuari al darrer test
        self::$testUser->delete();
        // Comprovem que s'ha eliminat
        $this->assertDatabaseMissing('users', [
            'email' => self::$testUser->email,
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
            fn ($message) => !empty($message) && is_string($message)
        );
    }
}

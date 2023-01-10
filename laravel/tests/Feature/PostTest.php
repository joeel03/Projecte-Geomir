<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
<?php

namespace Tests\Feature;
 
use App\Models\User;
use App\Models\Post;
use Laravel\Sanctum\Sanctum;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class PostTest extends TestCase
{
    public static User $testUser;
    public static array $validData = [];
    public static array $invalidData = [];
    public static function setUpBeforeClass() : void
    {
       parent::setUpBeforeClass();
       // Creem usuari/a de prova
       $name = "test_" . time();
       self::$testUser = new User([
           "name"      => "{$name}",
           "email"     => "{$name}@mailinator.com",
           "password"  => "12345678"
       ]);
       // TODO Omplir amb dades vàlides
       self::$validData = [];
       // TODO Omplir amb dades incorrectes
       self::$invalidData = [];
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

    public function test_post_list()
    {
        $response = $this->get('api/places');
        $response->assertStatus(200);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_create() : object
    {
        // Create fake file
        $name  = "avatar.png";
        $size = 500; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
        // Create place
        $description="descripcion de prueba";
        $latitude=41.2310371;
        $longitude=1.7282036;
        // Upload fake file using API web service
        $response = $this->postJson("/api/posts", [
            "upload" => $upload,
        ]);
        // Check OK response
        $this->_test_ok($response, 201);
        // Check validation errors
        $response->assertValid(["upload"]);
        // Check JSON exact values
        $response->assertJsonPath("data.filesize", $size*1024);
        // Check JSON dynamic values
        $response->assertJsonPath("data.id",
            fn ($id) => !empty($id)
        );
        $response->assertJsonPath("data.filepath",
            fn ($filepath) => str_contains($filepath, $name)
        );
        // Read, update and delete dependency!!!
        $json = $response->getData();
        return $json->data;
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
    public function test_myresource_auth_operation()
    {
        Sanctum::actingAs(self::$testUser);
        
    }
  
    public function test_myresource_guest_operation()
    {
        // TODO Lògica del test
    }
    public function test_myresource_create()
    {
        Sanctum::actingAs(self::$testUser);
        // Cridar servei web de l'API
        $response = $this->postJson("/api/myresource", self::$validData);
        // Revisar que no hi ha errors de validació
        $params = array_keys(self::$validData);
        $response->assertValid($params);
        // TODO Revisar més errors
    }
    public function test_myresource_create_error()
   {
       // Create fake file with invalid max size
       $name  = "avatar.png";
       $size = 5000; /*KB*/
       $upload = UploadedFile::fake()->image($name)->size($size);
       // Upload fake file using API web service
       $response = $this->postJson("/api/posts", [
           "upload" => $upload,
       ]);
       // Check ERROR response
       $this->_test_error($response);
   }

 
 
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

}

<?php
 
namespace Tests\Feature;
 
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Mymodel;
use Laravel\Sanctum\Sanctum;
use Illuminate\Testing\Fluent\AssertableJson;
 
class MyresourceTest extends TestCase
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

 
   public function test_myresource_auth_operation()
   {
       Sanctum::actingAs(self::$testUser);
       // TODO Lògica del test
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
       Sanctum::actingAs(self::$testUser);
       // Cridar servei web de l'API
       $response = $this->postJson("/api/myresource", self::$invalidData);
       // TODO Revisar errors de validació
       $params = [ /* Omplir */];
       $response->assertInvalid($params);
       // TODO Revisar més errors
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

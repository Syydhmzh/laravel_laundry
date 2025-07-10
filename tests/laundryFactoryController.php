<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Auth\User;
use App\Models\Customer;
use App\Models\Customers;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_testing_creation()
    {
        // create a fake organization
        $user = User::factory()->create();
        $this->actingAs($user);
        //Post request to create a new book
        $response = $this->post('/customer', [
            'name' => 'New name',
            'phone' => 'New phone',
        ]);
        //Check if the book was created
        $response->assertRedirect('/customer');
        $this->assertDatabaseHas('customers', [
            'customer_name' => 'New Name',
            'phone' => 'New Phone',
        ]);

        $response->userSessionHasError(['phone' =>'phone has already been taken' ]);
    }

    /**
     * test book update
     */
    public function test_customer_update()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $customer = Customers::factory()->create([
            'customer_name' => 'new name',
            'phone' => 'new phone',
        ]);
        $response = $this->put("/customer/{$customer->id}",[
            'customer_name' => 'update name',
            'phone' => 'update phone',
        ]);
    }
}

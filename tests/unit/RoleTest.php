<?php

use App\Users\Models\User;
use App\Users\Models\Role;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoleTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
	public function add_role_to_user()
	{
		$user = factory(User::class)->create();
		$role = Role::create(['name' => 'Admin', 'slug' => 'admin', 'description' => 'admin role']);

		$user->role()->attach($role->id);

		$this->assertTrue($user->roles);
		$this->assertEquals(1, $user->roles()->count());
		$this->assertEquals('Admin', $user->roles()->first()->name);
	}

	/** @test */
	// public function check_user_has_role()
	// {

	// }

	/** @test */
	// public function assign_permissions_to_a_role()
	// {
	// }
}
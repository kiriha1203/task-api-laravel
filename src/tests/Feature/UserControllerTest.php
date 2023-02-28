<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testIndex()
    {
        $this->seed(UserSeeder::class);

        $response = $this->getJson('/api/users');

        $response
            ->assertStatus(200)
            ->assertJsonCount(5, 'data.users')
            ->assertJsonFragment([
                'metadata' => array (
                    'message' => 'Users get index successfully'
                )
            ]);
    }

    public function testCreate()
    {
        $postData = [
            'name' => 'TestUser',
            'email' => 'testUser@example.com'
        ];
        $response = $this->postJson('api/user', $postData);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'TestUser',
                'email' => 'testUser@example.com',
                'message' => 'User was created successfully'
            ]);
    }

    public function testFetch()
    {
        $this->seed(UserSeeder::class);

        $response = $this->getJson('api/user?user_id=1');

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'test user1',
                'email' => 'test_user@example.com',
                'message' => 'User get successfully'
            ]);
    }

    public function testUpdate()
    {
        $this->seed(UserSeeder::class);

        $putData = [
            'user_id' => 1,
            'name' => 'UpdateUser'
        ];
        $response = $this->putJson('api/user', $putData);

        $response
            ->assertStatus(200)
            ->assertJsonMissing([
                'name' => 'test user1',
            ])
            ->assertJsonFragment([
                'name' => 'UpdateUser',
                'message' => 'User update successfully'
            ]);

    }

    public function testDelete()
    {
        $this->seed(UserSeeder::class);

        $deleteData = [
            'user_id' => 1,
        ];

        $response = $this->deleteJson('api/user', $deleteData);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'User delete successfully'
            ]);

        $indexData = $this->getJson('/api/users');

        $indexData
            ->assertJsonCount(4, 'data.users')
            ->assertJsonMissing([
                'name' => 'test user1',
            ]);

    }
}

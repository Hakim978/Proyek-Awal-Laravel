<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_from_inventory_pages(): void
    {
        $this->get('/')->assertRedirect(route('login'));
        $this->get(route('items.index'))->assertRedirect(route('login'));
    }

    public function test_user_can_sign_in_and_sign_out(): void
    {
        $user = User::factory()->create();

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);

        $this->post(route('logout'))
            ->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_invalid_login_keeps_user_signed_out(): void
    {
        $user = User::factory()->create();

        $this->from(route('login'))
            ->post(route('login.store'), [
                'email' => $user->email,
                'password' => 'incorrect',
            ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors(['email' => 'Email atau kata sandi yang Anda masukkan tidak sesuai.']);

        $this->assertGuest();
    }

    public function test_authenticated_user_can_create_edit_and_delete_an_item(): void
    {
        $this->actingAs(User::factory()->create());
        $this->get(route('items.create'))->assertOk()->assertSee('Tambah barang');

        $this->post(route('items.store'), [
            'code' => 'BRG-001',
            'name' => 'Monitor',
            'category' => 'Elektronik',
            'stock' => 8,
            'unit' => 'unit',
            'price' => 1250000,
        ])->assertRedirect(route('items.index'));

        $item = Item::query()->where('code', 'BRG-001')->firstOrFail();
        $this->assertModelExists($item);
        $this->get(route('items.edit', $item))->assertOk()->assertSee('Monitor');

        $this->put(route('items.update', $item), [
            'code' => 'BRG-001',
            'name' => 'Monitor Baru',
            'category' => 'Elektronik',
            'stock' => 12,
            'unit' => 'unit',
            'price' => 1350000,
        ])->assertRedirect(route('items.index'));

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'name' => 'Monitor Baru',
            'stock' => 12,
        ]);

        $this->delete(route('items.destroy', $item))
            ->assertRedirect(route('items.index'));

        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }

    public function test_invalid_item_is_not_created(): void
    {
        $this->actingAs(User::factory()->create());

        $this->from(route('items.create'))
            ->post(route('items.store'), [
                'code' => '',
                'name' => '',
                'category' => '',
                'stock' => -1,
                'unit' => '',
                'price' => -10,
            ])
            ->assertRedirect(route('items.create'))
            ->assertSessionHasErrors(['code', 'name', 'category', 'stock', 'unit', 'price']);

        $this->assertDatabaseCount('items', 0);
    }

    public function test_item_code_must_be_unique(): void
    {
        $this->actingAs(User::factory()->create());
        Item::factory()->create(['code' => 'BRG-001']);

        $this->from(route('items.create'))
            ->post(route('items.store'), [
                'code' => 'BRG-001',
                'name' => 'Barang duplikat',
                'category' => 'Perlengkapan',
                'stock' => 3,
                'unit' => 'pcs',
                'price' => 5000,
            ])
            ->assertRedirect(route('items.create'))
            ->assertSessionHasErrors('code');

        $this->assertDatabaseCount('items', 1);
    }

    public function test_item_list_searches_and_escapes_user_provided_content(): void
    {
        $this->actingAs(User::factory()->create());
        $item = Item::factory()->create([
            'name' => '<script>alert(1)</script>',
            'category' => 'Elektronik',
        ]);

        $this->get(route('items.index', ['search' => 'script']))
            ->assertOk()
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false);

        $this->assertModelExists($item);
    }

    public function test_dashboard_displays_live_inventory_summary(): void
    {
        $this->actingAs(User::factory()->create());
        Item::factory()->create(['category' => 'Elektronik', 'stock' => 2]);
        Item::factory()->create(['category' => 'Elektronik', 'stock' => 8]);

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Dashboard')
            ->assertSee('10')
            ->assertSee('1');
    }

    public function test_database_seeder_does_not_create_admin_without_configured_password(): void
    {
        config()->set('inventory.admin_password', null);

        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseMissing('users', ['email' => 'admin@gmail.com']);
    }

    public function test_database_seeder_uses_configured_password_for_admin_login(): void
    {
        config()->set('inventory.admin_password', 'a-long-local-only-password');

        $this->seed(DatabaseSeeder::class);

        $this->post(route('login.store'), [
            'email' => 'admin@gmail.com',
            'password' => 'a-long-local-only-password',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();
    }
}

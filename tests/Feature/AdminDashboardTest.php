<?php

namespace Tests\Feature;

use App\Filament\Widgets\DashboardBanner;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_can_be_rendered(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Ringkasan Operasional & Penjualan');
    }

    public function test_dashboard_banner_widget_renders(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        Livewire::test(DashboardBanner::class)
            ->assertStatus(200)
            ->assertSee('Sistem Operasional Aktif')
            ->assertSee('Tambah Menu')
            ->assertSee('Kelola Pesanan');
    }
}

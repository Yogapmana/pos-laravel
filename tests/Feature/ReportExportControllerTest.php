<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportExportControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    public function test_export_excel_requires_admin_role(): void
    {
        $kasir = User::factory()->create(['role' => 'kasir']);

        $response = $this->actingAs($kasir)
            ->get('/admin/reports/export/excel?start=2026-05-01&end=2026-05-27');

        $response->assertStatus(403);
    }

    public function test_export_excel_returns_file_for_admin(): void
    {
        Order::create([
            'order_number' => 'ORD-20260527-0001',
            'total_price' => 55500,
            'status' => 'Paid',
        ]);

        $response = $this->actingAs($this->admin)
            ->get('/admin/reports/export/excel?start=2026-05-01&end=2026-05-31');

        $response->assertStatus(200);
    }

    public function test_export_pdf_requires_admin_role(): void
    {
        $kasir = User::factory()->create(['role' => 'kasir']);

        $response = $this->actingAs($kasir)
            ->get('/admin/reports/export/pdf?start=2026-05-01&end=2026-05-27');

        $response->assertStatus(403);
    }

    public function test_export_pdf_returns_file_for_admin(): void
    {
        Order::create([
            'order_number' => 'ORD-20260527-0001',
            'total_price' => 55500,
            'status' => 'Paid',
        ]);

        $response = $this->actingAs($this->admin)
            ->get('/admin/reports/export/pdf?start=2026-05-01&end=2026-05-31');

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_export_requires_authentication(): void
    {
        $response = $this->get('/admin/reports/export/excel?start=2026-05-01&end=2026-05-31');
        $response->assertRedirect('/login');
    }
}

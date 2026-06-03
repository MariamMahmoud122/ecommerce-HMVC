<?php

namespace Modules\Catalog\Tests\Feature;

use Modules\Catalog\Tests\CatalogTestCase;

class CatalogRouteTest extends CatalogTestCase
{
    /** @test */
    public function it_can_access_the_google_redirect_route()
    {
        // ريكويست وهمي للرابط اللي برمجناه لجوجل لوجن
        $response = $this->get('/auth/google/redirect');

        // الـ Redirect بيرد بـ 302 أوتوماتيك
        $response->assertStatus(302);
    }
}
<?php

namespace Tests\Feature;

use Tests\TestCase;

class LocalizationTest extends TestCase
{
    /**
     * Test locale switching route.
     */
    public function test_locale_switching_updates_session(): void
    {
        // Default locale
        $response = $this->get('/');
        $response->assertStatus(200);

        // Switch to French
        $response = $this->get('/lang/fr');
        $response->assertRedirect();
        $this->assertEquals('fr', session('locale'));

        // Switch to Arabic
        $response = $this->get('/lang/ar');
        $response->assertRedirect();
        $this->assertEquals('ar', session('locale'));

        // Switch to English
        $response = $this->get('/lang/en');
        $response->assertRedirect();
        $this->assertEquals('en', session('locale'));
    }

    /**
     * Test that pages render correctly with correct translation values and no raw translation keys.
     */
    public function test_landing_page_rendered_without_raw_translation_keys_in_all_locales(): void
    {
        $locales = ['en', 'fr', 'ar'];

        foreach ($locales as $locale) {
            // Set session locale
            $response = $this->withSession(['locale' => $locale])->get('/');
            $response->assertStatus(200);
            
            // The response must NOT contain raw translation keys like landing.title or auth.connexion
            $content = $response->getContent();
            $this->assertStringNotContainsString('landing.title', $content);
            $this->assertStringNotContainsString('landing.subtitle', $content);
            $this->assertStringNotContainsString('landing.placeholder', $content);
            $this->assertStringNotContainsString('landing.hero_badge_title', $content);
            $this->assertStringNotContainsString('auth.connexion', $content);
            $this->assertStringNotContainsString('auth.dont_have_account', $content);
            
            // Check that locale-specific title is rendered
            if ($locale === 'en') {
                $response->assertSee('Validate your next winning product');
                $response->assertSee('dir="ltr"', false);
            } elseif ($locale === 'fr') {
                $response->assertSee('Valisez votre prochain produit gagnant');
                $response->assertSee('dir="ltr"', false);
            } elseif ($locale === 'ar') {
                $response->assertSee('صادق على منتجك الرابح التالي');
                $response->assertSee('dir="rtl"', false);
            }
        }
    }

    /**
     * Test login page has no raw translation keys and has correct layout direction.
     */
    public function test_login_page_localization(): void
    {
        $locales = ['en', 'fr', 'ar'];

        foreach ($locales as $locale) {
            $response = $this->withSession(['locale' => $locale])->get('/login');
            $response->assertStatus(200);
            
            $content = $response->getContent();
            $this->assertStringNotContainsString('auth.connexion', $content);
            $this->assertStringNotContainsString('auth.dont_have_account', $content);
            $this->assertStringNotContainsString('auth.forgot_password', $content);
            $this->assertStringNotContainsString('auth.remember_me', $content);
            
            if ($locale === 'ar') {
                $response->assertSee('dir="rtl"', false);
            } else {
                $response->assertSee('dir="ltr"', false);
            }
        }
    }

    /**
     * Test register page has no raw translation keys and has correct layout direction.
     */
    public function test_register_page_localization(): void
    {
        $locales = ['en', 'fr', 'ar'];

        foreach ($locales as $locale) {
            $response = $this->withSession(['locale' => $locale])->get('/register');
            $response->assertStatus(200);
            
            $content = $response->getContent();
            $this->assertStringNotContainsString('auth.create_account', $content);
            $this->assertStringNotContainsString('auth.already_registered', $content);
            
            if ($locale === 'ar') {
                $response->assertSee('dir="rtl"', false);
            } else {
                $response->assertSee('dir="ltr"', false);
            }
        }
    }

    /**
     * Test that missing translation keys are logged with locale and URL.
     */
    public function test_missing_translation_keys_are_logged(): void
    {
        $key = 'non_existent_key_for_testing_123';

        \Illuminate\Support\Facades\Log::shouldReceive('warning')
            ->once()
            ->with(\Mockery::on(function ($message) use ($key) {
                return str_contains($message, "Missing translation key: '{$key}'") 
                    && str_contains($message, "for locale:")
                    && str_contains($message, "at URL:");
            }));

        $translated = __($key);

        // Verify that the UI fallback is still the key itself (does not break UI)
        $this->assertEquals($key, $translated);
    }
}

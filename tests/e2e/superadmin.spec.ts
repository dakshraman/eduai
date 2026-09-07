import { test, expect } from '@playwright/test';
import { loginAsSuperAdmin, expectSidebarItem } from './helpers/auth';

test.describe('SuperAdmin Panel', () => {
    test.beforeEach(async ({ page }) => {
        await loginAsSuperAdmin(page);
    });

    test('dashboard shows platform stats', async ({ page }) => {
        await page.goto('/superadmin');
        await expect(page.locator('text=Platform Overview').first()).toBeVisible();
        await expect(page.locator('text=Total Schools').first()).toBeVisible();
        await expect(page.locator('text=Total Users').first()).toBeVisible();
    });

    test('sidebar has correct superadmin navigation', async ({ page }) => {
        await expectSidebarItem(page, 'Dashboard');
        await expectSidebarItem(page, 'Schools');
        await expectSidebarItem(page, 'Plans');
        await expectSidebarItem(page, 'Settings');

        // Should NOT have admin panel items
        await expect(page.locator('nav a').filter({ hasText: 'Students' })).not.toBeVisible();
        await expect(page.locator('nav a').filter({ hasText: 'Teachers' })).not.toBeVisible();
    });

    test('schools page loads with list', async ({ page }) => {
        await page.goto('/superadmin/schools');
        await expect(page.locator('h1').filter({ hasText: 'Schools' })).toBeVisible();
        await expect(page.locator('text=EduAI Demo School').first()).toBeVisible();
    });

    test('schools page has add school button', async ({ page }) => {
        await page.goto('/superadmin/schools');
        await expect(page.locator('a[href="/superadmin/schools/create"], button').filter({ hasText: /Add School|Create/ }).first()).toBeVisible();
    });

    test('plans page loads with plan cards', async ({ page }) => {
        await page.goto('/superadmin/plans');
        await expect(page.locator('h1').filter({ hasText: /Plans|Subscription/ })).toBeVisible();
        await expect(page.locator('text=Starter').first()).toBeVisible();
        await expect(page.locator('text=Pro').first()).toBeVisible();
    });

    test('plans page has add plan button', async ({ page }) => {
        await page.goto('/superadmin/plans');
        await expect(page.locator('a[href="/superadmin/plans/create"], button').filter({ hasText: /Add Plan|Create/ }).first()).toBeVisible();
    });

    test('settings page loads', async ({ page }) => {
        await page.goto('/superadmin/settings');
        await expect(page.locator('h1').filter({ hasText: /Settings|Platform/ })).toBeVisible();
    });

    test('school detail page loads', async ({ page }) => {
        await page.goto('/superadmin/schools');
        await page.locator('a[href*="/superadmin/schools/"]').first().click();
        await expect(page.locator('text=EduAI Demo School').first()).toBeVisible({ timeout: 5000 });
    });
});

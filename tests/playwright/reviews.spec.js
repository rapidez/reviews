import { test, expect } from "@playwright/test";
import { BasePage } from '../../vendor/rapidez/core/tests/playwright/pages/BasePage'
import { ProductPage } from "./pages/ProductPage";

test('product with reviews', async ({ page }) => {
    const productPage = new ProductPage(page)
    const product = await productPage.goto(process.env.PRODUCT_URL_REVIEWS)

    expect(await productPage.hasReviews()).toBe(true)
    expect(await productPage.getRatingText(product))

    await new BasePage(page).screenshot('fullpage-footer', {
        mask: [await page.getByTestId('masked')]
    })
})

test('product without reviews', async ({ page }) => {
    const productPage = new ProductPage(page)
    await productPage.goto(process.env.PRODUCT_URL_WITHOUT_REVIEW)

    expect(await productPage.hasReviews()).toBe(false)

    await new BasePage(page).screenshot('fullpage-footer')
})

test('load more reviews', async ({ page}) => {
    const productPage = new ProductPage(page)
    await productPage.goto(process.env.PRODUCT_URL_LOAD_MORE_REVIEWS)

    expect(await productPage.hasLoadMoreReviews()).toBe(true)

    await new BasePage(page).screenshot('fullpage-footer', {
        mask: [await page.getByTestId('masked')]
    })
})

test('product write a review', async ({ page }) => {
    const productPage = new ProductPage(page)
    await productPage.goto(process.env.PRODUCT_URL_WRITE_REVIEW)

    await productPage.writeReview()

    await new BasePage(page).screenshot('fullpage-footer')
})
import { test, expect } from "@playwright/test";
import { BasePage } from '../../vendor/rapidez/core/tests/playwright/pages/BasePage'
import { ProductPage } from "./pages/ProductPage";

test('product with reviews', async ({ page }) => {
    const productPage = new ProductPage(page)
    await productPage.goto(process.env.PRODUCT_URL_REVIEWS)

    const hasReviews = await productPage.hasReviews()
    expect(hasReviews).toBe(true)

    const ratingText = await productPage.getRatingText()
    expect(ratingText).toBe('6.7')

    await new BasePage(page).screenshot('fullpage-footer')
})

test('product without reviews', async ({ page }) => {
    const productPage = new ProductPage(page)
    await productPage.goto(process.env.PRODUCT_URL_WITHOUT_REVIEW)

    const hasReviews = await productPage.hasReviews()
    expect(hasReviews).toBe(false)

    await new BasePage(page).screenshot('fullpage-footer')
})

test('load more reviews', async ({ page}) => {
    const productPage = new ProductPage(page)
    await productPage.goto(process.env.PRODUCT_URL_LOAD_MORE_REVIEWS)

    const hasLoadMoreReviews = await productPage.hasLoadMoreReviews()
    expect(hasLoadMoreReviews).toBe(true)

    await new BasePage(page).screenshot('fullpage-footer')

})

test('product write a review', async ({ page }) => {
    const productPage = new ProductPage(page)
    await productPage.goto(process.env.PRODUCT_URL_WRITE_REVIEW)

    await productPage.writeReview()

    await new BasePage(page).screenshot('fullpage-footer')
})
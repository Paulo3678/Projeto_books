const express = require('express')
const ensureAuthenticated = require('../middlewares/ensureAuthenticated')
const reviewService = require('../service/reviewService')

const router = express.Router()

// Create review
router.post('/reviews', ensureAuthenticated, async (req, res, next) => {
	const data = req.body
	try {
		const newReview = await reviewService.saveReview(data)
		res.status(201).json(newReview)
	} catch (e) {
		next(e)
	}
})

// Get review
router.get('/reviews/:id', async (req, res, next) => {
	try {
		const review = await reviewService.getReview(req.params.id)
		res.status(200).json(review)
	} catch (e) {
		next(e)
	}
})

// Get all user reviews
router.get('/reviews/:id/users', async (req, res, next) => {
	try {
		const userReviews = await reviewService.getUserReviews(req.params.id)
		res.status(200).json(userReviews)
	} catch (e) {
		next(e)
	}
})

// Get all book reviews
router.get('/reviews/:id/books', async (req, res, next) => {
	try {
		const bookReviews = await reviewService.getBookReviews(req.params.id)
		res.status(200).json(bookReviews)
	} catch (e) {
		next(e)
	}
})

// Update review
router.put('/reviews/:id', ensureAuthenticated, async (req, res, next) => {
	const newData = req.body
	try {
		await reviewService.putReview(req.params.id, req.usuario.id_user, newData)
		res.status(200).end()
	} catch (e) {
		next(e)
	}
})

// Delete review
router.delete('/reviews/:id', ensureAuthenticated, async (req, res, next) => {
	try {
		await reviewService.deleteReview(req.params.id, req.usuario.id_user)
		res.status(200).end()
	} catch (e) {
		next(e)
	}
})
module.exports = router

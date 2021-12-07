const express = require('express')
const ensureAuthenticated = require('../middlewares/ensureAuthenticated')
const authorService = require('../service/authorService')

const router = express.Router()

// Create author
router.post('/authors', ensureAuthenticated, async (req, res, next) => {
	const data = req.body
	try {
		if (req.usuario.admin !== true) throw new Error('Unauthorized')
		const newbook = await authorService.saveAuthor(data)
		res.status(200).json(newbook)
	} catch (e) {
		next(e)
	}
})

// Get author
router.get('/authors/:id', async (req, res, next) => {
	try {
		const book = await authorService.getAuthor(req.params.id)
		res.status(200).json(book)
	} catch (e) {
		next(e)
	}
})

// Get all book authors
router.get('/authors/:id/books', async (req, res, next) => {
	try {
		const books = await authorService.getAuthors(req.params.id)
		res.status(200).json(books)
	} catch (e) {
		next(e)
	}
})

// Update author
router.put('/authors/:id', ensureAuthenticated, async (req, res, next) => {
	const newData = req.body
	try {
		if (req.usuario.admin !== true) throw new Error('Unauthorized')
		await authorService.putAuthor(req.params.id, newData)
		res.status(200).end()
	} catch (e) {
		next(e)
	}
})

// Delete author
router.delete('/authors/:id', ensureAuthenticated, async (req, res, next) => {
	try {
		if (req.usuario.admin !== true) throw new Error('Unauthorized')
		await authorService.deleteAuthor(req.params.id)
		res.status(200).end()
	} catch (e) {
		next(e)
	}
})

module.exports = router

// const book = require('../models/bookModel')
const { Op } = require('sequelize')
const author = require('../models/authorModel')
const book = require('../models/bookModel')

exports.saveBook = function (newBook) {
	return book.create(newBook, { raw: true })
}

exports.getBook = function (id) {
	return book.findOne({ where: { id } })
}

exports.getBookByIsbn = function (isbn) {
	return book.findOne({ where: { isbn } })
}

exports.getBooks = async function (titleOrAuthor) {
	const authoridBooks = await author.findAll({
		attributes: ['id_book'],
		where: {
			name: titleOrAuthor,
		},
		raw: true,
	})

	if (authoridBooks.length >= 1) {
		const ids = []

		for (let i = 0; i < authoridBooks.length; i += 1) {
			ids.push(authoridBooks[i].id_book)
		}

		return book.findAll({
			where: {
				id: {
					[Op.in]: ids,
				},
			},
		})
	}

	return book.findAll({ where: { title: titleOrAuthor } })
}

exports.putBook = function (id, newData) {
	return book.update(newData, { where: { id } })
}

exports.deleteBook = function (id) {
	return book.destroy({ where: { id } })
}

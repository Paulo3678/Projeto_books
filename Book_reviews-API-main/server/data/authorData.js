const author = require('../models/authorModel')

exports.saveAuthor = function (name, idBook) {
	return author.create({ name, id_book: idBook }, { raw: true })
}

exports.getAuthors = function (idBook) {
	return author.findAll({ where: { id_book: idBook } }, { raw: true })
}

exports.getAuthor = function (id) {
	return author.findOne({ where: { id } })
}

exports.putAuthor = function (id, newData) {
	return author.update(newData, { where: { id } })
}

exports.deleteAuthor = function (id) {
	return author.destroy({ where: { id } })
}

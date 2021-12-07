const review = require('../models/reviewModel')

exports.saveReview = function (newReview) {
	return review.create(newReview, { raw: true })
}

exports.getReview = function (id) {
	return review.findOne({ where: { id } })
}

exports.getUserReviews = function (id) {
	return review.findAll({ where: { id_user: id } }, { raw: true })
}

exports.getBookReviews = function (id) {
	return review.findAll({ where: { id_book: id } }, { raw: true })
}

exports.deleteReview = function (id) {
	return review.destroy({ where: { id } })
}

exports.putReview = function (id, newData) {
	return review.update(newData, { where: { id } })
}

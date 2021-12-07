const { DataTypes } = require('sequelize')
const connection = require('../infra/database')
const book = require('./bookModel')
const user = require('./userModel')

const review = connection.define('reviews', {
	id: {
		type: DataTypes.INTEGER,
		primaryKey: true,
		autoIncrement: true,
	},
	date: {
		type: DataTypes.DATE,
		allowNull: false,
		defaultValue: DataTypes.NOW,
	},
	title: {
		type: DataTypes.TEXT,
		allowNull: false,
	},
	content: {
		type: DataTypes.TEXT,
		allowNull: false,
	},
	count_likes: {
		type: DataTypes.INTEGER,
		defaultValue: 0,
	},
	count_dislikes: {
		type: DataTypes.INTEGER,
		defaultValue: 0,
	},
	rating: {
		type: DataTypes.FLOAT,
		allowNull: false,
	},
	id_book: {
		type: DataTypes.INTEGER,
		allowNull: false,
	},
	id_user: {
		type: DataTypes.INTEGER,
		allowNull: false,
	},
}, {
	tableName: 'reviews',
	timestamps: false,

})
review.belongsTo(book, { foreignKey: 'id_book', targetKey: 'id' })
review.belongsTo(user, { foreignKey: 'id_user', targetKey: 'id' })

review.sync()

module.exports = review

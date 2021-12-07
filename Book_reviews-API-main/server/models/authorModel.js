const { DataTypes } = require('sequelize')
const connection = require('../infra/database')
const book = require('./bookModel')

const author = connection.define('authors', {
	id: {
		type: DataTypes.INTEGER,
		primaryKey: true,
		autoIncrement: true,
	},
	name: {
		type: DataTypes.TEXT,
		allowNull: false,
	},
	id_book: {
		type: DataTypes.INTEGER,
		allowNull: false,
	},
}, {
	tableName: 'authors',
	timestamps: false,
	indexes: [
		{
			name: 'unique_index',
			unique: true,
			fields: ['name', 'id_book'],
		},
	],
})
author.belongsTo(book, { foreignKey: 'id_book', targetKey: 'id' })

author.sync()

module.exports = author

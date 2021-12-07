const { Sequelize } = require('sequelize')
require('dotenv').config()

const sequelize = new Sequelize(
	'bd_books',
	'postgres',
	'Sandisk266',
	{
		host: 'localhost',
		dialect: 'postgres',
		logging: false,
	},
)

module.exports = sequelize

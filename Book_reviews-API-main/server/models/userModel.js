const { DataTypes } = require('sequelize')
const connection = require('../infra/database')

const user = connection.define('users', {
	id: {
		type: DataTypes.INTEGER,
		primaryKey: true,
		autoIncrement: true,
	},
	password: {
		type: DataTypes.TEXT,
		allowNull: false,
	},
	name: {
		type: DataTypes.TEXT,
		allowNull: false,
	},
	email: {
		type: DataTypes.STRING(100),
		allowNull: false,
		unique: true,
	},
	admin: {
		type: DataTypes.BOOLEAN,
		defaultValue: 'false',
	},

}, {
	tableName: 'users',
	timestamps: false,
	hooks: {
		afterCreate: (record) => {
			delete record.dataValues.password
			delete record.dataValues.admin
		},
	},
})

user.sync()

module.exports = user

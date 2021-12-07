const axios = require('axios')
const jwt = require('jsonwebtoken')
const userService = require('../service/userService')

const request = (url, method, data) => axios({
	url, method, data, validateStatus: false,
})

const requestAuthenticated = (url, method, data, token) => axios({
	url, method, data, validateStatus: false, headers: { Authorization: `Bearer ${token}` },
})

describe('Camada de testes CRUD', () => {
	test('should save a user', async () => {
		const data = {
			password: 'secret',
			name: 'Luiz',
			email: 'luizebmartins@gmail.com',
		}
		const response = await request('http://localhost:3000/users', 'post', data)
		const user = response.data
		expect(user.email).toBe(data.email)
		expect(response.status).toBe(201)
		await userService.deleteUser(user.id)
	})

	test('should not save a duplicate user', async () => {
		const data = {
			password: 'secret',
			name: 'Luiz',
			email: 'luizebmartins@gmail.com',
		}
		const response1 = await request('http://localhost:3000/users', 'post', data)
		const response2 = await request('http://localhost:3000/users', 'post', data)
		const user = response1.data

		expect(response2.status).toBe(409)
		await userService.deleteUser(user.id)
	})

	test('should get a user', async () => {
		const data = {
			password: 'secret',
			name: 'Luiz',
			email: 'luizebmartins@gmail.com',
		}
		const response1 = await request('http://localhost:3000/users', 'post', data)
		const newUser = response1.data

		const response2 = await request(`http://localhost:3000/users/${newUser.id}`, 'get')
		const user = response2.data
		expect(user.email).toBe(data.email)
		expect(response2.status).toBe(200)
		await userService.deleteUser(user.id)
	})

	test('should not get a user', async () => {
		const data = {
			id: 1000,
		}
		const response = await request(`http://localhost:3000/users/${data.id}`, 'get')

		expect(response.status).toBe(404)
	})

	test('should update a user', async () => {
		const data = {
			password: 'secret',
			name: 'Luiz',
			email: 'luizebmartins@gmail.com',
		}

		const response1 = await request('http://localhost:3000/users', 'post', data)
		const userID = response1.data.id

		data.name = 'luiz eduardo'
		data.email = 'emailteste@gmail.com'
		const response2 = await request(`http://localhost:3000/users/${userID}`, 'put', data)

		const response3 = await request(`http://localhost:3000/users/${userID}`, 'get')
		const updatedUser = response3.data

		expect(updatedUser.name).toBe(data.name)
		expect(updatedUser.email).toBe(data.email)
		expect(response2.status).toBe(200)

		await userService.deleteUser(userID)
	})

	test('should not update a user', async () => {
		const data = {
			name: 'teste',
		}

		const idUser = 10000
		const response = await request(`http://localhost:3000/users/${idUser}`, 'put', data)

		expect(response.status).toBe(404)
	})

	test('should not update a user with conflicting email', async () => {
		const data1 = {
			password: 'secret',
			name: 'Luiz',
			email: 'luizebmartins@gmail.com',
		}
		const data2 = {
			password: 'secret',
			name: 'carlos',
			email: 'teste@gmail.com',
		}

		const response1 = await request('http://localhost:3000/users', 'post', data1)
		const userID1 = response1.data.id

		const response2 = await request('http://localhost:3000/users', 'post', data2)
		const userID2 = response2.data.id

		data2.email = 'luizebmartins@gmail.com'
		const response3 = await request(`http://localhost:3000/users/${userID2}`, 'put', data2)
		expect(response3.status).toBe(409)

		await userService.deleteUser(userID1)
		await userService.deleteUser(userID2)
	})

	test('should delete a user', async () => {
		const data = {
			password: 'secret',
			name: 'Luiz',
			email: 'luizebmartins@gmail.com',
		}

		const response1 = await request('http://localhost:3000/users', 'post', data)
		const user = response1.data
		const response2 = await request(`http://localhost:3000/users/${user.id}`, 'delete')
		expect(response2.status).toBe(200)

		const response3 = await request(`http://localhost:3000/users/${user.id}`, 'get')
		expect(response3.status).toBe(404)
	})

	test('should not delete a user', async () => {
		const userID = 10000

		const response = await request(`http://localhost:3000/users/${userID}`, 'delete')
		expect(response.status).toBe(404)
	})

	// teste acima não são mais válidos, adicionado necessidade de autentificação
	test('should authenticate a user', async () => {
		const data = {
			password: 'secret',
			name: 'Luiz',
			email: 'luizebmartins@gmail.com',
		}
		const responseCreate = await request('http://localhost:3000/users', 'post', data)

		const responseLogin = await request('http://localhost:3000/users/login', 'post', { email: data.email, password: data.password })
		const token = responseLogin.data
		const decoded = jwt.verify(token, process.env.JWT_KEY)

		expect(decoded.id_user).toBe(responseCreate.data.id)
		expect(responseLogin.status).toBe(200)

		await userService.deleteUser(responseCreate.data.id)
	})

	test('should get a authenticated user', async () => {
		const data = {
			password: 'secret',
			name: 'Luiz',
			email: 'luizebmartins@gmail.com',
		}
		const responseCreate = await request('http://localhost:3000/users', 'post', data)
		const newUser = responseCreate.data
		const responseLogin = await request('http://localhost:3000/users/login', 'post', { email: data.email, password: data.password })
		const token = responseLogin.data

		const responseGet = await requestAuthenticated(`http://localhost:3000/users/${newUser.id}`, 'get', {}, token)

		const user = responseGet.data
		expect(user.email).toBe(newUser.email)

		await userService.deleteUser(user.id)
	})

	test('should not get a not authenticated user', async () => {
		const data = {
			password: 'secret',
			name: 'Luiz',
			email: 'luizebmartins@gmail.com',
		}
		const responseCreate = await request('http://localhost:3000/users', 'post', data)
		const newUser = responseCreate.data

		const responseGet = await request(`http://localhost:3000/users/${newUser.id}`, 'get')
		expect(responseGet.status).toBe(401)
		await userService.deleteUser(newUser.id)
	})
})

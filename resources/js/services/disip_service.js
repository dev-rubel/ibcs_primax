import { http } from './http_service'

export function createDisip(data) {
   return http().post('/disiplinaryes', data)
}

export function loadDisip() {
   return http().get('/disiplinaryes')
}

export function deleteDisip(id) {
   return http().get('disiplinaryes/delete/' + id)
}

export function upateDisip(id, data) {
   return http().post('disiplinaryes/' + id, data)
}
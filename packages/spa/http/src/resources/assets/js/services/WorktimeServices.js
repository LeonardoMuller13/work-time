const axios = require('axios')
const instance = axios.create({
    headers: {
        "Content-Type": "application/json",
    },
    timeout: 20 * 1000
});

const BASE_URL = "http://localhost:8000";

export function postHours(hourStart, hourEnd) {
    return new Promise((resolve, reject) => {
        instance.post(BASE_URL + "/api/worktime/hours", {
            'hourStart': hourStart,
            'hourEnd': hourEnd
        }).then((result) => {
           resolve(result.data)
        }).catch((err) => {
            reject(err.response.data)
        })
    })
}
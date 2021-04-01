import { baseUrl } from "./routes";

const getUrl = options => {
    let requestUrl = baseUrl + 'api/' + options.route;
    if (options.params) {
        Object.keys(options.params).map(i => {
            requestUrl += '&' + i + '=' + options.params[i]
        })
    }
    return requestUrl
}

export const get = async options => {
    const url = getUrl(options)

    const response = await fetch(url, {
        headers: {
            accept: 'application/json',
            Authorization: `Bearer ${document.getElementById('token').value}`,
        }
    });

    return response
}

export const post = async (options) => {
    const url = getUrl(options);
    const response = await fetch(url, {
        method: "POST",
        headers: {
            Authorization: `Bearer ${document.getElementById('token').value}`,
            "Content-Type": "application/json"
        },
        body: JSON.stringify(options.body),
    })
    return response
}
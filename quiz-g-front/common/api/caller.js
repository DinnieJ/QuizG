import axios from 'axios'

const baseURL = "http://127.0.0.1:8888/api"
const timeoutDefault = 60000

/**
 * 
 * @param {Object} config
 * @param {String} config.token
 * @param {Object} config.customHeader
 */
function ApiCaller(
  {token, customHeader} = {
    token: '',
    customHeader: false
  }
) {
  let headers =  {
    Accept: "application/json",
    "Content-Type": "application/json",
    "Authorization": `Bearer ${token}`
  }

  if(customHeader) {
    headers = customHeader
  }

  const caller = axios.create({
    baseURL,
    headers,
    timeout: timeoutDefault
  });
  return caller;
}

export default ApiCaller
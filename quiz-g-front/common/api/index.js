import axios from '@nuxtjs/axios'

export default customHeader => {
  const caller = axios.create({
    baseURL: config.backendEndpoint,
    headers: customHeader || {
      Accept: "application/json",
      "Content-Type": "application/json",
    //   "X-AUTH-TOKEN": localStorage.getItem("AUTH_TOKEN")
    },
    timeout: config.timeoutDefault
  });
  return caller;
};

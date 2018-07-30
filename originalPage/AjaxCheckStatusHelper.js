// This is a helper file for using fetch() for Ajax
// Either copy the function below into your JavaScript file
// or add this line to your html head:
// <script  src="https://courses.cs.washington.edu/courses/cse154/18sp/18sp-data/lecture/AjaxCheckStatusHelper.js"></script>

// Based on code by Matt Gaunt
// https://developers.google.com/web/updates/2015/03/introduction-to-fetch

  /**
    * Function to check the status of an Ajax call, boiler plate code to include,
    * based on: https://developers.google.com/web/updates/2015/03/introduction-to-fetch
    * @param the response text from the url call
    * @return did we succeed or not, so we know whether or not to continue with the handling of
    * this promise
    */
    global fetch;
   function checkStatus(response) {
     const OK = 200;
     const ERROR = 300;
     if (response.status >= OK && response.status < ERROR) {
       return response.text();
     } else {
       return Promise.reject(new Error(response.status +
                                        ": " + response.statusText));
     }
   }



  function callAjax() {
    let url = ..... // put url string here
    //       fetch(url)                             // general fetch
    //       fetch(url, {credentials: 'include'})   // c9 -> c9
    fetch(url, {mode: 'cors'})              // anywhere -> webster
      .then(checkStatus)
      .then(handleResponse)
      .catch(console.log);
  }

  function handleResponse(responseText) {
    //success: do something with the responseText
  }

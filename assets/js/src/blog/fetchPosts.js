/**
 * fetchPosts()
 *
 * Hooks into the wp api and gets the posts.
 * Posts are offsetted so we only load the number per page
 *
 * @param {string} url - The rest api query endpoint
 * @param {object} headers - pass the headers we want
 *
 * @returns {object} - Returns an object containing the posts array and the total number of posts
 */
const fetchPosts = async ({ url, headers }) => {
  const response = await fetch(url, { headers });
  let totalPosts;

  if (!response.ok) {
    throw new Error(`HTTP error! status: ${response.status}`);
  }

  // Get the headers object so we can return the total posts
  for (let pair of response.headers.entries()) {
    // accessing the entries
    if (pair[0] === 'x-wp-total') {
      totalPosts = pair[1];
    }
  }

  const posts = await response.json();

  return {
    posts,
    totalPosts,
  };
};

export default fetchPosts;

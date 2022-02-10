/* global UNDERSCORES_BLOG_SCRIPT_PARAMS */
import fetchPosts from './blog/fetchPosts';
import card from './blog/card';

const resturl = UNDERSCORES_BLOG_SCRIPT_PARAMS.resturl;
let restbase = UNDERSCORES_BLOG_SCRIPT_PARAMS.rest_base;
let totalPosts = Number(UNDERSCORES_BLOG_SCRIPT_PARAMS.total_posts);
let postsPerPage = Number(UNDERSCORES_BLOG_SCRIPT_PARAMS.per_page);
let offset = postsPerPage;

const postCounter = document.querySelector('[data-element="post-count"]');
const postTotal = document.querySelector('[data-element="post-total"]');
const spinner = document.querySelector('[data-element="spinner"]');

const loadMoreConainer = document.querySelector(
  '[data-element="load-more-container"',
);
const loadMoreButton = document.querySelector(
  '[data-element="load-more-button"]',
);

/**
 * setCounterValue()
 *
 * Sets the values in the counter at the bottom of the page
 */
const setCounterValue = () => {
  postCounter.innerText =
    offset + postsPerPage <= totalPosts ? offset + postsPerPage : totalPosts;

  postTotal.innerText = totalPosts;
};

/**
 * handleLoadMore()
 *
 * Eventlistener handler to handle the loadMorePosts() function.
 */
const handleLoadMore = () => {
  // Build the query URL
  let url = `${resturl}wp/v2/${restbase}?per_page=${postsPerPage}`;

  if (offset) url = url + `&offset=${offset}`;

  if (offset < totalPosts) {
    if (spinner) spinner.style.display = 'grid';

    // Fetch our posts
    fetchPosts({
      url: `${url}&_embed`,
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': UNDERSCORES_BLOG_SCRIPT_PARAMS.restNonce,
      },
    })
      .then((data) => {
        // Need to use join to remove the unexpected comma,
        // template literals use the toString() method which by default joins the returned array by map with a ,.
        const posts = data.posts.map((post) => card(post)).join('');

        loadMoreConainer.insertAdjacentHTML('beforeend', posts);

        // Set the counter value
        setCounterValue();

        // Increase the pagination after data has been returned
        offset = offset + postsPerPage;

        // Remove load more button if there are no more posts
        if (offset >= totalPosts) {
          loadMoreButton.remove();
        }
      })
      .finally(() => {
        if (spinner) spinner.style.display = 'none';
      })
      .catch((err) => console.error(err));
  }
};

loadMoreButton.addEventListener('click', handleLoadMore);

const card = (data) => {
  const { id, title, excerpt, link, featured_media } = data;

  console.log(data);

  // Generate the thumbnail
  const thumbnail = () => {
    if (featured_media !== 0) {
      const featured_image = data._embedded['wp:featuredmedia'][0];
      const { alt_text } = featured_image;
      const { height, width, source_url } =
        featured_image.media_details.sizes['card-thumb'];

      // TODO: Sort out responsive images
      return `<img width="${width}" height="${height}" src="${source_url}" class="card__image wp-post-image" alt="${alt_text}" loading="lazy" />`;
    }
  };

  return `<div id="post-${id}" class="card box stack">
    <div class="card__header">
      ${thumbnail()}
    </div>
    <div class="card__body stack">
      <h2>${title.rendered}</h2>

      ${excerpt.rendered}

      <a class="button" href="${link}">Read more</a>
    </div>
  </div>`;
};

export default card;

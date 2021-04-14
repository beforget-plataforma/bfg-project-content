export const getServicesTerms = async(data) => {
  try {
    const resp = await fetch(bfg_pageviews_ajax.ajax_url, {
      method: 'POST',
      credentials: 'same-origin',
      body: data,
    })
    const terms = await resp.json()
    return terms
  } catch (error) {
    return error
  }
}
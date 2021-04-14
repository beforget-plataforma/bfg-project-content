const template = ({ nombre, slug, excerpt, logo, imagen, member, link, content, ods, get_template_directory_uri, get_stylesheet_directory_uri}) => {
  const host = get_stylesheet_directory_uri;
  const displayMemeber = () => {
    return member.map(el => {
      return `${el}`
    })
  }
  const displayOds = () => {
    return ods.map(el => {
      return `<li class="${el.slug}">
        <img src="${host}/assets/images/${el.slug}.png" alt="">
      </li>`
    })
  }
  const memeberState = displayMemeber();
  const odsState = displayOds();
  console.log(excerpt);
  return `<div class="bfg-item-proyectos">
            <a class="no-color" href="${link}">
              <div class="bfg-header-cover-sesiones bfg-has-avatar item-profile flex" style="background-image:url(${imagen})">
              </div>
              <div class="bfg-avatar-proyecto " style="background-image: url(${logo})">
              </div>
              <hgroup class="bfg-content-inprofile resumen-proyecto">
                <div class=" ">
                  <h2 class="title-bit">${nombre}</h2>
                </div>
                <div class="group-description">
                  <p>${excerpt || content}</p>
                </div>
              </hgroup>
              <div class="bfg-miembros-proyecto flex bfg-flex-grap">
                ${memeberState.join('')}
              </div>
              <div class="bfg-ods-proyecto">
                <ul class="bfg-list flex">
                  ${odsState.join('')}
                </ul>
              </div>
            </a>
          </div>`
};

export default template;
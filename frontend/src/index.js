import template from './template';

const bfgFilterContent = {
  ods: [],
  init: function () {
    const bfgNavFilter = document.querySelectorAll('.bfg-filter-button-ods');
    bfgNavFilter.forEach((el) => {
      const input = el.querySelector('input');
      input.onclick = (e) => {
        let temp = [];
        if (e.target.checked) {
            this.ods.push(e.target.value);
        } else {
          temp = this.ods.filter((val) => {
          if (val !== e.target.value) {
              return val;
          }
          });
          this.ods = temp;
        }
        this.getPosts();
      };
    });
  },
  render: (data) => {
    let temp = [];
    const wrapperContent = document.querySelector(
      '.wrapper-post-proyectos-page'
    );
    data.forEach((el) => {
      const post = template(el);
      temp.push(post);
    });
    wrapperContent.innerHTML = temp.join('');
    // console.log(template(data));
  },
  getPosts: () => {

    const filterProyectosTipo = document.querySelector('#bfg-filter-tipo-proyectos');
    const data = new FormData();

    data.append('action', 'searchPostProyectos');
    data.append('nonce', bfg_pageviews_ajax.nonce);
    data.append('searchOds', bfgFilterContent.ods);
    
    filterProyectosTipo.classList.add('loading');

    fetch(bfg_pageviews_ajax.ajax_url, {
      method: 'POST',
      credentials: 'same-origin',
      body: data,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data) {
          bfgFilterContent.render(data);
        }
        filterProyectosTipo.classList.remove('loading');
      })
      .catch((error) => {
        console.log('[WP Pageviews Plugin]');
        console.error(error);
      });
  },
};

document.addEventListener('DOMContentLoaded', function () {
  bfgFilterContent.init();
});

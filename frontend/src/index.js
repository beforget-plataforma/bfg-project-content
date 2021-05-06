import { getServicesTerms } from './services';
import template from './template';

const bfgFilterContent = {
  verMas: document.querySelector('.ver-mas-sesiones'),
  bfgNavFilter: document.querySelectorAll('.bfg-filter-button'),
  queryMaxWidth800: window.matchMedia("(max-width: 800px)"),
  postsTipo: [],
  postsCategory: [],
  empty: false,
  gotoSesion: 0,
  dataChunk: [],
  dataLength: 0,
  initialTaxSesiones: [],
  initApp: false,
  init: function() {
    bfgFilterContent.bfgNavFilter.forEach((el) => {
      const input = el.querySelector('input');
      const type = input.parentElement.getAttribute('data-type')
      input.onclick = (e) => {
        let temp = [];
        if (e.target.checked) {
            if(type === 'ods') {
                this.postsTipo.push(e.target.value);
            }else{
                this.postsCategory.push(e.target.value);
            }
        } else {
            if(type === 'tipo-sesion') {
                temp = this.postsTipo.filter((val) => {
                if (val !== e.target.value) {
                    return val;
                }
                });
                this.postsTipo = temp;
            }else{
                temp = this.postsCategory.filter((val) => {
                    if (val !== e.target.value) {
                        return val;
                    }
                });
                this.postsCategory = temp;
            } 
        }
        this.getPosts(type);
        bfgFilterContent.initApp = true;
      };
    });
    bfgFilterContent.verMas.addEventListener('click', () => {
      if((bfgFilterContent.gotoSesion +1) === bfgFilterContent.dataLength){
        bfgFilterContent.verMas.disabled = true
        bfgFilterContent.verMas.classList.remove('active')
      }
      bfgFilterContent.render(bfgFilterContent.dataChunk[bfgFilterContent.gotoSesion], 'append');
      bfgFilterContent.gotoSesion ++;
    })
  },
  render: (data, type) => {
    let temp = [];
    const wrapperContent = document.querySelector('.wrapper-post-proyectos-page');
    data.forEach((el) => {
      const post = template(el);
      temp.push(post);
    });
    if(type === 'inner'){
      wrapperContent.innerHTML = temp.join('');
    }else{
      wrapperContent.insertAdjacentHTML('beforeend', temp.join(''));
    }

  },
  stateFilter: (state, opacity, cursor) => {
    bfgFilterContent.bfgNavFilter.forEach(el => {
      const _check = el.querySelector('input');
      _check.parentElement.style.opacity = opacity;
      _check.parentElement.style.cursor = cursor
      _check.disabled = state;
    })
  },
  getPosts: (type) => {
    // let transformObjToArray = [];
    let transformObjToArrayCatSesiones = [];
    const filterSesionesTipo = document.querySelector('.bfg-nav-filter');
    let resultadosSesionesTipo = document.querySelector('.bfg-count-resultados');
    const data = new FormData();

    // if(!Array.isArray(bfg_pageviews_ajax.taxSesionesType)) {
    //   for (const property in bfg_pageviews_ajax.taxSesionesType) {
    //     transformObjToArray.push(bfg_pageviews_ajax.taxSesionesType[property]);
    //   }
    // }else{
    //   transformObjToArray = bfg_pageviews_ajax.taxSesionesType;
    // }
    
    if(!Array.isArray(bfg_pageviews_ajax.taxOdsCategory)) {
      for (const property in bfg_pageviews_ajax.taxOdsCategory) {
        transformObjToArrayCatSesiones.push(bfg_pageviews_ajax.taxOdsCategory[property]);
      }
    }else{
      transformObjToArrayCatSesiones = bfg_pageviews_ajax.taxOdsCategory;
    }


    if(bfgFilterContent.postsCategory.length === 0 && bfgFilterContent.postsTipo.length === 0 ){
      // if(bfg_pageviews_ajax.taxOdsCategory) {
      //   bfgFilterContent.postsTipo = transformObjToArray.map(el => {
      //     return el.slug
      //   })
      // }
      bfgFilterContent.postsCategory = transformObjToArrayCatSesiones.map(el => {
        return el.slug
      });
      bfgFilterContent.empty = true;
    }

    data.append('action', 'searchPostProyectos');
    data.append('nonce', bfg_pageviews_ajax.nonce);
    data.append('is_user_logged_in', bfg_pageviews_ajax.is_user_logged_in);
    data.append('searchTipo', bfgFilterContent.postsTipo);
    // data.append('searchCategory', bfgFilterContent.postsCategory);
    data.append('searchOds', bfgFilterContent.postsCategory);
    data.append('type', type);


    filterSesionesTipo.classList.add('loading');
    resultadosSesionesTipo.innerHTML = '';
    bfgFilterContent.stateFilter(true, .8, 'default');
    getServicesTerms(data).then(sesiones => {
      if(sesiones === null) {
        filterSesionesTipo.classList.remove('loading');
        resultadosSesionesTipo.innerHTML = `<span>Aún no tenemos proyectos con este ODS.</span>`;
        bfgFilterContent.stateFilter(false, 1, 'pointer');
        return;
      }
      const chunk = (arr, size) => arr.reduce((acc, e, i) => (i % size ? acc[acc.length - 1].push(e) : acc.push([e]), acc), []);

      bfgFilterContent.dataChunk = chunk(sesiones, 20)
      bfgFilterContent.gotoSesion = 0;
      bfgFilterContent.dataLength = bfgFilterContent.dataChunk.length;

      if(bfgFilterContent.dataChunk.length >= 2 ){
        bfgFilterContent.verMas.classList.add('active')
        bfgFilterContent.verMas.disabled = false
      }else{
        bfgFilterContent.verMas.classList.remove('active')
        bfgFilterContent.verMas.disabled = true
      }
      if (sesiones) {
        bfgFilterContent.render(bfgFilterContent.dataChunk[0], 'inner');
        bfgFilterContent.gotoSesion = 1;

        if(bfgFilterContent.empty) {
          bfgFilterContent.postsTipo = [];
          bfgFilterContent.postsCategory = [];
          bfgFilterContent.empty = false;
        }
      }
      filterSesionesTipo.classList.remove('loading');

      const displayCatAndType = [...bfgFilterContent.postsCategory];

      const initialTaxSesiones = (tax) => {
        return tax.map( taxo => {
          return {
            name: taxo.name,
            slug: taxo.slug
          }
        })
      };
      

      // const tipoSesiones = initialTaxSesiones(transformObjToArray);
      const catSesiones = initialTaxSesiones(transformObjToArrayCatSesiones);
      
      // const getNameTypeSesiones = displayCatAndType.map(tax => {
      //   const valueName = tipoSesiones.find(taxonomy => {
      //     if(taxonomy.slug === tax) {
      //       return taxonomy
      //     }
      //   });
      //   return  valueName
      // })
      const getNameCatSesiones = displayCatAndType.map(tax => {
        const valueName = catSesiones.find(taxonomy => {
          if(taxonomy.slug === tax) {
            return taxonomy
          }
        });
        return  valueName
      })
      const getNamesTaxonomies = (typeTax) => {
        const filtered = typeTax.filter(function (el) {
          return el != undefined;
        });
        return filtered
      }
      const renderDisplayCatAndType = () => {
        const sesiones = [...getNamesTaxonomies(getNameCatSesiones)];
        const sesionesTem = sesiones.map(s => s.name);
        return sesionesTem.map(tax => `<span><b> ${tax} </b></span>`)
      }
      const temp = renderDisplayCatAndType(displayCatAndType);
      if(bfgFilterContent.initApp && (displayCatAndType.length > 0)) {
        resultadosSesionesTipo.innerHTML = `<span>Hemos encontrado <b>${sesiones.length}</b> proyectos para ${temp.join(',')}.</span>`;
      } else {
        resultadosSesionesTipo.innerHTML = `<span>Tenemos un total de <b>${sesiones.length}</b> proyectos.</span>`;
      };
      bfgFilterContent.stateFilter(false, 1, 'pointer');
    })
  },
};

document.addEventListener('DOMContentLoaded', function () {
  bfgFilterContent.init();
  bfgFilterContent.getPosts('ods');
});

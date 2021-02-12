<?
if ( ! defined( 'ABSPATH' ) ) exit;

function project_agregar_metaboxes(){
  // Agrega el Metabox en el Post Type de Quizes
  // 7 parametros:
  // id para identificar el metabox
  // Titulo del Metabox
  // Callback con el Cntenido
  // Pantalla donde se mostrará o Post Type
  // contexto es donde se mostrará (normal, aside, advanced)
  // Prioridad en la que se mostrarán
  // Argumentos con callback
  add_meta_box( 'project_meta_box', 'Buscar colaboradores', 'project_metaboxes', 'proyectos', 'normal', 'high', null );
}
add_action( 'add_meta_boxes', 'project_agregar_metaboxes' );


function project_metaboxes($post) {
  ?>
    <table class="form-table">
       <tr>
           <td>
               <input id="bfg-search-user" name="bfg_search_user" class="regular-text" type="text" >
           </td>
       </tr>
    </table>
    <div class="container">
      <div class="row">
        <ul>
          <li>
          <Label>Colaborador 1: </Label>
          <?php echo esc_attr( get_post_meta($post->ID,'bfg_search_user', true ) ); ?></li>
        </ul>
      </div>
    </div>
  <?
}

function save_event_meta( $post_id, $post, $update ) {
  $user = "";
     
 // If this isn't a 'event' post, don't update it.
 if (isset( $_POST["bfg_search_user"] ) ) {
    $user = sanitize_text_field($_POST["bfg_search_user"]);
    
  }
  update_post_meta( $post_id, 'bfg_search_user', $user );
}
add_action( 'save_post', 'save_event_meta', 10, 3 );


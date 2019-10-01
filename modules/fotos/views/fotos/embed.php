<?php
use Mix\Application;
$ui = Application::getDefault()->getUiManager();
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="pt_BR" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
        <title><?=$ui->getPageTitle()?> | <?=$ui->getProjectName()?></title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
        <meta name="robots" content="noindex, nofollow" />
		<!-- end: META -->

        <!-- start: MAIN CSS -->
        <?= \View::factory('admin/stylesheet') ?>
        <!-- end: MAIN CSS -->

        <style type="text/css">
            .photo-container.selected, .photo-container.selected input {
                transition: background-color 0.3s ease;
                background-color: #CCE2F9;
            }
            .photo-container, .photo-container input {
                transition: background-color 0.3s ease;
                background-color: #FFFFFF;
            }
            .photo-container input {
                width:100%;
                text-align:center;
                margin:10px 0;
                border:solid 1px transparent;
                font-weight: bold;
                color:#007AFF;
            }
            .photo-container input.photo-toggle {
                margin:0;
                width:12px;
                height:12px;

            }
            .photo-container input.photo-description {
                font-weight: normal;
                margin:0 0 10px 0;
            }
            .photo-container input:focus {
                box-shadow: none;
            }

            .photo-container input::-webkit-input-placeholder {
                font-weight: normal;
                color:#858585;
                font-style: italic;
            }

            .photo-container input::-moz-placeholder {
                font-weight: normal;
                color:#858585;
                font-style: italic;
            }
            .photo-container input:-ms-input-placeholder {
                font-weight: normal;
                color:#858585;
                font-style: italic;
            }
            .photo-container input:-moz-placeholder {
                font-weight: normal;
                color:#858585;
                font-style: italic;
            }
            .photo-container input::placeholder {
                font-weight: normal;
                color:#858585;
                font-style: italic;
            }
        </style>
	</head>
	<body>

		<!-- end: HEADER -->
		<!-- start: MAIN CONTAINER -->
        <div class="container gallery">
            <?php if (!empty($info)):?>
            <div class="alert alert-info alert-block">
                <h4 class="alert-heading">Atenção</h4>
                <?=$info?>
            </div>
            <?php endif?>


            <?=$this->renderFlashes()?>
            <div class="row">
                <?=$form->addClass('form-validation')->setAttr('class', 'form-upload-photos')->open()?>
                    <div class="fileupload-buttonbar">
                        <div class="col-lg-7">
                            <!-- The fileinput-button span is used to style the file input field as button -->
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Adicionar imagens...</span>
                                <input mandatory type="file" name="foto" multiple />

                            </span>
                            <!-- The global file processing state -->
                            <span class="fileupload-process"></span>
                            <?= $form->modelInfo('foto')?>
                        </div>
                        <!-- The global progress state -->
                        <div class="col-lg-5 fileupload-progress fade">
                            <!-- The global progress bar -->
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                            </div>
                            <!-- The extended global progress state -->
                            <div class="progress-extended">&nbsp;</div>
                        </div>
                    </div>
                <table role="presentation" class="table table-striped" id="files-stack"><tbody class="files"></tbody></table>
                <?=$form->close()?>
                <?php if (empty($photos) && empty($pending)):?>
                    <div class="alert alert-warning">
                        Nenhuma foto.
                    </div>
                <?php else:?>
                    <?php if (!empty($pending)):?>
                        <h5>Fotos pendentes</h5>
                        <div class="alert alert-info">
                            Estas fotos serão adicionadas à esse registro quando ele for salvo.
                        </div>
                        <p class="col-md-12">
                            Selecionar: <a href="javascript:void(0);" id="photo-action-select-all">Todas</a> |
                            <a href="javascript:void(0);" id="photo-action-select-none">Nenhuma</a> |
                            <a href="javascript:void(0);" id="photo-action-select-toggle">Inverter seleção</a>
                        </p>
                        <form method="post" action="<?=\URL::site(\Route::get('photo.bulk_actions')->uri(array('type' => $type, 'type_id' => $type_id)))?>">
                            <p class="col-md-12">
                                Com fotos selecionadas:
                                <select name="bulk_action">
                                    <option value=""></option>
                                    <option value="delete">Excluir</option>
                                    <option value="make_visible">Deixar visível no site</option>
                                    <option value="make_invisible">Ocultar do site</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-default">OK</button>
                            </p>
                                <div class="gallery-photos">
                                    <?php
                                    $params = array(
                                        'type' => $type
                                    );
                                    if (!empty($type_id)) {
                                        $params['type_id'] = $type_id;
                                    }
                                    foreach ($pending as $idx => $p):
                                        $params['id'] = $p['id'];
                                        $isCover      = $p['capa'];
                                    ?>
                                        <div class="col-md-3 col-sm-4" >
                                            <div class="panel panel-default photo-container" data-photo-id="<?=$p['id']?>">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-2" style="text-align: center">
                                                            <label>
                                                                <input type="checkbox" class="photo-toggle checkbox-inline" value="<?=$p['id']?>" name="photos[]" /> <br />
                                                                <span class="photo-order"><?=$idx+1?></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <a class="group1" href="<?=URL::site('uploads/fotos/' . $p['foto'])?>" target="_blank">
                                                                <img style="margin:0 auto" src="<?=URL::site('uploads/fotos/small_' . $p['foto'])?>" alt="" class="img-responsive">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a title="Excluir" class="confirm" href="<?=\URL::site(\Route::get('embed_photos_delete')->uri($params))?>">
                                                                <i class="clip-close"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <?php if ($hasTitle):?>
                                                        <div class="col-md-12">
                                                            <input value="<?=$p['titulo']?>" maxlength="255" class="ajax-update" data-id="<?=$p['id']?>" data-field="titulo" type="text" placeholder="Sem Título" />
                                                        </div>
                                                        <?php endif?>
                                                        <?php if ($hasDescription):?>
                                                        <div class="col-md-12">
                                                            <input value="<?=$p['descricao']?>" type="text" data-id="<?=$p['id']?>" data-field="descricao" class="photo-description ajax-update" placeholder="Sem Descrição" />
                                                        </div>
                                                        <?php endif?>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6" style="text-align: center">
                                                            <label>
                                                                <input  data-id="<?=$p['id']?>" data-field="capa" class="cover photo-checkbox ajax-update" <?=$isCover ? 'checked' : ''?> type="checkbox" /><br />
                                                                Foto de Capa?
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6" style="text-align: center">
                                                            <label>
                                                                <input data-id="<?=$p['id']?>" data-field="visivel_site" class="photo-visible photo-checkbox ajax-update" <?=$p['visivel_site'] ? 'checked' : ''?> type="checkbox" /> <br />
                                                                Aparecer no site?
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach?>
                                </div>
                        </form>
                    <?php endif?>
                    <?php if (!empty($pending) && !empty($photos)):?>
                        <hr />
                    <?php endif?>
                        <div class="clearfix"></div>
                    <?php if (!empty($photos)):?>
                        <?php if (!empty($pending)):?>
                        <h5>Fotos</h5>
                        <?php endif?>
                        <p class="col-md-12">
                            Selecionar: <a href="javascript:void(0);" id="photo-action-select-all">Todas</a> |
                            <a href="javascript:void(0);" id="photo-action-select-none">Nenhuma</a> |
                            <a href="javascript:void(0);" id="photo-action-select-toggle">Inverter seleção</a>
                        </p>
                        <form method="post" action="<?=\URL::site(\Route::get('photo.bulk_actions')->uri(array('type' => $type, 'type_id' => $type_id)))?>">
                            <p class="col-md-12">
                                Com fotos selecionadas:
                                <select name="bulk_action">
                                    <option value=""></option>
                                    <option value="delete">Excluir</option>
                                    <option value="make_visible">Deixar visível no site</option>
                                    <option value="make_invisible">Ocultar do site</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-default">OK</button>
                            </p>

                            <div class="gallery-photos">
                            <?php
                            $params = array(
                                'type' => $type
                            );


                            foreach ($photos as $idx => $p):
                                $params['id']      = $p['id'];
                                $params['type_id'] = $p['objeto_id'];
                                $isCover           = $p['capa'];
                            ?>
                                <div class="col-md-3 col-sm-4" >
                                    <div class="panel panel-default photo-container" data-photo-id="<?=$p['id']?>">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-2" style="text-align: center">
                                                    <label>
                                                        <input type="checkbox" class="photo-toggle" value="<?=$p['id']?>" name="photos[]" /> <br />
                                                        <span class="photo-order"><?=$idx+1?></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <a class="group1" href="<?=URL::site('uploads/fotos/' . $p['foto'])?>" target="_blank">
                                                        <img style="margin:0 auto" src="<?=URL::site('uploads/fotos/small_' . $p['foto'])?>" alt="" class="img-responsive">
                                                    </a>
                                                </div>
                                                <div class="col-md-2">
                                                    <a title="Excluir" class="confirm" href="<?=\URL::site(\Route::get('embed_photos_delete')->uri($params))?>">
                                                        <i class="clip-close"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <?php if ($hasTitle):?>
                                                    <div class="col-md-12">
                                                        <input value="<?=$p['titulo']?>" maxlength="255" class="ajax-update" data-id="<?=$p['id']?>" data-field="titulo" type="text" placeholder="Sem Título" />
                                                    </div>
                                                <?php endif?>
                                                <?php if ($hasDescription):?>
                                                    <div class="col-md-12">
                                                        <input value="<?=$p['descricao']?>" type="text" data-id="<?=$p['id']?>" data-field="descricao" class="photo-description ajax-update" placeholder="Sem Descrição" />
                                                    </div>
                                                <?php endif?>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6" style="text-align: center">
                                                    <label>
                                                        <input  data-id="<?=$p['id']?>" data-field="capa" class="cover photo-checkbox ajax-update" <?=$isCover ? 'checked' : ''?> type="checkbox" /><br />
                                                        Foto de Capa?
                                                    </label>
                                                </div>
                                                <div class="col-md-6" style="text-align: center">
                                                    <label>
                                                        <input data-id="<?=$p['id']?>" data-field="visivel_site" class="photo-visible photo-checkbox ajax-update" <?=$p['visivel_site'] ? 'checked' : ''?> type="checkbox" /> <br />
                                                        Aparecer no site?
                                                    </label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach?>
                        <?php endif?>
                        </div>
                        </form>
                <?php endif?>
                <hr />

            </div>

		</div>

		<?= \View::factory('admin/scripts') ?>

        <script id="template-upload" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-upload working">
                <td class="text-center">
                    <p class="name">{%=file.name%}</p>
                    <strong class="error text-danger">{%=file.error%}</strong>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                </td>
            </tr>
        {% } %}
        </script>
		<!-- end: MAIN JAVASCRIPTS -->
		<script>
            (function($) {
                $(document).ready(function() {
                    Main.init();
                    var uploadButton = $('<button/>')
                    .addClass('btn btn-primary')
                    .prop('disabled', true)
                    .text('Processing...')
                    .on('click', function () {
                        var $this = $(this),
                            data = $this.data();
                        $this
                            .off('click')
                            .text('Abort')
                            .on('click', function () {
                                $this.remove();
                                data.abort();
                            });
                        data.submit().always(function () {
                            $this.remove();
                        });
                    });

                    $('.form-upload-photos').fileupload({
                        url: '<?=$form->getAttr('action')?>',
                        dataType: 'json',
                        autoUpload: false,
                        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                        maxFileSize: 999000,
                        // Enable image resizing, except for Android and Opera,
                        // which actually support image resizing, but fail to
                        // send Blob objects via XHR requests:
                        disableImageResize: /Android(?!.*Chrome)|Opera/
                            .test(window.navigator.userAgent),
                        previewMaxWidth: 100,
                        previewMaxHeight: 100,
                        previewCrop: true,
                        add: function (e, data) {
                            console.log(data);
                            var row = $(tmpl('template-upload', data));
                            data.context = row;
                            $('#files-stack tbody').append(row);
                            var jqXHR = data.submit();
                        },
                        progress: function (e, data) {
                            var progress = parseInt(data.loaded / data.total * 100, 10);
                            data.context.find('.progress-bar-success').css('width', progress + '%');
                            if(progress == 100){
                                data.context.removeClass('working');
                            }
                        },
                        progressall: function (e, data) {

                        }
                    }).on('fileuploadprogressall', function (e, data) {
                        if (data.loaded == data.total) {
                            window.setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        }
                    }).on('fileuploaddone', function (e, data) {
                    }).on('fileuploadprocessalways', function (e, data) {
                    });




                    $('.confirm').each(function(e){
                        var item = this;

                        $(item).click(function(e) {
                            sweetAlert({
                                title: "Tem certeza?",
                                text: "Você não poderá recuperar esta foto!",
                                type: "warning",   showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Sim, exclua-a!",
                                cancelButtonText: "Cancelar",
                                closeOnConfirm: false
                            }, function() {
                                window.location.href = $(item).attr('href');
                            });
                            return false;
                        });

                    });

                    $('.modal-confirm').each(function(){
                        var item = this;
                        $(item).click(function() {
                            return confirm($(item).data('confirm'));
                        });
                    });

                    $('.form-validation').formValidation({
                        framework: 'bootstrap',
                        locale: 'pt_BR',
                        live: 'blur'
                    });
                });
                $('input.photo-toggle').bind('click', function() {
                    if ($(this).is(':checked')) {
                        $(this).parentsUntil('.photo-container').parent().addClass('selected');
                    } else {
                        $(this).parentsUntil('.photo-container').parent().removeClass('selected');
                    }
                });
                $('#photo-action-select-all').bind('click', function() {
                    $('input.photo-toggle').each(function() {
                        if (!$(this).is(':checked')) {
                            $(this).trigger('click');
                        }
                    });
                });

                $('#photo-action-select-none').bind('click', function() {
                    $('input.photo-toggle').each(function() {
                        if ($(this).is(':checked')) {
                            $(this).trigger('click');
                        }
                    });
                });

                $('#photo-action-select-toggle').bind('click', function() {
                    $('input.photo-toggle').each(function() {
                        $(this).trigger('click');
                    });
                });
                <?php if (!empty($params)):?>
                $('.ajax-update').each(function() {
                    var $elm       = $(this);
                    var isCheckbox = $elm.hasClass('photo-checkbox');
                    var id         = $elm.data('id');
                    var field      = $elm.data('field');
                    if (isCheckbox) {
                        var isCover = $elm.hasClass('cover');

                        if (!isCover) {
                            $elm.bind('click', function(e) {
                                var isCover   = $elm.parentsUntil('.photo-container').parent().find('.cover').is(':checked');
                                if (isCover) {
                                    e.preventDefault();
                                    return;
                                }
                                var isChecked = $elm.is(':checked') ? 1 : 0;
                                $.ajax({
                                    type: 'post',
                                    data: {
                                        field: field,
                                        photoId: id,
                                        value: isChecked
                                    },
                                    url: '<?=\URL::site(\Route::get('photo.update_info')->uri($params))?>'
                                });
                            });
                        } else {
                            $elm.bind('click', function(e) {
                                var isChecked = $elm.is(':checked') ? 1 : 0;
                                if (isChecked) {
                                    $('.gallery-photos').find('.cover').not($elm[0]).attr('checked', false);
                                    $elm.parentsUntil('.photo-container').parent().find('input.photo-visible').prop('checked', true);
                                } else {
                                    e.preventDefault();
                                    return;
                                }
                                $.ajax({
                                    type: 'post',
                                    data: {
                                        field: field,
                                        photoId: id,
                                        value: isChecked
                                    },
                                    url: '<?=\URL::site(\Route::get('photo.update_info')->uri($params))?>'
                                });
                            });
                        }
                    } else {
                        $elm.bind('blur', function() {
                            var value = $elm.val();
                            $.ajax({
                                type: 'post',
                                data: {
                                    field: field,
                                    photoId: id,
                                    value: value
                                },
                                url: '<?=\URL::site(\Route::get('photo.update_info')->uri($params))?>'
                            });
                        });
                    }
                });


                $('.gallery-photos').sortable({
                    update: function (e, ui) {
                        var data = {
                            'photos' : []
                        };
                        var i    = 0;
                        $('.gallery-photos .photo-container').each(function() {
                            data['photos'].push({
                                id: $(this).data('photo-id'),
                                pos: i++
                            });
                            $('.photo-order', $(this)).text(i);
                        });
                        $.ajax({
                            type: 'post',
                            data: data,
                            url: '<?=\URL::site(\Route::get('update_photos_positions')->uri($params))?>'
                        });
                    }
                });
                //$('.gallery-photos').disableSelection();
                <?php endif?>
            })(jQuery);

		</script>
	</body>
	<!-- end: BODY -->
</html>

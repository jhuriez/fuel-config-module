<section class="panel panel-default">
    <div class="panel-heading">
        Config
    </div>

    <div class="panel-body">
		<ul class="nav nav-tabs">
			<?php $i=0; ?>
			<?php foreach($tabs as $tabName => $panels): ?>
				<li <?= ($i==0) ? 'class="active"' : ''; ?>><a href="#<?= \Inflector::friendly_title($tabName); ?>" data-toggle="tab"><?= $tabName; ?></a></li>
				<?php $i++; ?>
			<?php endforeach; ?>
		</ul>

		<?= \Form::open(array('role' => 'form', 'class' => 'form-horizontal')); ?>
		<div class="tab-content">
			<?php $i=0; ?>
			<?php foreach($tabs as $tabName => $panels): ?>
				<div class="tab-pane <?= ($i==0) ? 'active' : ''; ?>" id="<?= \Inflector::friendly_title($tabName); ?>">
					<br/>
					<?php $nbPanel = 0; ?>
					<?php foreach($panels as $panelName => $panel): ?>
						<?php $nbPanel++; ?>
						<?php if($nbPanel == 1): ?>
							<div class="row">
						<?php endif; ?>

						<div class="col-md-4">
							<section class="panel <?= $panel['panel_class']; ?>">
								<div class="panel-heading">
									<?= $panelName; ?>
								</div>

								<div class="panel-body">
									<?php foreach($panel['configs'] as $key => $config): ?>
										<?php
											$name = 'configs['.$key.']';
											$nameFile = $name . '[file]';
											$nameType = $name . '[type]';
											$nameValue = $name . '[value]';
										?>
										<div class=" form-group">
											<label id="label_<?= $key; ?>" for="form_<?= $key; ?>" class="control-label col-lg-4"><?= $config['label']; ?></label>
											<div class="col-lg-8">
												<?php if($config['type'] == 'bool'): ?>
													<select class="form-control" id="form_<?= $key; ?>" name="<?= $nameValue; ?>">
														<?php if($form->field($nameValue)->get_attribute('value', $config['value'])): ?>
															<option value="0">Non</option>
															<option value="1" selected="selected">Oui</option>
														<?php else: ?>
															<option value="0" selected="selected">Non</option>
															<option value="1">Oui</option>
														<?php endif; ?>
													</select>
												<?php elseif($config['type'] == 'select'): ?>
													<select class="form-control" id="form_<?= $key; ?>" name="<?= $nameValue; ?>">
														<?php foreach($config['values'] as $optionLabel => $optionValue): ?>
															<?php
																if($form->field($nameValue)->get_attribute('value', $config['value']) == $optionValue)
																	$selected = 'selected="selected"';
																else
																	$selected = '';
															?>
															<option value="<?= $optionValue; ?>" <?= $selected; ?>><?= $optionLabel; ?></option> 
														<?php endforeach; ?>
													</select>
												<?php else: ?>
													<input type="text" class="form-control" id="form_<?= $key; ?>" name="<?= $nameValue; ?>" value="<?= $form->field($nameValue)->get_attribute('value', $config['value']); ?>">
												<?php endif; ?>

												<?= \Form::hidden($nameFile, $config['file']); ?>
												<?= \Form::hidden($nameType, $config['type']); ?>
											</div>
										</div> <?php // form-group ?>
									<?php endforeach; ?>	
								</div> <?php // panel-body ?>
							</section>
						</div> <?php // col-md-4 ?>

						<?php if($nbPanel == 3): ?>
							</div>
							<?php $nbPanel = 0; ?>
						<?php endif; ?>
						
					<?php endforeach; ?>
					<?php if($nbPanel > 0): ?></div><?php endif; ?>
				</div> <?php // pane ?>
				<?php $i++; ?>
			<?php endforeach; ?>
		</div>

		<?= \Form::submit('add', __('config.register'), array('class' => 'btn btn-primary')); ?>
		<?= \Form::close(); ?>

    </div>
</section>

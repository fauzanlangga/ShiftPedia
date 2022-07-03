<div class="post-head mb-4"> 
    <?php echo $title;?>
</div>  
<div class="blog card detail mb-4">
	<div class="card-body">  
		<?php if(!emptY($iden['maps'])) { ?>
		<div class="google-maps">
			<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo "$iden[maps]"; ?>"></iframe>
		</div>
		<?php } ?>
		<div class="card-text">			
			<?php echo "$rows[alamat]";?>
		</div>
		<?php echo form_open('contact-us');?>
			<?php  
				$alert = $this->session->flashdata('contact_message');   
				if( !empty($alert) && isset($alert['success'])) {?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						<?php echo $alert['success'];?>
					</div>
					<?php
				}
				if( !empty($alert) && isset($alert['warning'])) {?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						<?php echo $alert['warning'];?>
					</div>
					<?php
				}
			?>
			
			<div class="row">
				<div class="form-group col-md-6">
					<label>Nama *</label>
					<input type="text" placeholder="Nama" name='nama' required class="form-control" />
				</div>				
				<div class="form-group col-md-6">				
					<label>E-mail *</label>
					<input type="text" placeholder="E-mail" name='email' required class="form-control" />
				</div>
			</div> 			
			<div class="row">
				<div class="form-group col-md-12">
					<label for="c_message">Pesan<span class="required">*</span></label>
					<textarea rows="8" name='pesan' placeholder="Pesan" required class="form-control" ></textarea>
				</div>
			</div>  						
			<div class="row">
				<div class="col-md-12">
					<label >Kode Keamanan <span class="required">*</span></label>
				</div>
				<div class="form-group col-md-3">
					<label><?php echo $image; ?></label>
				</div>							
				<div class="form-group col-md-9">
					<input name='security_code' maxlength="6" type="text" class="form-control" required placeholder="Masukkkan kode di sebelah kiri..">
				</div>
			</div> 
			<div class="row">
				<div class="form-group col-md-12">
					<input type="submit" name="submit" class="btn btn-theme" value="Kirim" onclick="return confirm('Pesan anda ini akan kami balas melalui email ?')"/>
				</div>
			</div>	
		<?php echo form_close();?>
	</div> 
</div> 
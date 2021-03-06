<?php

use SSD\User;
use SSD\Form;
use SSD\Validation;
use SSD\Helper;


$id = $this->objUrl->get('id');

if (!empty($id)) {

	$objUser = new User();
	$user = $objUser->getUser($id);
	
	if (!empty($user)) {
	
		$objForm = new Form();
		$objValid = new Validation($objForm);
		
		if ($objForm->isPost('first_name')) {
			
			$objValid->expected = array(
				'first_name',
				'last_name',
				
				'address_1',
				'address_2',
				'town',
				'county',
				'post_code',
				'country',
				
				'ship_address_1',
				'ship_address_2',
				'ship_town',
				'ship_county',
				'ship_post_code',
				'ship_country',
				
				'email'
			);
			
			$objValid->required = array(
				'first_name',
				'last_name',
				'address_1',
				'town',
				'county',
				'post_code',
				'country',
				'email'
			);
			
			$objValid->special = array(
				'email' => 'email'
			);
			
			$email = $objForm->getPost('email');
			$duplicate = $objUser->getByEmail($email);
			
			if (!empty($duplicate) && $duplicate['id'] != $user['id']) {
				$objValid->add2Errors('email_duplicate');
			}
			
			if ($objValid->isValid()) {
				
				if ($objUser->updateUser($objValid->post, $user['id'])) {
					Helper::redirect($this->objUrl->getCurrent(array('action', 'id'), false, array('action', 'edited')));
				} else {
					Helper::redirect($this->objUrl->getCurrent(array('action', 'id'), false, array('action', 'edited-failed')));
				}
				
			}
			
		}
		
		require_once('_header.php'); 
?>
	
	<h1>Clients :: Edit</h1>
	
	<form action="" method="post">
		<table cellpadding="0" cellspacing="0" border="0" class="tbl_insert">
			
			<tr>
				<th><label for="first_name">First name: *</label></th>
				<td>
					<?php echo $objValid->validate('first_name'); ?>
					<input type="text" name="first_name"
						id="first_name" class="fld" 
						value="<?php echo $objForm->stickyText('first_name', $user['first_name']); ?>" />
				</td>
			</tr>
			
			<tr>
				<th><label for="last_name">Last name: *</label></th>
				<td>
					<?php echo $objValid->validate('last_name'); ?>
					<input type="text" name="last_name"
						id="last_name" class="fld" 
						value="<?php echo $objForm->stickyText('last_name', $user['last_name']); ?>" />
				</td>
			</tr>
			
			<tr>
				<th><label for="email">Email address: *</label></th>
				<td>
					<?php echo $objValid->validate('email'); ?>
					<input type="text" name="email"
						id="email" class="fld" 
						value="<?php echo $objForm->stickyText('email', $user['email']); ?>" />
				</td>
			</tr>
			
		</table>
		
		<h3>Billing address</h3>
		
		<table cellpadding="0" cellspacing="0" border="0" class="tbl_insert">
			<tr>
				<th><label for="address_1">Address 1: *</label></th>
				<td>
					<?php echo $objValid->validate('address_1'); ?>
					<input type="text" name="address_1"
						id="address_1" class="fld" 
						value="<?php echo $objForm->stickyText('address_1', $user['address_1']); ?>" />
				</td>
			</tr>
			
			<tr>
				<th><label for="address_2">Address 2:</label></th>
				<td>
					<?php echo $objValid->validate('address_2'); ?>
					<input type="text" name="address_2"
						id="address_2" class="fld" 
						value="<?php echo $objForm->stickyText('address_2', $user['address_2']); ?>" />
				</td>
			</tr>
			
			<tr>
				<th><label for="town">Town: *</label></th>
				<td>
					<?php echo $objValid->validate('town'); ?>
					<input type="text" name="town"
						id="town" class="fld" 
						value="<?php echo $objForm->stickyText('town', $user['town']); ?>" />
				</td>
			</tr>
			
			<tr>
				<th><label for="county">County: *</label></th>
				<td>
					<?php echo $objValid->validate('county'); ?>
					<input type="text" name="county"
						id="county" class="fld" 
						value="<?php echo $objForm->stickyText('county', $user['county']); ?>" />
				</td>
			</tr>
			
			<tr>
				<th><label for="post_code">Post code: *</label></th>
				<td>
					<?php echo $objValid->validate('post_code'); ?>
					<input type="text" name="post_code"
						id="post_code" class="fld" 
						value="<?php echo $objForm->stickyText('post_code', $user['post_code']); ?>" />
				</td>
			</tr>
			
			<tr>
				<th><label for="country">Country: *</label></th>
				<td>
					<?php echo $objValid->validate('country'); ?>
					<?php echo $objForm->getCountriesSelect($user['country']); ?>
				</td>
			</tr>
			
		</table>
		
		<h3>Shipping address</h3>
		
		<table cellpadding="0" cellspacing="0" border="0" class="tbl_insert">
			<tr>
				<th><label for="ship_address_1">Address 1:</label></th>
				<td>
					<?php echo $objValid->validate('address_1'); ?>
					<input type="text" name="ship_address_1"
						id="ship_address_1" class="fld" 
						value="<?php echo $objForm->stickyText('ship_address_1', $user['ship_address_1']); ?>" />
				</td>
			</tr>
			
			<tr>
				<th><label for="ship_address_2">Address 2:</label></th>
				<td>
					<?php echo $objValid->validate('address_2'); ?>
					<input type="text" name="ship_address_2"
						id="ship_address_2" class="fld" 
						value="<?php echo $objForm->stickyText('ship_address_2', $user['ship_address_2']); ?>" />
				</td>
			</tr>
			
			<tr>
				<th><label for="ship_town">Town:</label></th>
				<td>
					<?php echo $objValid->validate('town'); ?>
					<input type="text" name="ship_town"
						id="ship_town" class="fld" 
						value="<?php echo $objForm->stickyText('ship_town', $user['ship_town']); ?>" />
				</td>
			</tr>
			
			<tr>
				<th><label for="ship_county">County:</label></th>
				<td>
					<?php echo $objValid->validate('county'); ?>
					<input type="text" name="ship_county"
						id="ship_county" class="fld" 
						value="<?php echo $objForm->stickyText('ship_county', $user['ship_county']); ?>" />
				</td>
			</tr>
			
			<tr>
				<th><label for="ship_post_code">Post code:</label></th>
				<td>
					<?php echo $objValid->validate('post_code'); ?>
					<input type="text" name="ship_post_code"
						id="ship_post_code" class="fld" 
						value="<?php echo $objForm->stickyText('ship_post_code', $user['ship_post_code']); ?>" />
				</td>
			</tr>
			
			<tr>
				<th><label for="ship_country">Country:</label></th>
				<td>
					<?php echo $objValid->validate('country'); ?>
					<?php echo $objForm->getCountriesSelect($user['ship_country'], 'ship_country', true); ?>
				</td>
			</tr>
			
		</table>
		
		
		<table cellpadding="0" cellspacing="0" border="0" class="tbl_insert">	
			
			<tr>
				<td>
					<label for="btn" class="sbm sbm_blue fl_l">
					<input type="submit"
						id="btn" class="btn" value="Update" />
					</label>
				</td>
			</tr>
			
		</table>
	</form>

<?php 
		require_once('_footer.php'); 
	}
} 	
?>
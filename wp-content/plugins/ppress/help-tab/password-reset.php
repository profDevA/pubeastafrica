<?php
return <<<DOC

<table class="widefat">
	<thead>
	<tr>
		<th>Shortcodes</th>
		<th>Description</th>
		<th class="row-title">Attributes</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td><strong>[user-login]</strong></td>
		<td>Output the username/email field for the password reset form</td>
		<td>
			<p><strong>title</strong>: &nbsp; advisory information about the field</p>
			<p><strong>class</strong>: &nbsp; space-separated list of the CSS classes</p>
			<p><strong>placeholder</strong>: &nbsp; short hint that describes the expected value of the field</p>
			<p><strong>id</strong>: &nbsp; unique identifier to identify the field.</p>
			<p><strong>value</strong>: the initial value present in the field.</p>
		</td>
	</tr>
	<tr>
		<td><strong>[reset-submit]</strong></td>
		<td>Output a submit button of the password reset form</td>
		<td>
			<p><strong>title</strong>: &nbsp; advisory information about the field.</p>
			<p><strong>class</strong>: &nbsp; space-separated list of the CSS classes.</p>
			<p><strong>id</strong>: &nbsp; unique identifier to identify the element.</p>
			<p><strong>value</strong>: the submit button text.</p>
		</td>
	</tr>
	</tbody>
	<tfoot>
	<tr>
		<th>Shortcodes</th>
		<th>Description</th>
		<th class="row-title">Attributes</th>
	</tr>
	</tfoot>
</table>
DOC;

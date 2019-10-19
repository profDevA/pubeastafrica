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
		<td><strong>[login-username]</strong></td>
		<td>Output a username field for the login form</td>
		<td>
			<p><strong>title</strong>: &nbsp; advisory information about the field</p>
			<p><strong>class</strong>: &nbsp; space-separated list of the CSS classes</p>
			<p><strong>placeholder</strong>: &nbsp; short hint that describes the expected value of the field</p>
			<p><strong>id</strong>: &nbsp; unique identifier to identify the field.</p>
			<p><strong>value</strong>: the initial value present in the field.</p>
		</td>
	</tr>
	<tr>
		<td><strong>[login-password]</strong></td>
		<td>Output a password field for the login form</td>
		<td>
			<p><strong>title</strong>: &nbsp; advisory information about the field.</p>
			<p><strong>class</strong>: &nbsp; space-separated list of the CSS classes</p>
			<p><strong>placeholder</strong>: &nbsp; short hint that describes the expected value of the field</p>
			<p><strong>id</strong>: &nbsp; unique identifier to identify the field.</p>
			<p><strong>value</strong>: the initial value present in the field.</p>
		</td>
	</tr>
	<tr>
		<td><strong>[login-remember]</strong></td>
		<td>Output a remember-me checkbox for the login form</td>
		<td>
			<p><strong>title</strong>: &nbsp; advisory information about the field.</p>
			<p><strong>class</strong>: &nbsp; space-separated list of the CSS classes.</p>
			<p><strong>id</strong>: &nbsp; unique identifier to identify the field.</p>
		</td>
	</tr>
	<tr>
		<td><strong>[login-submit]</strong></td>
		<td>Output a submit button for the login form</td>
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

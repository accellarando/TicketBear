<?php
function printTicket($ticket, $users, $clearance){
?>

<td class="clickable"><?php echo $ticket->name;?></td>
<td class="clickable"><?php echo $ticket->description; ?></td>
<td class="clickable"><?php echo $ticket->status; ?></td>
<td class="clickable"><?php echo $ticket->category; ?></td>
<td class="clickable"><?php echo $ticket->email; ?></td>
<td class="clickable"><?php echo $ticket->priority; ?></td>
<?php if($clearance === "admin"): ?>
    <td class="clickable"><?php echo $ticket->assigned; ?></td>
<?php endif; ?>
<td class="clickable"><?php echo $ticket->completed == 1 ? "Yes" : "No"; ?></td>
<td class="clickable"><?php echo $ticket->created_at; ?></td>
<td class="clickable"><?php echo $ticket->updated_at; ?></td>
<?php if($clearance === "admin"): ?>
<td>
    <select onchange='assign(<?php echo $ticket->id; ?>,this.value)'>
        <?php foreach($users as $user): ?>
        <!-- todo: mark the selected one as such -->
            <option><?php echo $user->name; ?></option>
        <?php endforeach; ?>
    </select>
</td>
<?php endif; ?>
<?php } ?>

<?php
function printTicket($ticket, $users, $clearance){
?>

<td><?php echo $ticket->name;?></td>
<td><?php echo $ticket->description; ?></td>
<td><?php echo $ticket->status; ?></td>
<td><?php echo $ticket->category; ?></td>
<td><?php echo $ticket->email; ?></td>
<td><?php echo $ticket->priority; ?></td>
<td><?php echo $ticket->assigned_to; ?></td>
<td><?php echo $ticket->completed == 1 ? "Yes" : "No"; ?></td>
<td><?php echo $ticket->created_at; ?></td>
<td><?php echo $ticket->updated_at; ?></td>
<?php if($clearance === "admin"): ?>
<td>
    <select onchange='doSomething()'>
        <?php foreach($users as $user): ?>
            <option><?php echo $user->name; ?></option>
        <?php endforeach; ?>
    </select>
</td>
<?php endif; ?>
<?php } ?>
